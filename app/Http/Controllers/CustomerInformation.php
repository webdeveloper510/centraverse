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
use Illuminate\Support\Facades\File;
use App\Models\Campaigndata;

class CustomerInformation extends Controller
{
    public function index(){
       $customers = Lead::all();
       $emailtemplates = Emailcontent::all();
       $leadsuser = Lead::all();
       $users = UserImport::all();
       return view('customer.index',compact('customers','emailtemplates','leadsuser','users'));
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
        $campaignlist = new Campaigndata();
        $campaignlist['type'] = $request->type;
        $campaignlist['title'] =$request->title;
        $campaignlist['recipients'] =$request->recepient_names;
        $campaignlist['content'] =$request->content;
        $campaignlist['description'] = $request->description;
        $campaignlist->save();
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
                Mail::raw($request->content, function ($message) use ($customer) {
                    $message->to($customer)
                    ->subject('Campaign');
                });
            } catch (\Exception $e) {
                return response()->json(
                    [
                        'is_success' => false,
                        'message' => $e->getMessage(),
                    ]
                );
                //   return redirect()->back()->with('error', 'Email Not Sent');
            }
            return redirect()->back()->with('success','Email Sent Successfully');
        }
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
    public function savetemplatedesign(Request $request){
        $jsonData = json_encode($request->jsondata);

        $uniqueFilename = 'data_' . uniqid() . '.json';
        $filePath = public_path() . '/template/' . $uniqueFilename;
        File::put($filePath, $jsonData);
        return $jsonData;
    }
    public function campaignlisting(){
        $campaignlist = Campaigndata::all();
        return view('customer.campaignlist',compact('campaignlist'));
    }
}
