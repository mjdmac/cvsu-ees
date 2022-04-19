<?php

use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\CollegeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Applicant\ApplicantDashboardController;
use App\Http\Controllers\Applicant\ApplicantLoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect('/admin/dashboard');
    } else {
        return Inertia::render('Auth/Login');
    }
});

Route::prefix('/admin')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard/Index');
    })->name('dashboard');

    // Users routes
    Route::resource('users', UserController::class);
    Route::get('/export/users', [UserController::class, 'usersExport'])->name('users.export'); //Export users data to excel

    // College routes
    Route::resource('colleges', CollegeController::class);

    // Course routes
    Route::resource('courses', CourseController::class);

    // Applicant routes
    Route::resource('applicants', ApplicantController::class);

    // Exam routes
    Route::resource('exams', ExamController::class);
    // Sample
    Route::resource('tasks', TaskController::class);
});

Route::prefix('applicant')->group(function () {
    Route::get('login', [ApplicantLoginController::class, 'showLoginForm'])->name('applicant-login');
    Route::post('login', [ApplicantLoginController::class, 'login']);
    Route::get('logout', [ApplicantLoginController::class, 'logout'])->name('applicant-logout');
    Route::post('logout', [ApplicantLoginController::class, 'logout']);

    Route::get('dashboard', [ApplicantDashboardController::class, 'index'])->name('applicant-dashboard');
    // Route::resource('dashboard', [ApplicantDashboardController::class]);
});
