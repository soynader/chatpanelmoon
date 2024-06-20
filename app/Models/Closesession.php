<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Closesession extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'received_welcome'];

}
