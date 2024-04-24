<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class EmailController extends Controller
{
    public function index(){
        $leads = Lead::where('status','>= ',1)->get();
        return view('email_integration.index',compact('leads'));
    }
}
