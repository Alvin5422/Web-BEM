<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:150',
            'campus_name' => 'required|string|max:200',
            'campus_short' => 'nullable|string|max:100',
            'tagline' => 'required|string|max:200',
            'cabinet_name' => 'nullable|string|max:100',
            'active_period' => 'nullable|string|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'instagram' => 'nullable|string|max:150',
            'youtube' => 'nullable|string|max:150',
            'tiktok' => 'nullable|string|max:150',
            'address' => 'required|string',
            'maps_embed_url' => 'nullable|string',
            'logo_bem' => 'nullable|image|max:2048',
            'logo_campus' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo_bem')) {
            $path = 'storage/'.$request->file('logo_bem')->store('logo', 'public');
            SiteSetting::set('logo_bem', $path, 'branding');
        }

        if ($request->hasFile('logo_campus')) {
            $path = 'storage/'.$request->file('logo_campus')->store('logo', 'public');
            SiteSetting::set('logo_campus', $path, 'branding');
        }

        foreach ($validated as $key => $value) {
            if (! in_array($key, ['logo_bem', 'logo_campus'])) {
                SiteSetting::set($key, $value);
            }
        }

        return redirect()->route('admin.settings')->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
