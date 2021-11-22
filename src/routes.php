<?php

use Apurv\LaravelSite\Http\Controllers\CMSController;
use Illuminate\Support\Facades\Route;

Route::get('/{slug?}', [CMSController::class, 'index']);
