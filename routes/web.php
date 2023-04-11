<?php

use App\Http\Controllers\CategoryController;
use App\Http\Livewire\ShowUserPosts;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts=Post::with('user', 'category')->orderBy('titulo')->paginate(10);
    return view('home', compact('posts'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', ShowUserPosts::class)->name('dashboard');
});
Route::middleware((['auth:sanctum', 'is_admin']))->resource('categories', CategoryController::class);
