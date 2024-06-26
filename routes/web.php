<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DetailArtikelController;
use App\Http\Controllers\CommentController;

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
    return view('welcome');
});


Route::get('/', [WelcomeController::class, 'index']);
Route::get('/artikel/{id}', [DetailArtikelController::class, 'show'])->name('artikel.show');

// Contoh rute untuk CommentController
Route::post('/todo/{todo}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::get('/comment/{comment}', [CommentController::class, 'show'])->name('comment.show');
Route::get('/comment/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit');
Route::patch('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');




Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/todos/{todo}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [TodoController::class, 'dashboard'])->name('dashboard');

    Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create');
    Route::get('/todo/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit');
    Route::get('/todo/{todo}', [TodoController::class, 'show'])->name('todo.show');
    Route::patch('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
    Route::patch('/todo/{todo}/complete', [TodoController::class, 'complete'])->name('todo.complete');
    Route::patch('/todo/{todo}/incomplete', [TodoController::class, 'uncomplete'])->name('todo.uncomplete');
    Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::delete('/todo', [TodoController::class, 'destroyCompleted'])->name('todo.deleteallcompleted');

    Route::resource('/category', CategoryController::class);

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [TodoController::class, 'dashboard'])->name('dashboard');

        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::patch('/user/{user}/makeadmin', [UserController::class, 'makeadmin'])->name('user.makeadmin');
        Route::patch('/user/{user}/removeadmin', [UserController::class, 'removeadmin'])->name('user.removeadmin');
    });
});

require __DIR__ . '/auth.php';
