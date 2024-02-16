<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Emailcontent;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Campaignmail;
use App\Imports\UsersImport;
use App\Models\UserImport;
use Maatwebsite\Excel\Facades\Excel;

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
    public function campaigntype(Request $request){
        $type = $request->type;
        $settings=  Utility::settings();
        $campaign = explode(',',$settings['campaign_type']);
        $filteredArray = array_filter($campaign, function($item) use ($type) {
            return stripos($item, $type) !== false;
        });
        return $filteredArray;
    }
    public function existinguserlist(){
        $leadsuser = Lead::all();
        return view('customer.existingleads',compact('leadsuser'));
    }
    public function addusers(){
        $users = UserImport::all();
        return view('customer.new_user',compact('users'));
    }
    public function uploaduserlist(){
        return view('customer.uploaduserinfo');
    }
    public function importuser(Request $request) 
    {
        Excel::import(new UsersImport,request()->file('users'));
        return back();
    }
    public function mailformatting(){
        return view('customer.editor');
    }
    public function textmailformatting(){
        return view('customer.textmail');
    }
    public function addeduserlist(){
        $users = UserImport::all();
        return view('customer.addeduserlist',compact('users'));
    }
}
