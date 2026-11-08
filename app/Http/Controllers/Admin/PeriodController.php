<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::withCount('members')->orderBy('start_year', 'desc')->get();

        return view('admin.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.periods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'cabinet_name' => 'required|string|max:100',
            'leader_name' => 'required|string|max:100',
            'vice_leader_name' => 'nullable|string|max:100',
            'motto' => 'nullable|string|max:200',
            'start_year' => 'required|integer|min:2000|max:2099',
            'end_year' => 'required|integer|min:2000|max:2099',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $isActive = $request->boolean('is_active');

        if ($isActive) {
            Period::where('is_active', true)->update(['is_active' => false]);
        }

        $period = Period::create(array_merge($validated, ['is_active' => $isActive]));

        if ($isActive) {
            SiteSetting::set('active_period', $period->name);
            SiteSetting::set('cabinet_name', $period->cabinet_name);
        }

        return redirect()->route('admin.periods.index')->with('success', 'Periode kepengurusan berhasil ditambahkan.');
    }

    public function edit(Period $period)
    {
        return view('admin.periods.edit', compact('period'));
    }

    public function update(Request $request, Period $period)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'cabinet_name' => 'required|string|max:100',
            'leader_name' => 'required|string|max:100',
            'vice_leader_name' => 'nullable|string|max:100',
            'motto' => 'nullable|string|max:200',
            'start_year' => 'required|integer|min:2000|max:2099',
            'end_year' => 'required|integer|min:2000|max:2099',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $isActive = $request->boolean('is_active');

        if ($isActive && ! $period->is_active) {
            Period::where('id', '!=', $period->id)->update(['is_active' => false]);
            SiteSetting::set('active_period', $period->name);
            SiteSetting::set('cabinet_name', $period->cabinet_name);
        }

        $period->update(array_merge($validated, ['is_active' => $isActive]));

        return redirect()->route('admin.periods.index')->with('success', 'Data periode kepengurusan berhasil diperbarui.');
    }

    public function toggleActive(Period $period)
    {
        Period::where('id', '!=', $period->id)->update(['is_active' => false]);
        $period->update(['is_active' => true]);

        SiteSetting::set('active_period', $period->name);
        SiteSetting::set('cabinet_name', $period->cabinet_name);

        return redirect()->route('admin.periods.index')->with('success', "Kabinet {$period->cabinet_name} ({$period->name}) diaktifkan sebagai kepengurusan resmi.");
    }

    public function destroy(Period $period)
    {
        if ($period->is_active) {
            return back()->with('error', 'Tidak dapat menghapus periode kepengurusan yang sedang aktif.');
        }

        $period->delete();

        return redirect()->route('admin.periods.index')->with('success', 'Periode berhasil dihapus.');
    }
}
