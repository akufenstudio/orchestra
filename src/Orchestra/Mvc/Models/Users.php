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
 * Akufen\Orchestra\Mvc\Models\Users
 *
 * A model for WordPress users.
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 */
class Users extends \Akufen\Orchestra\Mvc\Model
{
    /**
     * Initialize a user's source & relationships.
     *
     * @return void
     */
    public function initialize()
    {
        global $table_prefix;

        $this->setSource($table_prefix . 'users');

        // A user has many user meta
        $this->hasMany(
            'ID',
            'Akufen\Orchestra\Mvc\Models\UserMeta',
            'user_id',
            array('alias' => 'metas')
        );

        // A user has many posts
        $this->hasMany(
            'ID',
            'Akufen\Orchestra\Mvc\Models\Posts',
            'post_author',
            array('alias' => 'posts')
        );
    }
}
