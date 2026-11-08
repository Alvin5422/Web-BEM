<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Media;
use App\Models\Period;
use App\Models\Program;
use Illuminate\Http\Request;

class InformationCenterController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'proker');
        $period = Period::getActive();

        // 1. Program Kerja
        $prokerQuery = Program::query();
        if ($period) {
            $prokerQuery->where('period_id', $period->id);
        }
        if ($request->filled('proker_status') && $request->proker_status !== 'all') {
            $prokerQuery->where('status', $request->proker_status);
        }
        if ($request->filled('proker_dept') && $request->proker_dept !== 'all') {
            $prokerQuery->where('department', $request->proker_dept);
        }
        $programs = $prokerQuery->orderBy('start_date', 'asc')->get();

        $departments = Program::select('department')
            ->when($period, fn ($q) => $q->where('period_id', $period->id))
            ->distinct()
            ->pluck('department');

        // 2. Kalender & Agenda
        $events = Event::with('program')
            ->orderBy('event_date', 'asc')
            ->get();

        // 3. Timeline
        $timelineEvents = Event::orderBy('event_date', 'asc')->get();

        // 4. Dokumentasi Galeri
        $gallery = Media::orderBy('taken_at', 'desc')->paginate(12)->withQueryString();

        return view('public.information.index', compact(
            'activeTab',
            'period',
            'programs',
            'departments',
            'events',
            'timelineEvents',
            'gallery'
        ));
    }
}
