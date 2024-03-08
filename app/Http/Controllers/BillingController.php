<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Meeting;
use App\Models\Lead;
use App\Models\Payment;
use App\Models\Billingdetail;
// use Mpdf\Mpdf;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\SendPdfEmail;
// use App\Mail\SendBillingMail;
// use Barryvdh\DomPDF\Facade\Pdf;
// use App\Models\Utility;
// use PayPal;
use App\Mail\Invoicemail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalHttp\HttpException;
use Mail;

class BillingController extends Controller
{
    public $paypalClient;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\Auth::user()->type == 'owner') {
            $billing = Billingdetail::all();
            $status = Billingdetail::$status;
            $events = Meeting::where('status',2)->get();
            return view('billing.index', compact('billing','events'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (\Auth::user()->type == 'owner') {
            $meeting    = Meeting::get();
            $billing = Billing::first();
            return view('billing.create', compact('billing', 'meeting'));
        }
    }
    public function createbill($type,$id){
        $event = Meeting::find($id);
        return view('billing.a',compact('type','id','event'));
        // $meeting    = Meeting::get();
        // $billing = Billing::first();
        // return view('billing.create', compact('billing', 'meeting'));
        // if (\Auth::user()->type == 'owner') {
            // $meeting    = Meeting::get();
            // $billing = Billing::first();
            // return view('billing.a');
        // }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // $validator = \Validator::make(
        //     $request->all(),
        //     [
        //         'event' => 'required|unique:billindetails,event_id',
        //     ],
        //     [
        //         'event.unique' => 'Billing already exists for this event'
        //     ]
        // );
        // if ($validator->fails()) {
        //     $messages = $validator->getMessageBag();

        //     return redirect()->back()->with('error', $messages->first());
        // }
        $event_info = Meeting::where('id', $request->event)->first();
        $billingdetails = new Billingdetail();
        $billingdetails['event_id'] = $request->event;
        $billingdetails['venue_rental'] = serialize($request->billing['venue_rental']);
        $billingdetails['hotel_rooms'] = serialize($request->billing['hotel_rooms']);
        $billingdetails['equipment'] = serialize($request->billing['equipment']);
        $billingdetails['setup'] = serialize($request->billing['setup']);
        $billingdetails['bar'] = serialize($request->billing['gold_2hrs']);
        $billingdetails['special_req'] = serialize($request->billing['special_req']);
        $billingdetails['food'] = serialize($request->billing['classic_brunch']);
        $billingdetails['created_by'] = \Auth::user()->creatorId();
        $billingdetails->save();
      
        return redirect()->back()->with('success', __('Billing Created'));
     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billingdetail $billing)
    {
        $assigned_user = Lead::all();
        return view('billing.edit', compact('billing', 'assigned_user'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $billing = Billingdetail::find($id);

        $billing->delete();
        return redirect()->back()->with('success', 'Bill Deleted!');
    }
    public function get_event_info(Request $request)
    {
        $event_info = Meeting::where('id', $request->id)->get();
        return $event_info;
    }
    // public function billpaymenturl(Request $request){
    //     $settings = Utility::settings();
    //     $meeting = Meeting::find($request->id);
    //     $meeting->update(['total'=>$request->total]);
    //     try {
    //         config(
    //             [
    //                 'mail.driver'       => $settings['mail_driver'],
    //                 'mail.host'         => $settings['mail_host'],
    //                 'mail.port'         => $settings['mail_port'],
    //                 'mail.username'     => $settings['mail_username'],
    //                 'mail.password'     => $settings['mail_password'],
    //                 'mail.from.address' => $settings['mail_from_address'],
    //                 'mail.from.name'    => $settings['mail_from_name'],
    //             ]
    //         );

    //     Mail::to('sonali@codenomad.net')->send(new SendBillingMail($meeting));
    //     } catch (\Exception $e) {
    //         return response()->json(
    //             [
    //                 'is_success' => false,
    //                 'message' => $e->getMessage(),
    //             ]
    //         );
    //     }
    //     return true;
    // }
    public function payviamode($id)
    {
        $new_id = decrypt(urldecode($id));
        return view('billing.paymentview', compact('new_id'));
    }

    public function stripe_payment_view($meeting)
    {
        $id = decrypt(urldecode($meeting));
        Stripe::setApiKey('sk_test_51NsfMiSB2Q4XHHYWytwO10vqV2boVj3Gd2bQE9yZSMKPGuSbymUbnBRu1pj2huE98VItbVcVG9wUhbYIbnyvAzoj00zU4tEl47');
        $user = Meeting::where('id', $id)->get();

        $amount = $user[0]->total * 100;

        $intent = PaymentIntent::create([
            'amount' => (int) $amount,
            'currency' => 'usd',
        ]);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'The Bond 1786',
                        ],
                        'unit_amount' => (int) $amount,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' =>  url('/payment-success?meeting_id=' . $meeting . '&session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' =>   url('/payment-failed'),
        ]);
        header('Location: ' . $session->url);
        exit;
    }

    public function paypal_payment_view($meeting)
    {
        $id = decrypt(urldecode($meeting));

        $user = Meeting::where('id', $id)->first();
        $amount = $user->total;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => url('/paypal-payment-success'),
                "cancel_url" => url('/payment-failed'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    session(['meeting_id' => $meeting]);
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function welcome()
    {
        $event_id = decrypt(urldecode($_REQUEST['meeting_id']));

        $stripe = new \Stripe\StripeClient('sk_test_51NsfMiSB2Q4XHHYWytwO10vqV2boVj3Gd2bQE9yZSMKPGuSbymUbnBRu1pj2huE98VItbVcVG9wUhbYIbnyvAzoj00zU4tEl47');
        $session_id = $_REQUEST['session_id'];
        $session = $stripe->checkout->sessions->retrieve($session_id, []);

        $name = $session->customer_details->name;
        $email = $session->customer_details->email;
        $payment_intent = $session->payment_intent;
        $payment_status = $session->payment_status;
        $total_amount = $session->amount_subtotal / 100;

        $payment = new Payment;
        $payment->event_id = $event_id;
        $payment->name = $name;
        $payment->email = $email;
        $payment->payment_intent = $payment_intent;
        $payment->payment_status = $payment_status;
        $payment->amount_paid = $total_amount;
        $payment->save();   
        // Mail::to($email)->send(new \App\Mail\Invoicemail($name,$email));

        Billingdetail::where('event_id', $event_id)->update(['status' => 2]);
        return view('calendar.welcome');
    }

}
