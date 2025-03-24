<?php

use App\Http\Controllers\ProfileController;
use App\Modules\AppUser\Http\Controllers\AppUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('chats');
    return view('welcome');
});


Route::get('/app-login', [AppUserController::class, 'appLogin'])->name('app.login');
Route::get('/world-chat-create', [AppUserController::class, 'worldChatCreate'])->name('world.chat.create');

Route::get('/log-out', function () {
    Auth::logout();
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('chats');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
