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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
// define( 'DB_NAME', 'abbadtours_website' );

// /** Database username */
// define( 'DB_USER', 'abbadtours_website' );

// /** Database password */
// define( 'DB_PASSWORD', 'ftE4m2jhZaATHHw5UhT8' );

// /** Database hostname */
// define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'B- _9>T%[Zrqmsa#IW,J[ET3MYpTOmBWzpmZMoc:j5KN}h@l;S&+$ds-$oL:]#^U' );
define( 'SECURE_AUTH_KEY',  'q7Nw6Oy5&im6`DfFX<kPYPnwNO+j*/L|jF,^=*9cRZwemP!3K_aedumyY5{y7q,O' );
define( 'LOGGED_IN_KEY',    'ys9OA2H[a~*4!I[(J,[H=6=(hRAI^KK$aUzXyFH7t- DMCAW:FeQ@Y{uJ)]u;9[0' );
define( 'NONCE_KEY',        '<*^4/qB>e~Av]LGFP]QvNh]1W<.>:vUg]qn?M<J|Jb=&ll$x:Hl+Q>{;ga@b[>&K' );
define( 'AUTH_SALT',        '=-)oqw/r4!}$MV^3)lNpx}h:O(k83Ln1f]uvE+Ay^L0o|cWb2&;Wf3%:V%jLUMlk' );
define( 'SECURE_AUTH_SALT', 'a6Y2.L a#lM;Y&kei1Cx_:vJlKzONp-Vzsd^7^6ycX41fE29e,ke><a^rYjSjIAh' );
define( 'LOGGED_IN_SALT',   '?l0>moNyJ#q-k2u`f)2q+xX`}o6JrMyA?&`6@f>p5GXaNeJSTQc U?q>VxAH7sV#' );
define( 'NONCE_SALT',       'asxD+W`9UwML6ONI>; i/9&*Kf#,w7F*j!ag2G=c5`q6IZ8L8oD3V~__,e:]8!jM' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', true);
define( 'WP_DEBUG_DISPLAY', false);

define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');
define('DISALLOW_FILE_EDIT', true);

/* Add any custom values between this line and the "stop editing" line. */



define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
