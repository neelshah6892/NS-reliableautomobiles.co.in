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
define( 'DB_NAME', 'novaswtm_reliable' );

/** MySQL database username */
define( 'DB_USER', 'novaswtm_reliabl' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Reliable@12345' );

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
define( 'AUTH_KEY',         '$w~Mwz/lZa;8wNdSm)tHtE3oY/X`DnThs8-#nJTqaN]v:(UpVR1[ZtrL`:0d9r0+' );
define( 'SECURE_AUTH_KEY',  '7o5_iFrQ^5jr$du},|0b2D?NpIUKfBwDJkJf>2j{/!X PM?~Z$of>}IymsCD0TK+' );
define( 'LOGGED_IN_KEY',    ']esA|/(_V1B5[Q*U0&%$]d,&n+9bw+KCiXT&B?@n9E`un}>vrdNw;@:yY+9=9+T/' );
define( 'NONCE_KEY',        'YOBdt;(w`@+e$4;DIn9%BD^zFzhad!=T*s0lNDDnUn6f>uvq>wZW!?l~W|KU59/8' );
define( 'AUTH_SALT',        '}w6>l>J&(aG8Lo>yrFJ/45ooKTw1vG:?UKS>}mXM`_M)Dx]@-}uhBV-|>)C96K}u' );
define( 'SECURE_AUTH_SALT', 'H/`n+@P+K4O~*:n7,gz(C0*E2tMG$dPU7>~J{z}9~CAwb%8xm-EVHEU`UDh+gU5M' );
define( 'LOGGED_IN_SALT',   '^*XfSU/4{;]h@pi[l07Nj<%,ewL0<bK)%NK):yeV.KOBnkM{,7G2}9:;9s^?>Vnk' );
define( 'NONCE_SALT',       'e$E,]3Icn?rficLu]mp,BNnCs&vyo=!pA8_D7w%Le~)``<[i5yC)M@3EE)+G-V4_' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_hj';

define( 'WPMS_ON', true );
define( 'WPMS_SMTP_PASS', 'NewSecure@123' );
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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
