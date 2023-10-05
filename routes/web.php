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

//Route::get('/', function () {
//    return view('welcome');
//})->middleware('auth');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('/', 'HomeController', ['only' => 'index']);
    Route::resource('/usuarios', 'OrganizationsController');
    Route::resource('/LineasProduccion', 'ProjectsController');
    Route::resource('/Producto', 'ProductoController');
    Route::resource('/Asignaciones', 'ReportsController');
    Route::resource('/reports-global', 'ReportLight', ['only' => 'index']);
    Route::resource('/ProdLineasAgregar', 'IssuesController');
    Route::resource('/chart', 'ChartController');
    Route::resource('/ProcesosProduccion', 'TagController');
    Route::resource('/auth', 'RegisterController');
    Route::post('/upload-excel', 'ExcelUploadController@uploadExcel')->name('upload.excel.controller');
   // Route::post('/upload-excel', 'ExcelController@subirExcel')->name('upload.excel.controller');
    Route::get('/filtrar-produccion', 'TagController@filtrarProduccion')->name('filtrar.produccion');
    Route::get('/quitar-filtro', 'TagController@quitarFiltro')->name('quitar.filtro');






});
Route::resource('/resume', 'ChartController', ['only' => 'index']);



