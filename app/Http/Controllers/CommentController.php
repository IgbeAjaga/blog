<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Get a paginated list of comments for a specific post.
     */
    public function index(Post $post)
    {
        $comments = $post->comments()->paginate(10);

        return response()->json([
            'data' => $comments->items(),
            'meta' => [
                'current_page'  => $comments->currentPage(),
                'last_page'     => $comments->lastPage(),
                'per_page'      => $comments->perPage(),
                'total'         => $comments->total(),
                'next_page_url' => $comments->nextPageUrl(),
                'prev_page_url' => $comments->previousPageUrl(),
            ]
        ]);
    }

    /**
     * Store a new comment on a post.
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'body'    => $request->validated()['body']
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment
        ], 201);
    }
}