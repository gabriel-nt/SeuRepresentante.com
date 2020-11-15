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
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/sobre', function () { 
    return view('about'); 
})->name('about');

Auth::routes();

Route::group(['prefix' => 'empresa'], function () {
    Route::get('/login', 'EmpresaAuth\LoginController@showLoginForm')->name('empresa.login');
    Route::post('/login', 'EmpresaAuth\LoginController@login')->name('empresa.login.submit');

    Route::post('senha/email', 'EmpresaAuth\ForgotPasswordController@sendResetLinkEmail')->name('empresa.password.email');
    Route::get('senha/resetar', 'EmpresaAuth\ForgotPasswordController@showLinkRequestForm')->name('empresa.password.request');
    Route::post('senha/resetar', 'EmpresaAuth\ResetPasswordController@reset')->name('empresa.password.update');
    Route::get('senha/resetar/{token}', 'EmpresaAuth\ResetPasswordController@showResetForm')->name('empresa.password.reset');

    // Route::get('/home', 'EmpresaController@index')->name('empresa.dashboard');
    Route::get('/cadastrar', 'EmpresaController@create')->name('empresa.create');
    Route::post('/cadastro','EmpresaController@store')->name('empresa.store');
    Route::get('/ver-perfil/{id}', 'EmpresaController@show')->name('empresa.show');
    Route::get('/editar/{id}', 'EmpresaController@edit')->name('empresa.edit');
    Route::post('/editar/{id}', 'EmpresaController@update')->name('empresa.update');
});

Route::group(['prefix' => 'comerciante'], function () {
    Route::get('/login', 'ComercianteAuth\LoginController@showLoginForm')->name('comerciante.login');
    Route::post('/login', 'ComercianteAuth\LoginController@login')->name('comerciante.login.submit');
    Route::post('/logout', 'ComercianteAuth\LoginController@logout')->name('comerciante.logout');

    Route::post('senha/email', 'ComercianteAuth\ForgotPasswordController@sendResetLinkEmail')->name('comerciante.password.email');
    Route::get('senha/resetar', 'ComercianteAuth\ForgotPasswordController@showLinkRequestForm')->name('comerciante.password.request');
    Route::post('senha/resetar', 'ComercianteAuth\ResetPasswordController@reset')->name('comerciante.password.update');
    Route::get('senha/resetar/{token}', 'ComercianteAuth\ResetPasswordController@showResetForm')->name('comerciante.password.reset');

    // Route::get('/home', 'ComercianteController@index')->name('comerciante.dashboard');
    Route::get('/cadastrar', 'ComercianteController@create')->name('comerciante.create');
    Route::post('/cadastro','ComercianteController@store')->name('comerciante.store');
    Route::get('/ver-perfil/{id}', 'ComercianteController@show')->name('comerciante.show');
    Route::get('/editar/{id}', 'ComercianteController@edit')->name('comerciante.edit');
    Route::post('/editar/{id}', 'ComercianteController@update')->name('comerciante.update');
    Route::get('/lista-representantes', 'ComercianteController@representantesList')->name('comerciante.listRepresentantes');
    Route::get('/pesquisa-representantes', 'LiveSearchController@action')->name('comerciante.searchRepresentantes');

    Route::get('/produtos', 'ComercianteController@productsByRepresentante')->name('comerciante.products');
    Route::get('/pedidos', 'ComercianteController@showPedidos')->name('comerciante.showPedidos');
});

Route::get('representante/perfil/{id}', 'ComercianteController@showRepresentante')->name('representante.perfil');

Route::group(['prefix' => 'representante'], function () {
    Route::get('/login', 'RepresentanteAuth\LoginController@showLoginForm')->name('representante.login');
    Route::post('/login', 'RepresentanteAuth\LoginController@login')->name('representante.login.submit');
    Route::post('/logout', 'RepresentanteAuth\LoginController@logout')->name('representante.logout');

    Route::post('senha/email', 'RepresentanteAuth\ForgotPasswordController@sendResetLinkEmail')->name('representante.password.email');
    Route::get('senha/resetar', 'RepresentanteAuth\ForgotPasswordController@showLinkRequestForm')->name('representante.password.request');
    Route::post('senha/resetar', 'RepresentanteAuth\ResetPasswordController@reset')->name('representante.password.update');
    Route::get('senha/resetar/{token}', 'RepresentanteAuth\ResetPasswordController@showResetForm')->name('representante.password.reset');

    // Route::get('/home', 'RepresentanteController@index')->name('representante.dashboard');
    Route::get('/cadastrar', 'RepresentanteController@create')->name('representante.create');
    Route::post('/cadastro','RepresentanteController@store')->name('representante.store');
    Route::get('/ver-perfil/{id}', 'RepresentanteController@show')->name('representante.show');
    Route::get('/editar/{id}', 'RepresentanteController@edit')->name('representante.edit');
    Route::post('/editar/{id}', 'RepresentanteController@update')->name('representante.update');

    Route::get('/pedidos', 'RepresentanteController@showPedidos')->name('representante.showPedidos');
    Route::get('/definir-localizacao', 'RepresentanteController@location')->name('representante.location');
    Route::post('/definir-localizacao', 'RepresentanteController@storeLocation')->name('representante.storeLocation');
    Route::get('/minha-localizacao/{id}', 'RepresentanteController@showLocation')->name('representante.showLocation');
    Route::get('/editar-localizacao/{id}', 'RepresentanteController@editLocation')->name('representante.editLocation');
    Route::post('/editar-localizacao/{id}', 'RepresentanteController@updateLocation')->name('representante.updateLocation');
});

Route::group(['prefix' => 'produto'], function () {
    Route::get('/home', 'ProdutoController@index')->name('produto.index')->middleware('auth:representante');
    Route::get('/cadastrar', 'ProdutoController@create')->name('produto.create')->middleware('auth:representante');
    Route::post('/cadastro','ProdutoController@store')->name('produto.store')->middleware('auth:representante');
    Route::get('/ver-perfil/{id}', 'ProdutoController@show')->name('produto.show')->middleware('auth:comerciante,representante');
    Route::get('/editar/{id}', 'ProdutoController@edit')->name('produto.edit')->middleware('auth:representante');
    Route::post('/editar/{id}', 'ProdutoController@update')->name('produto.update')->middleware('auth:representante');
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/home', 'CartController@index')->name('cart.index')->middleware('auth:comerciante');
    Route::post('/add-item', 'CartController@addCart')->name('cart.addCart')->middleware('auth:comerciante');
    Route::post('/adicionar-item', 'CartController@store')->name('cart.store')->middleware('auth:comerciante');
    Route::delete('/remover-item/{id}', 'CartController@remove')->name('cart.remove')->middleware('auth:comerciante');
    Route::post('/atualizar/{id}', 'CartController@update')->name('cart.update')->middleware('auth:comerciante');
    Route::get('/destroy', 'CartController@destroy')->name('cart.destroy')->middleware('auth:comerciante');
});

Route::group(['prefix' => 'pedido'], function () {
    Route::post('/gerar-pedido', 'PedidoController@store')->name('pedido.store')->middleware('auth:comerciante');
    Route::get('/detalhes-do-pedido/{id}', 'PedidoController@show')->name('pedido.show')->middleware('auth:comerciante,representante');
    Route::get('/ver-pdf/{id}', 'PedidoController@makePDF')->name('pedido.pdf')->middleware('auth:comerciante,representante');
    Route::get('/download-pdf/{id}', 'PedidoController@downloadPDF')->name('pedido.downloadPDF')->middleware('auth:comerciante,representante');
});




