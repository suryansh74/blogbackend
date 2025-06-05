<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'=>'required| string| max:255',
            'content'=>'required| string',
            'user_id'=>'required|exists:users,id'
        ]);

        $post = Post::create($validated);
        return response()->json($post, 201);  
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'=>'required| string| max:255',
            'content'=>'required| string',
            'user_id'=>'required|exists:users,id'
        ]);

        $post->update($validated);
        return response()->json([
            'message' => 'Post Updated Successfully'], 200);  

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'Post Deleted Successfully'], 200);
    }
}
