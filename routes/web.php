<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;

Route::resource('/students', StudentsController::class);


