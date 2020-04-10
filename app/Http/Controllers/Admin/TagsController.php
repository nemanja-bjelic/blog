<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index (Request $request)
    {
        $tags = Tag::all();
        
        return view('admin.tags.index', [
            'tags' => $tags
        ]);
    }
    
    public function add (Request $request)
    {
        return view('admin.tags.add');
    }
    
    public function insert (Request $request)
    {
        $formData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name']
        ]);
        
        $newTag = new Tag();
        
        $newTag->fill($formData);
        
        $newTag->save();
        
        session()->flash('system_message', __('Tag has been added'));
        return redirect()->route('admin.tags.index');
    }
    
    public function edit (Request $request, Tag $tag)
    {
        return view('admin.tags.edit', ['tag'=> $tag]);
    }
    
    public function update (Request $request, Tag $tag)
    {
        $formData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('tags')->ignore($tag->id)]
        ]);
        
        $tag->fill($formData);
        
        $tag->save();
        
        session()->flash('system_message', $tag->name . __(' tag has been updated'));
        return redirect()->route('admin.tags.index');
    }
    
    public function delete (Request $request)
    {
        $formData = $request->validate([
            'id' => ['required', 'int']
        ]);
        
        $tag = Tag::findOrFail($formData['id']);
        
        $tag->delete();
        
        \DB::table('post_tags')
                ->where('tag_id', $tag->id)
                ->delete()
                ;
        
        session()->flash('system_message', $tag->name . __(' tag has been deleted'));
        
        return redirect()->route('admin.tags.index');
        
    }
}
