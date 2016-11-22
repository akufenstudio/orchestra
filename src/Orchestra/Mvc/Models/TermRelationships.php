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
 * Akufen\Orchestra\Mvc\Models\TermRelationships
 *
 * A model for WordPress term relationships.
 *
 * @package Models
 * @uses    \Akufen\Orchestra\Mvc\Model
 * @Entity @Table(name="wp_term_relationships")
 */
class TermRelationships extends \Akufen\Orchestra\Mvc\Model
{
    /** @Column(type="bigint", name="object_id") */
    public $objectId;

    /** @Column(type="bigint", name="term_taxonomy_id") */
    public $termTaxonomyId;

    /** @Column(type="integer", name="term_order") */
    public $termOrder;
}
