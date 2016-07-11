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
 * @version   0.1.1
 * @link      https://github.com/akufenstudio/orchestra
 */

namespace Akufen\Orchestra\Mvc;

/**
 * Akufen\Orchestra\Mvc\Model
 *
 * Default model class.
 *
 * @package Models
 * @uses    \Phalcon\Mvc\Model
 */
class Model extends \Phalcon\Mvc\Model
{
    use \Akufen\Orchestra\Traits\AccessibleTrait;
    use \Akufen\Orchestra\Traits\AssignableTrait;
}
