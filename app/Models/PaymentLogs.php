<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLogs extends Model
{
    use HasFactory;
    protected $table = 'payment_logs';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_of_card',
        'amount',
        'response_code',
        'transaction_id',
        'auth_id',
        'message_code',
        'qty'
    ];
}
