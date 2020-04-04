<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;

class IndexController extends Controller
{
    public function index ()
    {
        
        $sliders = Slider::query()
                ->where('status', 1)
                ->orderBy('priority')
                ->get();
        
        return view('front.index.index', [
            'sliders' => $sliders
        ]);
    }
}
