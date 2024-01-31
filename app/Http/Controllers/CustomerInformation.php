<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Emailcontent;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Campaignmail;

class CustomerInformation extends Controller
{
    public function index(){
       $customers = Lead::all();
       $emailtemplates = Emailcontent::all();
       return view('customer.index',compact('customers','emailtemplates'));
    }
    public function sendmail(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'template'=>'required',
                'customer'=>'required'
            ]);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $template = Emailcontent::where('id',$request->template)->first();
        $customers = $request->customer;
        $settings = Utility::settings();
        // foreach($customers as $customer){
        //     Mail::to($customer)->send(new Campaignmail($template));
        //     echo"<br>";
        //     print_r($customer);
        // }
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

            Mail::to('sonali@codenomad.net')->send(new Campaignmail($template));
        } catch (\Exception $e) {
              return redirect()->back()->with('error', 'Email Not Sent');
        }
        return redirect()->back()->with('success', 'Email Sent Successfully');
    }
}
