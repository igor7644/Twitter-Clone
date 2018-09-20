<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function numberOfComments()
    {
        return $this->comments->count();
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function numberOfLikes()
    {
        return $this->likes->count();
    }
}
