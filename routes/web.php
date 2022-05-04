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
use App\Http\Controllers\Applicant\ApplicantExamController;
use App\Http\Controllers\Applicant\ApplicantLoginController;
use App\Http\Controllers\Applicant\ApplicantResultController;
use App\Http\Controllers\Applicant\ApplicantUpdateController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\ChatbotController;
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

        // Dashboard
        Route::resource('dashboard', AdminDashboardController::class);

        // Users routes
        Route::resource('users', UserController::class);
        Route::get('/export/users', [UserController::class, 'usersExport'])->name('users.export'); //Export data to excel

        // College routes
        Route::resource('colleges', CollegeController::class);

        // Course routes
        Route::resource('courses', CourseController::class);

        // Applicant routes
        Route::resource('applicants', ApplicantController::class);

        // Exam routes
        Route::resource('exams', ExamController::class);
        Route::post('status', [ExamController::class, 'statusChange'])->name('exam.status.change');

        // Question routes
        Route::resource('questions', QuestionController::class);

        // Choice routes
        Route::resource('choices', ChoiceController::class);

        // Schedule routes
        Route::resource('schedules', ScheduleController::class);

        // Results routes
        Route::resource('results', ResultController::class);

        // Chatbot routes
        Route::resource('chatbot', ChatbotController::class);
    });

Route::prefix('applicant')
    ->as('applicant.')
    ->group(function () {
        Route::get('login', [ApplicantLoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [ApplicantLoginController::class, 'login'])->name('post.login');
        Route::post('logout', [ApplicantLoginController::class, 'logout'])->name('logout');

        Route::group(['middleware' => ['auth:sanctum', 'verified', 'isApplicant']], function () {
            // Dashboard
            Route::resource('dashboard', ApplicantDashboardController::class);

            // Applicant update
            Route::resource('profile', ApplicantUpdateController::class);

            // Exam
            Route::resource('exams', ApplicantExamController::class);

            // Result
            Route::resource('results', ApplicantResultController::class);
        });
    });


Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
