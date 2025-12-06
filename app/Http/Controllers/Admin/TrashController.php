<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trash;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TrashController extends Controller
{
    public function index()
    {
        // Get trash items without eager loading relationships
        $trashedPosts = Trash::latest('created_at')->paginate(15);

        // Manually load relationships that exist
        foreach ($trashedPosts as $item) {
            $item->author = \App\Models\Staff::find($item->author_id);
            $item->category = \App\Models\Category::find($item->category_id);
        }

        return view('admin.posts.trash', compact('trashedPosts'));
    }

    public function restore($id)
{
    try {
        // Step 1: Find trash
        $trash = Trash::findOrFail($id);
        
        // Step 2: Generate unique slug
        $slug = $trash->slug;
        $originalSlug = $slug;
        $counter = 1;
        
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        // Step 3: Try to create post
        try {
            $post = new Post();
            $post->title = $trash->title;
            $post->slug = $slug;
            $post->date = $trash->date;
            $post->time = $trash->time;
            $post->author_id = $trash->author_id;
            $post->photojournalist_id = $trash->photojournalist_id;
            $post->category_id = $trash->category_id;
            $post->thumbnail = $trash->thumbnail;
            $post->description = $trash->description;
            $post->save();
            
            // Step 4: Delete from trash
            $trash->delete();
            
            return redirect()->route('admin.trash.index')->with('success', 'Post restored successfully!');
            
        } catch (\Exception $e) {
            return redirect()->route('admin.trash.index')->with('error', 'Database error: ' . $e->getMessage());
        }
        
    } catch (\Exception $e) {
        return redirect()->route('admin.trash.index')->with('error', 'Error finding trash: ' . $e->getMessage());
    }
}


    public function destroy($id)
    {
        $trash = Trash::findOrFail($id);

        // Delete thumbnail from storage
        if ($trash->thumbnail) {
            Storage::disk('public')->delete($trash->thumbnail);
        }
        
        // Delete article image from storage
        if ($trash->article_image) {
            Storage::disk('public')->delete($trash->article_image);
        }
        
        // Delete image from storage
        if ($trash->image) {
            Storage::disk('public')->delete($trash->image);
        }

        // Permanently delete from trash
        $trash->delete();

        return redirect()->route('admin.trash.index')->with('success', 'Post permanently deleted!');
    }
}
