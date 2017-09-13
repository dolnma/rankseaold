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
define('DB_NAME', 'c2rankseadev');

/** MySQL database username */
define('DB_USER', 'c2rankseadev');

/** MySQL database password */
define('DB_PASSWORD', 'bPqDh6S_7');

/** MySQL hostname */
define('DB_HOST', '192.168.16.12');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '{0D~j/G$8ubRC$:8J}1,D2961!ieiR#E}sNW,qDcyd+/4mG:evIMnse2>9Moi7x=');
define('SECURE_AUTH_KEY',  '.S!DLReU{H9v*`&06VM<}GF(A[=&(j,B.`JGMh$gZaM!GN6]h4j &v3JUj/b[lj{');
define('LOGGED_IN_KEY',    'QG&2?&m9= _izDx$7@>-_!^a`DN9{#9T.N]FS?ba6W}/O57<nxmHJ3FIL/VEPHx{');
define('NONCE_KEY',        'h%vuNo90 54=s,Q[K5iNL@2&]c$B?b<f:fx7 50rN2jjVV`1!5]N2uxmd|>;7dt{');
define('AUTH_SALT',        '!+f|;/yHn]J4.;S1*>}|7=nk-X=;GrYj]L)xSw6d6::qTq?8ylwuLS~u$,r[j|4&');
define('SECURE_AUTH_SALT', '24gnoN*s$)YDD)75QLP)tT%|$j k|sT:RahL7F@LnU3OE]OQ(R^o(Y&T$6:#/2a}');
define('LOGGED_IN_SALT',   '~M>*(O{P<MW8YD% 6h;s,H??t#(l8l{&`&_YKJ#Q]RFrX%;@2 (>+vW!.V$2B`iq');
define('NONCE_SALT',       'xL.iJ6-FA9Xp>1If./&Gdxcb Ep!SMcN~13/rfj^P6#IK;H|1-$wj4/O6NL&`H9^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
