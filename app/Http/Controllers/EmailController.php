<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\ProposalInfo;

class EmailController extends Controller
{
    public function index(){
        $leads = Lead::where('status','>=',1)->get();
        return view('email_integration.index',compact('leads'));
    }
    public function communication($id){
        $lead = ProposalInfo::where('lead_id',$id)->get();
        // echo"<pre>";print_r($lead);die;
        return view('email_integration.communication');
    }
}
