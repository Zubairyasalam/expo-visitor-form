<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;

Route::get('/', [VisitorController::class, 'index'])->name('visitor.index');
Route::post('/register', [VisitorController::class, 'store'])->name('visitor.store');

Route::get('/admin', [VisitorController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/export', [VisitorController::class, 'exportCsv'])->name('admin.export');
Route::get('/admin/visitor/{id}/edit', [VisitorController::class, 'edit'])->name('admin.edit');
Route::put('/admin/visitor/{id}', [VisitorController::class, 'update'])->name('admin.update');
Route::delete('/admin/visitor/{id}', [VisitorController::class, 'destroy'])->name('admin.destroy');
Route::post('/admin/settings', [VisitorController::class, 'updateSettings'])->name('admin.settings.update');
