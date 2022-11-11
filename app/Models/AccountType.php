<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'created_by', 'updated_by'
    ];

     // Get the user that owns the account Type
    public function user_created()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // Get the user that update the account Type
    public function user_updated()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    // get user name who create this account type
    public function created_by(){
        return $this->user_created ? $this->user_created->first_name. ' ' . $this->user_created->last_name  : 'N/A';
    }

    // get user name who create this account type
    public function updated_by(){
        return  $this->user_updated ? $this->user_updated->first_name. ' ' . $this->user_updated->last_name : 'N/A';
    }
    public function account_bal()
    {
        return $this->belongsTo(User::class, 'account_type', 'id');
    }
}
