<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebController;

// --

// Pantalla principal.
Route::get('/', [WebController::class, 'googlePlay'])->name('google_play');

// Pantalla principal.
Route::get('/start', [WebController::class, 'start'])->name('start');

// Formulari per a obtenir el pin diari.
Route::get('get-pin/{gimcana_id}', [WebController::class, 'getPin'])->name('get_pin');

// Retornar el pin diari segons les dades enviades pel formulari.
Route::post('do-get-pin', [WebController::class, 'doGetPin'])->name('do_get_pin');

// Classificació.
Route::get('standings/{gimcana_id}', [WebController::class, 'standings'])->name('standings');

// Operacions disponibles per l'app.
Route::prefix('app')->group(function ()
{
    // Fer la identificació de l'equip, retornant el codi identificador.
    Route::any('do-sign-up', [WebController::class, 'doSignUp'])->name('do_sign_up');

    // Rebre les responses, retornant els resultats (encerts, ordre, temps).
    Route::post('do-sending-answers', [WebController::class, 'doSendingAnswers'])->name('do_sending_answers');
});
