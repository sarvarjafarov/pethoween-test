<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,image,boolean,json',
            'group' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('value') && $request->type === 'image') {
            $data['value'] = $request->file('value')->store('settings', 'public');
        }

        Setting::create($data);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return view('admin.settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key,' . $setting->id,
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,image,boolean,json',
            'group' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('value') && $request->type === 'image') {
            // Delete old image
            if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }
            $data['value'] = $request->file('value')->store('settings', 'public');
        }

        $setting->update($data);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        // Delete image if exists
        if ($setting->type === 'image' && $setting->value && Storage::disk('public')->exists($setting->value)) {
            Storage::disk('public')->delete($setting->value);
        }
        
        $setting->delete();
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully.');
    }

    /**
     * Bulk update settings
     */
    public function bulkUpdate(Request $request)
    {
        $settings = $request->except(['_token', '_method']);
        
        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
