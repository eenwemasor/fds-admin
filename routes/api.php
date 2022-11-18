<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
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


Route::middleware('auth:sanctum')->prefix('profiles')->group(function () {
    Route::get('/', [ProfileController::class, 'list'])->name('profiles.list');
    Route::post('create', [ProfileController::class, 'store'])->name('profiles.create');
    Route::get('{profileId}', [ProfileController::class, 'view'])->name('profiles.create');
    Route::delete('{profileId}/delete', [ProfileController::class, 'delete'])->name('profiles.delete');
    Route::delete('{profileId}/delete/image/{imageId}', [ProfileController::class, 'deleteImage'])->name('profiles.delete');
    Route::post('{profileId}/manage/file-upload', [ProfileController::class, 'uploadFiles'])->name('profiles.create');
});

Route::middleware('auth:sanctum')->prefix('settings')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('settings.list');
    Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
});



Route::prefix('external')->group(function () {
    Route::get('settings', [SettingController::class, 'index'])->name('external.settings.list');
});
