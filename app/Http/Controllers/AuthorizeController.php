<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\PaymentLogs;
use App\Models\PaymentInfo;
use App\Models\Billing;
use App\Models\Utility;
use Illuminate\Http\Request;
use App\Mail\InvoicePaymentMail;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Mail;
use PDF;
use Storage;
use App\Models\User;

class AuthorizeController extends Controller
{
    public function pay($id) {
        $id = decrypt(urldecode($id));
        $event = Meeting::where('id',$id)->first();
        $collectpayment = PaymentInfo::where('event_id',$id)->orderby('id','desc')->first();

        return view('payments.pay',compact('event','collectpayment'));
    }
    public function handleonlinepay(Request $request ,$id) {
   
        $id = decrypt(urldecode($id));
        $event = Meeting::find($id);
        $input = $request->all();
        $settings = Utility::settings();
        /* Create a merchantAuthenticationType object with authentication details
        retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('MERCHANT_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('MERCHANT_TRANSACTION_KEY'));
        
        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($input['cardNumber']);
        $creditCard->setExpirationDate($input['expiration-year'] .'-'. $input['expiration-month']);
        $creditCard->setCardCode($input['cvv']);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($input['amount']);
        $transactionRequestType->setPayment($paymentOne);
      
        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        
        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();
            

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    // echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                    // echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                    // echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                    // echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                    // echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";

                        $msg_type = 'success_msg';
                        $message_text = $tresponse->getMessages()[0]->getDescription().' Transaction ID:'.$tresponse->getTransId();
                         $newpayment = new PaymentLogs();
                         $newpayment->event_id = $id;
                         $newpayment->amount = $input['amount'];
                         $newpayment->response_code = $tresponse->getResponseCode();
                         $newpayment->transaction_id = $tresponse->getTransId();
                         $newpayment->auth_id = $tresponse->getAuthCode();
                         $newpayment->message_code =  $tresponse->getMessages()[0]->getCode();
                         $newpayment->name_of_card =  $input['owner'];
                         $newpayment->save();

                       
                        $paymentinfo = PaymentInfo::where('event_id',$id)->orderby('id','desc')->first();
                        $payhistory = PaymentLogs::where('event_id',$id)->get();
                        $deposit = Billing::where('event_id',$id)->first()->deposits;
                        $totalpaid = 0;
                        foreach ($payhistory as $key => $value) {
                          $totalpaid+= $value->amount;
                        }
                        $info = PaymentInfo::where('event_id',$event->id)->get();
                        $latefee = 0;
                        $adjustments = 0;
                        foreach($info as $inf){
                        $latefee += $inf->latefee;
                        $adjustments += $inf->adjustments;
                        }
                        $data=[
                            'paymentinfo' =>$paymentinfo,
                            'paymentlog'=>$newpayment,
                            'event' =>$event,
                            'totalpaid'=>$totalpaid,
                            'deposit' =>$deposit,
                            'adjustments'=>$adjustments,
                            'latefee'=>$latefee,
                        
                        ];
                        $pdf = PDF::loadView('billing.mail.inv', $data);
                        return $pdf->stream('invoice.pdf');          
                        try {
                            $filename = 'invoice_' . time() . '.pdf'; // You can adjust the filename as needed
                            $folder = 'Invoice/' . $id; 
                            $path = Storage::disk('public')->put($folder . '/' . $filename, $pdf->output());
                            $newpayment->update(['invoices' => $filename]);
                        } catch (\Exception $e) {
                            // Log the error for future reference
                            \Log::error('File upload failed: ' . $e->getMessage());
                            // Return an error response
                            return response()->json([
                                'is_success' => false,
                                'message' => 'Failed to save PDF: ' . $e->getMessage(),
                            ]);
                        }
                        try {
                            config(
                                [
                                    'mail.driver'       => $settings['mail_driver'],
                                    'mail.host'         => $settings['mail_host'],
                                    'mail.port'         => $settings['mail_port'],
                                    'mail.username'     => $settings['mail_username'],
                                    'mail.password'     => $settings['mail_password'],
                                    'mail.from.address' => $settings['mail_from_address'],
                                    'mail.from.name'    => $settings['mail_from_name'],
                                ]
                            );
                            $users = User::where('type','owner')->orwhere('type','Admin')->get();
                            foreach ($users as  $user) {
                                Mail::to($event->email)->cc($user->email)->send(new InvoicePaymentMail($newpayment));
                            }
                            
                            // $payinfo = PaymentInfo::where('event_id',$id)->first();
                            $halfpay = ($event->total)/2;
                            // $amountpaid = 0 ;
                            // foreach($paymentpayhistory as $pay){
                            //     $amountpaid += $pay->amount;
                            // }
                            $amountlefttobepaid = $event->total - ( $totalpaid + $deposit - $latefee + $adjustments) ;
                           
                            if($amountlefttobepaid == 0 || $amountlefttobepaid <= 0){
                                Billing::where('event_id',$id)->update(['status' => 4]);
                            }elseif($amountlefttobepaid ==  $halfpay || $amountlefttobepaid >=  $halfpay){
                                Billing::where('event_id',$id)->update(['status' => 3]);
                            }elseif($amountlefttobepaid <= $halfpay  ){
                                Billing::where('event_id',$id)->update(['status' => 2]);
                            }
                            $data =  Billing::where('event_id',$id)->get();
                            // Billing::where('event_id',$id)->update(['status' => 4]);
                            return view('calendar.welcome')->with('success',$message_text);
                        } catch (\Exception $e) {
                            //   return response()->json(
                            //             [
                            //                 'is_success' => false,
                            //                 'message' => $e->getMessage(),
                            //             ]
                            //         );
                           
                            return redirect()->route('billing.index')->with('success', 'Email Not Sent');
                        }
                } else {
                    echo "Transaction Failed \n";
                    if ($tresponse->getErrors() != null) {
                        echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                        echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";

                        $msg_type = 'error_msg';
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $msg_type = 'error_msg';
                $message_text = 'Transaction Failed ';
                // echo "\n";
                $tresponse = $response->getTransactionResponse();
                if ($tresponse != null && $tresponse->getErrors() != null) {
                    echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                    echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";

                    $msg_type = 'error_msg';
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                } else {
                    echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                    echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";

                    $msg_type = 'error_msg';
                    $message_text = $response->getMessages()->getMessage()[0]->getText();
                }
            }
        } else {
            $msg_type = 'error_msg';
            $message_text = 'No reponse returned';
        }
        return view('calendar.paymentfailed')->with('error', $message_text);
    }
}