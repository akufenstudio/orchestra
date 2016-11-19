<?php

namespace App;

use Symfony\Component\Routing\Route;


/**
 * Router
 *
 * @uses Symfony\Component\Routing\RouteCollection
 * @copyright Akufen Atelier Creatif
 * @author Nicholas Charbonneau <nicholas@akufen.ca>
 */
class Router extends \Symfony\Component\Routing\RouteCollection
{
    /**
     * Initialise the routing collection
     *
     * @return void
     */
    public function __construct()
    {
        // Construct initial collection
        parent::__construct();

        // Basic configuration
        $this->setPaths(array(
            'module' => 'app',
            'controller' => 'index',
            'namespace' => 'App\Controllers'
        ));
    }
}
