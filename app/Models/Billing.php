<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table= 'billing';
    public static $status   = [
        'Create Bill',
        'Bill created',
        'Payment In Process',
        'Payment Completed',
    ];
}
