<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'sambutan_ketua_nama' => 'required|string|max:150',
            'sambutan_ketua_periode' => 'required|string|max:150',
            'sambutan_ketua_text' => 'required|string',
            'sambutan_ketua_foto' => 'nullable|image|max:2048',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'sejarah' => 'required|string',
            'filosofi_logo' => 'required|string',
        ]);

        if ($request->hasFile('sambutan_ketua_foto')) {
            $path = $request->file('sambutan_ketua_foto')->store('team', 'public');
            SiteSetting::set('sambutan_ketua_foto', 'storage/'.$path, 'profile');
        }

        SiteSetting::set('sambutan_ketua_nama', $validated['sambutan_ketua_nama'], 'profile');
        SiteSetting::set('sambutan_ketua_periode', $validated['sambutan_ketua_periode'], 'profile');
        SiteSetting::set('sambutan_ketua_text', $validated['sambutan_ketua_text'], 'profile');
        SiteSetting::set('visi', $validated['visi'], 'profile');
        SiteSetting::set('misi', $validated['misi'], 'profile');
        SiteSetting::set('sejarah', $validated['sejarah'], 'profile');
        SiteSetting::set('filosofi_logo', $validated['filosofi_logo'], 'profile');

        return redirect()->route('admin.profile')->with('success', 'Profil dan visi-misi BEM berhasil diperbarui.');
    }
}
