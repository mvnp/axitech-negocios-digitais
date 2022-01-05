<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'axitech' );

/** MySQL database username */
define( 'DB_USER', 'axitech' );

/** MySQL database password */
define( 'DB_PASSWORD', 'z6k7968pXMSDqqYwqoMfI1B' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql995.umbler.com:41890' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '+E,7zGYXMNBpT&a97n>-<cCl:**=;i)GJ$4+fPm,k)$TZSc|3C)$):^y<oFy<|D0' );
define( 'SECURE_AUTH_KEY',  'ke;F|4jysq:k-b3(VQu{2a8$I&EJ1Qy o<Y:06#JKz(a07cjQ#6#8@^n<C2U/VVZ' );
define( 'LOGGED_IN_KEY',    'Ho-wg0eI>z-6#j:fYka{q~vi@6TeLN]hcPVxQQ59v^<jc3-))#,&H208lP7(aN:-' );
define( 'NONCE_KEY',        '-l+jwuz3`~EcAmY{U$`l;J9=h+aI<MZeGC.RAT(SS!j<x#-<wPetDX&%!NwUkWl%' );
define( 'AUTH_SALT',        'KnZ[ze(@i4+as(JP#C2&ssf+f(nYiVNs5|wDZgX/l<MUHiyR;>0X(9:!Eb2OVhW=' );
define( 'SECURE_AUTH_SALT', 'F9RD~{O16(cpLd8I/P0um]wf=a-il,a#_2QCV_T9:2M{;l6/n!_{m:w(tZ,;-W0[' );
define( 'LOGGED_IN_SALT',   'Cq-%vnY/$X2q/s|Dk!s%wi^&b>)JJq0LlN6}*ILL}|!93YZ6{pAfhBugNd6fW[ W' );
define( 'NONCE_SALT',       'Tdwqod9XVKB{c-96IP~q_i_sSs4Qx(w98/sm1wRW}AUhH1tQ$H/zNFU+K^ImsW~w' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */
define( 'WP_HOME', 'http://localhost:8000' );
define( 'WP_SITEURL', 'http://localhost:8000' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
