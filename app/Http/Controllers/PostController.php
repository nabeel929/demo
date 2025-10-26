<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Post::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post = Post::create($request->only('title', 'body'));

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully!',
            'data' => $post
        ], 201);
    }

    public function show(Post $post)
    {
        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:Add 255',
            'body'  => 'required|string',
        ]);

        $post->update($request->only('title', 'body'));

        return response()->json([
            'success' => true,
            'message' => 'Post updated!',
            'data' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted!'
        ]);
    }
}