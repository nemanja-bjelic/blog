<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;

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
        
        $tags = Tag::query()
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ;
        
        return view('front.posts.index',[
            'posts' => $posts,
            'latestPosts' => $latestPosts,
            'postCategories' => $postCategories,
            'tags' => $tags
        ]);
    }
    
    public function categoryPosts (Request $request, PostCategory $postCategory)
    {
        $posts = Post::query()
                ->where('post_category_id', $postCategory->id)
                ->with(['postCategory', 'user'])
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
        
        $postCategories = PostCategory::query()
                ->orderBy('priority')
                ->withCount(['posts'])
                ->get()
                ;
        
        $latestPosts = Post::query()
                ->with('postCategory', 'user')
                ->orderBy('created_at')
                ->limit(3)
                ->get()
                ;
        
        
        $tags = Tag::query()
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ;
        
        return view('front.posts.category_posts', [
            'posts' => $posts,
            'postCategory' => $postCategory,
            'postCategories' => $postCategories,
            'latestPosts' => $latestPosts,
            'tags' => $tags,
        ]);
    }
    
    public function tagPosts (Request $request, Tag $tag)
    {
        
        
        return view('front.posts.tag_posts', [
            'tag' => $tag
        ]);
    }
}
