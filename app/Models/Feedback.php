<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject',
        'message',
    ];

    public function photos(){
        return $this->hasMany(Photo::class, 'parent_id', 'id')->where('parent_type', Feedback::class);

    }

    public function get_image()
    {
        $image = !empty($this->photos->sortByDesc('created_at')->first());
        $image = $image ? $this->photos->sortByDesc('created_at')->first()->path : '';
        if(!empty($image) && file_exists(public_path().'/storage/'.$image)){
            return asset('public/storage/'.$image);
        }else{
            return asset('public/app-assets/images/portrait/small/avatar-s-19.png');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
