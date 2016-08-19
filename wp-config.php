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
define('DB_NAME', 'hostbybest');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '!bS4O}ezM w0L5 n&K$=Lscm;#<DlGz4,sJc6xM3))Z2A9_m!_ vVRR2k,Yb{H[L');
define('SECURE_AUTH_KEY',  '@19-}Q@`NBv,PsL{!KP?XZlAgpT!`_#^e-h-#XfDlqrD)W^~4OQIYF}RcW]9N_LU');
define('LOGGED_IN_KEY',    '>9cM_VcwX/U2H_ x:s=X&J$=YLg8dUI9ND|7?`~b%^(7`0k<54<P;f<mOA)?wRc$');
define('NONCE_KEY',        '9d3GX=9+9C%6<gO 0W-H.(oz.|!B~EFGq#`R3Q^!~wT5lWzBK5`h,?,RWMFx:`~[');
define('AUTH_SALT',        '*bS>ET+mm!}uak+G/SNQ1PJGV-k7id6x=JA{FqBz9<]/!SxU!`JUaW?1r`B/9^$1');
define('SECURE_AUTH_SALT', '.iY[[pN[U@uPk#|N[S8[W;dJe]GzC/FSAEYg_0SbXZC+aoWB+vcv_En34}e!9x=q');
define('LOGGED_IN_SALT',   '+U[+>r@!$*K.Rikw0Np0H/~,_VJd#3+%&*^<^f<[CQ0b_ BwvrTvTnf(QiKkY2f2');
define('NONCE_SALT',       '[wU#GHWEbOq-j{KNY3EkuovA4oDGr1^iCga(RbWIT5!6]@nQh*E,#A{P[Fj1`m*.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_hostbybe';

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
