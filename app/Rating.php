<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded = [];

    public function posts(){
        return $this->belongsTo(Post::class);
    }

    public function ratingBy(){
        return $this->belongsTo(User::class);
    }
}
