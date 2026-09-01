<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'business_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::create($validated);

        return back()->with('contact_success', 'Thanks for reaching out.  Our team will get back to you shortly.');
    }
    public function index(Request $request)
    {
        $messages = ContactMessage::query()
            ->orderByDesc('created_at')
            ->get();
        $selectedMessage = null;

        if ($request->filled('message')) {
            $selectedMessage = ContactMessage::findOrFail($request->integer('message'));
            if (! $selectedMessage->is_read) {
                $selectedMessage->update(['is_read' => true]);
            }
        }

        return view('admin.contact-messages.index', compact('messages', 'selectedMessage'));
    }

    public function reply(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'reply' => ['required', 'string', 'max:5000'],
        ]);

        Mail::raw($validated['reply'], function ($mail) use ($contactMessage) {
            $mail->to($contactMessage->email)
                ->subject('Re: Your CraveSupply message');
        });

        $contactMessage->update(['is_read' => true]);

        return redirect()
            ->route('admin.contact-messages.index', ['message' => $contactMessage->id])
            ->with('success', 'Reply sent successfully.');
    }
}
