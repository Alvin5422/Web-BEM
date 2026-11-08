<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->paginate(15);
        $events = Event::orderBy('event_date', 'desc')->get();

        return view('admin.media.index', compact('media', 'events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'caption' => 'nullable|string|max:255',
            'category' => 'required|string|max:100',
            'event_id' => 'nullable|exists:events,id',
            'taken_at' => 'nullable|date',
            'file' => 'required|image|max:4096',
        ]);

        $filePath = 'storage/'.$request->file('file')->store('gallery', 'public');

        Media::create([
            'title' => $validated['title'],
            'caption' => $validated['caption'] ?? null,
            'category' => $validated['category'],
            'event_id' => $validated['event_id'] ?? null,
            'taken_at' => $validated['taken_at'] ?? now()->toDateString(),
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Foto dokumentasi berhasil diunggah.');
    }

    public function destroy(Media $media)
    {
        $media->delete();

        return redirect()->route('admin.media.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
