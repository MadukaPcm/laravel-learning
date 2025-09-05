<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get a list of all posts:
        // $posts = Post::all()->count();
        $posts = Post::all();

        return [
            'error' => false,
            'message' => 'success',
            'date' => $posts
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create a new post:
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required'
        ]);

        info("Payload object is: ", $validatedData);

        if(Post::where('title', $validatedData['title'])->exists()){
            return [
                'error' => true,
                'message' => 'Post with same title already exist!',
                'data' => null
            ];
        }

        $post = Post::create($validatedData);
        return [
            'error' => false,
            'message' => 'Post created successfully!',
            'data' => $post 
        ];
    }

    /**
     * Display the specified resource.
     */
    // public function show(Post $post)
    public function show($id)
    {
        // get a specific post by id:
        // $post = Post::where('id', $id)
        //     ->where('status', true)
        //     ->first(); // returns null if not found

        $post = Post::find($id);
        if(!$post){
            return [
                'error' => true,
                'message' => 'Post not found',
                'data' => null
            ];
        }

        return [
            'error' => false,
            'message' => 'success',
            'data' => $post
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // updating a single post:
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required'
        ]);

        if(Post::where('title', $validatedData['title'])->exists()){
            return [
                'error' => true,
                'message' => 'Post with same title already exist',
                'data' => null
            ];
        }

        $post->update($validatedData);
        return [
            'error' => false,
            'message' => 'Post updated successfully!',
            'data' => $post
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete a specific post:
        $post = Post::find($id);
        if(!$post){
            return [
                'error' => true,
                'message' => 'Post not found',
                'data' => null
            ];
        }
        
        $post->delete();
        return [
            'error' => false,
            'message' => 'Post deleted successfully!',
            'data' => null
        ];
    }
}
