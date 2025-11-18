<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user',  function (Request $request) {
        $user = $request->user();

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->getRoleNames(),
        ];
    });

    Route::get('/external-user-data', [UserApiController::class, 'externalUserData']);

    Route::get('/tickets', [TicketController::class, 'index']);        // lista z filtrami
    Route::post('/tickets', [TicketController::class, 'store']);       // tworzenie
    Route::get('/tickets/{id}', [TicketController::class, 'show']); // szczegóły
    Route::put('/tickets/{id}', [TicketController::class, 'update']); // aktualizacja
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy']); // usuwanie
    Route::get('/tickets/{id}/triage-suggest', [TicketController::class, 'suggestTriage']);

    Route::get('/tags', [TagController::class, 'index']);

});
