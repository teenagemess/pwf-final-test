<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Tambahkan middleware auth ke dalam constructor
    }

    /**
     * Store a newly created resource in storage.
     */    public function store(Request $request, Todo $todo)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->id(); // Assigning authenticated user's id to user_id
        $comment->todo_id = $todo->id;
        $comment->save();

        return back()->with('success', 'Comment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.show', compact('comment'));
    }
}
