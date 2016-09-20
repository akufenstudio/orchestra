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

namespace Akufen\Orchestra\Mvc\Models;

/**
 * Akufen\Orchestra\Mvc\Models\TermMeta
 *
 * A model for WordPress term metas.
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 */
class TermMeta extends \Akufen\Orchestra\Mvc\Model
{
    /**
     * Initialize a term's meta source & relationships.
     *
     * @return void
     */
    public function initialize()
    {
        global $table_prefix;

        $this->setSource($table_prefix . 'termmeta');

        // Term metas belong to a term
        $this->belongsTo(
            'term_id',
            'Akufen\Orchestra\Mvc\Models\Terms',
            'term_id',
            array('alias' => 'term')
        );
    }
}
