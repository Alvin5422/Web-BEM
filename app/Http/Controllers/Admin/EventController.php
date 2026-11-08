<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('program')->orderBy('event_date', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $events = $query->paginate(10)->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $programs = Program::orderBy('name', 'asc')->get();

        return view('admin.events.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'program_id' => 'nullable|exists:programs,id',
            'description' => 'nullable|string',
            'location' => 'required|string|max:200',
            'event_date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'status' => 'required|in:mendatang,berlangsung,selesai',
            'poster' => 'nullable|image|max:2048',
            'registration_link' => 'nullable|url|max:255',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Event::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-".$count++;
        }

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = 'storage/'.$request->file('poster')->store('events', 'public');
        }

        Event::create(array_merge($validated, [
            'slug' => $slug,
            'poster' => $posterPath,
        ]));

        return redirect()->route('admin.events.index')->with('success', 'Agenda kegiatan berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        $programs = Program::orderBy('name', 'asc')->get();

        return view('admin.events.edit', compact('event', 'programs'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'program_id' => 'nullable|exists:programs,id',
            'description' => 'nullable|string',
            'location' => 'required|string|max:200',
            'event_date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'status' => 'required|in:mendatang,berlangsung,selesai',
            'poster' => 'nullable|image|max:2048',
            'registration_link' => 'nullable|url|max:255',
        ]);

        $posterPath = $event->poster;
        if ($request->hasFile('poster')) {
            $posterPath = 'storage/'.$request->file('poster')->store('events', 'public');
        }

        $event->update(array_merge($validated, [
            'poster' => $posterPath,
        ]));

        return redirect()->route('admin.events.index')->with('success', 'Agenda kegiatan berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
