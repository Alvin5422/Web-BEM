<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Program;
use Illuminate\Http\Request;

class AdminProgramController extends Controller
{
    public function index(Request $request)
    {
        $periods = Period::orderBy('start_year', 'desc')->get();
        $activePeriod = Period::getActive();

        $selectedPeriod = $request->filled('period_id')
            ? Period::find($request->period_id)
            : $activePeriod;

        $query = Program::query();
        if ($selectedPeriod) {
            $query->where('period_id', $selectedPeriod->id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programs = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.programs.index', compact('programs', 'periods', 'selectedPeriod'));
    }

    public function create()
    {
        $periods = Period::orderBy('start_year', 'desc')->get();
        $activePeriod = Period::getActive();

        return view('admin.programs.create', compact('periods', 'activePeriod'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'period_id' => 'required|exists:periods,id',
            'department' => 'required|string|max:100',
            'name' => 'required|string|max:200',
            'description' => 'required|string',
            'objective' => 'nullable|string',
            'target_audience' => 'nullable|string|max:200',
            'status' => 'required|in:direncanakan,berjalan,selesai',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'person_in_charge' => 'nullable|string|max:100',
            'is_featured' => 'nullable|boolean',
        ]);

        Program::create(array_merge($validated, [
            'is_featured' => $request->boolean('is_featured'),
        ]));

        return redirect()->route('admin.programs.index')->with('success', 'Program kerja berhasil ditambahkan.');
    }

    public function edit(Program $program)
    {
        $periods = Period::orderBy('start_year', 'desc')->get();

        return view('admin.programs.edit', compact('program', 'periods'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'period_id' => 'required|exists:periods,id',
            'department' => 'required|string|max:100',
            'name' => 'required|string|max:200',
            'description' => 'required|string',
            'objective' => 'nullable|string',
            'target_audience' => 'nullable|string|max:200',
            'status' => 'required|in:direncanakan,berjalan,selesai',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'person_in_charge' => 'nullable|string|max:100',
            'is_featured' => 'nullable|boolean',
        ]);

        $program->update(array_merge($validated, [
            'is_featured' => $request->boolean('is_featured'),
        ]));

        return redirect()->route('admin.programs.index')->with('success', 'Program kerja berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program kerja berhasil dihapus.');
    }
}
