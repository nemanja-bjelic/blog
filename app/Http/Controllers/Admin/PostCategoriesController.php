<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\PostCategory;

class PostCategoriesController extends Controller
{
    public function index ()
    {
        $postCategories = PostCategory::query()->orderBy('priority')->get();
        
        return view('admin.post_categories.index', [
            'postCategories' => $postCategories
        ]);
    }
    
    
    public function add (Request $request)
    {
        return view('admin.post_categories.add');
    }
    
    public function insert (Request $request)
    {
        $formData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:post_categories,name'],
            'description' => ['required', 'string', 'min:50', 'max:500']
        ]);
        
        $newPostCategory = new PostCategory();
        
        $newPostCategory->fill($formData);
        
        $highestPriorityNumber = PostCategory::query()
                ->orderBy('priority', 'desc')
                ->first();
        if ($highestPriorityNumber){
            $newPostCategory->priority = $highestPriorityNumber->priority + 1;
        } else {
            $newPostCategory->priority = 1;
        }
        
        
        $newPostCategory->save();
        
        session()->flash('system_message', 'You add new post category');
        return redirect()->route('admin.post_categories.index');
    }
    
    public function edit (Request $request, PostCategory $postCategory)
    {
        return view('admin.post_categories.edit', ['postCategory' => $postCategory]);
    }

    
    public function update (Request $request, PostCategory $postCategory)
    {
        $formData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('post_categories')->ignore($postCategory->id)],
            'description' => ['required', 'string', 'min:50', 'max:500']
        ]);
        
        $postCategory->fill($formData);
        
        $postCategory->save();
        
        session()->flash('system_message', 'You updated post category' . $postCategory->name);
        return redirect()->route('admin.post_categories.index');
    }

    
    public function delete (Request $request)
    {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:post_categories,id']
        ]);
        
        $postCategoty = PostCategory::findOrFail($formData['id']);
        
        
        $postCategoty->delete();
        
        PostCategory::query()
                ->where('priority', '>', $postCategoty->priority)
                ->decrement('priority')
                ;
        
        session()->flash('system_message', $postCategoty->name . __(' post category has been deleted'));
        return redirect()->route('admin.post_categories.index');
    }
    
    public function changePriority (Request $request)
    {
        $formData = $request->validate([
            'priorities' => ['required', 'string']
        ]);
        
        $priorities = explode(',', $formData['priorities']);
        
        foreach($priorities as $key => $id){
            $postCategory = PostCategory::findOrFail($id);
            
            $postCategory->priority = $key + 1;
            
            $postCategory->save();
        }
        
        session()->flash('system_message', __('Post categories have been reordered!'));
        
        return redirect()->route('admin.post_categories.index');
    }
}
