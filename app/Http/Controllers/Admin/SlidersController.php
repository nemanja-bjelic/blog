<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;

class SlidersController extends Controller
{
    
    public function index() 
    {
        
        $sliders = Slider::query()
                ->orderBy('priority')
                ->get()
                ;
        
        return view('admin.sliders.index', [
            'sliders' => $sliders
        ]);
    }
    
    public function add(Request $request)
    {
        
        return view('admin.sliders.add', [
            
        ]);
    }
    
    public function insert(Request $request)
    {
        
        $formData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'button_title' => ['required', 'string', 'max:50'],
            'button_url' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'file', 'image', 'max:65000']
        ]);
        
        $newSlider = new Slider(); 
        
        $newSlider->fill($formData);
        
        $sliderWithHighestPriority = Slider::query()
                ->orderBy('priority', 'desc')
                ->first()
                ;
        
        $newSlider->priority = $sliderWithHighestPriority->priority + 1;
        
        $newSlider->save();
        
        $filePhoto = $request->file('photo');
        
        $filePhotoName = $newSlider->id. '_' . $filePhoto->getClientOriginalName();
        
        $filePhoto->move(public_path('/storage/sliders/'), $filePhotoName);
        
        $newSlider->photo = $filePhotoName;
        
        $newSlider->save();
        
        \Image::make(public_path('/storage/sliders/' . $newSlider->photo))
                ->fit(1280, 850)
                ->save()
                ;
        
        
        
        
        session()->flash('system_message', __('You add a slider'));
        return redirect()->route('admin.sliders.index');
    }
    
    public function edit(Request $request, Slider $slider)
    {
        return view('admin.sliders.edit', [
            'slider' => $slider
        ]);
    }
    
    public function update(Request $request, Slider $slider)
    {
        $formData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'button_title' => ['required', 'string', 'max:50'],
            'button_url' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'file', 'image', 'max:65000']
        ]);
        
        $slider->fill($formData);
        
        $slider->save();
        
        if ($request->has('photo')){
            
            $slider->deletePhoto();
            
            $filePhoto = $request->file('photo');
        
        $filePhotoName = $slider->id. '_' . $filePhoto->getClientOriginalName();
        
        $filePhoto->move(public_path('/storage/sliders/'), $filePhotoName);
        
        $slider->photo = $filePhotoName;
        
        $slider->save();
        
        \Image::make(public_path('/storage/sliders/' . $slider->photo))
                ->fit(1280, 850)
                ->save()
                ;
        }
        
        session()->flash('system_message', __('You edited a slider ') . $slider->id);
        return redirect()->route('admin.sliders.index');
    }
    
    
    public function delete (Request $request)
    {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:sliders,id']
        ]);
        
        $slider = Slider::findOrFail($formData['id']);
        
        Slider::query()
                ->where('priority', '>', $slider->priority)
                ->decrement('priority')
                ;
        
        $slider->delete();
        
        $slider->deletePhoto();
        
        return response()->json([
            'system_message' => __('Slider has been deleted')
        ]);
        
    }
    
    public function sliderTable(Request $request)
    {
        $sliders = Slider::query()
                ->orderBy('priority')
                ->get()
                ;
        
        return view('admin.sliders.partials.slider_table', [
            'sliders' => $sliders
        ]);
    }
    
    public function enable (Request $request)
    {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:sliders,id']
        ]);
        
        $slider = Slider::findOrFail($formData['id']);
        
        $slider->status = Slider::STATUS_ENABLED;
        
        $slider->save();
        
        return response()->json([
            'system_message' => __('Slider status has been enabled')
        ]);
    }
    
    public function disable (Request $request)
    {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:sliders,id']
        ]);
        
        $slider = Slider::findOrFail($formData['id']);
        
        $slider->status = Slider::STATUS_DISABLED;
        
        $slider->save();
        
        return response()->json([
            'system_message' => __('Slider status has been disabled')
        ]);
    }
    
    public function changePriority (Request $request)
    {
        $formData = $request->validate([
            'priorities' => ['required', 'string']
        ]);
        
        $priorities = explode(',', $formData['priorities']);
        
        foreach ($priorities as $key => $id) {
            
            $slider = Slider::findOrFail($id);
            
            $slider->priority = $key +1;
            
            $slider->save();
        }
        
        session()->flash('system_message', __('Sliders priority order has been changed'));
        return redirect()->route('admin.sliders.index');
    }
    
}
