<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refferaltransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'referal_recever_id', 
        'amount', 
    ];
}
