<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Emailcontent;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\CampaigntextMail;
use App\Imports\UsersImport;
use App\Mail\SendCampaignMail;
use App\Models\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use App\Models\Campaigndata;
use Twilio\Rest\Client;

class CustomerInformation extends Controller
{
    public function index(){
       $customers = Lead::all();
       $emailtemplates = Emailcontent::all();
       $leadsuser = Lead::all();
       $users = UserImport::all();
       $campaign= Campaigndata::all();
       return view('customer.index',compact('customers','emailtemplates','leadsuser','users','campaign'));
    }
    public function sendmail(Request $request){
        $validator = \Validator::make(
            $request->all(),
            [
                'description'=>'required',
                'type' => 'required|max:120',
                'recipients' => 'required',
                'title' => 'required',
            ]);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $content = $request->content;
        $campaignlist = new Campaigndata();
        $campaignlist['type'] = $request->type;
        $campaignlist['title'] =$request->title;
        $campaignlist['recipients'] =$request->recepient_names;
        $campaignlist['content'] =$content;
        $campaignlist['template'] =$request->template_html;
        $campaignlist['description'] = $request->description;
        $campaignlist->save();

        $notifyvia = $request->notify[1][0];
        $attachment = $request->file('document');
        if($attachment){
            $attachmentPath = $attachment->store('attachments', 'public');
        }
        if($notifyvia != "email"){
            $users = explode(',',$request->recepient_names);
            foreach($users as $user){
                $lead = Lead::where('email',$user)->exists();
                $existinguser = UserImport::where('email',$user)->exists();
                if($lead){
                   $user =  Lead::where('email',$user)->pluck('phone');
                }
                if($existinguser){
                    $user =   UserImport::where('email',$user)->pluck('phone');
                }  
                $uArr[] = [
                    'user' =>$user,
                    'content' => $request->content,
                ];                
            } 
            $settings = Utility::settings();
            $account_sid = $settings['twilio_sid'];
            $auth_token = $settings['twilio_token'];
            $twilio_number = $settings['twilio_from'];
            foreach ($uArr as  $value) {
                try {
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create('+91'.$value['user'][0], [
                        'from' => $twilio_number,
                        'body' => $value['content'],
                    ]);
                    return redirect()->back()->with('success','Message Sent successfully');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error',"Message couldn't be sent");
                }
            }
        }
       
        $customers = explode(',',$request->recepient_names);
        $subject= $request->description;
        $settings = Utility::settings();
        foreach($customers as $customer){
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
                if(($request->format) && $request->format =='html'){
                    Mail::to($customer)->send(new SendCampaignMail($campaignlist, $attachmentPath));
                }elseif(($request->format) && $request->format =='text'){
                    Mail::to($customer)->send(new CampaigntextMail($content));
                }
                return redirect()->back()->with('success','Email Sent Successfully');
            } catch (\Exception $e) {
                return response()->json(
                    [
                        'is_success' => false,
                        'message' => $e->getMessage(),
                    ]
                );
                //   return redirect()->back()->with('error', 'Email Not Sent');
            }
        }
        return redirect()->back()->with('success','Campaign  Sent Successfully');
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
        $category = [
            'category' => $request->input('category'),
        ];
        Excel::import(new UsersImport($category),request()->file('users'));
        return redirect()->back()->with('success', 'Data  imported successfully');

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
    public function campaign_categories(Request $request){
        $types = $request->types;
        if(!empty($types)){
            foreach($types as $type){
                $user[] = UserImport::where('category',$type)->get();
            }
            return $user;
        }
    }

    public function campaignlisting(){
        $campaignlist = Campaigndata::all();
        return view('customer.campaignlist',compact('campaignlist'));
    }
    public function contactinfo(Request $request){
       $user =  UserImport::where('id',$request->customerid)->get();
       return $user;
    }
    public function resendcampaign(Request $request){
        $campaign = Campaigndata::where('id',$request->id)->get();
        $settings = Utility::settings();
        $customers = explode(',',$request->recepient_names);
        if(!empty($campaign->template)){
            foreach($customers as $customer){
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
                    // Mail::to($customer)->send(new SendCampaignMail($campaign));
                   
                    return 'Email Sent Successfully';
        
                } catch (\Exception $e) {
                    return response()->json(
                        [
                            'is_success' => false,
                            'message' => $e->getMessage(),
                        ]
                    );
                }
            }
        }else{

                foreach($customers as $customer){
                    $lead = Lead::where('email',$customer)->exists();
                    $existinguser = UserImport::where('email',$customer)->exists();
                    if($lead){
                       $user =  Lead::where('email',$customer)->pluck('phone');
                    }
                    if($existinguser){
                        $user =   UserImport::where('email',$customer)->pluck('phone');
                    }  
                    $uArr[] = [
                        'user' =>$user,
                        'content' => $request->content,
                    ];                    
                }
                $account_sid = $settings['twilio_sid'];
                $auth_token = $settings['twilio_token'];
                $twilio_number = $settings['twilio_from'];
                foreach ($uArr as  $value) {
                    try {
                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create('+91'.$value['user'][0], [
                            'from' => $twilio_number,
                            'body' => $value['content'],
                        ]);
                        return 'Message Sent successfully';
                    } catch (\Exception $e) {
                        return "Message couldn't be sent";
                    }
                }
            
        }      
    }
}
