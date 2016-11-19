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

/**
 * Akufen\Orchestra\Traits\AssignableTrait
 *
 * A trait for easy class properties assignment.
 *
 * @package Traits
 */
trait AssignableTrait
{
    /**
     * Assign properties from an object to the model
     *
     * @param  Object $object The object to assign to the model
     * @return void
     */
    public function fromObject($object)
    {
        // Iterate object properties and assign to the model
        foreach (get_object_vars($object) as $property => $value) {
            $this->{$property} = $value;
        }
    }

    /**
     * Assign properties from an array to the model
     *
     * @param  Array $array The array to assign to the model
     * @return void
     */
    public function fromArray(array $array)
    {
        // Iterate object properties and assign to the model
        foreach ($array as $property => $value) {
            $this->{$property} = $value;
        }
    }
}
