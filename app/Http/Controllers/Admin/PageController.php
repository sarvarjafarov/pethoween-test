<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::with('user')
            ->latest()
            ->paginate(10);
            
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'template' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
            'featured' => 'boolean',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'template' => $request->template,
            'status' => $request->status,
            'featured' => $request->boolean('featured'),
            'user_id' => auth()->id(),
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        $page->load('user');
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'template' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
            'featured' => 'boolean',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'template' => $request->template,
            'status' => $request->status,
            'featured' => $request->boolean('featured'),
            'published_at' => $request->status === 'published' && !$page->published_at ? now() : $page->published_at,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        
        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
