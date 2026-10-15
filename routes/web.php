<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;

// Login and logout
Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Public participant registration
Route::get('/register', [
    RegistrationController::class,
    'publicIndex'
])->name('registrations.public.index');

Route::get('/register/{activity}', [
    RegistrationController::class,
    'publicCreate'
])->name('registrations.public.create');

Route::post('/register/{activity}', [
    RegistrationController::class,
    'publicStore'
])->name('registrations.public.store');

// Protected dashboard and staff functions
Route::middleware(['auth', 'staff'])->group(function () {

//added route
Route::resource('activities', ActivityController::class);


    Route::get('/', function () {
        $totalActivities = \App\Models\Activity::count();

        $totalRegistrations = \App\Models\Registration::count();

        $pendingRegistrations = \App\Models\Registration::where(
            'status',
            'pending'
        )->count();

        $approvedRegistrations = \App\Models\Registration::where(
            'status',
            'approved'
        )->count();

        $recentRegistrations = \App\Models\Registration::with('activity')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalActivities',
            'totalRegistrations',
            'pendingRegistrations',
            'approvedRegistrations',
            'recentRegistrations'
        ));
    })->name('dashboard');


    Route::resource('activities', ActivityController::class);

    Route::get('/registrations', [
        RegistrationController::class,
        'index'
    ])->name('registrations.index');

    Route::get('/registrations/create', [
        RegistrationController::class,
        'create'
    ])->name('registrations.create');

    Route::post('/registrations', [
        RegistrationController::class,
        'store'
    ])->name('registrations.store');

    Route::patch('/registrations/{registration}/status', [
        RegistrationController::class,
        'updateStatus'
    ])->name('registrations.status');


    Route::middleware('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserController::class, 'store'])
            ->name('users.store');
    });
});
