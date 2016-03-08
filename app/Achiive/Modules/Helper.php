<?php
namespace App\Achiive\Modules;

use Dingo\Api\Routing\Router;

class Helper
{

    /**
     * Allows you to build an API route using an array tree (`$routes`).
     *
     * @param   \Dingo\Api\Routing\Router  $api        API routing class
     * @param   array                      $routes     Array of paths with controller assigned
     * @param   string                     $prePrefix  Path prefix for the route
     */
    static public function apiRouteLoop(Router $api, array $routes, $prePrefix = '')
    {
        foreach ($routes as $prefix => $controller) {

            // Build up the prefix path
            $prefix = $prePrefix . $prefix;

            // If `$controller` is an array then we will need to run this
            // method again to get the controllers out of it
            if (is_array($controller)) {
                self::apiRouteLoop($api, $controller, $prefix . '/');
                continue;
            }

            // Our defaults paths for each API endpoint
            if (method_exists('\App\Http\Controllers\\' . $controller, 'collection')) {
                $api->get($prefix, $controller . '@collection')->name(str_replace('/', '.', $prefix));
            }

            if (method_exists('\App\Http\Controllers\\' . $controller, 'tagged')) {
                $api->get($prefix . '/tagged', $controller . '@tagged')->name(str_replace('/', '.', $prefix) . '.tagged');
            }

            if (method_exists('\App\Http\Controllers\\' . $controller, 'item')) {
                $api->get($prefix . '/{id}', $controller . '@item')->name(str_replace('/', '.', $prefix) . '.item');
            }

        }
    }

}
