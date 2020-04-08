<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use App\Models\PostComment;
use App\User;

class PostsController extends Controller
{
    public function index (Request $request)
    {
        
        
        $posts = Post::query()
                ->with('postCategory', 'user')
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
        

        
        return view('front.posts.index',[
            'posts' => $posts,
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
        

        
        return view('front.posts.category_posts', [
            'posts' => $posts,
            'postCategory' => $postCategory,
        ]);
    }
    
    public function tagPosts (Request $request, Tag $tag)
    {
        
        $posts = Post::query()
                ->whereHas('tags', function ($query) use($tag){
                    $query->where('tag_id', $tag->id);
                })
                ->with('postCategory', 'user')
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
                
        
        return view('front.posts.tag_posts', [
            'tag' => $tag,
            'posts' => $posts,
            
        ]);
    }
    
    public function authorPosts (Request $request, User $user)
    {
        $posts = Post::query()
                ->where('user_id', $user->id)
                ->with(['postCategory', 'user'])
                ->orderBy('created_at', 'desc')
                ->paginate(12)
                ;
        

        
        return view('front.posts.author_posts', [
            'posts' => $posts,
            'user' => $user,
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
                
        $comments = PostComment::query()
                ->orderBy('created_at', 'desc')
                ->get()
                ;
        
        $previousPost = Post::query()
                ->where('id', '<', $post->id)
                ->orderBy('id', 'desc')
                ->first()
                ;
        
        $nextPost = Post::query()
                ->where('id', '>', $post->id)
                ->orderBy('id', 'asc')
                ->first()
                ;
        
        return view('front.posts.single_post', [
            'post' => $post,
            'tags' => $tags,
            'comments' => $comments,
            'previousPost' => $previousPost,
            'nextPost' => $nextPost
        ]);
    }
    
    public function increseViews(Request $request, Post $post) 
    {
        
        $numberOfViews = $post->visits_number;
        
        
        $post->visits_number = $numberOfViews + 1;
        
        
        $post->save();
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
        
        //$posts->withPath('');
        //dd($formData);
        
        return view('front.posts.search_posts', [
            'posts' => $posts,
            'searchTerm' => $formData['search_term']
                ]);
    }
    
    
    
}
