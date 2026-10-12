<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'status' => ['nullable', Rule::in(ContactMessage::STATUSES)],
        ]);

        $messages = ContactMessage::query()
            ->when($validated['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('admin.messages.index', [
            'messages' => $messages,
            'statusFilter' => $validated['status'] ?? null,
            'statuses' => ContactMessage::STATUSES,
        ]);
    }

    public function show(ContactMessage $contactMessage): View
    {
        if ($contactMessage->status === ContactMessage::STATUS_NEW) {
            $contactMessage->update(['status' => ContactMessage::STATUS_SEEN]);
        }

        return view('admin.messages.show', [
            'contactMessage' => $contactMessage,
            'statuses' => ContactMessage::STATUSES,
        ]);
    }

    public function updateStatus(Request $request, ContactMessage $contactMessage): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(ContactMessage::STATUSES)],
        ]);

        $contactMessage->update(['status' => $validated['status']]);

        return redirect()->route('admin.messages.show', $contactMessage)->with('success', 'Message status updated.');
    }
}
