<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(['api.token'])->group(function () {

// POST routes
Route::post('/posts', [PostController::class, 'store']); // Create a new post
Route::get('/posts', [PostController::class, 'index']); // List all posts with pagination and search
Route::get('/posts/{id}', [PostController::class, 'show']); // Show a single post with comments


// COMMENT routes
Route::post('/posts/{id}/comments', [CommentController::class, 'store']); // Add comment to a post
Route::delete('/comments/{id}', [CommentController::class, 'destroy']); // Delete comment

Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});