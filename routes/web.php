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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::resource('produtos', 'ProdutoController')->middleware('auth');
Route::resource('funcionarios','FuncionarioController')->middleware('auth');
Route::group(['prefix' => '/relatorios', 'middleware' => 'auth'], function () {
    Route::get('/produtos', 'RelatoriosController@produtos')->name('relatorios.produtos');
    Route::get('/funcionarios','RelatoriosController@funcionarios')->name('relatorios.funcionarios');
});
Route::get('/nova-venda','VendaController@index')->middleware('auth');
Route::post('/nova-venda','VendaController@store')->middleware('auth')->name('vendas.store');
