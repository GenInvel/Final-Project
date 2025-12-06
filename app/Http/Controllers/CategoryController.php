<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->get();
        
        return view('categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $posts = Post::with(['author', 'category'])
            ->where('category_id', $category->id)
            ->latest('date')
            ->latest('time')
            ->paginate(9); // 1 featured + 8 in grid = 9 per page

        return view('categories.show', compact('category', 'posts'));
    }
}
