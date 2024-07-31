<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\PortfolioController;

// Routes for job applications with authentication middleware
Route::middleware(['auth'])->group(function () {
    Route::post('applications', [JobApplicationController::class, 'store'])->name('applications.store');
    Route::get('applications', [JobApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [JobApplicationController::class, 'show'])->name('applications.show');
    Route::delete('applications/{application}', [JobApplicationController::class, 'destroy'])->name('applications.destroy');
});

Route::resource('job-applications', JobApplicationController::class);

   
// Route to show the job application form
Route::get('job-postings/{jobPosting}/apply', [JobApplicationController::class, 'create'])->name('applications.create');

// Route to handle job application submission
Route::post('job-postings/{jobPosting}/apply', [JobApplicationController::class, 'store'])->name('applications.store');

// Route to show the job application form
Route::get('job-postings/{jobPosting}/apply', [JobApplicationController::class, 'create'])->name('applications.create');

// Route to handle job application submission
Route::post('job-postings/{jobPosting}/apply', [JobApplicationController::class, 'store'])->name('applications.store');
// Routes for roles, permissions, users, and job postings with role-based middleware
Route::middleware(['role:super-admin|admin'])->group(function(){
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

    Route::resource('job-postings', JobPostingController::class);
});

 //portfolios routing
Route::middleware(['auth'])->group(function () {
    Route::get('/portfolio', [PortfolioController::class, 'show'])->name('portfolio.show');
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::post('/portfolio/update', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolio', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
});

// Default and dashboard routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management routes with authentication middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
