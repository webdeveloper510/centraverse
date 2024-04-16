<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;

class CalenderNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calender_new.index');
    }
    public function get_event_data(Request $request)
    {
        $events = Meeting::where('start_date', $request->start)->get();
        return response()->json(["events" => $events]);
    }
    public function eventinfo(){
        $event = Meeting::all();
        return $event;

    }
    public function monthbaseddata(Request $request){
       
        $startDate = "{$request->year}-{$request->month}-01"; // First day of the month
        $endDate = date('Y-m-t', strtotime($startDate)); // Last day of the month
        $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
        return $data;
    }
}
