<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Period;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $periodId = $request->get('period_id');
        $activePeriod = Period::getActive();

        $selectedPeriod = $periodId ? Period::find($periodId) : $activePeriod;

        $periods = Period::orderBy('start_year', 'desc')->get();

        $members = Member::when($selectedPeriod, fn ($q) => $q->where('period_id', $selectedPeriod->id))
            ->orderBy('order', 'asc')
            ->get();

        return view('admin.members.index', compact('members', 'periods', 'selectedPeriod'));
    }

    public function create()
    {
        $periods = Period::orderBy('start_year', 'desc')->get();
        $activePeriod = Period::getActive();

        return view('admin.members.create', compact('periods', 'activePeriod'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'period_id' => 'required|exists:periods,id',
            'name' => 'required|string|max:100',
            'nim' => 'nullable|string|max:30',
            'role_title' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:1000',
            'instagram' => 'nullable|string|max:150',
            'linkedin' => 'nullable|string|max:150',
            'order' => 'nullable|integer',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = 'storage/'.$request->file('photo')->store('team', 'public');
        }

        Member::create(array_merge($validated, [
            'photo' => $photoPath,
            'order' => $validated['order'] ?? 0,
        ]));

        return redirect()->route('admin.members.index', ['period_id' => $validated['period_id']])
            ->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function edit(Member $member)
    {
        $periods = Period::orderBy('start_year', 'desc')->get();

        return view('admin.members.edit', compact('member', 'periods'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'period_id' => 'required|exists:periods,id',
            'name' => 'required|string|max:100',
            'nim' => 'nullable|string|max:30',
            'role_title' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:1000',
            'instagram' => 'nullable|string|max:150',
            'linkedin' => 'nullable|string|max:150',
            'order' => 'nullable|integer',
        ]);

        $photoPath = $member->photo;
        if ($request->hasFile('photo')) {
            $photoPath = 'storage/'.$request->file('photo')->store('team', 'public');
        }

        $member->update(array_merge($validated, [
            'photo' => $photoPath,
            'order' => $validated['order'] ?? $member->order,
        ]));

        return redirect()->route('admin.members.index', ['period_id' => $validated['period_id']])
            ->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        $periodId = $member->period_id;
        $member->delete();

        return redirect()->route('admin.members.index', ['period_id' => $periodId])
            ->with('success', 'Pengurus berhasil dihapus.');
    }
}
