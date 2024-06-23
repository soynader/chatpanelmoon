<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    use HasFactory;
    protected $fillable = ['prompt_type', 'content', 'chatias_id'];

    public function chatias()
    {
        return $this->belongsTo(Chatia::class, 'chatias_id');
    }
}
