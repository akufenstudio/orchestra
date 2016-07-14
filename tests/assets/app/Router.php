<?php

namespace App;

/**
 * Router
 *
 * @uses \Phalcon\Mvc\Router\Group
 * @copyright Akufen Atelier Creatif
 * @author Nicholas Charbonneau <nicholas@akufen.ca>
 */
class Router extends \Phalcon\Mvc\Router\Group
{
    /**
     * Initialise the routing group
     *
     * @return void
     */
    public function initialize()
    {
        // Basic configuration
        $this->setPaths(array(
            'module' => 'app',
            'controller' => 'index',
            'namespace' => 'App\Controllers'
        ));

        $this->add('/test', array(
            'controller' => 'testing',
            'action' => 'static'
        ));
    }
}
