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
 * @version   0.1.4
 * @link      https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Traits;

use Akufen\Orchestra\Helpers\Strings;

/**
 * Akufen\Orchestra\Traits\AccessibleTrait
 *
 * A trait for easy class property access.
 *
 * @package Traits
 */
trait AccessibleTrait
{
    /**
     * Magic method for fast get & set
     *
     * @param  string $method The name of the method that was executed
     * @param  mixed  $value  The value that will be used to set a property
     * @return mixed The value of a property or null
     */
    public function __call($method, $value = null)
    {
        // Handle a get method on a service
        if (preg_match('/^get/', $method)) {
            $property = lcfirst(substr($method, 3));
            if (!isset($this->{$property})) {
                $property = Strings::toUnderscores($property);
            }
            return $this->get($property);
        }

        // Handle a set method on a service
        if (preg_match('/^set/', $method)) {
            if (is_array($value) && !empty($value)) {
                $this->set(lcfirst(substr($method, 3)), $value[0]);
            }
            return null;
        }

        throw new Exception("Method '".$method."' wasn't found in the class.");
    }

    /**
     * Set a class property
     *
     * @param  string $name  The name of the property to set
     * @param  mixed  $value The value of the property to set
     * @return void
     */
    public function set($name, $value)
    {
        $name = strval($name);

        // Setting the property to null first because Phalcon converts array keys to properties
        $this->$name = null;
        $this->$name = $value;
    }

    /**
     * Get a class property
     *
     * @param  string $name The requested variable name
     * @return mixed $var The instance of the variable or null
     */
    public function get($name)
    {
        $name = strval($name);

        if (!isset($this->$name)) {
            throw new Exception("Access to undefined property");
        }

        return $this->$name;
    }
}
