<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function toggle(Post $post)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Removed from favorites';
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);
            $message = 'Added to favorites';
        }

        return back()->with('success', $message);
    }
}
