<?php

/**
 * Orchestra: A minimalist object-oriented superset for WordPress using Phalcon.
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE and is available through
 * the world-wide-web at the following URI:
 * http://opensource.org/licenses/MIT
 *
 * @copyright Akufen Atelier Creatif
 * @author    Nicholas Charbonneau <nicholas@akufen.ca>
 * @license   http://opensource.org/licenses/MIT
 * @version   0.1.2
 * @link      https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Services;

/**
 * Akufen\Orchestra\Dispatcher
 *
 * A custom dispatcher for WordPress architecture
 *
 * @package Services
 */
class Dispatcher extends \Phalcon\Mvc\User\Plugin
{
    /**
     * Attempts to find a controller & action that matches the request.
     *
     * @param  \Phalcon\Events\Event   $event      Contextual information of the event produced.
     * @param  \Phalcon\Mvc\Dispatcher $dispatcher The dispatcher service.
     * @return void
     */
    public function beforeDispatchLoop(\Phalcon\Events\Event $event, \Phalcon\Mvc\Dispatcher $dispatcher)
    {
        global $post;
        $router = $this->getDI()->getRouter();

        // Send to a 404 by default
        $dispatcher->setControllerName('error');
        $dispatcher->setActionName('show404');

        // Get paths if router matched
        if ($router->wasMatched()) {
            $paths = $router->getMatchedRoute()->getPaths();
        }

        // Attempt to redirect to a controller & action
        if (isset($paths) && is_string($paths['controller'])) {
            $dispatcher->setModuleName($paths['module']);
            $dispatcher->setNamespaceName($paths['namespace']);
            $dispatcher->setControllerName($paths['controller']);
            $dispatcher->setActionName($paths['action']);
        } else if ($post) {
            // Set the correct controller & action
            $dispatcher->setControllerName($post->post_type);
            $dispatcher->setActionName(str_replace('.php', '', get_page_template_slug($post->ID)));
        }
    }
}
