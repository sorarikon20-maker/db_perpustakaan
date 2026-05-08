<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $dendaPerHari = Setting::get('denda_per_hari', 5000);
        return view('settings.index', compact('dendaPerHari'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'denda_per_hari' => 'required|integer|min:0|max:1000000',
        ]);

        Setting::set('denda_per_hari', $request->denda_per_hari);

        return redirect()->route('settings.index')->with('success', 'Pengaturan denda berhasil diperbarui.');
    }
}
