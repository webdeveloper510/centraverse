<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Meeting;
use App\Models\Lead;
use App\Models\Payment;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use Barryvdh\DomPDF\Facade\Pdf;
Use App\Models\PaymentInfo;
use App\Models\PaymentLogs;

class BillingController extends Controller
{
    public $paypalClient;
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        if (\Auth::user()->type == 'owner') {
            $billing = Billing::all();
            $status = Billing::$status;
            $events = Meeting::all();
            return view('billing.index', compact('billing','events'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type,$id)
    {
        if (\Auth::user()->type == 'owner') {
            $event = Meeting::find($id);
            return view('billing.create', compact('type','id','event'));
        }
    }
    // public function createbill($type,$id){
      
    //     return view('billing.a',compact('type','id','event'));
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,$id)
    {
        $items = $request->billing;
        $totalCost = 0;
        foreach ($items as $item) {
            $totalCost += $item['cost'] * $item['quantity'];
        }
        $totalCost = $totalCost + 7* ($totalCost)/100 + 20 * ($totalCost)/100 - $request->deposits;
        $billing = new Billing();
        $billing['event_id'] = $id;
        $billing['data'] = serialize($items);
        $billing['status'] = 1;
        $billing['deposits'] = $request->deposits;
        $billing->save();
        Meeting::where('id',$id)->update(['total' => $totalCost ,'status' => 2]);
        return redirect()->back()->with('success', __('Billing Created'));
     
    }
    /**
     * Display the specified resource.
    */
    public function show(string $id)
    {
        $billing = Billing::where('event_id',$id)->first();
        $event = Meeting::where('id',$id)->first();
        return view('billing.view',compact('billing','event'));
    }

    public function destroy(string $id)
    {
        $billing = Billing::where('event_id',$id)->first();

        $billing->delete();
        return redirect()->back()->with('success', 'Bill Deleted!');
    }
    public function get_event_info(Request $request)
    {
        $event_info = Meeting::where('id', $request->id)->get();
        return $event_info;
    }
    public function payviamode($id)
    {
        $new_id = decrypt(urldecode($id));
        return view('billing.paymentview', compact('new_id'));
    }
    public function paymentinformation($id){
        $event = Meeting ::find($id);
        $payment = PaymentInfo::where('event_id',$id)->orderBy('id', 'DESC')->first();
        return view('billing.pay-info',compact('event','payment'));
    }
    public function paymentupdate(Request $request, $id){
        $payment = new PaymentInfo();
        $payment->event_id = $id;
        $payment->amount = $request->amount;
        $payment->date = $request->date;
        $payment->deposits = $request->deposits;
        $payment->adjustments = $request->adjustments;
        $payment->latefee = $request->latefee;
        $payment->adjustmentnotes = $request->adjustmentnotes;
        $payment->paymentref = $request->paymentref;
        $payment->modeofpayment = $request->mode;
        $payment->notes = $request->notes;
        $balance = $request->balance;
        $event = Meeting::find($id);
        $payment->save();
        if($request->mode == 'credit'){
            return view('payments.pay',compact('balance','event'));
        }else{
            PaymentLogs::create([
                'amount' => $balance,
                'transaction_id' => $request->paymentref,
                'name_of_card' => $event->name,
                'event_id' =>$id
            ]);
        }
         return redirect()->back()->with('success','Payment Information Updated Sucessfully');
    }
    // public function stripe_payment_view($meeting)
    // {
    //     $id = decrypt(urldecode($meeting));
    //     Stripe::setApiKey('sk_test_51NsfMiSB2Q4XHHYWytwO10vqV2boVj3Gd2bQE9yZSMKPGuSbymUbnBRu1pj2huE98VItbVcVG9wUhbYIbnyvAzoj00zU4tEl47');
    //     $user = Meeting::where('id', $id)->get();

    //     $amount = $user[0]->total * 100;

    //     $intent = PaymentIntent::create([
    //         'amount' => (int) $amount,
    //         'currency' => 'usd',
    //     ]);

    //     $session = Session::create([
    //         'payment_method_types' => ['card'],
    //         'line_items' => [
    //             [
    //                 'price_data' => [
    //                     'currency' => 'usd',
    //                     'product_data' => [
    //                         'name' => 'The Bond 1786',
    //                     ],
    //                     'unit_amount' => (int) $amount,
    //                 ],
    //                 'quantity' => 1,
    //             ],
    //         ],
    //         'mode' => 'payment',
    //         'success_url' =>  url('/payment-success?meeting_id=' . $meeting . '&session_id={CHECKOUT_SESSION_ID}'),
    //         'cancel_url' =>   url('/payment-failed'),
    //     ]);
    //     header('Location: ' . $session->url);
    //     exit;
    // }

    // public function paypal_payment_view($meeting)
    // {
    //     $id = decrypt(urldecode($meeting));

    //     $user = Meeting::where('id', $id)->first();
    //     $amount = $user->total;

    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $paypalToken = $provider->getAccessToken();
    //     $response = $provider->createOrder([
    //         "intent" => "CAPTURE",
    //         "application_context" => [
    //             "return_url" => url('/paypal-payment-success'),
    //             "cancel_url" => url('/payment-failed'),
    //         ],
    //         "purchase_units" => [
    //             0 => [
    //                 "amount" => [
    //                     "currency_code" => "USD",
    //                     "value" => $amount
    //                 ]
    //             ]
    //         ]
    //     ]);

    //     if (isset($response['id']) && $response['id'] != null) {
    //         foreach ($response['links'] as $links) {
    //             if ($links['rel'] == 'approve') {
    //                 session(['meeting_id' => $meeting]);
    //                 return redirect()->away($links['href']);
    //             }
    //         }
    //         return redirect()
    //             ->route('createTransaction')
    //             ->with('error', 'Something went wrong.');
    //     } else {
    //         return redirect()
    //             ->route('createTransaction')
    //             ->with('error', $response['message'] ?? 'Something went wrong.');
    //     }
    // }

    // public function welcome()
    // {
    //     $event_id = decrypt(urldecode($_REQUEST['meeting_id']));

    //     $stripe = new \Stripe\StripeClient('sk_test_51NsfMiSB2Q4XHHYWytwO10vqV2boVj3Gd2bQE9yZSMKPGuSbymUbnBRu1pj2huE98VItbVcVG9wUhbYIbnyvAzoj00zU4tEl47');
    //     $session_id = $_REQUEST['session_id'];
    //     $session = $stripe->checkout->sessions->retrieve($session_id, []);

    //     $name = $session->customer_details->name;
    //     $email = $session->customer_details->email;
    //     $payment_intent = $session->payment_intent;
    //     $payment_status = $session->payment_status;
    //     $total_amount = $session->amount_subtotal / 100;

    //     $payment = new Payment;
    //     $payment->event_id = $event_id;
    //     $payment->name = $name;
    //     $payment->email = $email;
    //     $payment->payment_intent = $payment_intent;
    //     $payment->payment_status = $payment_status;
    //     $payment->amount_paid = $total_amount;
    //     $payment->save();   
    //     // Mail::to($email)->send(new \App\Mail\Invoicemail($name,$email));

    //     return view('calendar.welcome');
    // }
    public function estimationview($id){
        $id =  decrypt(urldecode($id));
        $billing = Billing::where('event_id',$id)->first();
        $event = Meeting::find($id);
        $data = [
            'event'=>$event,
            'billing_data' => unserialize($billing->data),
            'billing' => $billing
        ];
        $pdf = Pdf::loadView('billing.estimateview', $data);
        return $pdf->stream('estimate.pdf');
    }
}