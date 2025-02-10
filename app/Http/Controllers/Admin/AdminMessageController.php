<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMessageController extends Controller
{
    public function __construct()
    {
        // Remove the middleware from here since it's already in the routes
    }

    /**
     * Display a listing of messages
     */
    public function index()
    {
        $messages = Message::paginate(10);  // Adjust pagination as needed
        return view('admin.messages.index', compact('messages'));
    }

    public function reply(Request $request, Message $message)
    {
        // Validate the reply message
        $validated = $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        // Save the reply (assumes you have an 'admin_reply' field)
        $message->update([
            'admin_reply' => $validated['reply'],
            'is_read' => true,  // Mark as read
        ]);

        // Show success message using SweetAlert
        Alert::success('Success', 'Message replied successfully!');

        return redirect()->route('admin.messages.index')->with('success', 'Reply sent successfully');
    }

    public function replyToMessage(Request $request, Message $message)
{
    // Admin reply logic
    $message->admin_reply = $request->reply;
    $message->is_replied = true;  // Mark the message as replied
    $message->is_read = false;    // Keep it unread until the user views it
    $message->save();

    // Send the reply (e.g., via email or direct message)
}

}
