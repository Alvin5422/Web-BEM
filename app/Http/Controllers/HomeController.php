<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Media;
use App\Models\Period;
use App\Models\Post;
use App\Models\Program;

class HomeController extends Controller
{
    public function index()
    {
        $period = Period::getActive();

        $featuredPrograms = Program::where('is_featured', true)
            ->when($period, fn ($q) => $q->where('period_id', $period->id))
            ->take(3)
            ->get();

        if ($featuredPrograms->isEmpty() && $period) {
            $featuredPrograms = Program::where('period_id', $period->id)->take(3)->get();
        }

        $latestPosts = Post::published()
            ->with('category')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $upcomingEvents = Event::where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        $gallery = Media::orderBy('created_at', 'desc')->take(6)->get();

        return view('public.home', compact(
            'period',
            'featuredPrograms',
            'latestPosts',
            'upcomingEvents',
            'gallery'
        ));
    }
}
