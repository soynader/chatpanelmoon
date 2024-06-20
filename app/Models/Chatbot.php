<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'estado'];

    public function flows()
    {
        return $this->hasMany(Flow::class, 'id');
    }
}
