<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Event;
use App\Models\Message;
use App\Models\Period;
use App\Models\Post;
use App\Models\Program;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'total_programs' => Program::count(),
            'active_programs' => Program::where('status', 'berjalan')->count(),
            'upcoming_events' => Event::where('event_date', '>=', now()->toDateString())->count(),
            'unhandled_aspirations' => Aspiration::whereIn('status', ['menunggu', 'diproses'])->count(),
            'unread_messages' => Message::where('is_read', false)->count(),
        ];

        $recentPosts = Post::with('category')->latest()->take(5)->get();
        $upcomingEvents = Event::where('event_date', '>=', now()->toDateString())->orderBy('event_date', 'asc')->take(5)->get();
        $pendingAspirations = Aspiration::whereIn('status', ['menunggu', 'diproses'])->latest()->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();
        $activePeriod = Period::getActive();

        return view('admin.dashboard', compact(
            'stats',
            'recentPosts',
            'upcomingEvents',
            'pendingAspirations',
            'recentMessages',
            'activePeriod'
        ));
    }
}
