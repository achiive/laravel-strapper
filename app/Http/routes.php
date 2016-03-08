<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Http\Controllers', 'middleware' => 'cors'], function ($api) {

    // Advance Routes...
    // =========================================================================

    // ...


    // Helpers...
    // =========================================================================

    // Single point
    // -------------------------------------------------------------------------
    $api->get('{model}_{id}', function ($model, $id) {
        return redirect('api/' . str_plural($model) . '/' . $id);
    })->name('helper.single_point');


    // Basic Routes...
    // =========================================================================

    Helper::apiRouteLoop($api, [
        'url' => 'TheController',
        'prefix' => [
            'sub-route' => 'AnotherController'
        ],
    ]);

});
