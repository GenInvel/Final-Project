<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['author', 'category'])
            ->latest('date')
            ->latest('time');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $posts = $query->paginate(9); // 1 featured + 8 in grid = 9 per page
        $categories = Category::all();

        return view('articles.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::with(['author', 'photojournalist', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related posts (same category, exclude current post)
        $relatedPosts = Post::with(['category'])
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('date')
            ->take(3)
            ->get();

        // Get top 3 latest stories for sidebar
        $topStories = Post::with(['category'])
            ->where('id', '!=', $post->id)
            ->latest('date')
            ->take(3)
            ->get();

        // Get all categories for sidebar
        $categories = Category::all();

        return view('articles.show', compact('post', 'relatedPosts', 'topStories', 'categories'));
    }
}
