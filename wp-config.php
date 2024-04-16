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
define( 'DB_NAME', 'SBB-Dev' );
/** MySQL database username */
define( 'DB_USER', 'root' );
/** MySQL database password */
define( 'DB_PASSWORD', 'Sbb_2024_Ind' );
/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication Unique Key: and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'w6xTF?3kVpx*3SFlBVW<SIhT[6!80@|-nZT8J/fb=h9zS>{e&lBabXlJxD?H>dZ ' );
define( 'SECURE_AUTH_KEY',  '>*R|pafx]9%|@kw1Wdedk]%:Ydzf$H;}bRuw%o`Am7-vu(KO#/3~x*l[iWok%Cno' );
define( 'LOGGED_IN_KEY',    '%`BavGP7IQG|iQdzo?Y>l-{jN|7(/#.|kGkLZ62G%@rTr[e:YbA6S,Rv6z[-EDV4' );
define( 'NONCE_KEY',        '[JM+Zv!&:4@IIo|C]wQC!dmG;pwg4[$lJ5}w[ScDj)@ nzOoIes0DeX$!iQJ(nd*' );
define( 'AUTH_SALT',        'Dp[I8C5XjV;;@d7H`t$s8e!:levFb!mQ|[Ku,=)7#Wy}GO%G;brW0E%?Aj!%5H09' );
define( 'SECURE_AUTH_SALT', 'sn3c1>`VveHj97bLST3^P+;0R7tqM$L{.#s[K#g$L~>({KNS7p6dN3@ofst!IeR/' );
define( 'LOGGED_IN_SALT',   'QUDe=3go(6hpc~lXkFdGl:i$l}s+ls?bF~scF5y%-/y.+-K3f5B2{E&ozEOfO~So' );
define( 'NONCE_SALT',       ' h?4s`e];LZKPtM{fKJcLC:E .5 aQU>NwuMI:5^v*{?B4bvG&x)Pp-Qg%uTbzz7' );
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

ini_set('log_errors','On'); 

ini_set('display_errors','Off'); 

ini_set('error_reporting', E_ALL ); 

define('WP_DEBUG', false);   //This line may exist in wp-config already if so comment this line or remove 

define('WP_DEBUG_LOG', true); 

define('WP_DEBUG_DISPLAY', false); 





