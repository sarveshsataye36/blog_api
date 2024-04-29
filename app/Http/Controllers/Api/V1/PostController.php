<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{ PostRequest, PostUpdateRequest};
use App\Traits\HttpResponses;
use App\Models\Post;
use Exceptions;


class PostController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {   
            // get all posts
            $posts = Post::get();

            // created data send to back to user
            $data = [
                'post' => $posts
            ];

            // return response to back to user
            return $this->success(true, $data, 'Post retrive successfully', 200);

        }catch(\Throwable $e)
        {
            return $this->fails(false,$e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try
        {
            // Create new user
            $post = Post::create([
                'title'  => $request['title'],
                'content'  => $request['content'],
                'category'  => $request['category'],
                'tags'  => $request['tags'],
            ]);

            // created data send to server
            $data = [
                'post' => $post,
            ];

            // return response to back to user
            return $this->success(true, $data, 'Post created successfully', 200);

        }catch(\Throwable $e)
        {
            return $this->fails(false, $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $postId)
    {
        try
        {   
            // Find the post by ID
            $post = Post::find($postId);

            if($post){

                // created data send to back to user
                $data = [
                    'post' => $post
                ];

                // return response to back to user
                return $this->success(true, $data, 'Post retrive successfully', 200);
            }else{

                // return response to back to user
                return $this->fails(false, 'Post not fount', 404);
            }

            

        }catch(\Throwable $e)
        {
            return $this->fails(false,$e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $postId)
    {
        try
        {   
            // Find the post by ID
            $post = Post::findOrFail($postId);

            if($post){

                // update post
                $post->update($request->all());

                // created data send to server
                $data = [
                    'post' => $post,
                ];

                // return response to back to user
                return $this->success(true, $data, 'Post update successfully', 200);
            }else{

                // return response to back to user
                return $this->fails(false, 'Post not fount', 404);
            }

            

        }catch(\Throwable $e)
        {
            return $this->fails(false,$e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $postId)
    {
        try
        {   
            // Find the post by ID
            $post = Post::findOrFail($postId);

            if($post){

                // update post
                $post->delete();

                // created data send to server
                $data = [
                    'post' => $post,
                ];

                // return response to back to user
                return $this->success(true, $data, 'Post delete successfully', 200);
            }else{

                // return response to back to user
                return $this->fails(false, 'Post not fount', 404);
            }

            

        }catch(\Throwable $e)
        {
            return $this->fails(false,$e->getMessage(), 500);
        }
    }
}
