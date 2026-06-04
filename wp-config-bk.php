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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'Pupgipa$c&-oi|,T#,[I4T_cTfC}eDV(0IMKL!x,SgE{Mv*rn24S|s`CL08]D* H' );
define( 'SECURE_AUTH_KEY',   'VuOqrr<gdguj*fX(FSH:b3r1GCq?5Fhap2aHdfTO8p+O?cd@achi.*79s GdS1Gk' );
define( 'LOGGED_IN_KEY',     '`]JUg/0@h~}vBM=LuKk?}Av]; (_1;O/umAh5=#vH(}}?PglO7b{3O=DbqLcrxBM' );
define( 'NONCE_KEY',         '!AW)WB!6ipLt!O%A1Bgx=PS]|S$7!w|dqT.@Jqby}<8U143disY#o|:HO#(.v-,#' );
define( 'AUTH_SALT',         'f(rd9H-v?5lu50[:OyY]ZXeYCvM!i}-KO:sK%w#MpqG,!evF:`qR+%>IjPsK#y2e' );
define( 'SECURE_AUTH_SALT',  '* tY#85QB&m[oXA{*nakRw SBQiaqqXNpR17M:q1$s^JqNb[vC;}qB?uf4,>AeiS' );
define( 'LOGGED_IN_SALT',    '{2jkR%Fc[d1+Q{g2LF)7f*vlHML8YK`fX,Ci9&3s*sr0`3A+]-X8-Y$ck({Y0JeF' );
define( 'NONCE_SALT',        '{04=>{cvN+8VQD~ Q0{TjRA+!lN4UR,QpU==>(FvY;A&h$ 1QQ`zAlRQWUM:A}?o' );
define( 'WP_CACHE_KEY_SALT', 'NKG,6un+<w3F9+A!m*@8EuTHkB+^YS&u)5[KacD*u9s !*A/|7T+f*,6 $6I(k&D' );


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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
