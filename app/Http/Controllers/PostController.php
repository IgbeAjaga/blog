<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Get a paginated list of posts.
     */
    public function index()
    {
        return response()->json(Post::paginate(10));
    }

    /**
     * Store a new post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        $post = auth()->user()->posts()->create($request->all());

        return response()->json($post, 201);
    }
}
