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
    
    protected $fillable = ['title', 'description', 'content', 'post_category_id', 'important'];
    
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
        if (empty($this->photo)) {
            return url('/themes/front/img/featured-pic-1.jpeg');
        }
        
        $photoUrl = url('/storage/posts/'.$this->photo);
        
        return $photoUrl;
    }
    
    public function getPhotoThumbUrl()
    {
        if (empty($this->photo)) {
            return url('/themes/front/img/small-thumbnail-1.jpg');
        }
        
        $photoUrl = url('/storage/posts/thumbs/'.$this->photo);
        
        return $photoUrl;
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
   
    
    public function deletePhoto()
	{
		if (!$this->photo) {
			return $this;
		}
		
		$photoFilePath = public_path('/storage/posts/' . $this->photo);
		
		if (!is_file($photoFilePath)) {
			
			return $this;
		}
		
		unlink($photoFilePath);
		
		$photoThumbPath = public_path('/storage/posts/thumbs/' . $this->photo);
		
		if (!is_file($photoThumbPath)) {
			return $this;
		}
		
		unlink($photoThumbPath);
		
		return $this;
	}
}
