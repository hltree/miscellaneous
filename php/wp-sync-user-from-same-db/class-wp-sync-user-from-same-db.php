<?php

class WP_Sync_User_From_SameDB
{
    private static $inited = false;
    private $version = '0.0.1';
    protected static $plugin_prefix = 'wsufsb_';
    protected static $table_name = 'wsufsb_core';
    protected static $plugin_key_name = 'plugin_key';
    protected static $authkey_name = 'active_user_key';

    public function __construct()
    {
        if (!self::$inited) {
            add_action('init', [$this, 'init']);
        }
    }

    public function plugin_activation()
    {
        $this->create_db();
    }

    public function get_db()
    {
        global $wpdb;
        $query = 'SELECT * FROM `' . self::$table_name . '`';
        $result = $wpdb->get_results($wpdb->prepare($query));

        if (is_array($result) && 0 < count($result)) {
            $result = $result[0];
        } else {
            $result = null;
        }

        return $result;
    }


    public function get_plugin_key()
    {
        $db = $this->get_db();
        $result = is_object($db) ? $db->plugin_key : null;

        return $result;
    }

    public function get_user_key()
    {
        $db = $this->get_db();
        $result = is_object($db) ? $db->active_user_key : null;

        return $result;
    }

    public function init()
    {
        require_once(WP_Sync_User_From_SameDB__PLUGIN_DIR . 'class-wp-sync-user-from-same-db-setting-page.php');
        require_once(WP_Sync_User_From_SameDB__PLUGIN_DIR . 'class-wp-sync-user-from-same-db-user-setting.php');
        require_once(WP_Sync_User_From_SameDB__PLUGIN_DIR . 'class-wp-sync-user-from-same-db-sync.php');
        $setting_page_class = new WP_Sync_User_From_SameDB_Setting_Page();
        $user_setting_class = new WP_Sync_User_From_SameDB_User_Setting();
        $sync = new WP_Sync_User_From_SameDB_Sync();

        $user_setting_class->init();
        $setting_page_class->init();
        $sync->sync();

        self::$inited = true;
    }

    private function create_db()
    {
        global $wpdb;

        $is_db_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", self::$table_name));

        if (!$is_db_exists) {

            $charset_collate = $wpdb->get_charset_collate();
            $table_name = self::$table_name;

            $sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  active_user_key text NOT NULL,
  plugin_key text NOT NULL,
  UNIQUE KEY id (id)
) $charset_collate;";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);

            $key = substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, 32);
            $wpdb->insert(
                $table_name,
                [
                    self::$plugin_key_name => $key,
                    self::$authkey_name => ''
                ]
            );
        }
    }
}
