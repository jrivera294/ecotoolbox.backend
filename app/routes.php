<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => 'api'), function()
{

    /******************** Puntos *********************/

    //Obtiene los puntos cercanos a una latitud y longitud determinada
    Route::get('nearbyPoints/{lat}/{lng}/{radius}', array('as' => 'getNearbyPoints', 'uses' => 'pointsController@getNearbyPoints'));

    //Obtiene el detalle de un punto determinado
    Route::get('points/{id}', array('as' => 'getPoints', 'uses' => 'pointsController@getPoints'));

    //Añade un punto a la base de datos
    Route::post('points', array('as' => 'postPoints', 'uses' => 'pointsController@postPoints'));

    /******************** Usuarios *********************/
    //Añade un usuario a la base de datos
    //Route::post('users/', array('as' => 'postUsers', 'uses' => 'pointsController@postUsers'));

    /******************** Reportes *********************/
    //Añade un reporte a la base de datos
    //Route::post('points/{id}/report', array('as' => 'postReports', 'uses' => 'pointsController@postReports'));
});


