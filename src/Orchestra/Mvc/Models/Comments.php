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
 * Akufen\Orchestra\Mvc\Models\Comments
 *
 * A model for WordPress comments
 *
 * @package Models
 * @uses \Akufen\Orchestra\Mvc\Model
 * @Entity @Table(name="wp_comments")
 */
class Comments extends \Akufen\Orchestra\Mvc\Model
{
    /** @Id @Column(type="bigint", name="comment_ID") @GeneratedValue */
    public $id;

    /** @Column(type="bigint", name="comment_post_ID") */
    public $postId;

    /** @Column(type="text", name="comment_author") */
    public $author;

    /** @Column(type="string", length=100, name="comment_author_email") */
    public $authorEmail;

    /** @Column(type="string", length=200, name="comment_author_url") */
    public $authorUrl;

    /** @Column(type="string", length=100, name="comment_author_IP") */
    public $authorId;

    /** @Column(type="datetime", name="comment_date") */
    public $date;

    /** @Column(type="datetime", name="comment_date_gmt") */
    public $dateGmt;

    /** @Column(type="text", name="comment_content") */
    public $content;

    /** @Column(type="integer", name="comment_karma") */
    public $karma;

    /** @Column(type="string", length=20, name="comment_approved") */
    public $approved;

    /** @Column(type="string", name="comment_agent") */
    public $agent;

    /** @Column(type="string", length=20, name="comment_type") */
    public $type;

    /** @Column(type="bigint", name="comment_parent") */
    public $parent;

    /** @Column(type="bigint", name="user_id") */
    public $userId;
}
