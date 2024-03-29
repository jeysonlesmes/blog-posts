<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return PostController::get("welcome");
})->name("home");

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect(route("posts.index"));
    })->name('dashboard');

    Route::resource('posts', PostController::class)->only(['index', 'create', 'store']);
});

require __DIR__.'/auth.php';
