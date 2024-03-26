<?php

namespace App\Http\Controllers;

use App\Models\Billingdetail;
use App\Models\Meeting;
use App\Models\PaymentLogs;
use Illuminate\Http\Request;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeController extends Controller
{
    public function pay($id) {
        $id = decrypt(urldecode($id));
        $event = Meeting::where('id',$id)->first();
        return view('payments.pay',compact('event'));
    }
    public function handleonlinepay(Request $request ,$id) {
        $input = $request->all();

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

    // // Create order information
    // $order = new AnetAPI\OrderType();
    // $order->setInvoiceNumber("10101");
    // $order->setDescription("Golf Shirts");

    // // Set the customer's Bill To address
    // $customerAddress = new AnetAPI\CustomerAddressType();
    // $customerAddress->setFirstName("Ellen");
    // $customerAddress->setLastName("Johnson");
    // $customerAddress->setCompany("Souveniropolis");
    // $customerAddress->setAddress("14 Main Street");
    // $customerAddress->setCity("Pecan Springs");
    // $customerAddress->setState("TX");
    // $customerAddress->setZip("44628");
    // $customerAddress->setCountry("USA");

    // // Set the customer's identifying information
    // $customerData = new AnetAPI\CustomerDataType();
    // $customerData->setType("individual");
    // $customerData->setId("99999456654");
    // $customerData->setEmail("EllenJohnson@example.com");

    // // Add values for transaction settings
    // $duplicateWindowSetting = new AnetAPI\SettingType();
    // $duplicateWindowSetting->setSettingName("duplicateWindow");
    // $duplicateWindowSetting->setSettingValue("60");

    // // Add some merchant defined fields. These fields won't be stored with the transaction,
    // // but will be echoed back in the response.
    // $merchantDefinedField1 = new AnetAPI\UserFieldType();
    // $merchantDefinedField1->setName("customerLoyaltyNum");
    // $merchantDefinedField1->setValue("1128836273");

    // $merchantDefinedField2 = new AnetAPI\UserFieldType();
    // $merchantDefinedField2->setName("favoriteColor");
    // $merchantDefinedField2->setValue("blue");

    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setAmount($input['amount']);
    $transactionRequestType->setPayment($paymentOne);
    // $transactionRequestType->setOrder($order);
    // $transactionRequestType->setBillTo($customerAddress);
    // $transactionRequestType->setCustomer($customerData);
    // $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    // $transactionRequestType->addToUserFields($merchantDefinedField1);
    // $transactionRequestType->addToUserFields($merchantDefinedField2);

    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    
    // dd($response);

    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();
            echo"<pre>";print_r($tresponse);die;
            if ($tresponse != null && $tresponse->getMessages() != null) {
                echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";

                    $msg_type = 'success_msg';
                    $message_text = $tresponse->getMessages()[0]->getDescription().' Transaction ID:'.$tresponse->getTransId();

                    PaymentLogs::create([
                        'amount' => $input['amount'],
                        'response_code' =>  $tresponse->getResponseCode(),
                        'transaction_id' =>  $tresponse->getTransId(),
                        'auth_id' =>  $tresponse->getAuthCode(),
                        'message_code' =>  $tresponse->getMessages()[0]->getCode(),
                        'name_of_card' =>  $input['owner'],
                        'qty' =>  1,
                    ]);
                    Billingdetail::where('event_id', $id)->update(['status' => 2]);
                    return view('calendar.welcome')->with('success',$message_text);
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
    return view('calendar.paymentfailed')->with($msg_type, $message_text);
    // return back()->with($msg_type,$message_text);
    }
}
// Billingdetail::where('event_id', $event_id)->update(['status' => 2]);
// return view('calendar.welcome');