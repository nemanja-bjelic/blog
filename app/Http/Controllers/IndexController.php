<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\Post;

class IndexController extends Controller
{
    public function index ()
    {
        
        $sliders = Slider::query()
                ->where('status', 1)
                ->orderBy('priority')
                ->get();
        
        $postsQuery = Post::query()
                ->with(['user', 'postCategory'])
                ->where('status', 1)
                ;
        
        $posts = $postsQuery
                ->where('important', 1)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get()
                ;
        
        
        $latestPosts = $postsQuery
                ->orderBy('created_at', 'desc')
                ->limit(12)
                ->get()
                ;
        
        
        
        return view('front.index.index', [
            'sliders' => $sliders,
            'posts' => $posts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
