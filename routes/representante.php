<?php

// Route::get('/home', function () {
//     $users[] = Auth::user();
//     $users[] = Auth::guard()->user();
//     $users[] = Auth::guard('representante')->user();

//     return view('representante.index');
// })->name('dashboard');

Route::get('/home', 'RepresentanteController@index')->name('dashboard');

