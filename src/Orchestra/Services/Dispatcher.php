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
 * @version   0.1.0
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
class Dispatcher
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
        global $post, $template;

        // Attempt to redirect to a controller & action
        if ($post) {
            // Get path information for the template
            $info = pathinfo($template);

            // Set the correct controller & action
            $dispatcher->setControllerName(get_post_type());
            $dispatcher->setActionName($info['filename']);
        } else {
            // Send to a 404
            $dispatcher->setControllerName('error');
            $dispatcher->setActionName('show404');
        }
    }
}
