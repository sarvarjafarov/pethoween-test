<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::with('user')
            ->latest()
            ->paginate(20);
            
        return view('admin.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'alt_text' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('media', $filename, 'public');

        Media::create([
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'path' => $path,
            'url' => Storage::url($path),
            'size' => $file->getSize(),
            'alt_text' => $request->alt_text,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'File uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $medium)
    {
        $medium->load('user');
        return view('admin.media.show', compact('medium'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $medium)
    {
        return view('admin.media.edit', compact('medium'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $medium)
    {
        $request->validate([
            'alt_text' => 'nullable|string|max:255',
        ]);

        $medium->update([
            'alt_text' => $request->alt_text,
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $medium)
    {
        // Delete the file from storage
        Storage::disk('public')->delete($medium->path);
        
        $medium->delete();
        
        return redirect()->route('admin.media.index')
            ->with('success', 'Media deleted successfully.');
    }
}
