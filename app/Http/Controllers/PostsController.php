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
        
        
        $posts = Post::query()
                ->with('postCategory', 'user')
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
        
        $latestPosts = Post::query()
                    ->orderBy('created_at')
                    ->limit(3)
                    ->get()
                    ;
        
        $postCategories = PostCategory::query()
                ->orderBy('priority')
                ->withCount(['posts'])
                ->get()
                ;
        
        $allTags = Tag::query()
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ;
        
        return view('front.posts.index',[
            'posts' => $posts,
            'latestPosts' => $latestPosts,
            'postCategories' => $postCategories,
            'allTags' => $allTags
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
                ->orderBy('created_at')
                ->limit(3)
                ->get()
                ;
        
        
        $allTags = Tag::query()
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ;
        
        return view('front.posts.category_posts', [
            'posts' => $posts,
            'postCategory' => $postCategory,
            'postCategories' => $postCategories,
            'latestPosts' => $latestPosts,
            'allTags' => $allTags,
        ]);
    }
    
    public function tagPosts (Request $request, Tag $tag)
    {
        
        $posts = Post::query()
                ->whereHas('tags', function ($query) use($tag){
                    $query->where('tag_id', $tag->id);
                })
                ->with('postCategory', 'user')
                ->orderBy('created_at')
                ->paginate(12)
                ;
                
        $postCategories = PostCategory::query()
                ->orderBy('priority')
                ->withCount(['posts'])
                ->get()
                ;
        
        $latestPosts = Post::query()
                ->orderBy('created_at')
                ->limit(3)
                ->get()
                ;
        
        
        $allTags = Tag::query()
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ;
        
        return view('front.posts.tag_posts', [
            'tag' => $tag,
            'posts' => $posts,
            'postCategories' => $postCategories,
            'latestPosts' => $latestPosts,
            'allTags' => $allTags,
            
        ]);
    }
    
    
    public function singlePost (Request $request, Post $post)
    {
        
        $tags = Tag::query()
                ->whereHas('posts', function ($query) use($post) {
                    $query->where('post_id', $post->id);
                })
                ->with(['posts'])
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ;
                
        $postCategories = PostCategory::query()
                ->orderBy('priority')
                ->withCount(['posts'])
                ->get()
                ;
        
        $latestPosts = Post::query()
                ->orderBy('created_at')
                ->limit(3)
                ->get()
                ;
        
        
        $allTags = Tag::query()
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ;
        
        return view('front.posts.single_post', [
            'post' => $post,
            'tags' => $tags,
            'postCategories' => $postCategories,
            'latestPosts' => $latestPosts,
            'allTags' => $allTags,
        ]);
    }
    
    public function increseViews(Request $request, Post $post) 
    {
        //dd($post);
        
        $numberOfViews = $post->visits_number;
        
        
        $post->visits_number = $numberOfViews + 1;
        
        
        $post->save();
    }
    
    
}
