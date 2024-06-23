<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatia extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'estado'];

    public function prompts()
    {
        return $this->hasMany(Prompt::class, 'id');
    }
}
