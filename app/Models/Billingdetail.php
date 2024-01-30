<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billingdetail extends Model
{
    use HasFactory;
    protected $table = 'billindetails';
    protected $fillable = [
        'event_id',
        'venue_rental',
        'hotel_rooms',
        'equipment',
        'setup',
        'food'
    ];
    public static $status = [
        'In Process',
        'Payment Pending',
        'Payment Completed',
    ];
}
