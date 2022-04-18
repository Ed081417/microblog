<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model 
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'dob',
        'uname',
        'uemail',
        'profile'
    ];
}
