<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['user_id', 'book_id', 'parent_id', 'content', 'rating'];
    public function user() 
    { 
        return $this->belongsTo(User::class); 
    }
    public function book() 
    { 
        return $this->belongsTo(Book::class); 
    }
    public function replies() 
    { 
        return $this->hasMany(Comment::class, 'parent_id'); 
    }
}
