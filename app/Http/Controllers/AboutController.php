<?php

namespace App\Http\Controllers;

use App\Models\Period;

class AboutController extends Controller
{
    public function index()
    {
        $activePeriod = Period::getActive();

        $departments = [];
        if ($activePeriod) {
            $members = $activePeriod->members()->orderBy('order', 'asc')->get();
            $departments = $members->groupBy('department');
        }

        $pastPeriods = Period::where('is_active', false)
            ->orderBy('start_year', 'desc')
            ->get();

        return view('public.about', compact('activePeriod', 'departments', 'pastPeriods'));
    }
}
