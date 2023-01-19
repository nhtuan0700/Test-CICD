<?php

use App\Http\Controllers\ReflectionTestController;
use App\Http\Controllers\UploadFileController;
use App\Jobs\CancelConference;
use App\Jobs\ProcessPayment;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/upload-file', [UploadFileController::class, 'upload']);


Route::get('', [ReflectionTestController::class, 'index']);

Route::group(['prefix' => 'job'], function () {
    Route::get('cancel', function () {
        CancelConference::dispatch();
        dd('Cancel conference job success');
    });
});
