<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Botia extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'prompt', 'chatias_id'];

    public function chatias()
    {
        return $this->belongsTo(Chatia::class, 'chatias_id');
    }
}
