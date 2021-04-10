<?php

class WP_Sync_User_From_SameDB_Sync extends WP_Sync_User_From_SameDB
{
    public function sync()
    {
        add_action('wp_logout', [$this, 'wp_logout'], 10, 2);
        add_action('wp_login', [$this, 'wp_login'], 10, 2);
        $this->force();
    }

    public function force()
    {
        $user_key = parent::get_user_key();
        $currend_user_id = get_current_user_id();
        $user_meta = get_user_meta($currend_user_id, parent::$authkey_name, true);
        $match_user_id = false;

        if (!is_user_logged_in()) {
            // 非ログイン状態
            global $wpdb;
            $query = 'SELECT * FROM ' . $wpdb->usermeta . ' WHERE meta_key LIKE %s';

            $result = $wpdb->get_results($wpdb->prepare($query, '%' . $wpdb->esc_like(parent::$authkey_name) . '%'));

            if (is_array($result) && 0 < count($result)) {
                foreach ($result as $value) {
                    if (is_object($value)) {
                        if ($value->meta_value === $user_key) {
                            $match_user_id = $value->user_id;
                        }
                    }
                }
            }
            $this->force_login($match_user_id);
        } else {
            // ログイン状態
            if ($user_meta && $user_key !== $user_meta) {
                add_action('shutdown', [$this, 'force_logout']);
            }
        }
    }

    public function wp_logout()
    {
        if (parent::get_user_key()) {
            $db = parent::get_db();
            if (is_object($db)) {
                $table_id = $db->id;
                global $wpdb;
                $wpdb->update(parent::$table_name, [parent::$authkey_name => ''], ['ID' => $table_id]);
            }
        }
    }

    public function wp_login($login_user)
    {
        $user_key = parent::get_user_key();
        if (!$user_key) {
            $db = parent::get_db();
            if (is_object($db)) {
                $table_id = $db->id;
                $user = get_user_by('login', $login_user);
                $user_id = $user->ID;
                $user_meta = get_user_meta($user_id, parent::$authkey_name, true);

                if ($user_meta) {
                    global $wpdb;
                    $wpdb->update(parent::$table_name, [parent::$authkey_name => $user_meta], ['ID' => $table_id]);
                }
            }
        }
    }

    public function force_logout()
    {
        $user_id = get_current_user_id();
        wp_clear_auth_cookie();
        delete_user_meta($user_id, 'session_tokens');
    }

    private function force_login($user_id)
    {
        if (!is_user_logged_in()) {
            wp_clear_auth_cookie();
            wp_set_auth_cookie($user_id);
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
        }
    }
}
