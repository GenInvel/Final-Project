<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Staff;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
   public function index(Request $request)
{
    $query = Post::with(['author', 'category'])->latest();

    // Search by title
    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $posts = $query->paginate(15)->appends(['search' => $request->search]);

    return view('admin.posts.index', compact('posts'));
}


    public function create()
    {
        $authors = Staff::all();
        $contributors = Staff::whereIn('position', ['Photojournalist', 'Video Editor'])->get();
        $categories = Category::all();

        return view('admin.posts.create', compact('authors', 'contributors', 'categories'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'date' => 'required|date',
        'time' => 'required',
        'author_id' => 'required|exists:staff,id',
        'photojournalist_id' => 'nullable|exists:staff,id',
        'category_id' => 'required|exists:categories,id',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'required',
    ]);

    // Generate slug with better uniqueness check
    $baseSlug = Str::slug($request->title);
    $slug = $baseSlug;
    $counter = 1;

    // Keep checking until we find a unique slug
    while (Post::where('slug', $slug)->exists()) {
        $slug = $baseSlug . '-' . $counter;
        $counter++;
    }

    // Handle thumbnail upload
    $thumbnailPath = null;
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
    }

    // Calculate reading time
    $readingTime = ceil(str_word_count(strip_tags($request->description)) / 200);

    // Create post
    Post::create([
        'title' => $request->title,
        'slug' => $slug,
        'date' => $request->date,
        'time' => $request->time,
        'author_id' => $request->author_id,
        'photojournalist_id' => $request->photojournalist_id,
        'category_id' => $request->category_id,
        'thumbnail' => $thumbnailPath,
        'description' => $request->description,
        'reading_time' => $readingTime,
    ]);

    return redirect()->route('admin.posts.index')->with('success', 'Post published successfully!');
}


    public function edit(Post $post)
    {
        $authors = Staff::all();
        $contributors = Staff::whereIn('position', ['Photojournalist', 'Video Editor'])->get();
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'authors', 'contributors', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'author_id' => 'required|exists:staff,id',
            'photojournalist_id' => 'nullable|exists:staff,id',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        // Generate new slug if title changed
        if ($post->title !== $request->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $counter = 1;

            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            $post->slug = $slug;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $post->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Calculate reading time
        $readingTime = ceil(str_word_count(strip_tags($request->description)) / 200);

        // Update post
        $post->update([
            'title' => $request->title,
            'date' => $request->date,
            'time' => $request->time,
            'author_id' => $request->author_id,
            'photojournalist_id' => $request->photojournalist_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'reading_time' => $readingTime,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        // Delete thumbnail from storage
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        // Delete article image from storage if exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Permanently delete post
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}
