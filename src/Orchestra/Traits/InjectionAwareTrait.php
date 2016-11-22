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

namespace Akufen\Orchestra\Traits;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Akufen\Orchestra\Trait\InjectionAwareTrait
 *
 * A basic trait for injection aware classes.
 *
 * @package Mvc
 */
trait InjectionAwareTrait
{
    /** @var The application dependency injector. */
    public $di = null;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->di = $container;
    }
}
