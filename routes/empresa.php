<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('empresa')->user();

    //dd($users);

    return view('empresa.index');
})->name('dashboard');

