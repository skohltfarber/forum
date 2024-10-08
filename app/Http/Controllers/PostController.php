<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use ray;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ray()->showQueries();
        // return PostResource::collection(Post::paginate());
        return inertia('Posts/Index', [

            // 'post' => PostResource::make(Post::first()), 

            'posts' => PostResource::collection(Post::with('user')->latest()->latest('id')->paginate()),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('user');
        // dd('test', PostResource::make($post));

        return inertia('Posts/Show', [
            'post' => fn() => PostResource::make($post),
            'comments' => fn() => CommentResource::collection($post->comments()->with('user')->latest()->latest('id')->paginate(10)),
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
