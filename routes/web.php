<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Dashboard protégé pour utilisateurs authentifiés
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Assignation et suppression des rôles
Route::get('/assign-role/{userId}/{role}', [ProfileController::class, 'assignRoleToUser']);
Route::get('/remove-role/{userId}/{role}', [ProfileController::class, 'removeRoleFromUser']);

// Routes protégées par le rôle 'Admin' avec permissions
Route::middleware(['auth', 'role:Admin', 'permission:create posts|edit posts|delete posts|publish posts'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/{post}/update', [PostController::class, 'update'])->name('post.update');
    Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
    Route::post('/posts/{post}/publish', [PostController::class, 'publish'])->name('post.publish');
});

// Routes pour les auteurs avec contrôle des permissions
Route::middleware(['auth', 'role:Auteur'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create')->middleware('permission:create posts');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store')->middleware('permission:create posts');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit')->middleware('permission:edit posts');
    Route::put('/posts/{post}/update', [PostController::class, 'update'])->name('post.update')->middleware('permission:edit posts');
});

// Routes pour les utilisateurs authentifiés (Profil)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour afficher les posts
Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('post.show');

require __DIR__.'/auth.php';
