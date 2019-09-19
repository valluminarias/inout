<?php

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

use App\Attendance;

Route::group([
    'middleware' => 'auth',
], function () {

    Route::get('/', function () {
        return redirect('/home');
    });

    Route::get('/home', function () {
        return view('inout');
    })->name('home');

    Route::post('/checkin', function () {
        request()->user()->can('checkIn', Attendance::class);

        $attendance = request()->user()->attendance()->create([
            'type' => 'in',
            'log' => now()->toDateTimeString(),
        ]);

        return back()->with('message', 'You have checked in successfully.');
    });

    Route::post('/checkout', function () {
        request()->user()->can('checkOut', Attendance::class);

        $attendance = request()->user()->attendance()->create([
            'type' => 'out',
            'log' => now()->toDateTimeString(),
        ]);

        return back()->with('message', 'You have checked out successfully.');
    });

});

Auth::routes();
