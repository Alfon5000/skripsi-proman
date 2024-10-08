<?php

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

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::view('users', 'users')->name('users');
        Route::view('departments', 'departments')->name('departments');
        Route::view('positions', 'positions')->name('positions');
        Route::view('categories', 'categories')->name('categories');
    });

    Route::middleware(['user'])->group(function () {
        Route::view('tasks', 'tasks')->name('tasks');
        Route::view('members', 'members')->name('members');
    });

    Route::get('/', App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::view('projects', 'projects')->name('projects');
    Route::get('projects/{project}/overview', fn () => view('project-overview'))->name('project.overview');
    Route::get('projects/{project}/tasks', fn () => view('project-tasks'))->name('project.tasks');
    Route::get('projects/{project}/members', fn () => view('project-members'))->name('project.members');
    Route::get('projects/{project}/expenditures', fn () => view('project-expenditures'))->name('project.expenditures');
    Route::get('projects/{project}/documents', fn () => view('project-documents'))->name('project.documents');
    Route::get('projects/{project}/discussions', fn () => view('project-discussions'))->name('project.discussions');
    Route::get('projects/{project}/discussions/{discussion}/comments', fn () => view('project-discussion-comments'))->name('project.discussion.comments');

    Route::view('events', 'events')->name('events');
    Route::view('notifications', 'notifications')->name('notifications');
    Route::view('profile', 'profile')->name('profile');
});
