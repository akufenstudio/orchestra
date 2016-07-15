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

namespace Akufen\Orchestra\Mvc\Models;

/**
 * Akufen\Orchestra\Mvc\Models
 *
 * A model for WordPress posts
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Posts
 */
class Medias extends Posts
{
    /**
     * Initialize a post's source & relationships
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Retrieve a media post by id.
     *
     * @param int $id The id of the media we're looking for.
     *
     * @return mixed $media The media or false.
     */
    public static function findById($id)
    {
        return self::findFirst(array(
            "ID = ?1 AND post_type = 'attachment'",
            "bind" => array(1 => strval($id))
        ));
    }
}
