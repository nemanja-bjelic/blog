<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {
    
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    protected $table = 'sliders';
    protected $fillable = ['title', 'button_url', 'button_title', 'status',
        'priority', 'photo'];
    
    
    public function getPhotoUrl ()
    {
        if (empty($this->photo)) {
            return url('/themes/front/img/featured-pic-1.jpeg');
        }
        
        $photoUrl = url('/storage/sliders/'.$this->photo);
        
        return $photoUrl;
    }
    
    public function getButtonUrl ()
    {
        return url($this->button_url);
    }
    
    public function deletePhoto ()
    {
        if (empty($this->photo)) {
            return $this;
        }
        
        $filePhotoPath = public_path('/storage/sliders/').$this->photo;
        
        if (!is_file($filePhotoPath)) {
            return $this;
        }
        
        unlink($filePhotoPath);
        
        return $this;
    }

}
