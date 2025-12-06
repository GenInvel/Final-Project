<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Draft;
use App\Models\Post;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function index()
    {
        $drafts = Draft::with(['author', 'category'])
            ->latest('created_at')
            ->paginate(15);

        return view('admin.posts.drafts', compact('drafts'));
    }

    public function store(Request $request)
    {
        // This is handled in PostController
    }

    public function publish($id)
    {
        $draft = Draft::findOrFail($id);

        // Create post from draft
        Post::create([
            'title' => $draft->title,
            'slug' => $draft->slug,
            'date' => $draft->date,
            'time' => $draft->time,
            'author_id' => $draft->author_id,
            'photojournalist_id' => $draft->photojournalist_id,
            'category_id' => $draft->category_id,
            'thumbnail' => $draft->thumbnail,
            'description' => $draft->description,
            'reading_time' => $draft->reading_time,
            'article_image' => $draft->article_image ?? null,
        ]);

        // Delete draft
        $draft->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Draft published successfully!');
    }

    public function destroy($id)
    {
        $draft = Draft::findOrFail($id);

        // Delete thumbnail and article image from storage
        if ($draft->thumbnail) {
            \Storage::disk('public')->delete($draft->thumbnail);
        }
        if ($draft->article_image) {
            \Storage::disk('public')->delete($draft->article_image);
        }

        $draft->delete();

        return redirect()->route('admin.drafts.index')->with('success', 'Draft deleted successfully!');
    }
}
