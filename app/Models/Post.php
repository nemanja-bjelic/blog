<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    protected $fillable = ['title', 'photo', 'description', 'content', 'category_id', 'user_id', 'post_tags_id',];
    
    public function user () 
    {
        return $this->belongsTo(
                \App\User::class,
                'user_id',
                'id'
                );
    }
    
    public function postCategory ()
    {
        return $this->belongsTo(
                PostCategory::class,
                'post_category_id',
                'id'
                );
    }
    
    public function getPhotoUrl()
    {
        return url($this->photo);
    }
}
