<?php

// Route::get('/home', function () {
//     $users[] = Auth::user();
//     $users[] = Auth::guard()->user();
//     $users[] = Auth::guard('comerciante')->user();

//     return view('comerciante.index');
// })->name('dashboard');

Route::get('/home', 'ComercianteController@index')->name('dashboard');

