<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProjetController;
use Illuminate\Support\Facades\Route;


Route::get('/cs-dev/home',[AppController::class,'home'])->name('projects.index');
Route::get('/cs-dev/projects',[AppController::class,'allProject'])->name('projects.all'); 
Route::get('/cs-dev/project/create', [ProjetController::class, 'create'])->name('projects.create');
Route::post('/cs-dev/project', [ProjetController::class, 'store'])->name('projects.store');
Route::get('/cs-dev/project/{id}/edit', [ProjetController::class, 'edit'])->name('projects.edit');
Route::put('/cs-dev/project/{id}', [ProjetController::class, 'update'])->name('projects.update');
Route::get('/cs-dev/project/{id}', [ProjetController::class, 'show'])->name('projet.show');
Route::delete('/cs-dev/project/{id}', [ProjetController::class, 'destroy'])->name('projects.destroy');

Route::get('/download-cv', [AdminController::class,'cv']);
Route::post('/contact', [AppController::class, 'send'])->name('contact.send');



Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/projet',[AdminController::class, 'Projet'])->name('admin.project');
Route::get('/profil/{id}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
Route::get('/admin/profil', [ProfilController::class, 'show'])->name('admin.profil');
Route::put('/admin/profil/edit/{id}', [ProfilController::class, 'update'])->name('profil.update');

