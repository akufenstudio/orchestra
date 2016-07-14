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
 * Akufen\Orchestra\Mvc\Models\Comments
 *
 * A model for WordPress comments
 *
 * @package Models
 * @uses \Akufen\Orchestra\Mvc\Model
 */
class Comments extends \Akufen\Orchestra\Mvc\Model
{
    /**
     * Initialize a comment's source & relationships
     *
     * @return void
     */
    public function initialize()
    {
        global $table_prefix;

        $this->setSource($table_prefix . 'comments');

        // Comments belong to an author
        $this->belongsTo(
            'comment_author',
            'Akufen\Orchestra\Mvc\Models\Users',
            'ID',
            array('alias' => 'author')
        );

        // Comments have many comment metas
        $this->hasMany(
            'comment_ID',
            'Akufen\Orchestra\Mvc\Models\CommentMetas',
            'comment_id',
            array('alias' => 'metas')
        );
    }
}
