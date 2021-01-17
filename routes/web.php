<?php

use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use L5Swagger\ConfigFactory;
use L5Swagger\Http\Middleware\Config as L5SwaggerConfig;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/avito', [PublicationController::class, 'loadDataFromDomclick']);
