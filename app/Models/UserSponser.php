<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSponser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sponser_user_id', 
        'placement', 
        'phase_no', 
    ];
}
