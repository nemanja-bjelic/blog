<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PostComment;
use App\Models\Post;

class CommentsController extends Controller
{
    public function index ()
    {
        $comments = PostComment::query()
                ->with(['post'])
                ->orderBy('created_at', 'desc')
                ->get()
                ;
        
        return view('admin.comments.index', [
            'comments' =>$comments
        ]);
    }
    
    public function commentsTable(Request $request)
    {
        $comments = PostComment::query()
                ->with(['post'])
                ->orderBy('created_at', 'desc')
                ->get()
                ;
        
        return view('admin.comments.partials.comments_table', [
            'comments' => $comments
        ]);
    }
    
    public function enable (Request $request)
    {
        $formData = $request->validate([
            'id' => ['required', 'int', 'exists:post_comments,id']
        ]);
        
        $postComment = PostComment::findOrFail($formData['id']);
        
        $postComment->status = PostComment::STATUS_ENABLED;
        
        $postComment->save();
        
        $post = Post::findOrFail($postComment->post_id);
                
        
        $post->comments_number = $post->comments_number + 1;
        
        $post->save();
        
        return response()->json([
            'system_message' => __('Comment has been enabled')
        ]);
    }
    
    public function disable (Request $request)
    {
        $formData = $request->validate([
            'id' => ['required', 'int', 'exists:post_comments,id']
        ]);
        
        $postComment = PostComment::findOrFail($formData['id']);
        
        $postComment->status = PostComment::STATUS_DISABLED;
        
        $postComment->save();
        
        $post = Post::findOrFail($postComment->post_id);
                
        
        $post->comments_number = $post->comments_number - 1;
        
        $post->save();
        
        return response()->json([
            'system_message' => __('Comment has been disable')
        ]);
    }
}
