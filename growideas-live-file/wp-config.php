<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

define('WP_MEMORY_LIMIT', '4G');

/* define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false); */


// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u808927808_jPzt5' );

/** Database username */
define( 'DB_USER', 'u808927808_lJeIX' );

/** Database password */
define( 'DB_PASSWORD', 'QW5lWGygsv' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '-->~anY5@Y!P%7)|epY_3rJ)ebh(b30n1x_8e^86b `564!v0HYtz%+x`D?o21BZ' );
define( 'SECURE_AUTH_KEY',   '4j06.mn](bMSImb@@NHr]TXUNw}C9gsm?ga?8l$(7mO}O-1BDq$~k&3wFS%w_*{B' );
define( 'LOGGED_IN_KEY',     'P@ax2U0o8E/l?:>MSo~d;%d1xt+q %r[q+G/.qa@zqqz0QoF!L{x@p8K;q+8pc|B' );
define( 'NONCE_KEY',         '9|%4|n6PWi9 O5ELypaK/q* Wl:xV:_2*WE([BT-J*62u|Rlz%=gmL#p9Lv2=#1&' );
define( 'AUTH_SALT',         'Ly@b$tX6~0D~J>]+Y[2fe_wGnHD-E0gBeh}=hl Yt]ky;%u==;:Ww*&HdfWGOIci' );
define( 'SECURE_AUTH_SALT',  'F 5f^rA]I}P@J|AOuXy=[~%|Zh2K2,Jx]xp:Gkl4EzMvuH9?*8%W}1oe)Od~+7.`' );
define( 'LOGGED_IN_SALT',    'k OkDC(CR?~{qA>_l5ks7BOpt4#HD||&9Mkk5u#`%X.jBy%gZc^b#Q6vTlWJKV0&' );
define( 'NONCE_SALT',        '*G!;`[OID43}=b6EkO9+]^D&(y KhcU$h5-XN{oeHH$;q/,,(_M+d,m{^n&we^Zy' );
define( 'WP_CACHE_KEY_SALT', '@bDag>gfPE; 3z$y{$1FuUqK/ ar[EfHlt#i7^C}Lj2`}m.$g C)>/FK$[NF9X<!' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', 'af8a4c801893238648d138c34694a9b4' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
