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

namespace Akufen\Orchestra\Helpers;

/**
 * Akufen\Orchestra\Helpers\Strings
 *
 * A helper for easy string manipulation
 *
 * @package Helpers
 */
class Strings
{
    /**
     * Converts a camel case string to an underscored one
     *
     * @param  String $string The string to convert
     * @return $string The converted string
     */
    public static function toUnderscores($string)
    {
        // String must be string
        $string = strval($string);

        // Match all camel cases
        preg_match_all(
            '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!',
            $string,
            $matches
        );

        // Lowercase all matches
        $return = $matches[0];
        foreach ($return as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        // Return underscored string
        return implode('_', $return);
    }
}
