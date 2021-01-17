<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Exceptions\MethodNotAllowed;
use App\Http\API\Controllers\OwnershipController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::fallback(function (Request $request) {
  throw new MethodNotAllowed('Method not found');
});

Route::get('/ownership/{area}', [OwnershipController::class, 'publicationsList']);
