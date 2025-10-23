<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with(['user', 'category']);

        // Filter by category if provided
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest('published_at')->paginate(9);
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();

        return view('frontend.posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        // Ensure the post is published
        if ($post->status !== 'published') {
            abort(404);
        }

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->with(['user', 'category'])
            ->limit(3)
            ->get();

        return view('frontend.posts.show', compact('post', 'relatedPosts'));
    }
}
