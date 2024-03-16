<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CommonCase;
use App\Models\Contact;
use App\Models\Lead;
use App\Models\Meeting;
use App\Models\Opportunities;
use App\Models\Plan;
use App\Models\Stream;
use App\Models\Utility;
use App\Models\User;
use App\Models\UserDefualtView;
use Illuminate\Http\Request;
use App\Models\Blockdate;
use App\Models\Setup;
use App\Models\Billing;
use App\Models\Agreement;
use App\Models\Billingdetail;
use App\Mail\SendBillingMail;
use App\Mail\AgreementMail;
use DateTime;
use Mpdf\Mpdf;
use DateInterval;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Mail\SendEventMail;
use App\Mail\TestingMail;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('Manage Meeting')) {
            $billing = Billingdetail::get();
            if (\Auth::user()->type == 'owner') {
                $meetings = Meeting::with('assign_user')->where('created_by', \Auth::user()->creatorId())->get();
                $defualtView         = new UserDefualtView();
                $defualtView->route  = \Request::route()->getName();
                $defualtView->module = 'meeting';
                $defualtView->view   = 'list';
                User::userDefualtView($defualtView);
            } else {
                $meetings = Meeting::with('assign_user')->where('user_id', \Auth::user()->id)->get();
                $defualtView         = new UserDefualtView();
                $defualtView->route  = \Request::route()->getName();
                $defualtView->module = 'meeting';
                $defualtView->view   = 'list';
            }
            return view('meeting.index', compact('meetings', 'billing'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    public function create($type, $id)
    {
        if (\Auth::user()->can('Create Meeting')) {
            $status            = Meeting::$status;
            $parent            = Meeting::$parent;
            $users              = User::where('created_by', \Auth::user()->creatorId())->get();
            $attendees_lead    = Lead::where('created_by', \Auth::user()->creatorId())->where('proposal_status', 2)->get()->pluck('leadname', 'id');
            $attendees_lead->prepend('Select Lead', 0);
            $setup = Setup::all();
            // $function = Meeting::$function;
            $breakfast = Meeting::$breakfast;
            $lunch = Meeting::$lunch;
            $dinner = Meeting::$dinner;
            $wedding = Meeting::$wedding;
            return view('meeting.create', compact('status', 'type', 'breakfast', 'setup','lunch', 'dinner', 'wedding', 'parent', 'users', 'attendees_lead'));
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

    // WORKING  17-01-2024
    public function store(Request $request)
    {
        if (\Auth::user()->can('Create Meeting')) {
           
            $data = $request->all();
           
            echo "<pre>";print_r($data);die;
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:120',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'email' => 'required|email|max:120',
                    'lead_address' => 'required|max:120',
                    'type' => 'required',
                    'venue' => 'required|max:120',
                    'function' => 'required|max:120',
                    'guest_count' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'meal' => 'required'
                ]);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $start_time = $request->input('start_time');
            $end_time = $request->input('end_time');
            $venue_selected = $request->input('venue');

            $overlapping_event = Meeting::where('start_date', '<=', $end_date)
                ->where('end_date', '>=', $start_date)
                ->where(function ($query) use ($start_date, $end_date, $start_time, $end_time, $venue_selected) {
                    foreach ($venue_selected as $v) {
                        $query->orWhere(function ($q) use ($start_date, $end_date, $start_time, $end_time, $v) {
                            $q->where('venue_selection', 'LIKE', "%$v%")
                                ->where('end_time', '>', $start_time)
                                ->where('start_time', '<', $end_time)
                                ->where('start_date', '<=', $end_date)
                                ->where('end_date', '>=', $start_date);
                        });
                    }
                })->count();

            if ($overlapping_event > 0) {
                return redirect()->back()->with('error', 'Event exists for correspomding time or venue!');
            }

            $overlapping_event = Blockdate::where('start_date', '<=', $end_date)
                ->where('end_date', '>=', $start_date)
                ->where(function ($query) use ($start_date, $end_date, $start_time, $end_time, $venue_selected) {
                    foreach ($venue_selected as $v) {
                        $query->orWhere(function ($q) use ($start_date, $end_date, $start_time, $end_time, $v) {
                            $q->where('venue', 'LIKE', "%$v%")
                                ->where('end_time', '>', $start_time)
                                ->where('start_time', '<', $end_time)
                                ->where('start_date', '<=', $end_date)
                                ->where('end_date', '>=', $start_date);
                        });
                    }
                })->count();

            if ($overlapping_event > 0) {
                return redirect()->back()->with('error', 'Date is Blocked for corrosponding time and venue');
            }
            $allPackages = array_merge(
                isset($request->break_package) ? $request->break_package : [],
                isset($request->lunch_package) ? $request->lunch_package : [],
                isset($request->dinner_package) ? $request->dinner_package : [],
                isset($request->wedding_package) ? $request->wedding_package : []
            );

            $packagesString = implode(',', $allPackages);

            $meeting                      = new Meeting();
            $meeting['user_id']           =  implode(',', $request->user);
            $meeting['name']              = $request->name;
            $meeting['start_date']        = $request->start_date;
            $meeting['end_date']          = $request->end_date;
            $meeting['email']              = $request->email;
            $meeting['lead_address']       = $request->lead_address;
            $meeting['company_name']      = $request->company_name;
            $meeting['relationship']       = $request->relationship;
            $meeting['type']               = $request->type;
            $meeting['venue_selection']    = implode(',', $request->venue);
            $meeting['func_package']       = $packagesString;
            $meeting['function']            = implode(',', $request->function);
            $meeting['guest_count']         = $request->guest_count;
            $meeting['room']                = $request->rooms;
            $meeting['meal']                = $request->meal;
            $meeting['bar']                 = $request->bar;
            $meeting['bar_package']         = $request->bar_package;
            $meeting['spcl_request']        = $request->spcl_request;
            $meeting['alter_name']          = $request->alter_name;
            $meeting['alter_email']         = $request->alter_email;
            $meeting['alter_relationship']  = $request->alter_relationship;
            $meeting['alter_lead_address']  = $request->alter_lead_address;
            $meeting['attendees_lead']      = $request->lead;
            $meeting['eventname']            = $request->eventname;
            $meeting['phone']               = $request->phone;
            $meeting['start_time']          = $request->start_time;
            $meeting['end_time']            = $request->end_time;
            $meeting['ad_opts']             = implode(',',$request->ad_opts);
            $meeting['floor_plan']          = $request->uploadedImage;
            $meeting['created_by']          = \Auth::user()->creatorId();
            
            $meeting->save();
            $Assign_user_phone = User::where('id', $request->user)->first();
            $setting  = Utility::settings(\Auth::user()->creatorId());
            $uArr = [
                'meeting_name' => $request->name,
                'meeting_start_date' => $request->start_date,
                'meeting_due_date' => $request->end_date,
                // 'attendees_user' => $request->attendees_user,
                // 'attendees_contact' => $request->attendees_contact,
            ];
            $resp = Utility::sendEmailTemplate('meeting_assigned', [$meeting->id => $Assign_user_phone->email], $uArr);
            if (isset($setting['twilio_meeting_create']) && $setting['twilio_meeting_create'] == 1) {
                $uArr = [
                    'meeting_name' => $request->name,
                    'meeting_start_date' => $request->start_date,
                    'meeting_due_date' => $request->end_date,
                    'user_name' => \Auth::user()->name,
                ];
                Utility::send_twilio_msg($Assign_user_phone->phone, 'new_meeting', $uArr);
            }
            if ($request->get('is_check')  == '1') {
                $type = 'meeting';
                $request1 = new Meeting();
                $request1->title = $request->name;
                $request1->start_date = $request->start_date;
                $request1->end_date = $request->end_date;
                Utility::addCalendarData($request1, $type);
            }
            // $module = 'New Meeting';
            // $webhook =  Utility::webhookSetting($module);
            // if ($webhook) {
            //     $parameter = json_encode($meeting);
            //     // 1 parameter is  URL , 2 parameter is data , 3 parameter is method
            //     $status = Utility::WebhookCall($webhook['url'], $parameter, $webhook['method']);
            //     if ($status != true) {
            //         $msg = "Webhook call failed.";
            //     }
            // }
            if (\Auth::user()) {
                return redirect()->back()->with('success', __('Event created!') . ((isset($msg) ? '<br> <span class="text-danger">' . $msg . '</span>' : '')));
            } else {
                return redirect()->back()->with('error', __('Webhook call failed.') . ((isset($msg) ? '<br> <span class="text-danger">' . $msg . '</span>' : '')));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Meeting $meeting
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        if (\Auth::user()->can('Show Meeting')) {
            $status = Meeting::$status;
            $ids = explode(',', $meeting->user_id);
            foreach ($ids as $id) {
                $name[] = User::where('id', $id)->pluck('name')->first();
            }
            $name = implode(',', $name);
            return view('meeting.view', compact('meeting', 'status', 'name'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Meeting $meeting
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        if (\Auth::user()->can('Edit Meeting')) {
            $status            = Meeting::$status;
            $attendees_lead    = Lead::where('id', $meeting->attendees_lead)->get()->pluck('leadname')->first();
            $users  = User::where('created_by', \Auth::user()->creatorId())->get();
            $function_p = explode(',', $meeting->function);
            $venue_function = explode(',', $meeting->venue_selection);
            $food_package = explode(',', $meeting->func_package);
            $user_id = explode(',', $meeting->user_id);
            $setup = Setup::all();
            $ad_options = explode(',',$meeting->ad_opts);
            // $previous = Meeting::where('id', '<', $meeting->id)->max('id');
            // $next = Meeting::where('id', '>', $meeting->id)->min('id');
            // $function = Meeting::$function;
            $breakfast = Meeting::$breakfast;
            $lunch = Meeting::$lunch;
            $dinner = Meeting::$dinner;
            $wedding = Meeting::$wedding;
            return view('meeting.edit', compact('user_id', 'users', 'setup','food_package','ad_options','function_p', 'venue_function', 'meeting', 'breakfast', 'lunch', 'dinner', 'wedding', 'status','attendees_lead'))->with('start_date', $meeting->start_date)->with('end_date', $meeting->end_date);
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Meeting $meeting
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Meeting $meeting)
    {
        if (\Auth::user()->can('Edit Meeting')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:120',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'email' => 'required|email|max:120',
                    'lead_address' => 'required|max:120',
                    'type' => 'required',
                    'venue' => 'required|max:120',
                    'function' => 'required|max:120',
                    'guest_count' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'meal' => 'required'
                ]);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $start_time = $request->input('start_time');
            $end_time = $request->input('end_time');
            $venue_selected = $request->input('venue');
            
            $overlapping_event = Meeting::where('start_date', '<=', $end_date)
                ->where('end_date', '>=', $start_date)
                ->where(function ($query) use ($start_date, $end_date, $start_time, $end_time, $venue_selected) {
                    foreach ($venue_selected as $v) {
                        $query->orWhere(function ($q) use ($start_date, $end_date, $start_time, $end_time, $v) {
                            $q->where('venue_selection', 'LIKE', "%$v%")
                                ->where('end_time', '>', $start_time)
                                ->where('start_time', '<', $end_time)
                                ->where('start_date', '<=', $end_date)
                                ->where('end_date', '>=', $start_date);
                        });
                    }
                })->where('id', '<>', $meeting->id)->count();

            if ($overlapping_event > 0) {                
                return redirect()->back()->with('error', 'Event with overlapping time and matching venue already exists!');
            }

            $overlapping_event = Blockdate::where('start_date', '<=', $end_date)
                ->where('end_date', '>=', $start_date)
                ->where(function ($query) use ($start_date, $end_date, $start_time, $end_time, $venue_selected) {
                    foreach ($venue_selected as $v) {
                        $query->orWhere(function ($q) use ($start_date, $end_date, $start_time, $end_time, $v) {
                            $q->where('venue', 'LIKE', "%$v%")
                                ->where('end_time', '>', $start_time)
                                ->where('start_time', '<', $end_time)
                                ->where('start_date', '<=', $end_date)
                                ->where('end_date', '>=', $start_date);
                        });
                    }
                })->where('id', '<>', $meeting->id)->count();

            if ($overlapping_event > 0) {                
                return redirect()->back()->with('error', 'Date Already Blocked for corresponding time and Venue');
            }

            $break_package = $lunch_package = $dinner_package = $wedding_package = '';
            if (isset($_REQUEST['venue'])) {
                $venue = implode(',', $_REQUEST['venue']);
            }
            if (isset($_REQUEST['function'])) {
                $function = implode(',', $_REQUEST['function']);
            }
            if (isset($_REQUEST['meal'])) {
                $meal = $_REQUEST['meal'];
            }

            if (isset($_REQUEST['break_package'])) {
                $break_package = implode(',', $_REQUEST['break_package']);
            }
            if (isset($_REQUEST['lunch_package'])) {
                $lunch_package = implode(',', $_REQUEST['lunch_package']);
            }
            if (isset($_REQUEST['dinner_package'])) {
                $dinner_package = implode(',', $_REQUEST['dinner_package']);
            }
            if (isset($_REQUEST['wedding_package'])) {
                $wedding_package = implode(',', $_REQUEST['wedding_package']);
            }
            $packagesArray = implode(',', array($break_package, $lunch_package, $dinner_package, $wedding_package));

            $meeting['user_id']           = implode(',', $request->user);
            $meeting['name']              = $request->name;           
            $meeting['start_date']        = $request->start_date;
            $meeting['end_date']          = $request->end_date;
            $meeting['relationship']       = $request->relationship;
            $meeting['type']               = $request->type;
            $meeting['venue_selection']    = $request->venue_selection;
            $meeting['email']              = $request->email;
            $meeting['lead_address']      = $request->lead_address;
            $meeting['function']           = $function;
            $meeting['venue_selection']    = $venue;
            $meeting['func_package']       = $packagesArray;
            $meeting['guest_count']        = $request->guest_count;
            $meeting['room']                = $request->rooms;
            $meeting['meal']                = $meal;
            $meeting['bar']                 = $request->bar;
            $meeting['bar_package']         = $request->bar_package;
            $meeting['spcl_request']        = $request->spcl_request;
            $meeting['alter_name']          = $request->alter_name;
            $meeting['alter_email']         = $request->alter_email;
            $meeting['alter_relationship']  = $request->alter_relationship;
            $meeting['alter_lead_address']  = $request->alter_lead_address;
            $meeting['phone']               = $request->phone;
            $meeting['start_time']        = $request->start_time;
            $meeting['end_time']       = $request->end_time;
            $meeting['ad_opts']             =isset($request->ad_opts)? implode(',',$request->ad_opts):'' ;
            $meeting['floor_plan']          = $request->uploadedImage;
            $meeting['created_by']        = \Auth::user()->creatorId();
            // echo "<pre>";print_r($meeting);die;

            $meeting->update();
            return redirect()->back()->with('success', __('Event Updated.'));
        } else {
            return redirect()->back()->with('error', 'Permission Denied');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Meeting $meeting
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        if (\Auth::user()->can('Delete Meeting')) {
            $meeting->delete();
            Billingdetail::where('event_id',$meeting->id)->delete();
            Agreement::where('event_id',$meeting->id)->delete();
            return redirect()->back()->with('success', 'Event Deleted!');
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    public function grid()
    {
        $meetings = Meeting::where('created_by', \Auth::user()->creatorId())->get();

        $defualtView         = new UserDefualtView();
        $defualtView->route  = \Request::route()->getName();
        $defualtView->module = 'meeting';
        $defualtView->view   = 'grid';
        User::userDefualtView($defualtView);
        return view('meeting.grid', compact('meetings'));
    }

    public function getparent(Request $request)
    {
        if ($request->parent == 'account') {
            $parent = Account::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id')->toArray();
        } elseif ($request->parent == 'lead') {
            $parent = Lead::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id')->toArray();
        } elseif ($request->parent == 'contact') {
            $parent = Contact::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id')->toArray();
        } elseif ($request->parent == 'opportunities') {
            $parent = Opportunities::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id')->toArray();
        } elseif ($request->parent == 'case') {
            $parent = CommonCase::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id')->toArray();
        } else {
            $parent = '';
        }

        return response()->json($parent);
    }

    public function get_meeting_data(Request $request)
    {
        $arrayJson = [];
        if ($request->get('calender_type') == 'goggle_calender') {
            $type = 'meeting';
            $arrayJson =  Utility::getCalendarData($type);
        } else {
            $data = Meeting::where('created_by', \Auth::user()->creatorId())->get();
            foreach ($data as $val) {
                $end_date = date_create($val->end_date);
                date_add($end_date, date_interval_create_from_date_string("1 days"));
                $arrayJson[] = [
                    "id" => $val->id,
                    "title" => $val->name,
                    "start" => $val->start_date,
                    "end" => date_format($end_date, "Y-m-d H:i:s"),
                    "className" => $val->color,
                    "url" => route('meeting.show', $val['id']),
                    "textColor" => '#FFF',
                    "allDay" => true,
                ];
            }
        }

        return $arrayJson;
    }
    public function get_lead_data(Request $request)
    {
        $lead = Lead::where('id', $request->venue)->first();
        return $lead;
    }

    // 22-01-2024
    public function block_date(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'purpose' => 'required',
            'venue' => 'required|array',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $venue_selected = $request->input('venue');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');

        $overlapping_meetings = Meeting::where('start_date', '<=', $end_date)
            ->where('end_date', '>=', $start_date)
            ->where(function ($query) use ($start_date, $end_date, $start_time, $end_time, $venue_selected) {
                foreach ($venue_selected as $v) {
                    $query->orWhere(function ($q) use ($start_date, $end_date, $start_time, $end_time, $v) {
                        $q->where('venue_selection', 'LIKE', "%$v%")
                            ->where('end_time', '>', $start_time)
                            ->where('start_time', '<', $end_time)
                            ->where('start_date', '<=', $end_date)
                            ->where('end_date', '>=', $start_date);
                    });
                }
            })->count();

        if ($overlapping_meetings > 0) {
            return redirect()->back()->with('error', 'Event is Already Booked For this date or time');
        }

        $overlapping_event = Blockdate::where('start_date', '<=', $end_date)
            ->where('end_date', '>=', $start_date)
            ->where(function ($query) use ($start_date, $end_date, $start_time, $end_time, $venue_selected) {
                foreach ($venue_selected as $v) {
                    $query->orWhere(function ($q) use ($start_date, $end_date, $start_time, $end_time, $v) {
                        $q->where('venue', 'LIKE', "%$v%")
                            ->where('end_time', '>', $start_time)
                            ->where('start_time', '<', $end_time)
                            ->where('start_date', '<=', $end_date)
                            ->where('end_date', '>=', $start_date);
                    });
                }
            })->count();

        if ($overlapping_event > 0) {
            return redirect()->back()->with('error', 'Date Already Blocked for corrosponding time and Venue');
        }

        $venue = implode(',', $_REQUEST['venue']);
        $block = new Blockdate();
        $block->start_date = $start_date;
        $block->end_date = $end_date;
        $block->start_time = (new DateTime($start_time))->format('H:i:s');
        $block->end_time = (new DateTime($end_time))->format('H:i:s');
        $block->purpose = $request->purpose;
        $block->venue = $venue;
        $block->unique_id = uniqid();
        $block->created_by = \Auth::user()->id;
        $block->save();

        return redirect()->back()->with('success', __('Date Blocked'));
    }
    public function unblock_date(Request $request)
    {
        $unblock_date = $request->input('unblock_date');

        $existing_block = Blockdate::where('start_date', '<=', $unblock_date)
            ->where('end_date', '>=', $unblock_date)
            ->first();

        if ($existing_block) {
            if ($existing_block->start_date == $unblock_date && $existing_block->end_date == $unblock_date) {
                $existing_block->delete();
            } else {
                if ($existing_block->start_date == $unblock_date) {
                    $existing_block->start_date = date('Y-m-d', strtotime($unblock_date . ' + 1 day'));
                } elseif ($existing_block->end_date == $unblock_date) {
                    $existing_block->end_date = date('Y-m-d', strtotime($unblock_date . ' - 1 day'));
                } else {
                    $new_block = clone $existing_block;
                    $existing_block->end_date = date('Y-m-d', strtotime($unblock_date . ' - 1 day'));
                    $new_block->start_date = date('Y-m-d', strtotime($unblock_date . ' + 1 day'));
                    $new_block->save();
                }
                $existing_block->save();
            }

            return redirect()->back()->with('success', __('Date Successfully Unblocked'));
        } else {
            return redirect()->back()->with('error', __('Blockdate not found for the specified date'));
        }
    }

    public function share_event(Meeting $meeting)
    {
        return view('meeting.shareview', compact('meeting'));
    }
    public function get_event_info(Request $request, $id)
    {
        $settings = Utility::settings();
        $id = decrypt(urldecode($id));
        $meeting = Meeting::find($id);
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
            Mail::to($meeting->email)->send(new SendEventMail($meeting));
            $meeting->update(['status'=>1]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'is_success' => false,
                    'message' => $e->getMessage(),
                ]
            );
            // return redirect()->back()->with('error', 'Email Not Sent');
        }
        return redirect()->back()->with('success', 'Email Sent Successfully');
    }
    public function download_meeting($id)
    {
        $meeting = Meeting::findOrFail($id);
        $pdf = PDF::loadView('meeting.pdf.meeting', compact('meeting'));
        return $pdf->download('meeting-details.pdf');
    }
    public function agreement($id)
    {
        $decryptedId = decrypt(urldecode($id));
        $meeting = Meeting::find($decryptedId);
        $fixed_cost = Billing::first();
        $agreement = Agreement::where('event_id', $decryptedId)->first();
        $data = [
            'agreement' => $agreement,
            'meeting' => $meeting,
            'billing' => $fixed_cost,
        ];
        $pdf = Pdf::loadView('meeting.agreement.view', $data);
        return $pdf->stream('agreement.pdf');
    }
    public function signedagreementview($id)
    {
        $id = decrypt(urldecode($id));
        $agreement= Agreement::where('event_id',$id)->exists();
        if($agreement){
            return view('meeting.agreement_error',compact('id'));
        }else{
            $meeting = Meeting::find($id);
            $settings = Utility::settings();
            $fixed_cost = Billing::first();
            $venue = explode(',', $settings['venue']);
            return view('meeting.agreement.signedagreement', compact('meeting', 'venue', 'fixed_cost'));
        }
    }
    public function signedagreementresponse(Request $request, $id)
    {
        $id = decrypt(urldecode($id));
        if (!empty($request->imageData)) {
            $image = $this->uploadSignature($request->imageData);
            Billingdetail::where('event_id',$id)->update(['status'=>1]);
        }else{
            return redirect()->back()->with('error',('Please Sign agreement for confirmation'));
        }
        $meeting = Meeting::find($id);
        $settings = Utility::settings();
        $fixed_cost = Billing::first();
        $agreement = Agreement::where('event_id', $id)->first();
        $data = [
            'agreement' => $agreement,
            'meeting' => $meeting,
            'billing' => $fixed_cost,
        ];
        $pdf = Pdf::loadView('meeting.agreement.view', $data);
        $existagreement = Agreement::where('event_id', $id)->exists();
        if ($existagreement == TRUE) {
            Agreement::where('event_id', $id)->update([
                'signature' => $image,
            ]);
            return redirect()->back()->with('error',('Agreement is already confirmed'));
            return $pdf->stream('agreement.pdf');
        }
        $agreements = new Agreement();
        $agreements['event_id'] = $id;
        $agreements['signature'] = $image;
        $agreements->save();
        $meeting->update(['total' => $request->grandtotal,'status'=>2]);
        $url = 'payment-view/'.urlencode(encrypt($id));
        return redirect($url);
    }
    public function uploadSignature($signed)
    {
        $folderPath = public_path('agreement/');
        $image_parts = explode(";base64,", $signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.' . $image_type;
        file_put_contents($file, $image_base64);
        return $file;
    }
    public function review_agreement($id)
    {
        $id = decrypt(urldecode($id));
        $meeting = Meeting::where('id', $id)->first();
        $status            = Meeting::$status;
        $attendees_lead    = Lead::where('id', $meeting->attendees_lead)->get()->pluck('leadname')->first();
        $users  = User::where('created_by', \Auth::user()->creatorId())->get();
        $function_p = explode(',', $meeting->function);
        $venue_function = explode(',', $meeting->venue_selection);
        $food_package = explode(',', $meeting->func_package);
        $user_id = explode(',', $meeting->user_id);
        $setup = Setup::all();
        // $function = Meeting::$function;
        $breakfast = Meeting::$breakfast;
        $lunch = Meeting::$lunch;
        $dinner = Meeting::$dinner;
        $wedding = Meeting::$wedding;
        return view('meeting.agreement.review_agreement', compact('user_id', 'users', 'setup','food_package', 'function_p', 'venue_function', 'meeting', 'breakfast', 'lunch', 'dinner', 'wedding', 'status','attendees_lead'))->with('start_date', $meeting->start_date)->with('end_date', $meeting->end_date);
    }
     public function mail_testing(){
          /*$settings=Utility::settings();
          
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
            ); */
                
         $maildata = [
                'name' => 'name',
                'email' => 'email',
            ];
        $mail = Mail::to('testing.test3215@gmail.com')->send(new TestingMail($maildata));
        if($mail){ 
          echo 'Email has sent successfully.'; 
        }else{ 
          echo 'Email sending failed.'; 
        }
        
        // $to = 'testing.test3215@gmail.com'; 
        // $from = 'testing.test3215@gmail.com'; 
        // $fromName = 'Sender_Name';
        // $subject = "Send Text Email with PHP by CodexWorld";
        // $message = "First line of text\nSecond line of text";
        // $headers = 'From: '.$fromName.'<'.$from.'>';
        // if(mail($to, $subject, $message, $headers)){ 
        //   echo 'Email has sent successfully.'; 
        // }else{ 
        //   echo 'Email sending failed.'; 
        // }
     }
    public function review_agreement_data(Request $request,$id){
       $meeting = Meeting::find($id);
       $settings=Utility::settings();
        if($request->status == 'Approve'){                
            $status = 3;
        } elseif ($request->status == 'Resend') {
            $status = 4;
        } elseif ($request->status == 'Withdraw') {
            // Lead::where('id',$)
            $status = 5;
        }
        $break_package = $lunch_package = $dinner_package = $wedding_package = '';
        if (isset($_REQUEST['venue'])) {
            $venue = implode(',', $_REQUEST['venue']);
        }
        if (isset($_REQUEST['function'])) {
            $function = implode(',', $_REQUEST['function']);
        }
        if (isset($_REQUEST['meal'])) {
            $meal = $_REQUEST['meal'];
        }

        if (isset($_REQUEST['break_package'])) {
            $break_package = implode(',', $_REQUEST['break_package']);
        }
        if (isset($_REQUEST['lunch_package'])) {
            $lunch_package = implode(',', $_REQUEST['lunch_package']);
        }
        if (isset($_REQUEST['dinner_package'])) {
            $dinner_package = implode(',', $_REQUEST['dinner_package']);
        }
        if (isset($_REQUEST['wedding_package'])) {
            $wedding_package = implode(',', $_REQUEST['wedding_package']);
        }
        $packagesArray = implode(',', array($break_package, $lunch_package, $dinner_package, $wedding_package));
        $meeting['user_id']           = implode(',', $request->user);
        $meeting['name']              = $request->name;
        $meeting['status']            = $request->status;
        $meeting['start_date']        = $request->start_date;
        $meeting['end_date']          = $request->end_date;
        $meeting['relationship']       = $request->relationship;
        $meeting['type']               = $request->type;
        $meeting['venue_selection']    = $request->venue_selection;
        $meeting['email']              = $request->email;
        $meeting['lead_address']      = $request->lead_address;
        $meeting['status']               = $status;
        $meeting['function']           = $function;
        $meeting['venue_selection']    = $venue;
        $meeting['func_package']       = $packagesArray;
        $meeting['guest_count']        = $request->guest_count;
        $meeting['room']                = $request->rooms;
        $meeting['meal']                = $meal;
        $meeting['bar']                 = $request->bar;
        $meeting['spcl_request']        = $request->spcl_request;
        $meeting['alter_name']          = $request->alter_name;
        $meeting['alter_email']         = $request->alter_email;
        $meeting['alter_relationship']  = $request->alter_relationship;
        $meeting['alter_lead_address']  = $request->alter_lead_address;
        $meeting['phone']               = $request->phone;
        $meeting['start_time']        = $request->start_time;
        $meeting['end_time']        = $request->end_time;
        $meeting['ad_opts']             = $request->add_opts;
        $meeting['floor_plan']          = $request->uploadedImage;
        $meeting['created_by']        = \Auth::user()->creatorId();
        $meeting->update();
        if($status == 3){
            return redirect()->back()->with('success', __('Event  Approved.'));
        }elseif($status == 4 ){
            Agreement::where('event_id',$id)->delete();
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
    
                Mail::to($meeting->email)->send(new SendEventMail($meeting));
            } catch (\Exception $e) {
                // \Log::error('Error sending email: ' . $e->getMessage());
                // return response()->json(
                //     [
                //         'is_success' => false,
                //         'message' => $e->getMessage(),
                //     ]
                // );
                  return redirect()->back()->with('success', 'Email Not Sent');
            }
            return redirect()->back()->with('success', __('Event  Resent.'));
        }elseif($status == 5){
            return redirect()->back()->with('success', __('Event  Withdrawn.'));
        }
        return redirect()->back()->with('success', __('Event  Updated.'));
    }
    public function buffer_time(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        
        $startDate = $request->startdate;
        $endDate = date('Y-m-d', strtotime($request->enddate . ' -1 day'));
        $venue = $request->venue;
        $blockdate = Blockdate::where(function ($query) use ($startDate, $endDate, $venue) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate]);
        })
            ->where('venue', 'like', '%' . $venue . '%')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        $meetings = Meeting::where(function ($query) use ($startDate, $endDate, $venue) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate]);
        })
            ->where('venue_selection', 'like', '%' . $venue . '%')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        $data = array_merge($blockdate, $meetings);
       
        if (!empty($data)) {
            $settings = Utility::settings();
            $settings = explode(":", $settings['buffer_time']);
    
            $bufferedTime = date('H:i:s', strtotime("+{$settings[0]} hour +{$settings[1]} minutes", strtotime($data[0]['end_time'])));
    
            return response()->json(['data' => $data, 'bufferedTime' => $bufferedTime]);
        }
    
        return response()->json(['data' => []]);     
    }
    public function getpackages(Request $request){
        $settings = Utility::settings();
        $add_items = json_decode($settings['additional_items'],true);
        $selectedFunctions = $request->selectedFunctions;
        // print_r($add_items);
        // print_r($request->all());
        // Iterate over each selected function
        foreach ($selectedFunctions as $selectedFunction) {
            // Check if the selected function exists in the meal details
            if (isset($add_items[$selectedFunction])) {
                $selectedFunctionDetails = $add_items[$selectedFunction];
                // Iterate over each meal type within the selected function
                print_r($selectedFunctionDetails);
               
                foreach ($selectedFunctionDetails as $mealType => $items) {
                    return json_encode($mealType);
                    echo "$mealType\n";
                    // Iterate over each item within the meal type
                    // foreach ($items as $item => $quantity) {
                    //     echo "Item: $item, Quantity: $quantity\n";
                    // }
                }
            } else {
                echo "'$selectedFunction' meal type not found.\n";
            }
        }

    }
}
