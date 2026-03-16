<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicTournamentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrgController;
use App\Http\Controllers\PublicOrgController;
use App\Http\Controllers\AdminOrgController;
use App\Http\Controllers\AdminTournamentController;
use App\Http\Controllers\ContactController;


Route::get('/', [HomeController::class, 'index']);

Route::get('/tournaments', [PublicTournamentController::class, 'index']);
Route::get('/tournament/{slug}', [PublicTournamentController::class, 'show'])
    ->name('tournament.show');

Route::get('/tournaments', [PublicTournamentController::class, 'index']);
Route::get('/tournaments/closed', [PublicTournamentController::class, 'closed']);

Route::get('/orgs', [PublicOrgController::class, 'index'])->name('orgs.index');
Route::get('/org/{slug}', [PublicOrgController::class, 'show'])->name('org.show');

Route::get('/org/{slug}/social-stats', [PublicOrgController::class, 'socialStats']);

Route::get('/players', function () {
    return view('players.coming');
});

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/login', [AuthController::class, 'loginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');
Route::prefix('admin')
    ->middleware(['auth', 'role:superadmin'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        });

        Route::get('/tournaments', function () {
            return view('admin.tournaments.index');
        });

        // USERS
        Route::get('/users', [\App\Http\Controllers\AdminUserController::class, 'index']);
        Route::get('/users/create', function () {
            return view('admin.users.create');
        });
        Route::post('/users/create', [\App\Http\Controllers\AdminUserController::class, 'store']);
        Route::post('/users/{id}/status', [\App\Http\Controllers\AdminUserController::class, 'updateStatus']);

        // ORGS (Proper Controller Based)
        Route::get('/orgs', [\App\Http\Controllers\AdminOrgController::class, 'index']);
        Route::get('/orgs/create', [\App\Http\Controllers\AdminOrgController::class, 'create']);
        Route::post('/orgs', [\App\Http\Controllers\AdminOrgController::class, 'store']);

        Route::post('/orgs/{id}/trust', [AdminOrgController::class, 'updateTrust']);
        Route::post('/orgs/{id}/membership', [AdminOrgController::class, 'updateMembership']);
        Route::post('/orgs/{id}/ban', [AdminOrgController::class, 'ban']);

        Route::get('/banned-orgs', function () {
            return view('organizations.banned');
        });


        // Tournaments (Proper Controller Based)
        Route::get('/tournaments', [\App\Http\Controllers\AdminTournamentController::class, 'index']);
        Route::get('/tournaments/create', [\App\Http\Controllers\AdminTournamentController::class, 'create']);
        Route::post('/tournaments', [\App\Http\Controllers\AdminTournamentController::class, 'store']);

        Route::get('/tournaments/{id}/edit', [\App\Http\Controllers\AdminTournamentController::class, 'edit']);
        Route::post('/tournaments/{id}/update', [\App\Http\Controllers\AdminTournamentController::class, 'update']);
    });
