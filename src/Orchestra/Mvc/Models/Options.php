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

namespace Akufen\Orchestra\Mvc\Models;

/**
 * Akufen\Orchestra\Mvc\Models\Options
 *
 * A model for WordPress options.
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 * @Entity @Table(name="wp_options")
 */
class Options extends \Akufen\Orchestra\Mvc\Model
{
    /** @Id @Column(type="bigint", name="option_id") @GeneratedValue */
    public $id;

    /** @Column(type="string", length=191, name="option_name") */
    public $name;

    /** @Column(type="text", name="option_value") */
    public $value;

    /** @Column(type="string", length=20) */
    public $autoload;
}
