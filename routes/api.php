<?php

use App\Http\Controllers\{AuthenticationController, PostController, CategoryController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json(['success' => true, "message" => "Hello, world!"]);
});

Route::scopeBindings()->group(function () {
    Route::apiResources([
        'posts' => PostController::class,
        'categories' => CategoryController::class
    ]);
});

Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
