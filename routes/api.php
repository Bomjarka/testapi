<?php

use App\Http\Controllers\Api\ShortlinkController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('links', [ShortlinkController::class, 'list'])->name('showShortlinks');
Route::post('create-link', [ShortlinkController::class, 'create'])->name('createShortlink');
Route::post('update-link', [ShortlinkController::class, 'update'])->name('updateShortlink');

