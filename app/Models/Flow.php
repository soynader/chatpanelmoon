<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Flow extends Model
{
    use HasFactory;

    protected $fillable = ['keyword', 'answer', 'media_path', 'media_url', 'chatbots_id'];

    public function chatbots()
    {
        return $this->belongsTo(Chatbot::class, 'chatbots_id');
    }

    // Mutator to save the full URL
    public function setMediaPathAttribute($value)
    {
        if ($value) {
            $this->attributes['media_path'] = $value;
            $this->attributes['media_url'] = url('storage/' . $value);
        }
    }
}
