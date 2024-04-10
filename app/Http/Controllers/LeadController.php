<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountIndustry;
use App\Models\AccountType;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\Plan;
use App\Models\Stream;
use App\Models\Task;
use App\Models\Utility;
use App\Models\Billing;
use App\Models\Proposal;
use App\Models\User;
use App\Models\UserDefualtView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\SendPdfEmail;
use App\Mail\LeadWithrawMail;
use App\Models\MasterCustomer;
use Mail;
use Str;
use App\Models\LeadDoc;
use Storage;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if (\Auth::user()->can('Manage Lead')) {
                $statuss = Lead::$stat;

                if(\Auth::user()->type == 'owner'){
                $leads = Lead::with('accounts','assign_user')->where('created_by', \Auth::user()->creatorId())->get();
                $defualtView         = new UserDefualtView();
                $defualtView->route  = \Request::route()->getName();
                $defualtView->module = 'lead';
                $defualtView->view   = 'list';
                User::userDefualtView($defualtView);
                }
                else{
                $leads = Lead::with('accounts','assign_user')->where('user_id', \Auth::user()->id)->get();
                $defualtView         = new UserDefualtView();
                $defualtView->route  = \Request::route()->getName();
                $defualtView->module = 'lead';
                $defualtView->view   = 'list';
                }
                return view('lead.index', compact('leads','statuss'));
            } else {
                return redirect()->back()->with('error', 'permission Denied');
            }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type, $id)
    {
        if (\Auth::user()->can('Create Lead')){
            $users       = User::where('created_by', \Auth::user()->creatorId())->get();
            $status     = Lead::$status;
            return view('lead.create', compact('status', 'users', 'id','type'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (\Auth::user()->can('Create Lead')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'lead_name'=>'required',
                    'name' => 'required|max:120',
                    'phone'=>'required|numeric'
                ]);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first()) 
                ->withErrors($validator)
                ->withInput();
            }
            $data = $request->all();
            $package = [];
            $additional = [];
            $bar_pack = [];
            foreach ($data as $key => $values) {
                if (strpos($key, 'package_') === 0) {
                    $newKey = strtolower(str_replace('package_', '', $key));
                    $package[$newKey] = $values;
                }
                if (strpos($key, 'additional_') === 0) {
                    // Extract the suffix from the key
                    $newKey = strtolower(str_replace('additional_', '', $key));
                    // Check if the key exists in the output array, if not, initialize it
                    if (!isset($additional[$newKey])) {
                        $additional[$newKey] = [];
                    }
                    $additional[$newKey] = $values;
                }
                if (strpos($key, 'bar_') === 0) {
                    // Extract the suffix from the key
                    $newKey = ucfirst(strtolower(str_replace('bar_', '', $key)));
                    // Check if the key exists in the output array, if not, initialize it
                    if (!isset($bar_pack[$newKey])) {
                        $bar_pack[$newKey] = [];
                    }
                    // Assign the values to the new key in the output array
                    $bar_pack[$newKey] = $values;
                }
            }
            
            $package = json_encode($package);
            $additional = json_encode($additional);
            $bar_pack = json_encode($bar_pack);
           
            $lead                       = new Lead();
            $lead['user_id']            = Auth::user()->id;
            $lead['name']               = $request->name;
            $lead['leadname']           = $request->lead_name;
            $lead['assigned_user']      = $request->user;
            $lead['email']              = $request->email ?? '';
            $lead['phone']              = $request->phone;
            $lead['lead_address']       = $request->lead_address;
            $lead['company_name']       = $request->company_name;
            $lead['relationship']       = $request->relationship;
            $lead['start_date']         = $request->start_date;
            $lead['end_date']           = $request->end_date;
            $lead['type']               = $request->type;
            $lead['venue_selection']    = isset($request->venue)?implode(',',$request->venue) :'';
            $lead['function']           = isset($request->function)? implode(',',$request->function) :'';
            $lead['func_package']       = isset($package) && (!empty($package)) ? $package : '';
            $lead['guest_count']        = $request->guest_count ?? 0;
            $lead['description']        = $request->description;
            $lead['spcl_req']           = $request->spcl_req;
            $lead['allergies']          = $request->allergies;
            $lead['start_time']         = $request->start_time ?? '';
            $lead['end_time']           = $request->end_time ?? '';
            $lead['bar']                = $request->baropt;
            $lead['bar_package']        = isset($bar_pack) && !empty($bar_pack) ? $bar_pack : '';
            $lead['ad_opts']            = isset($additional) && !empty($additional) ? $additional : '';
            $lead['rooms']              = $request->rooms ?? 0;
            $lead['lead_status']        = ($request->is_active == 'on') ? 1 : 0;
            $lead['created_by']         = \Auth::user()->creatorId();
            $lead->save();

            $existingcustomer = MasterCustomer::where('email',$lead->email)->first();
            if(!$existingcustomer){
                $customer = new MasterCustomer();
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->phone = $request->phone;
                $customer->address = $request->lead_address ?? '';
                $customer->category = 'lead';
                $customer->save();
            }
            $uArr = [
                'lead_name' => $lead->name,
                'lead_email' => $lead->email,
            ];
            $resp = Utility::sendEmailTemplate('lead_assign', [$lead->id => $lead->email], $uArr);

            //webhook
            $module = 'New Lead';
           
            
            $Assign_user_phone = User::where('id', $request->user)->first();
            $setting  = Utility::settings(\Auth::user()->creatorId());
            $uArr = [
                'lead_name' => $lead->name,
                'lead_email' => $lead->email,
             ];
            // $resp = Utility::sendEmailTemplate('lead_assigned', [$lead->id => $Assign_user_phone->email], $uArr);
            if (isset($setting['twilio_lead_create']) && $setting['twilio_lead_create'] == 1) {
                $uArr = [
                    // 'company_name'  => $lead->name,
                    'lead_email' => $lead->email,
                    'lead_name' => $lead->name
                ];
                Utility::send_twilio_msg($Assign_user_phone->phone, 'new_lead', $uArr);
                
            }
            // if (Auth::user()) {
            //     return redirect()->back()->with('success', __('Lead created!') . ((isset($msg) ? '<br> <span class="text-danger">' . $msg . '</span>' : '')));
            // } else {
            //     return redirect()->back()->with('error', __('Webhook call failed.') . ((isset($msg) ? '<br> <span class="text-danger">' . $msg . '</span>' : '')));
            // }
            return redirect()->back()->with('success', __('Lead Created.'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {

        if (\Auth::user()->can('Show Lead')) {
            return view('lead.view', compact('lead'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        if (\Auth::user()->can('Edit Lead')) {
            $venue_function = explode(',', $lead->venue_selection);
            $function_package =  explode(',', $lead->function);
            $status   = Lead::$status;
            $users     = User::where('created_by', \Auth::user()->creatorId())->get();             
            return view('lead.edit', compact('venue_function','function_package','lead','users', 'status'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
     
        if (\Auth::user()->can('Edit Lead')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:120',
                    'phone' => 'required|numeric',
                   
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $data = $request->all();
            $package = [];
            $additional = [];
            $bar_pack = [];
            $venue_function = implode(',',$_REQUEST['venue']);
            $function = isset($request->function) ? implode(',',$_REQUEST['function']) : '';
            foreach ($data as $key => $values) {
                if (strpos($key, 'package_') === 0) {
                    $newKey = strtolower(str_replace('package_', '', $key));
                    $package[$newKey] = $values;
                }
                if (strpos($key, 'additional_') === 0) {
                    // Extract the suffix from the key
                    $newKey = strtolower(str_replace('additional_', '', $key));
                    // Check if the key exists in the output array, if not, initialize it
                    if (!isset($additional[$newKey])) {
                        $additional[$newKey] = [];
                    }
                    $additional[$newKey] = $values;
                }
                if (strpos($key, 'bar_') === 0) {
                    // Extract the suffix from the key
                    $newKey = ucfirst(strtolower(str_replace('bar_', '', $key)));
                    // Check if the key exists in the output array, if not, initialize it
                    if (!isset($bar_pack[$newKey])) {
                        $bar_pack[$newKey] = [];
                    }
                    // Assign the values to the new key in the output array
                    $bar_pack[$newKey] = $values;
                }
            }
            $package = json_encode($package);
            $additional = json_encode($additional);
            $bar_pack = json_encode($bar_pack);
           
            $lead['user_id']            = $request->user;
            $lead['name']               = $request->name;
            $lead['leadname']          = $request->lead_name;
            $lead['email']              = $request->email;
            $lead['phone']              = $request->phone;
            $lead['lead_address']       = $request->lead_address;
            $lead['company_name']       = $request->company_name;
            $lead['relationship']       = $request->relationship;
            $lead['start_date']         = $request->start_date;
            $lead['end_date']           = $request->end_date;
            $lead['type']               = $request->type;
            $lead['venue_selection']    = $venue_function;
            $lead['function']           = $function;
            $lead['guest_count']        = $request->guest_count ?? 0;
            $lead['description']        = $request->description;
            $lead['spcl_req']        = $request->spcl_req;
            $lead['allergies']        = $request->allergies;
            $lead['start_time']         = $request->start_time;
            $lead['end_time']        = $request->end_time;
            $lead['func_package']       = $package ?? '';
            $lead['bar_package']         = $bar_pack ?? '';
            $lead['ad_opts']             = $additional ?? '';
            $lead['bar']        =   $request->bar;
            $lead['rooms']          = $request->rooms ?? 0;
            $lead['lead_status']  = ($request->is_active == 'on') ? 1 : 0;
            $lead['created_by']         = \Auth::user()->creatorId();
            $lead->update();
            return redirect()->back()->with('success', __('Lead  Updated.'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        if (\Auth::user()->can('Delete Lead')) {
            $lead->delete();
            return redirect()->back()->with('success', __('Lead  Deleted.'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    public function grid()
    {
        $leads   = Lead::where('created_by', '=', \Auth::user()->creatorId())->get();
        $statuss = Lead::where('created_by', '=', \Auth::user()->creatorId())->get();

        // if($leads->isNotEmpty())
        // {
        //     $users = user::where('id', $leads[0]->user_id)->get();
        // }

        $defualtView         = new UserDefualtView();
        $defualtView->route  = \Request::route()->getName();
        $defualtView->module = 'lead';
        $defualtView->view   = 'kanban';
        User::userDefualtView($defualtView);
        // if($leads->isEmpty())
        // {
        //     return view('lead.grid', compact( 'statuss'));
        // }
        // else
        // {
        //      return view('lead.grid', compact('leads', 'statuss','users'));
        // }
        return view('lead.grid', compact('leads', 'statuss'));
    }

    public function changeorder(Request $request)
    {
        $post   = $request->all();
        $lead   = Lead::find($post['lead_id']);
        $status = Lead::where('status', $post['status_id'])->get();


        if (!empty($status)) {
            $lead->status = $post['status_id'];
            $lead->save();
        }

        foreach ($post['order'] as $key => $item) {
            $order         = Lead::find($item);
            $order->status = $post['status_id'];
            $order->save();
        }
    }

    public function showConvertToAccount($id)
    {
        if (\Auth::user()->type == 'owner') {
            $lead        = Lead::findOrFail($id);
            $accountype  = accountType::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $industry    = accountIndustry::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $user        = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $document_id = Document::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('lead.convert', compact('lead', 'accountype', 'industry', 'user', 'document_id'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function convertToAccount($id, Request $request)
    {
        if (\Auth::user()->type == 'owner') {
            $lead = Lead::findOrFail($id);
            $usr  = \Auth::user();

            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:accounts,email',
                    'shipping_postalcode' => 'required',
                    'lead_postalcode' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $account                        = new account();
            $account['user_id']             = $request->user;
            $account['document_id']         = $request->document_id;
            $account['name']                = $request->name;
            $account['email']               = $request->email;
            $account['phone']               = $request->phone;
            $account['website']             = $request->website;
            $account['billing_address']     = $request->lead_address;
            $account['billing_city']        = $request->lead_city;
            $account['billing_state']       = $request->lead_state;
            $account['billing_country']     = $request->lead_country;
            $account['billing_postalcode']  = $request->lead_postalcode;
            $account['shipping_address']    = $request->shipping_address;
            $account['shipping_city']       = $request->shipping_city;
            $account['shipping_state']      = $request->shipping_state;
            $account['shipping_country']    = $request->shipping_country;
            $account['shipping_postalcode'] = $request->shipping_postalcode;
            $account['type']                = $request->type;
            $account['industry']            = $request->industry;
            $account['description']         = $request->description;
            $account['created_by']          = \Auth::user()->creatorId();
            $account->save();
            // end create deal

            // Update is_converted field as deal_id
            $lead->is_converted = $account->id;
            $lead->save();

            return redirect()->back()->with('success', __('Lead converted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function proposal($id){
    

        $decryptedId = decrypt(urldecode($id));
        $lead = Lead::find($decryptedId);
        // $fixed_cost = Billing::first();
        $settings = Utility::settings();
        if(isset($settings['fixed_billing'])){
            $fixed_cost= json_decode($settings['fixed_billing'],true);
        }
        // echo"<pre>";print_r($lead);die;
        $proposal = Proposal::where('lead_id',$decryptedId)->first();
        $data = [
                'settings'=>$settings,
                'proposal'=> $proposal,
                'lead'=>$lead,
                'billing' => $fixed_cost,
        ];
        $pdf = Pdf::loadView('lead.signed_proposal', $data);
        return $pdf->stream('proposal.pdf');
    }
    public function share_proposal_view($id){
        $decryptedId = decrypt(urldecode($id));
        $lead = Lead::find($decryptedId);
        return view('lead.share_proposal',compact('lead'));
    }
    public function proposalpdf(Request $request,$id){
        $settings = Utility::settings();
        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
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
            Mail::to($lead->email)->send(new SendPdfEmail($lead));
            // $upd = Lead::where('id',$id)->update(['proposal_status' => 1]);
            $upd = Lead::where('id',$id)->update(['status' => 1]);

        } catch (\Exception $e) {
            //   return response()->json(
            //             [
            //                 'is_success' => false,
            //                 'message' => $e->getMessage(),
            //             ]
            //         );
              return redirect()->back()->with('success', 'Email Not Sent');
      
        }
        return redirect()->back()->with('success', 'Email Sent Successfully');
    }
    public function proposalview($id){
        $billing = Billing::first();
        $id = decrypt(urldecode($id));
        $proposal =  Proposal::where('lead_id',$id)->exists();
        if($proposal){
            return view('lead.proposal_error');
        }else{
            $lead = Lead::find($id);
            $settings = Utility::settings();
            $venue = explode(',',$settings['venue']);
            return view('lead.proposal',compact('lead','venue','settings','billing'));
        }
    }
    public function proposal_resp(Request $request,$id){
            $id = decrypt(urldecode($id));
            if(!empty($request->imageData)){
                $image = $this->uploadSignature($request->imageData);
                Lead::where('id',$id)->update(['status'=>2]);
                // Lead::where('id',$id)->update(['proposal_status'=> 2,'status'=>1]);
            }else{
                return redirect()->back()->with('error',('Please Sign it for confirmation'));
            }
          
            $existproposal = Proposal::where('lead_id', $id)->exists();
            if ($existproposal == TRUE) {
                Proposal::where('lead_id',$id)->update(['image' => $image]);
                return redirect()->back()->with('error','Proposal is already confirmed');
            }
            $proposal = new Proposal();
            $proposal['lead_id'] = $id;
            $proposal['image'] = $image;
            $proposal->save();
            $lead = Lead::find($id);
            $fixed_cost = Billing::first();
            $proposal = Proposal::where('lead_id',$id)->first();
            $data = [
                'proposal'=> $proposal,
                'lead'=>$lead,
                'billing' => $fixed_cost,
            ];
            $pdf = Pdf::loadView('lead.signed_proposal', $data);
            return $pdf->stream('proposal.pdf');
    } 
    public function uploadSignature($signed){
        $folderPath = public_path('upload/');
        $image_parts = explode(";base64,", $signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.'.$image_type;
        file_put_contents($file, $image_base64);
        return $file;
    }
    public function review_proposal($id){
       
        $id = decrypt(urldecode($id));
        $lead = Lead::where('id',$id)->first();
        $venue_function = explode(',', $lead->venue_selection);
        $function_package =  explode(',', $lead->function);
        $status   = Lead::$status;
        $users     = User::where('created_by', \Auth::user()->creatorId())->get();             
        return view('lead.review_proposal',compact('lead','venue_function','function_package','users','status'));
    }
    public function review_proposal_data(Request $request, $id){
        $settings = Utility::settings();
        $validator = \Validator::make($request->all(), [
            'status' => 'required|in:Approve,Resend,Withdraw',
        ],[
            'status.in' => 'The status field is required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $lead = Lead::find($id);
        $venue_function = isset($request->venue) ? implode(',',$_REQUEST['venue']) :'';
        $function =  isset($request->function) ? implode(',',$_REQUEST['function']) :'';
          
            if($request->status == 'Approve'){  
                $status = 4;              
                // $status = 2;
                // $lead->proposal_status = 2;
            }elseif($request->status == 'Resend'){
                $status = 5;
                // $status = 0;
                // $lead->proposal_status = 1;
            }elseif($request->status == 'Withdraw'){
                $status = 3;
                // $status = 3;
                // $lead->proposal_status = 3;
            }
            $data = [
                'user_id'=> $request->user,
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'lead_address'=>$request->lead_address,
                'company_name'      =>$request->company_name,
                'relationship'       =>$request->relationship,
                'start_date'        =>$request->start_date,
                'end_date'           =>$request->end_date,
                'type'              =>$request->type,
                'venue_selection'    =>$venue_function,
                'function'           =>$function,
                'status'           => $status,
                'guest_count'        =>$request->guest_count,
                'description'      =>$request->description,
                'spcl_req'      =>$request->spcl_req,
                'allergies'       =>$request->allergies,
                'start_time'        =>$request->start_time,
                'end_time'       =>$request->end_time,
                'bar'       =>  $request->bar,
                'rooms'         =>$request->rooms,
                'created_by'        => \Auth::user()->creatorId()
            ];
            $lead->update($data);

            if($status == 4){
                return redirect()->back()->with('success', __('Lead  Approved.'));
            }elseif($status == 5 ){
                Proposal::where('lead_id',$id)->delete();
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
        
                    Mail::to($lead->email)->send(new LeadWithrawMail($lead));
                } catch (\Exception $e) {
                    // return response()->json(
                    //     [
                    //         'is_success' => false,
                    //         'message' => $e->getMessage(),
                    //     ]
                    // );
                      return redirect()->back()->with('success', 'Email Not Sent');
                }
                return redirect()->back()->with('success', __('Lead  Resent.'));
            }elseif($status == 3){
                return redirect()->back()->with('success', __('Lead  Withdrawn.'));
            }
    }
    public function duplicate($id){
        
        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
        $newlead = new Lead();
        $newlead['user_id']            = Auth::user()->id;
        $newlead['name']               = $lead->name;
        $newlead['leadname']          =  $lead->leadname;
        $newlead['assigned_user']      = $lead->user_id;
        $newlead['email']              = $lead->email;
        $newlead['phone']              = $lead->phone;
        $newlead['lead_address']       = $lead->lead_address;
        $newlead['company_name']       = $lead->company_name;
        $newlead['relationship']       = $lead->relationship;
        $newlead['created_by']         = \Auth::user()->creatorId();
        $newlead->save();
        return redirect()->back()->with('Success','Lead Cloned successfully');
    }
    public function lead_info($id){
        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
        $leads = Lead::where('email',$lead->email)->orwhere('phone',$lead->phone)->get();
        $docs = LeadDoc::where('lead_id',$id)->get();
        return view('lead.leadinfo',compact('leads','lead','docs'));
    }
    public function lead_upload($id){
        return view('lead.uploaddoc',compact('id'));
    }
    public function lead_upload_doc(Request $request,$id){
        $validator = \Validator::make(
            $request->all(),
            [
                'lead_file'=>'required|mimes:doc,docx,pdf',
            ]);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first()) ;
        }
        $file = $request->file('lead_file');

        // Check if a file was uploaded
        if ($file) {
            // Get the original name of the file
            $originalName = $file->getClientOriginalName();
        
            // Generate a unique filename
            $filename = Str::random(4) . '.' . $file->getClientOriginalExtension();
        
            // Define the folder to store the file
            $folder = 'leadInfo/' . $id; // Example: uploads/1
        
            try {
                // Store the file with the generated filename
                $path = $file->storeAs($folder, $filename, 'public');
            } catch (\Exception $e) {
                // Handle file upload failure
                Log::error('File upload failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'File upload failed');
            }
        
            // If file upload was successful, save information to the database
            $document = new LeadDoc();
            $document->lead_id = $id; // Assuming you have a lead_id field
            $document->filename = $originalName; // Store original file name
            $document->filepath = $path; // Store file path
            $document->save();
        
            return redirect()->back()->with('success', 'Document Uploaded Successfully');
        } else {
            // Handle the case where no file was uploaded
            return redirect()->back()->with('error', 'No file uploaded');
        }
        
    }
    public function lead_billinfo($id){
        return view('lead.bill_information') ;
    }
    public function uploaded_docs($id){
        $docs = LeadDoc::where('lead_id',$id)->get();
        return view('lead.viewdocument',compact('docs'));

    }
    public function status(Request $request){
        $id = $request->id;
        Lead::where('id',$id)->update([
            'lead_status' => $request->status
        ]);
       return true;
    }
}