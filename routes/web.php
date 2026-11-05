
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalAttentionController;
use App\Http\Controllers\MedicalHistoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Redirección según el rol
    Route::get('/dashboard', function () {
        $role = auth()->user()->role?->name;

        return match ($role) {
            'Administrador' => redirect()->route('admin.dashboard'),
            'Profesional de salud' => redirect()->route('professional.dashboard'),
            'Paciente' => redirect()->route('patient.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');

    // Paneles
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:Administrador')
      ->name('admin.dashboard');

    Route::get('/professional/dashboard', function () {
        return view('professional.dashboard');
    })->middleware('role:Profesional de salud')
      ->name('professional.dashboard');

    Route::get('/patient/dashboard', function () {
        return view('patient.dashboard');
    })->middleware('role:Paciente')
      ->name('patient.dashboard');

    // Rutas del paciente
    Route::middleware(['role:Paciente'])
        ->prefix('patient')
        ->name('patient.')
        ->group(function () {

            Route::get('/appointments', [AppointmentController::class, 'index'])
                ->name('appointments.index');

            Route::get('/appointments/create', [AppointmentController::class, 'create'])
                ->name('appointments.create');

            Route::post('/appointments', [AppointmentController::class, 'store'])
                ->name('appointments.store');
        });

    // Rutas del profesional de salud
    Route::middleware(['role:Profesional de salud'])
        ->prefix('professional')
        ->name('professional.')
        ->group(function () {

            // Agenda de citas
            Route::get('/appointments', [AppointmentController::class, 'professionalIndex'])
                ->name('appointments.index');

            // Aceptar o rechazar citas
            Route::patch('/appointments/{appointment}/status',
                [AppointmentController::class, 'updateStatus']
            )->name('appointments.updateStatus');

            // Registrar atención médica
            Route::get('/appointments/{appointment}/attention/create',
                [MedicalAttentionController::class, 'create']
            )->name('attentions.create');

            Route::post('/appointments/{appointment}/attention',
                [MedicalAttentionController::class, 'store']
            )->name('attentions.store');

            // Consultar historia clínica del paciente
            Route::get('/patients/{patient}/medical-history',
                [MedicalHistoryController::class, 'index']
            )->name('medical-history.index');
        });
});

require __DIR__.'/auth.php';
