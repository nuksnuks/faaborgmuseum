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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'faaborgmuseum' );

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
define( 'AUTH_KEY',         '-W*yysoPtqltXo{m%X(nmyA8YDmnJP/=TPYnv],6Kg]Q)hQD*qGG!(Bn<h/T0x3]' );
define( 'SECURE_AUTH_KEY',  'x%n#`cbJM~%pUTo~i?sL3bJ0o_yQB.2Rm@!)o;Nm96g*h_5o0IrpiO_gDShJF/lw' );
define( 'LOGGED_IN_KEY',    'vpyXSxk*HU5=.@2^C9aGl_b~UK&I#opR#wGz%RXpZM<7]C?TFvPGDW!,*P~e]2y9' );
define( 'NONCE_KEY',        'N[Hpzm3TYUyp?bxN@JnFA>SSiV&t=ndp?hTXH$-,= apJ3T.81Ify|}#mGCFII((' );
define( 'AUTH_SALT',        'B@-+hY*8k`G}@E6c)_?oc@_qGA@lGPR[_74Z`t}bn(9rF:)_vaV+yJrQIPemKJsz' );
define( 'SECURE_AUTH_SALT', '}oG#^OvxK6qs:vTO*,M3Y}9 6[d{XZ}VY4&tprN0QOxT/HG}fv-YEMU9uU#TxDw.' );
define( 'LOGGED_IN_SALT',   '0y$=>TRtKemGg[m7F!xSU3%J6ej<{*)&4jN66}M|+[n#p[y}53xJ+TAvv>92fwsi' );
define( 'NONCE_SALT',       't=IrseCDk-p!qL`T9qzU-@0_Vc(s|v0Vc+0LTAA{7@SuGd-6]63D=}?ac4;s(^do' );

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */
define('WP_HOME', 'http://localhost/faaborgmuseum/');
define('WP_SITEURL', 'http://localhost/faaborgmuseum/');


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
