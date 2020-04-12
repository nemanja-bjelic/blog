<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    
    protected $table = 'post_comments';
    
    protected $fillable = ['user_name', 'user_email', 'content'];
    
    public function post () 
    {
        return $this->hasOne(
                Post::class,
                'id',
                'post_id'
                );
    }
    
    public function isEnabled() 
    {
        return $this->status == self::STATUS_ENABLED;
    }

    public function isDisabled() 
    {
        return $this->status == self::STATUS_DISABLED;
    }
    
}
