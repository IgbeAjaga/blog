<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function index(Post $post)
    {
        return response()->json($post->comments()->paginate(10));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate(['body' => 'required|string']);
        
        return $post->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body
        ]);
    }
}
