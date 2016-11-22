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
 * Akufen\Orchestra\Mvc\Models\CommentMeta
 *
 * A model for WordPress comment metas
 *
 * @package Models
 * @uses \Akufen\Orchestra\Mvc\Model
 */
class CommentMeta extends \Akufen\Orchestra\Mvc\Model
{
    use \Akufen\Orchestra\Traits\MetaKeyValueTrait;

    /** @Id @Column(type="bigint", name="meta_id") @GeneratedValue */
    public $id;

    /** @Column(type="bigint", name="comment_id") */
    public $commentId;
}
