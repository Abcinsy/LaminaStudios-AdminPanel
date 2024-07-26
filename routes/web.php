<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/internship-information/{program}', [App\Admin\Controllers\InternshipProgramController::class, 'showInternshipInformation'])->name('admin.internship.information');

Route::get('/', function () {
    return view('welcome');
});
