<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebStudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/estudiantes-crud', [WebStudentController::class, 'index'])->name('web.students');






