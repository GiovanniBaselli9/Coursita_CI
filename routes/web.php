<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;

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

Route::middleware(['lang'])->group(function () {
    Route::get('/', [FrontController::class, 'getHome'])->name('home');
    Route::get('/details', [FrontController::class, 'details'])->name('details');

    Route::get('/lang/{lang}', [LangController::class, 'changeLanguage'])->name('setLang');

    Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.login');
    Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');
    Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::get('/user/register', [AuthController::class, 'registration'])->name('user.register');
    Route::post('/user/register', [AuthController::class, 'register'])->name('user.register');
    Route::get('/user/accessdenied', [AuthController::class, 'accessdenied'])->name('user.accessdenied');
    Route::get('/pageNotFound', [AuthController::class, 'pageNotFound'])->name('pagenotfound');
});

Route::middleware(['lang', 'authprofessor'])->group( function() {
    Route::get('/professor/coursedetails/{id}', [CourseController::class, 'courseDetailsProfessor'])->name('professor.coursedetails');
    Route::get('/professor/studentdetails/{id}', [StudentController::class, 'studentDetails'])->name('professor.studentdetails');
    Route::get('/professor/professordetails/{id}', [ProfessorController::class, 'professorDetails'])->name('professor.professordetails');
    Route::get('/professor/course/{id}/destroyCourse', [CourseController::class, 'destroyCourse'])->name('course.destroycourse');
    Route::get('/professor/researchcourse', [CourseController::class, 'researchCourse'])->name('professor.researchcourse');
    Route::get('/professor/settings', [ProfessorController::class, 'settings'])->name('professor.settings');
    Route::get('/professor/{id}/destroyProfessor', [ProfessorController::class, 'destroy'])->name('professor.destroyprofessor');
    Route::put('/professor/settings/passwordUpdate/{id}', [ProfessorController::class, 'passwordUpdate'])->name('professor.passwordupdate');
    Route::resource('/professor/course', CourseController::class);
    Route::resource('/professor', ProfessorController::class);
});

Route::middleware(['lang', 'authstudent'])->group( function() {
    Route::get('/student/coursedetails/{id}', [CourseController::class, 'courseDetailsStudent'])->name('student.coursedetails');
    Route::get('/student/professordetails/{id}', [ProfessorController::class, 'professorDetails'])->name('student.professordetails');
    Route::get('/student/researchcourse', [CourseController::class, 'researchCourse'])->name('student.researchcourse');
    Route::get('/student/settings', [StudentController::class, 'settings'])->name('student.settings');
    Route::get('/student/{id}/destroyStudent', [StudentController::class, 'destroy'])->name('student.destroystudent');
    Route::post('/student/coursedetails/{id}/subscribe', [CourseController::class, 'subscribe'])->name('course.subscribe');
    Route::post('/student/coursedetails/{id}/unsubscribe', [CourseController::class, 'unsubscribe'])->name('course.unsubscribe');
    Route::put('/student/settings/passwordUpdate/{id}', [StudentController::class, 'passwordUpdate'])->name('student.passwordupdate');
    Route::resource('/student', StudentController::class);
});
