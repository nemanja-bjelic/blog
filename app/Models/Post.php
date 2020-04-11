<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    
    const IS_IMPORTANT = 1;
    const NOT_IMPORTANT = 0;
    
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
    
    public function tags () 
    {
        return $this->belongsToMany(
                Tag::class,
                'post_tags',
                'post_id',
                'tag_id'
                );
    }
    
    public function postViews()
    {
        return $this->hasMany(
                PostView::class,
                'post_id',
                'id'
                );
    }
    
    
    
    public function getPhotoUrl()
    {
        return url($this->photo);
    }
    
    public function getFrontUrl()
    {
        return route('front.posts.single_post', [
            'post' => $this->id,
            'seoSlug' => \Str::slug($this->title)
                ]);
    }
    
    public function isEnabled() 
    {
        return $this->status == self::STATUS_ENABLED;
    }

    public function isDisabled() 
    {
        return $this->status == self::STATUS_DISABLED;
    }
    
    
    public function isImportant() 
    {
        return $this->important == self::IS_IMPORTANT;
    }

    public function notImportant() 
    {
        return $this->important == self::NOT_IMPORTANT;
    }
   
}
