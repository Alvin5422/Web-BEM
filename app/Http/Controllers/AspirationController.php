<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AspirationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'is_anonymous' => 'nullable|boolean',
            'name' => 'nullable|string|max:100',
            'nim' => 'nullable|string|max:30',
            'study_program' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:30',
            'topic' => 'required|string|max:100',
            'subject' => 'required|string|max:200',
            'content' => 'required|string|min:15|max:5000',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:3072',
        ], [
            'subject.required' => 'Subjek aspirasi wajib diisi.',
            'content.required' => 'Uraian aspirasi wajib diisi minimal 15 karakter.',
            'topic.required' => 'Silakan pilih kategori topik aspirasi.',
        ]);

        $isAnonymous = $request->boolean('is_anonymous');
        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('aspirations', 'public');
        }

        // Generate unique tracking code
        do {
            $code = 'ASP-'.date('Ymd').'-'.strtoupper(Str::random(4));
        } while (Aspiration::where('tracking_code', $code)->exists());

        $aspiration = Aspiration::create([
            'tracking_code' => $code,
            'is_anonymous' => $isAnonymous,
            'name' => $isAnonymous ? 'Anonim' : ($validated['name'] ?? 'Mahasiswa'),
            'nim' => $isAnonymous ? null : ($validated['nim'] ?? null),
            'study_program' => $isAnonymous ? null : ($validated['study_program'] ?? null),
            'email' => $isAnonymous ? null : ($validated['email'] ?? null),
            'phone' => $isAnonymous ? null : ($validated['phone'] ?? null),
            'topic' => $validated['topic'],
            'subject' => $validated['subject'],
            'content' => $validated['content'],
            'attachment' => $attachmentPath,
            'status' => 'menunggu',
        ]);

        return redirect()->route('information.index', ['tab' => 'aspirasi'])
            ->with('aspiration_success', true)
            ->with('tracking_code', $code);
    }

    public function track(Request $request)
    {
        $code = trim($request->get('code', ''));
        $aspiration = null;
        $error = null;

        if (! empty($code)) {
            $aspiration = Aspiration::where('tracking_code', $code)->first();
            if (! $aspiration) {
                $error = 'Kode tracking "'.htmlspecialchars($code).'" tidak ditemukan. Mohon periksa kembali kode Anda.';
            }
        }

        return view('public.aspirations.track', compact('aspiration', 'code', 'error'));
    }
}
