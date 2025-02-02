<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{
    use HasFactory;
    protected $fillable = ['welcomereply', 'defaultreply', 'session_duration'];
}
 