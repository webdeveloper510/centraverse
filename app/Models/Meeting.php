<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Meeting extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected 
    $fillable = [
        'user_id',
        'name',
        'status',
        'start_date',
        'end_date',
        'description',
        'attendees_user',
        'attendees_lead',
        'food_package',
        'total',
        'ad_opts',
        'phone',
        'setup_plans'
    ];
    public static $status   = [
        'Share Agreement',
        'Waiting For Customer Confirmation',
        'Customer Confirmed / Need Admin Approval',
        'Approved',
        'Resent',
        'Withdrawn'
    ];
    public static $parent   = [
        '' => '--',
        'account' => 'Account',
        'contact' => 'Contact',
        'opportunities' => 'Opportunities',
        'case' => 'Case',
    ];
    
   
    public function assign_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

   
    public function attendees_leads()
    {
        return $this->hasOne('App\Models\Lead', 'id', 'attendees_lead');
    }
   
    public function user()
    {
    return $this->belongsTo(User::class, 'created_by');
    }
}