<?php
/**
 * @package WP Sync User From Same Database
 */

/*
Plugin Name: WP Sync User From Same Database
Plugin URI:
Description: user sync system from same database.
Version: 0.0.1
Author: hltree
Author URI: https://hltree.tech/
License: GPLv2 or later
Text Domain: wp-sync-user-from-same-db
*/

define('WP_Sync_User_From_SameDB__PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once(WP_Sync_User_From_SameDB__PLUGIN_DIR . 'class-wp-sync-user-from-same-db.php');
$wsufs = new WP_Sync_User_From_SameDB();
register_activation_hook(__FILE__, [$wsufs, 'plugin_activation']);
