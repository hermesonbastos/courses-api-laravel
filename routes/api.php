<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cursos', CourseController::class);
