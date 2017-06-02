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
define('DB_NAME', 'u391421981_pyxaj');

/** MySQL database username */
define('DB_USER', 'u391421981_wawum');

/** MySQL database password */
define('DB_PASSWORD', 'zevuhyBasa');

/** MySQL hostname */
define('DB_HOST', 'mysql');

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
define('AUTH_KEY',         'aKTaXBGI7sIfWP09ZbezfMwXx0ofW9TQNScbjVkUIBjV2pdDuN4WIwRVFPtDq7CO');
define('SECURE_AUTH_KEY',  'Nrsduab0JstRTYZdplAyhfImsCwhApaqh4lc91Nz6QUecCd6InGh1xS1Nfl5n8U1');
define('LOGGED_IN_KEY',    'yjz3azt2LNhpISse9eUB6VWcrBQzdwgP23MuThNEYXW7ubKsDoW0t2fNdrfn67fR');
define('NONCE_KEY',        'MRzB43keER9s3sKGRTEzAYkxmDlwWHsQm2DyVsazGrdl7OVQv3bQYmwmRbO41Ek4');
define('AUTH_SALT',        'vtsWLJeoyR8O2U1rJD0Lz6OTJFSGRbB3AoPjENRnNUFx9NlPiSEWoyLmKinEhHVi');
define('SECURE_AUTH_SALT', 'fZbA5yGQ3MtKS3bFGNudkutJPqe4QPOWxTFmjdcUEVhlvTK4WNYmpZj1VQGZNAri');
define('LOGGED_IN_SALT',   'w7eTfxrAmDTZetXucStX6EgAD0ZxVMDP7zEXICSMciPMDCVD5fnMvQwgucoiEj8B');
define('NONCE_SALT',       'c6bAzqm1zXjrSbdShTZm8vwhIv6ZosAXHPO59ylCecQWl37MUuSeX5qzIUVb4BvQ');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'fwbh_';

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
