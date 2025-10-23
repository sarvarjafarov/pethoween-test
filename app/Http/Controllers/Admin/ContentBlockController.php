<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use Illuminate\Http\Request;

class ContentBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contentBlocks = ContentBlock::ordered()->get();
        return view('admin.content-blocks.index', compact('contentBlocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content-blocks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:header,footer,hero,section,widget',
            'location' => 'nullable|string|max:255',
            'content' => 'required|string',
            'settings' => 'nullable|json',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data = $request->all();
        
        if ($request->has('settings')) {
            $data['settings'] = json_decode($request->settings, true);
        }

        ContentBlock::create($data);

        return redirect()->route('admin.content-blocks.index')
            ->with('success', 'Content block created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContentBlock $contentBlock)
    {
        return view('admin.content-blocks.show', compact('contentBlock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContentBlock $contentBlock)
    {
        return view('admin.content-blocks.edit', compact('contentBlock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContentBlock $contentBlock)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:header,footer,hero,section,widget',
            'location' => 'nullable|string|max:255',
            'content' => 'required|string',
            'settings' => 'nullable|json',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data = $request->all();
        
        if ($request->has('settings')) {
            $data['settings'] = json_decode($request->settings, true);
        }

        $contentBlock->update($data);

        return redirect()->route('admin.content-blocks.index')
            ->with('success', 'Content block updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContentBlock $contentBlock)
    {
        $contentBlock->delete();
        
        return redirect()->route('admin.content-blocks.index')
            ->with('success', 'Content block deleted successfully.');
    }
}
