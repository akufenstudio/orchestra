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
 * @Entity @Table(name="wp_users")
 */
class Users extends \Akufen\Orchestra\Mvc\Model
{
    /** @Id @Column(type="bigint", name="ID") @GeneratedValue */
    public $id;

    /** @Column(type="string", length=60,  name="user_login") */
    public $userLogin;

    /** @Column(type="string", name="user_pass") */
    public $userPass;

    /** @Column(type="string", length=50, name="user_nicename") */
    public $userNicename;

    /** @Column(type="string", length=100, name="user_email") */
    public $userEmail;

    /** @Column(type="string", length=100, name="user_url") */
    public $userUrl;

    /** @Column(type="datetime", name="user_registered") */
    public $userRegistered;

    /** @Column(type="string", name="user_activation_key") */
    public $userActivationKey;

    /** @Column(type="integer", name="user_status") */
    public $userStatus;

    /** @Column(type="string", length=250, name="display_name") */
    public $displayName;
}
