<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setuplans extends Model
{
    use HasFactory;
    protected $table = 'setuplans';
    protected $fillable = [
        'setp_docs',
    ];
}
