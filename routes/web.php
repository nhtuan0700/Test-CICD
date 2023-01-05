<?php

use App\Http\Controllers\ReflectionTestController;
use App\Http\Controllers\UploadFileController;
use App\Jobs\LogJobTest;
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


Route::get('email', function () {
    \Illuminate\Support\Facades\DB::table('users')->where('id', '<', 20)->orderBy('id')->chunk(10, function ($users) {
        \App\Jobs\TestSendEmail::dispatch($users);
    });
    dd('Send mail success');
});

Route::get('job', function () {
    LogJobTest::dispatch()->onQueue('job2');
    dd('Test other job success');
});


Route::get('', [ReflectionTestController::class, 'index']);