<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhasePairing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phase_no',
        'pair',
        'upgrade_counts',
    ];
}