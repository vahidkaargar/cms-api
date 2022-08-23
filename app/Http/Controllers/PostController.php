<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostIndexResource;
use App\Http\Resources\PostShowResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostIndexResource
     */
    public function index()
    {
        return new PostIndexResource(Post::query()->published(true)->latest()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return JsonResponse
     */
    public function store(PostStoreRequest $request)
    {
        try {
            $status = 201;
            Post::create($request->validated());
        } catch (\Exception $exception) {
            $status = 500;
        }

        return response()->json(null, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostShowResource
     */
    public function show(Post $post)
    {
        return new PostShowResource($post);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        try {
            $status = 204;
            $post->update($request->validated());
        } catch (\Exception $exception) {
            $status = 500;
        }

        return response()->json(null, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post)
    {
        try {
            $status = 204;
            $post->delete();
        } catch (\Exception $exception) {
            $status = 500;
        }

        return response()->json(null, $status);
    }
}
