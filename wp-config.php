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
define('DB_NAME', 'ddp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '[c`Kv,l$QMq|4Zalvhw]?oofZbEOPx-m{{;Qd}FXSI^>.Z|![-,T,q 8 AQ-pc}(');
define('SECURE_AUTH_KEY',  'm1Snw~v)rX*dG@XK&m.eNp|,v>6.KGu*$+?+%,sLcr?jhiJfj=Pb|b$G4M<8U4am');
define('LOGGED_IN_KEY',    'as$)5uqD9tk/lg,|iKS,)<H6m[oht~cQ7l@*henW@+TO]UM3s&U)W=*-n],eGw,I');
define('NONCE_KEY',        'z;Z$}nEPl5-;h`YMt-#_+N;|R&9PbNl**RsTmy[tN2V@m+&h@VdsoYmk8=Vu$Nni');
define('AUTH_SALT',        'KOG>aqp nGN|&vf,0D&+I3O,CSgG.OKys{6@]RW$?T0vOBiQ-E!H-{{^;rrZm|!S');
define('SECURE_AUTH_SALT', 'qU4fn4Br;D*6Os+P+9]jB3}5v5J%qKfPk8lz&w4.h-=Lgs?`uIjg>Wy-3l,-yoTp');
define('LOGGED_IN_SALT',   'P2kdLqcV-]f):pJ:@tG*tI#?W#`Cr`ZHw#({H6CRR0Nb9P[iG3Ay&j,B@q-U[-7N');
define('NONCE_SALT',       'p]ZV%_kDJ6J0%@<rSAyb05GnG3SV5TO|#?Q>vls^YgCEecda-ei8c^jC-d)~S}+j');

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
