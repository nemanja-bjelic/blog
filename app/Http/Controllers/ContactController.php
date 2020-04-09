<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Models\PostView;

class ContactController extends Controller
{
    public function index () 
    {
        
        $latestPostIds = PostView::query()
                ->select(\DB::raw('count(post_id), post_id'))
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime(' 1 months ago')), date('Y-m-d H:i:s')])
                ->groupBy('post_id')
                ->orderBy('count(post_id)', 'desc')
                ->limit(3)
                ->pluck('post_id')
                ->toArray();
        
        
        return view('front.contact.index', [
            'latestPostIds' => $latestPostIds
        ]);
    }
    
    public function sendEmail(Request $request)
    {
        // contact data validation
        $formData = $request->validate([
            'contact_name' => ['required', 'string', 'min:2'],
            'contact_email' => ['required', 'email'],
            'contact_message' => ['required', 'string', 'min:50', 'max:255'],
            'g-recaptcha-response' => 'recaptcha'
        ]);
        
        //dd($request->segment(1));
        
        // sending mail with contact data
        \Mail::to('nemanja.bjelic353@gmail.com')->send(new ContactFormMail(
                $formData['contact_email'],
                $formData['contact_name'],
                $formData['contact_message']
                ));
        session()->flash('system_message', __('We have received your message. We will contact you soon.'));
        
        return redirect()->back();
                
    }
}
