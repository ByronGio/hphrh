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


/*Route::get('/avs', function () {
    return view('ejemplo/index');
});*/

//Route::resource('solicitud','solicitud');


/*Route::get('/solicitud', function () {
    return view('layouts/solicitud');
});*/

Route::resource('persona','PersonaController');

Route::get('persona/towns/{id}', 'PersonaController@getTowns');
//Route::get('layouts/towns/{id}', 'PersonaController@getTowns');

// Rutas Creados por LDRL

Route::group(['prefix'=>'empleado'],function(){
	Route::get('vacaciones','VController@create');
	Route::post('vacaciones','VController@store');
	Route::resource('solicitante','SController'); // SController = SolicitanteController
});

Route::get('pdf','SController@pdf');

///