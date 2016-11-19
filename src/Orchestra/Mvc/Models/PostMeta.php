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
 * Akufen\Orchestra\Mvc\Models\PostMeta
 *
 * A model for WordPress posts metas
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 */
class PostMeta extends \Akufen\Orchestra\Mvc\Model
{
    /**
     * Initialize a post meta's source & relationships.
     *
     * @return void
     */
    public function initialize()
    {
        global $table_prefix;

        $this->setSource($table_prefix . 'postmeta');

        // Metas belong to a post
        $this->belongsTo(
            'post_id',
            'Akufen\Orchestra\Mvc\Models\Posts',
            'ID',
            array('alias' => 'post')
        );
    }
}
