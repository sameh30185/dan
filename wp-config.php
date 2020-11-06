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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'new-dan' );

/** MySQL database username */
define( 'DB_USER', 'newdan-user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'rUf{Vw_8dnm8' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'HZ=AHGh{JIF&kZDm[_1xQp81;;{$ebiq] ,Axud6H{*L#y:|DSl,bsE9, 4PGD<d' );
define( 'SECURE_AUTH_KEY',  'wI4mfU2aZ)J[^,sR6GZYchDnN1%/HaMj[wOXNa^*4n}aM[2$9/Q#Q4Q9zUwbfJ%k' );
define( 'LOGGED_IN_KEY',    'wFPQSpB}k}z63 J.B]M<M!^4xaI+s +G*L)M!iM<#-{[&2_{[,t*E6dRrd/qLpC2' );
define( 'NONCE_KEY',        'jSeD9`%GQI.N+uR_9,P,Fpfe>A#vwK@OV~_K_x0xRy}o{~oqxC9#tq:+KM1a:0np' );
define( 'AUTH_SALT',        'cmMfD4js DFf)9u>on)nrz1J^]~5KxtIHdzd`HCa2q*`Lx{]=&P(Os,Ena~jQ_zQ' );
define( 'SECURE_AUTH_SALT', '=3g{Q/~G8BXWa!}RGoD<lRM(hnth9@OU,;LOy9/oY5g!fJEhIoSQ!FWH{<HA}U.f' );
define( 'LOGGED_IN_SALT',   'rekDC~Hr7A5F!%o)MJdU]Au4<c?-o 3aSGUZ~oVWTva1hJS$5p0NZ7:.%Vq/]J%v' );
define( 'NONCE_SALT',       ')5YRtlvVoc6[HhYFYnO_DN6XtVHV?K 6;MS4c??pnn;MR-*uoX1@xN-i :c<8YKN' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
