<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\PostCategory;

class PostsController extends Controller
{
    public function index (Request $request)
    {
        $postsQuery = Post::query()
                ->with('postCategory', 'user')
                ;
        
        $posts = $postsQuery
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
        
        $latestPosts = $postsQuery
                ->orderBy('created_at')
                ->limit(3)
                ->get()
                ;
        
        $postCategories = PostCategory::query()
                ->orderBy('priority')
                ->withCount(['posts'])
                ->get()
                ;
        
        return view('front.posts.index',[
            'posts' => $posts,
            'latestPosts' => $latestPosts,
            'postCategories' => $postCategories
        ]);
    }
}
