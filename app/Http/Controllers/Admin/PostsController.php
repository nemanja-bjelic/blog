<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;

class PostsController extends Controller
{
    public function index (Request $request)
    {
        
        return view('admin.posts.index', [
            
        ]);
    }
    
    
    public function datatable(Request $request) 
    {
       
        $searchFilters = $request->validate([
			'status' => ['nullable', 'in:0,1'],
			'title'	 => ['nullable', 'string', 'max:255'],
			'user_id' => ['nullable', 'int', 'exists:users,id'],
			'post_category_id' => ['nullable', 'int', 'exists:post_categories,id'],
                        'important' => ['nullable', 'in:0,1'],
                        'tag_ids' => ['nullable', 'array', 'exists:tags,id']
		]);
        
        $query = Post::query()
                ->with(['user', 'postCategory', 'tags'])
                ->leftJoin('post_categories', 'posts.post_category_id', '=', 'post_categories.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select(['posts.*', 'post_categories.name AS post_category_name', 'users.name AS user_name'])
                ;


        $datatable = \DataTables::of($query);

        $datatable->addColumn('tags', function ($post) {
                    return optional($post->tags->pluck('name'))->join(', ');
                })
                ->editColumn('actions', function ($post) {
                    return view('admin.posts.partials.actions', ['post' => $post]);
                })
                ->editColumn('photo', function ($post) {
                    return view('admin.posts.partials.post_photo', ['post' => $post]);
                })
                ->editColumn('created_at', function ($post) {
                    return view('admin.posts.partials.created_at', ['post' => $post]);
                })
                ->editColumn('status', function ($post) {
                    return view('admin.posts.partials.status', ['post' => $post]);
                })
                ->editColumn('important', function ($post) {
                    return view('admin.posts.partials.important', ['post' => $post]);
                })
                ->editColumn('post_category_name', function ($post) {
                    return view('admin.posts.partials.post_category', ['post' => $post]);
                })
                ;
                
        $datatable->filter(function ($query) use ($request, $searchFilters) {

            if (
                    $request->has('search') &&
                    is_array($request->get('search')) &&
                    isset($request->get('search')['value'])
            ) {
                $searchTerm = $request->get('search')['value'];

                $query->where(function ($query) use ($searchTerm) {

                    $query->orWhere('posts.title', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('posts.id', '=', $searchTerm);
                });
            }

                        if (isset($searchFilters['status'])) {
				$query->where('posts.status', '=', $searchFilters['status']);
			}

			if (isset($searchFilters['title'])) {
				$query->where('posts.title', 'LIKE', '%' . $searchFilters['title'] . '%');
			}
			
			if (isset($searchFilters['user_id'])) {
				$query->where('posts.user_id', '=', $searchFilters['user_id']);
			}
                        
                        if (isset($searchFilters['post_category_id'])) {
				$query->where('posts.post_category_id', '=', $searchFilters['post_category_id']);
			}
			
                        
                        if (isset($searchFilters['important'])) {
				$query->where('posts.important', '=', $searchFilters['important']);
			}
                        if (isset($searchFilters['tag_ids'])) {
                                $query->whereHas('tags', function ($subQuery) use ($searchFilters){
                                    $subQuery->whereIn('tag_id', $searchFilters['tag_ids']);
                                });
			}
		});



        return $datatable->make(true);
    }
    
    
    public function add (Request $request)
    {
        return view('admin.posts.add');
    }
    
    public function insert (Request $request)
    {
       $formData = $request->validate([
           'post_category_id' => ['nullable', 'int', 'exists:post_categories,id'],
           'title' => ['required', 'string', 'min:20', 'max:255'],
           'description' => ['required', 'string', 'min:50', 'max:500'],
           'important' => ['required', 'int', 'in:0,1'],
           'tag_id' => ['required', 'array', 'exists:tags,id'],
           'photo' => ['nullable', 'file', 'image'],
           'content' => ['required', 'string']
       ]);
       
       $newPost = new Post();
       
       $newPost->fill($formData);
       
       $newPost->user_id = \Auth::user()->id;
       
       $newPost->save();
       
       $newPost->tags()->sync($formData['tag_id']);
       
       
       
       $this->handlePhotoUpload($request, $newPost);
       
       session()->flash('system_message', 'New post has been added');
       return redirect()->route('admin.posts.index');
       
    }
    
    public function edit (Request $request, Post $post)
    {
        return view('admin.posts.edit',[
            'post' => $post
        ]);
    }
    
    public function update (Request $request, Post $post)
    {
        $formData = $request->validate([
           'post_category_id' => ['nullable', 'int', 'exists:post_categories,id'],
           'title' => ['required', 'string', 'min:20', 'max:255'],
           'description' => ['required', 'string', 'min:50', 'max:500'],
           'important' => ['required', 'int', 'in:0,1'],
           'tag_id' => ['required', 'array', 'exists:tags,id'],
           'photo' => ['nullable', 'file', 'image'],
           'content' => ['required', 'string']
       ]);
       
       $post->fill($formData);
       
       $post->user_id = \Auth::user()->id;
       
       $post->save();
       
       $post->tags()->sync($formData['tag_id']);
       
       
       
       $this->handlePhotoUpload($request, $post);
       
       session()->flash('system_message', 'Post has been edited');
       return redirect()->route('admin.posts.index');
    }
    
    public function delete (Request $request)
    {
        $formData = $request->validate([
			'id' => ['required', 'numeric', 'exists:posts,id'],
		]);


		$post = Post::findOrFail($formData['id']);
                
                $post->deletePhoto();
		
		$post->delete();
                
                \DB::table('post_tags')
                        ->where('post_id', $post->id)
                        ->delete()
                        ;

		return response()->json([
			'system_message' => __('Post has been deleted')
		]);
    }
    
    public function disable(Request $request)
	{
		$formData = $request->validate([
			'id' => ['required', 'numeric', 'exists:posts,id'],
		]);


		$post = Post::findOrFail($formData['id']);
		
		$post->status = POST::STATUS_DISABLED;
		$post->save();

		return response()->json([
			'system_message' => __('Post has been disabled')
		]);
	}

	public function enable(Request $request)
	{
		$formData = $request->validate([
			'id' => ['required', 'numeric', 'exists:posts,id'],
		]);
		
		$post = Post::findOrFail($formData['id']);
		
		
		$post->status = Post::STATUS_ENABLED;
                
		$post->save();

		return response()->json([
			'system_message' => __('Post has been enabled')
		]);
	}
        
        
        public function unimportant(Request $request)
	{
		$formData = $request->validate([
			'id' => ['required', 'numeric', 'exists:posts,id'],
		]);


		$post = Post::findOrFail($formData['id']);
		
		$post->important = Post::NOT_IMPORTANT;
		$post->save();

		return response()->json([
			'system_message' => __('Post has been set as important')
		]);
	}

	public function important(Request $request)
	{
		$formData = $request->validate([
			'id' => ['required', 'numeric', 'exists:posts,id'],
		]);
		
		$post = Post::findOrFail($formData['id']);
		
		
		$post->important = Post::IS_IMPORTANT;
                
		$post->save();

		return response()->json([
			'system_message' => __('Post has been set as unimportand')
		]);
	}
        
        public function deletePhoto (Request $request, Post $post)
        {
            $post->deletePhoto();
            
            $post->photo = null;
            
            $post->save();
            
            return response()->json([
                'system_message' => _('Photo has been deleted'),
                'photo_url' => $post->getPhotoUrl()
            ]);
        }
        
        
        protected function handlePhotoUpload(Request $request, Post $post)
	{
		if ($request->hasFile('photo')) {


			$post->deletePhoto();

			$photoFile = $request->file('photo');

			$newPhotoFileName = $post->id . '_' . $photoFile->getClientOriginalName();

			$photoFile->move(
				public_path('/storage/posts/'), $newPhotoFileName
			);

			$post->photo = $newPhotoFileName;

			$post->save();

			//originalna slika
			\Image::make(public_path('/storage/posts/' . $post->photo))
				->fit(1280, 853)
				->save();

			//thumb slika
			\Image::make(public_path('/storage/posts/' . $post->photo))
				->fit(256, 256)
				->save(public_path('/storage/posts/thumbs/' . $post->photo));
		}
	}

}
