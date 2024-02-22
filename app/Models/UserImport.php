<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserImport extends Model
{
    use HasFactory;
    protected $table = 'importusers';
    protected $fillable = ['name','email','phone','address','organization','category'];
}
