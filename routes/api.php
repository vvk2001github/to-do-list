<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::resource('/tasks', TaskController::class)
        ->only([
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ]);
