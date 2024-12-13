<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ecommerce' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '%}4>eLWBz0s#Q^4Qii][+S~E XBDM}y;&&p-li$I@jRl?;fc~r87ll/VN+{ZdlOP' );
define( 'SECURE_AUTH_KEY',  'A*mhSqFmYWuTYRmjE>`cYW`~#b9bnomQC#?m8(ro5unX%6<> 8UOa8u1@66+!A}r' );
define( 'LOGGED_IN_KEY',    'hIW[.%MF?D3sR8Kd~*B~|HsV9Lj0BG1Kf,0qS&j!i(;ee)glGZwtT|qEj9Y)M_y~' );
define( 'NONCE_KEY',        '58VgP|HDQ!n#qhkQH{GJpMSz$,#VSBTSjI(Wt1-SL-MGQ51a:YucFp|nO;!7E=h6' );
define( 'AUTH_SALT',        'Xq-T+$.p&Mz+w(xGi*^dvk!Tb~XbKM7ul^Lv)>=4St`)@F!@9/L_|9fxizA@7o$q' );
define( 'SECURE_AUTH_SALT', 'cG^:rBv:J5L71$+S9Pa`,3GkbT,:hHREn#zmO tY]il6z%7i4_P$]&PU1${pmt-i' );
define( 'LOGGED_IN_SALT',   '{7`=)>Wwk=sljEOk~b4M1icCqR; SXg`%-)[]o.vjp;Pkfp#wlW=6n D7 FndXGz' );
define( 'NONCE_SALT',       'X}qDu5Klv.!Z(6iM^A4?j>J#d69Z)grR![lQX2@BEfgbQC`Pz=XsyAsWJr10u#1]' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
