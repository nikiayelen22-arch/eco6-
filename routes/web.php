<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;

Route::get('admin', function () {
    return redirect()->route('layouts.admin');
});

Route::get('/', function () {
    return redirect()->route('estudiantes.index');
});

Route::resource('estudiantes', EstudianteController::class);

Route::get('admin', function () {
    return view('layouts.admin');
});

