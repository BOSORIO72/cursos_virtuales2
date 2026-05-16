<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\AccesoController;

Route::get('/', function () {
    return redirect()->route('login.form');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth', 'nocache'])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ── CURSOS ──────────────────────────────────────────────
    Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');
    Route::get('/cursos/create', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');
    Route::get('/cursos/{curso}', [CursoController::class, 'show'])->name('cursos.show');
    Route::get('/cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit');
    Route::put('/cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
    Route::delete('/cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy');

    // ── ESTUDIANTES ─────────────────────────────────────────
    Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes.index');
    Route::get('/estudiantes/create', [EstudianteController::class, 'create'])->name('estudiantes.create');
    Route::post('/estudiantes', [EstudianteController::class, 'store'])->name('estudiantes.store');
    Route::get('/estudiantes/{estudiante}', [EstudianteController::class, 'show'])->name('estudiantes.show');
    Route::get('/estudiantes/{estudiante}/edit', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
    Route::put('/estudiantes/{estudiante}', [EstudianteController::class, 'update'])->name('estudiantes.update');
    Route::delete('/estudiantes/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');

    // ── INSCRIPCIONES ───────────────────────────────────────
    Route::get('/inscripciones', [InscripcionController::class, 'index'])->name('inscripciones.index');
    Route::get('/inscripciones/create', [InscripcionController::class, 'create'])->name('inscripciones.create');
    Route::post('/inscripciones', [InscripcionController::class, 'store'])->name('inscripciones.store');
    Route::delete('/inscripciones/{inscripcion}', [InscripcionController::class, 'destroy'])->name('inscripciones.destroy');

    // ── USUARIOS (solo admin) ───────────────────────────────
    Route::middleware('role:administrador')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    });

    // ── MÓDULOS ─────────────────────────────────────────────
    Route::get('cursos/{curso}/modulos', [ModuloController::class, 'index'])->name('cursos.modulos.index');
    Route::get('cursos/{curso}/modulos/crear', [ModuloController::class, 'create'])->name('cursos.modulos.create');
    Route::post('cursos/{curso}/modulos', [ModuloController::class, 'store'])->name('cursos.modulos.store');
    Route::get('cursos/{curso}/modulos/{modulo}/ver', [ModuloController::class, 'ver'])->name('cursos.modulos.ver');
    Route::get('cursos/{curso}/modulos/{modulo}/editar', [ModuloController::class, 'edit'])->name('cursos.modulos.edit');
    Route::put('cursos/{curso}/modulos/{modulo}', [ModuloController::class, 'update'])->name('cursos.modulos.update');
    Route::delete('cursos/{curso}/modulos/{modulo}', [ModuloController::class, 'destroy'])->name('cursos.modulos.destroy');

    // ── ACCESOS ─────────────────────────────────────────────
    Route::post('cursos/{curso}/solicitar-acceso', [AccesoController::class, 'solicitar'])->name('accesos.solicitar');

    Route::middleware('role:administrador')->group(function () {
        Route::get('/accesos', [AccesoController::class, 'index'])->name('accesos.index');
        Route::post('/accesos/{acceso}/aprobar', [AccesoController::class, 'aprobar'])->name('accesos.aprobar');
        Route::post('/accesos/{acceso}/rechazar', [AccesoController::class, 'rechazar'])->name('accesos.rechazar');
    });

});