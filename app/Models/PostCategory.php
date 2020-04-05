<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';
    
    protected $fillable = ['name', 'description'];
    
    public function posts ()
    {
        $this->hasMany(
                Post::class,
                'posts_category_id',
                'id'
                );
    }
}
