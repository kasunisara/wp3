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
define( 'DB_NAME', 'wp3' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '1234' );

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
define( 'AUTH_KEY',         's.XIdqB0q=k5!+$:FqSXF#t>ML&J1~0LQQIk@F}Fz3]w 7kO8|rJxV*!9`d~i,j6' );
define( 'SECURE_AUTH_KEY',  'vT;+.d/y<iHClBe$o^)[|-(jgkloy8V:ctR<Ie2+bT)/.Mdudq.@BfUr;kl/,mI5' );
define( 'LOGGED_IN_KEY',    '^b?el7/W7cfnPA[7?rUC{.$YOxH!|p^[d%ArXyecRF9[>`SCY8Ct5{M]rAaqOJOg' );
define( 'NONCE_KEY',        '_rFr-*j*-38eQRrJ3I;^| Y=<aDIBL2-X>g[FcgTk>=Ef*{mx<7%H1l0i:tO9~Oz' );
define( 'AUTH_SALT',        'kGA/5oxQJnID[jssUFUrbmD[``R4yqG-JuK0||zur{wObNC!JV@kBM}fS@HZ:R&R' );
define( 'SECURE_AUTH_SALT', 'sz*n-(CKSDrao@,Da_,Dk05Nw?aD0i!+4p 5lwCBlgiwO[*k-Ik|,|(<&I&RP5yQ' );
define( 'LOGGED_IN_SALT',   'A0B29!rM3<eZ4kG80YDdsob}9ULT5O04eBz;MM(+Xy|F{.1j8 $9vMr*=%x@@2<7' );
define( 'NONCE_SALT',       '4T>D{%$:wp^&Kz^g+gDzGO7TX;[>M@F,2x$Rl}xX7Y8j?-;5NCF[+sAtmd*t2Rk%' );

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
