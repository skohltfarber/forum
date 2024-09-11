<?php

use App\Http\Resources\PostResource;
use App\Models\Post;

use function Pest\Laravel\get;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Testing\AssertableInertia;


it('should return the correct component', function () {

    get(route('posts.index'))
       ->assertInertia(fn (AssertableInertia $inertia) => $inertia
            ->component('Posts/Index', true)
       ); 
});

it('passes posts to the view', function () {

     $posts = Post::factory(3)->create();

     $posts->load('user');

     get(route('posts.index'))
          // ->assertHasResource('post', PostResource::make($posts->first()))
          ->assertHasPaginatedResource('posts', PostResource::collection($posts->reverse()));

});