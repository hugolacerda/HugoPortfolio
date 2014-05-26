<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'ML7Gf0lP~|3|qRTQi;M$K4j# s!3>?69P,l0-.ehBW9l#K#Vn:p:/pi7{.F^:rrb');
define('SECURE_AUTH_KEY',  'ot$hs3_IS1Jzz;98#Gw*gbFg?q)9,Z )W@]>!Y-[]1*=CtITu` +cAYrF51c[f^[');
define('LOGGED_IN_KEY',    'vRa2xI~xR*+1PK&+>7^)M{$EBaH dj@+L(AhrQ-eKTaO&l:*7I=[hWg$hLqWU i~');
define('NONCE_KEY',        ',`|g,:gYDVbSXm*KzVmf:RSF@u-42s%J_e=JkJ&u-acw-W&]DNh/&pden;y-_X<|');
define('AUTH_SALT',        'gT&6~aI]e1o&WOEY^>H7jtz__#/vp1I3+yK_W5f[Vlp`CIs-^wjGahcAu%8sJ-LG');
define('SECURE_AUTH_SALT', 'H4X?v[qjVM)I&Zq|{:j~Th,Jl2^r*W[8mRkSdi2f}]3BmOC~Bbm:wbv]J=#O#gz*');
define('LOGGED_IN_SALT',   'MOGmcWVx>4_sgl}nslrNV?b^zSW_|zn]XNUiD0Jm-A)f&R+z8m-+3A<6F|g%Z;Xg');
define('NONCE_SALT',       '`s-E|cyxSO+:!yFOsC1pR$Ei j[>1z_kV9,-BRl67%uxM*^[Rw!!A/#2P#hG(+tE');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
