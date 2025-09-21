<?php

namespace App\Http\Controllers;
use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return [
            'error'=>false,
            'message'=>'Success',
            'data'=>$posts
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'title'=>'required|string|max:256',
            'description'=>'required'
        ]);

        $post_instance = post::where('title',$payload['title'])->exists();
        if($post_instance){
            return [
                'error'=>true,
                'message'=>'Post already exist',
                'data'=>null
            ];
        }

        $post = post::create([
            'user_id'=>auth()->id(),
            'title'=>$payload['title'],
            'description'=>$payload['description']
        ]);

        if(!$post){
            return [
                'error'=>true,
                'message'=>'Operation Failed',
                'data'=>null
            ];
        }

        return [
            'error'=>false,
            'message'=>'Success',
            'data'=>$post
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = post::where('id',$id)->first();

        if(!$post){
            return [
                'error'=>true,
                'message'=>'No post found!',
                'data'=>null
            ];
        }

        return [
            'error'=>false,
            'message'=>'Success',
            'data'=>$post
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'title'=>'required|string|max:256',
            'description'=>'required'
        ]);

        $post = post::where('id',$id)->first();
        if(!$post){
            return [
                'error'=>true,
                'message'=>'No data found!',
                'data'=>null
            ];
        }

        $post->title = $payload['title'];
        $post->description = $payload['description'];
        $post->save();

        return [
            'error'=>false,
            'message'=>'Success',
            'data'=>$post
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = post::where('id',$id)->first();

        if(!$post){
            return [
                'error'=>true,
                'message'=>'No post found!',
                'data'=>null
            ];
        }

        $post->delete();
        return [
            'error'=>false,
            'message'=>'Success',
            'data'=>null
        ];
    }
}
