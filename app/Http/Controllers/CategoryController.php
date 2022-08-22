<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryIndexResource;
use App\Http\Resources\CategoryShowResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CategoryIndexResource
     */
    public function index()
    {
        return new CategoryIndexResource(Category::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return JsonResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            $status = 201;
            Category::create($request->validated());
        } catch (\Exception $exception) {
            $status = 500;
        }

        return response()->json(null, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryShowResource
     */
    public function show(Category $category)
    {
        return new CategoryShowResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        try {
            $status = 204;
            $category->update($request->validated());
        } catch (\Exception $exception) {
            $status = 500;
        }

        return response()->json(null, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        try {
            $status = 204;
            $category->delete();
        } catch (\Exception $exception) {
            $status = 500;
        }

        return response()->json(null, $status);
    }
}
