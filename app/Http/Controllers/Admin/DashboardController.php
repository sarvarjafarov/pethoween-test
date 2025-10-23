<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'pages' => Page::count(),
            'categories' => Category::count(),
            'users' => User::count(),
            'media' => Media::count(),
        ];

        $recentPosts = Post::with(['user', 'category'])
            ->latest()
            ->limit(5)
            ->get();

        $recentUsers = User::with('role')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentUsers'));
    }
}
