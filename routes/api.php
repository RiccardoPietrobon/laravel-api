<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('projects', ProjectController::class)->except('store', 'update', 'destroy'); //fammi un api resource apparte questi 3 metodi



Route::get('/projects/{type_id}/type', [ProjectController::class, 'getProjectsByType']);
