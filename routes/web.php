<?php

// routes/web.php
use App\Http\Controllers\PairingController;

Route::get('/', [PairingController::class, 'generatePairings'])->name('pairings.index');