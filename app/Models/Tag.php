<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    
    protected $fillable = ['name'];
    
    public function posts ()
    {
        return $this->belongsToMany(
                Post::class,
                'post_tags',
                'tag_id',
                'post_id'
                );
    }
    
    public function getFrontUrl ()
    {
        return route('front.posts.tag_posts', [
            'tag' => $this->id,
            'seoSlug' => $this->name
        ]);
    }
}
