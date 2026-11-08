<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class AdminAspirationController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspiration::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('topic')) {
            $query->where('topic', $request->topic);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tracking_code', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $aspirations = $query->paginate(12)->withQueryString();

        return view('admin.aspirations.index', compact('aspirations'));
    }

    public function show(Aspiration $aspiration)
    {
        return view('admin.aspirations.show', compact('aspiration'));
    }

    public function updateStatus(Request $request, Aspiration $aspiration)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,ditindaklanjuti,selesai',
            'admin_notes' => 'nullable|string',
            'response' => 'nullable|string',
        ]);

        $respondedAt = ! empty($validated['response']) ? now() : $aspiration->responded_at;

        $aspiration->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? null,
            'response' => $validated['response'] ?? null,
            'responded_at' => $respondedAt,
        ]);

        return redirect()->route('admin.aspirations.show', $aspiration)->with('success', 'Status dan tanggapan aspirasi berhasil diperbarui.');
    }

    public function destroy(Aspiration $aspiration)
    {
        $aspiration->delete();

        return redirect()->route('admin.aspirations.index')->with('success', 'Data aspirasi berhasil dihapus.');
    }
}
