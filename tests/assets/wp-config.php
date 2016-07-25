<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'orchestra');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** The WordPress instance language. */
define('WP_LANG', 'en_US');

/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress using Phalcon.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ',0xO^sF63OYx7_oIs1N2k]k(<<vG%T0@_~{JgIM_sZFSQ)M)G;h+nHB-~O+-p^la');
define('SECURE_AUTH_KEY', ')!$.R@|+j}Yql>p7T?EZK}9s+yZ0KbAQP7sBi8~I5fBQL#mu)T1%o^y.jS.<lng!');
define('LOGGED_IN_KEY', 'y(MpFb<1fA|p4$!G%0%Dso!HdAohl9t,g 40.4M3)IgxLEJ~wbyjkd?IhyxJ-m;s');
define('NONCE_KEY', 'r;z[8pDul~oRNs[JJEfQ1uhX@D{]6B-JY7#$~xH-uZa`EJ>fy;h-3_G}ILPNBQ1G');
define('AUTH_SALT', 'gz?vn5hx0Fl<m^yd%.R(=zko%W`r%|8zYb|>/u.`be34[RMX7AePhQ]bS6j={t?&');
define('SECURE_AUTH_SALT', 'F<f9;Nw@7=pZO]rxk+2UnH)^C <K|V8irJ#_[e78!PI]0_++.vNFq=[<zu~~3%z%');
define('LOGGED_IN_SALT', '71w-u)P{A[$z}]z;F/C]_xd3AS69rXSs,T<.)ijspp0o7A=c[,7q+zvNFuVyo7TB');
define('NONCE_SALT', ')cly@-Zr~GzRWa@1KUi9g4ZzF3*Xj?9i,8R_}QU1a)dn2=)|wzBEF,!BTS`]< N(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}
