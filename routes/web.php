<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\ChoiceController;
use App\Http\Controllers\Admin\CollegeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamScheduleController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\ScheduleController;
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
        return redirect(route('admin.dashboard.index'));
    } else {
        return Inertia::render('Auth/Login');
    }
});
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {

        // Route::get('/dashboard', function () {
        //     return Inertia::render('Admin/Dashboard/Index');
        // })->name('dashboard');

        // Dashboard
        Route::resource('dashboard', AdminDashboardController::class);

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

        // Question routes
        Route::resource('questions', QuestionController::class);

        // Choice routes
        Route::resource('choices', ChoiceController::class);

        // Schedule routes
        Route::resource('schedules', ScheduleController::class);

        // Results routes
        Route::resource('results', ResultController::class);

        // Sample
        //Route::resource('tasks', TaskController::class);
    });

Route::prefix('applicant')
    ->as('applicant.')
    ->group(function () {
        Route::get('login', [ApplicantLoginController::class, 'showLoginForm'])->name('login');

        Route::post('login', [ApplicantLoginController::class, 'login'])->name('post.login');

        Route::post('logout', [ApplicantLoginController::class, 'logout'])->name('logout');

        Route::group(['middleware' => ['auth:sanctum', 'verified', 'isApplicant']], function () {

            Route::resource('dashboard', ApplicantDashboardController::class);
        });
        // Route::resource('dashboard', [ApplicantDashboardController::class]);
    });
