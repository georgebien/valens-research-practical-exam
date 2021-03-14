<?php

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

Route::get('new-paint-jobs', 'PageController@new_paint_jobs_page');
Route::get('paint-jobs', 'PageController@paint_jobs_page');
Route::resource('paint-controller', 'PaintController');
Route::get('on-queue-paint-jobs', 'PaintController@loadOnQueuePaintJobs');
Route::get('shop-performance', 'PaintController@loadShopPerformance');

