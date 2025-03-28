<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Get a paginated list of posts.
     */
    public function index()
    {
        $posts = Post::paginate(10);
    
        return response()->json([
            'data' => $posts->items(),
            'meta' => [
                'current_page'  => $posts->currentPage(),
                'last_page'     => $posts->lastPage(),
                'per_page'      => $posts->perPage(),
                'total'         => $posts->total(),
                'next_page_url' => $posts->nextPageUrl(),
                'prev_page_url' => $posts->previousPageUrl(),
            ]
        ]);
    }    

    /**
     * Store a new post.
     */
    public function store(StorePostRequest $request)
{
    $user = auth()->user();

    $validatedData = $request->validated();

    $post = new Post($validatedData);
    $post->user_id = $user->id;
    $post->save();

    return response()->json([
        'message' => 'Post created successfully',
        'post'    => $post
    ], 201);
}
}