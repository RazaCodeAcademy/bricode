<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id', 
        'amount', 
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}

