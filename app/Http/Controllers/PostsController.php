<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use App\Models\PostComment;
use App\User;
use App\Models\PostView;

class PostsController extends Controller
{
    public function index (Request $request)
    {
        
        
        $posts = Post::query()
                ->with('postCategory', 'user')
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
        
        $latestPostIds = PostView::query()
                ->select(\DB::raw('count(post_id), post_id'))
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime(' 1 months ago')), date('Y-m-d H:i:s')])
                ->groupBy('post_id')
                ->orderBy('count(post_id)', 'desc')
                ->limit(3)
                ->pluck('post_id')
                ->toArray();
        

    
        
        return view('front.posts.index',[
            'posts' => $posts,
            'latestPostIds' => $latestPostIds
        ]);
    }
    
    public function categoryPosts (Request $request, PostCategory $postCategory ,$seoSlug = null)
    {
        
        if ($seoSlug != \Str::slug($postCategory->name)){
            return redirect()->away($postCategory->getFrontUrl());
        }
        
        $posts = Post::query()
                ->where('post_category_id', $postCategory->id)
                ->with(['postCategory', 'user'])
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
        
        $latestPostIds = PostView::query()
                ->select(\DB::raw('count(post_id), post_id'))
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime(' 1 months ago')), date('Y-m-d H:i:s')])
                ->groupBy('post_id')
                ->orderBy('count(post_id)', 'desc')
                ->limit(3)
                ->pluck('post_id')
                ->toArray()
                ;
        
        return view('front.posts.category_posts', [
            'posts' => $posts,
            'postCategory' => $postCategory,
            'latestPostIds' => $latestPostIds
        ]);
    }
    
    public function tagPosts (Request $request, Tag $tag, $seoSlug = null)
    {
        
        if ($seoSlug != \Str::slug($tag->name)){
            return redirect()->away($tag->getFrontUrl());
        }
        
        $posts = Post::query()
                ->whereHas('tags', function ($query) use($tag){
                    $query->where('tag_id', $tag->id);
                })
                ->with('postCategory', 'user')
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
                
        $latestPostIds = PostView::query()
                ->select(\DB::raw('count(post_id), post_id'))
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime(' 1 months ago')), date('Y-m-d H:i:s')])
                ->groupBy('post_id')
                ->orderBy('count(post_id)', 'desc')
                ->limit(3)
                ->pluck('post_id')
                ->toArray()
                ;
                
        
        return view('front.posts.tag_posts', [
            'tag' => $tag,
            'posts' => $posts,
            'latestPostIds' => $latestPostIds
            
        ]);
    }
    
    public function authorPosts (Request $request, User $user, $seoSlug = null)
    {
        
        if ($seoSlug != \Str::slug($user->name)){
            return redirect()->away($user->getFrontUrl());
        }
        
        $posts = Post::query()
                ->where('user_id', $user->id)
                ->with(['postCategory', 'user'])
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
        
        
        $latestPostIds = PostView::query()
                ->select(\DB::raw('count(post_id), post_id'))
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime(' 1 months ago')), date('Y-m-d H:i:s')])
                ->groupBy('post_id')
                ->orderBy('count(post_id)', 'desc')
                ->limit(3)
                ->pluck('post_id')
                ->toArray()
                ;
        
        
        return view('front.posts.author_posts', [
            'posts' => $posts,
            'user' => $user,
            'latestPostIds' => $latestPostIds
        ]);
    }
    
    
    public function singlePost (Request $request, Post $post, $seoSlug = null)
    {
        
        if ($seoSlug != \Str::slug($post->title)){
            return redirect()->away($post->getFrontUrl());
        }
        
        $tags = Tag::query()
                ->whereHas('posts', function ($query) use($post) {
                    $query->where('post_id', $post->id);
                })
                ->with(['posts'])
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ;
                
        $comments = PostComment::query()
                ->orderBy('created_at', 'desc')
                ->get()
                ;
        
        $previousPost = Post::query()
                ->where('created_at', '<', $post->created_at)
                ->orderBy('created_at', 'desc')
                ->first()
                ;
        
        $nextPost = Post::query()
                ->where('created_at', '>', $post->created_at)
                ->orderBy('created_at', 'asc')
                ->first()
                ;
        
        $latestPostIds = PostView::query()
                ->select(\DB::raw('count(post_id), post_id'))
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime(' 1 months ago')), date('Y-m-d H:i:s')])
                ->groupBy('post_id')
                ->orderBy('count(post_id)', 'desc')
                ->limit(3)
                ->pluck('post_id')
                ->toArray();
        
        return view('front.posts.single_post', [
            'post' => $post,
            'tags' => $tags,
            'comments' => $comments,
            'previousPost' => $previousPost,
            'nextPost' => $nextPost,
            'latestPostIds' => $latestPostIds
        ]);
    }
    
    public function increseViews(Request $request, Post $post) 
    {
        
        $numberOfViews = $post->visits_number;
        
        
        $post->visits_number = $numberOfViews + 1;
        
        
        $post->save();
        
        $newPostView = new PostView();
        
        $newPostView->post_id = $post->id;
        
        $newPostView->save();
    }
    
    public function singlePostComment(Request $request, Post $post)
    {
        $formData = $request->validate([
            'user_name' => ['required', 'string', 'min:2', 'max:255'],
            'user_email' => ['required', 'email'],
            'content' => ['required', 'string', 'min:2', 'max:5000']
        ]);
        
        $newPostComment = new PostComment();
        
        $newPostComment->fill($formData);
        
        $newPostComment->post_id = $post->id;
        
        $newPostComment->save();
        
        $currentPostNumber = $post->comments_number;
        
        $post->comments_number = $currentPostNumber + 1;
        
        $post->save();
        
        return response()->json([
            'system_message' => 'You posted your comment successfuly'
        ]);
    }
    
    
    public function showPostComments (Post $post)
    {
        $postComments = PostComment::query()
                ->where('post_id', $post->id)
                ->orderBy('created_at')
                ->get()
                ;
        
        return view('front.posts.partials.comments', [
            'postComments' => $postComments
        ]);
    }
    
    public function searchPosts (Request $request)
    {
        
        $formData = $request->validate([
            'search_term' => ['required', 'string', 'max:255']
        ]);
        
        $posts = Post::query()
                ->orderBy('created_at', 'desc')
                ->where('title', 'LIKE', '%' . $formData['search_term'] . '%')
                ->orWhere('description', 'LIKE', '%' . $formData['search_term'] . '%')
                ->orWhere('content', 'LIKE', '%' . $formData['search_term'] . '%')
                ->paginate(12)
                ;
        $latestPostIds = PostView::query()
                ->select(\DB::raw('count(post_id), post_id'))
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime(' 1 months ago')), date('Y-m-d H:i:s')])
                ->groupBy('post_id')
                ->orderBy('count(post_id)', 'desc')
                ->limit(3)
                ->pluck('post_id')
                ->toArray();
        
        return view('front.posts.search_posts', [
            'posts' => $posts,
            'searchTerm' => $formData['search_term'],
            'latestPostIds' => $latestPostIds
                ]);
    }
    
    
    
}
