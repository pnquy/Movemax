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
define( 'DB_NAME', 'movemax' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

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
define( 'AUTH_KEY',         'hhs1oYWJ/LUPPm`&&Oq5OW<FXJc>5vA)T>K8^QrkqU2kQ||GQ7_YKXA)R7n|)PG5' );
define( 'SECURE_AUTH_KEY',  '&Zs%@|i{.&p56aK[I5qA1MSY7rh;|X|fGnv-0^Pm~p%fON9W5JbvM38X[ ;4ZZN1' );
define( 'LOGGED_IN_KEY',    ' 6AlfMML>EDen.}9(,z|+q!YN$~y<0_WYs6M!+B4a1{ +X;#BPThDn=c<ME3Dx_F' );
define( 'NONCE_KEY',        '&]Lx~=A.#B{&I;1Y?!`JTCiZ|ZwY whmY~/N7?@B!l}lQnh]wQ!)-w;~P6tLt|O>' );
define( 'AUTH_SALT',        'Y/EUklVsrwawrI(cCnRH~z~N/Q,?_mubF@XLklxZCFS@da6PWU6b[QSos??~cD%,' );
define( 'SECURE_AUTH_SALT', '{)2uYCg~qW_f5a[GUE06lCXbg,8`%j-oA{xfW-/>jWB0TA[mj=,-8qHTJrAF6n Y' );
define( 'LOGGED_IN_SALT',   '+QQ~Xtp8ri.$xUZ.SPJ.|mM<|<xH?g//CivC|w &Z|c%/[X9wSx;Cg+{M0)yKIB6' );
define( 'NONCE_SALT',       '(DXGxjH|X&<~d3JU.KyDEzzNsjvf!ZcKI*rL2?t^exwO9|O 93_JS1HgtjlI)SQ?' );

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
