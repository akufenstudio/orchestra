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
 * Akufen\Orchestra\Mvc\Models\UserMeta
 *
 * A model for WordPress user's metas.
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 */
class UserMeta extends \Akufen\Orchestra\Mvc\Model
{
    /**
     * Initialize a user's meta source & relationships.
     *
     * @return void
     */
    public function initialize()
    {
        global $table_prefix;

        $this->setSource($table_prefix . 'usermeta');

        // User metas belong to a user
        $this->belongsTo(
            'user_id',
            'Akufen\Orchestra\Mvc\Models\Users',
            'ID',
            array('alias' => 'user')
        );
    }
}
