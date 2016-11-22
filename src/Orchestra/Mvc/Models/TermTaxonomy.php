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
 * Akufen\Orchestra\Mvc\Models\TermTaxonomy
 *
 * A model for WordPress term taxonomy.
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 * @Entity @Table(name="wp_term_taxonomy")
 */
class TermTaxonomy extends \Akufen\Orchestra\Mvc\Model
{
    /** @Id @Column(type="bigint", name="term_taxonomy_id") @GeneratedValue */
    public $id;

    /** @Column(type="bigint", name="term_id") */
    public $termId;

    /** @Column(type="string", length=32) */
    public $taxonomy;

    /** @Column(type="text") */
    public $description;

    /** @Column(type="bigint") */
    public $parent;

    /** @Column(type="bigint") */
    public $count;
}
