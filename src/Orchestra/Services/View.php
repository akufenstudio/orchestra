<?php

/**
 * Orchestra: A minimalist object-oriented superset for WordPress using Symfony.
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE and is available through
 * the world-wide-web at the following URI:
 * http://opensource.org/licenses/MIT
 *
 * @copyright Akufen Atelier Creatif
 * @author    Nicholas Charbonneau <nicholas@akufen.ca>
 * @license   http://opensource.org/licenses/MIT
 * @version   0.2.0
 * @link      https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Services;

use Akufen\Orchestra\Traits\AccessibleTrait;
use Akufen\Orchestra\Traits\InjectionAwareTrait;

use Symfony\Component\Templating\PhpEngine;

/**
 * Akufen\Orchestra\Services\View
 *
 * Orchestra application view service.
 *
 * @package Orchestra
 */
class View extends PhpEngine
{
    use AccessibleTrait;
    use InjectionAwareTrait;

    /**
     * {@inheritDoc}
     */
    public function render($name, array $params = array(), $partial = false)
    {
        return $partial? parent::render($name, $params) :
            parent::render('index', array_merge($params, array(
                'content' => parent::render($name, $params)
            )));
    }
}
