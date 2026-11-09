<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactInboxController extends Controller
{
    public function index()
    {
        // Fetch contacts ordered by newest first, paginated
        $messages = Contact::orderBy('created_at', 'desc')->paginate(15);

        return view('screens.admin.inbox.index', compact('messages'));
    }

    public function show(Contact $contact)
    {
        // Mark as read when the admin opens it
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('screens.admin.inbox.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.inbox.index')->with('success', 'Message deleted successfully.');
    }
}
