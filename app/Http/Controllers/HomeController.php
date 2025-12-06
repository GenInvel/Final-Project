<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get latest 3 posts for carousel
        $carouselPosts = Post::with(['category'])
            ->latest('date')
            ->latest('time')
            ->take(3)
            ->get();

        // Get latest 6 posts for Popular Now
        $popularPosts = Post::with(['category'])
            ->latest('date')
            ->latest('time')
            ->take(6)
            ->get();

        // Get latest 3 posts for Published Issues
        $publishedIssues = Post::with(['category'])
            ->latest('date')
            ->latest('time')
            ->take(3)
            ->get();

        return view('home', compact('carouselPosts', 'popularPosts', 'publishedIssues'));
    }
}
