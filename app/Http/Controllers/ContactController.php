<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function index () 
    {
        $systemMessage = session()->pull('system_message');
        
        return view('front.contact.index', [
            'system_message' => $systemMessage
        ]);
    }
    
    public function sendEmail(Request $request)
    {
        // contact data validation
        $formData = $request->validate([
            'contact_name' => ['required', 'string', 'min:2'],
            'contact_email' => ['required', 'email'],
            'contact_message' => ['required', 'string', 'min:10', 'max:255']
        ]);
        
        //dd($formData);
        
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