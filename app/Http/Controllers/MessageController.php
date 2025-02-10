<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        try {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        Message::create([
            'user_id' => Auth::id(), // Changed to use Auth facade
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        Alert::success('Success', 'Your message has been sent successfully!');
        return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully.');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Sorry, there was a problem sending your message. Please try again.')
            ->withInput();
    }
}

    public function userMessages()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $messages = Message::where('user_id', Auth::id()) // Changed to use Auth facade
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('user.messages', compact('messages'));
    }

    public function showMessage(Message $message)
{
    // Mark the message as read when the user views it
    $message->is_read = true;
    $message->save();

    return view('user.messages.show', compact('message'));
}

}