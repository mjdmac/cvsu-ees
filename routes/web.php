<?php

use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\CollegeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\UserController;
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

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');

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
    Route::get('/export/colleges', [CollegeController::class, 'collegesExport'])->name('colleges.export'); //Export colleges data to excel

    // Course routes
    Route::resource('courses', CourseController::class);
    Route::get('/export/courses', [CourseController::class, 'coursesExport'])->name('courses.export'); //Export courses data to excel

    // Applicant routes
    Route::resource('applicants', ApplicantController::class);
    Route::get('/export/applicants', [ApplicantController::class, 'applicantsExport'])->name('applicants.export'); //Export applicants data to ex

    // Subject routes
    Route::resource('exams', ExamController::class);
    // Route::get('/export/subjects', [SubjectController::class, 'subjectsExport'])->name('subjects.export'); //Export applicants data to excel

    // Sample
    Route::resource('tasks', TaskController::class);
});