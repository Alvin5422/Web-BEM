<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = Message::latest();

        if ($request->has('unread')) {
            $query->where('is_read', false);
        }

        $messages = $query->paginate(12)->withQueryString();

        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function updateNotes(Request $request, Message $message)
    {
        $validated = $request->validate([
            'admin_notes' => 'nullable|string',
            'mark_replied' => 'nullable|boolean',
        ]);

        $message->update([
            'admin_notes' => $validated['admin_notes'] ?? null,
            'replied_at' => $request->boolean('mark_replied') ? now() : $message->replied_at,
        ]);

        return redirect()->route('admin.messages.show', $message)->with('success', 'Catatan pesan berhasil diperbarui.');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
