<?php

class WP_Sync_User_From_SameDB_User_Setting extends WP_Sync_User_From_SameDB
{
    public function init()
    {
        add_action('show_user_profile', [$this, 'generate_user_metabox']);
        add_action('edit_user_profile', [$this, 'generate_user_metabox']);
        add_action('personal_options_update', [$this, 'save_user_metabox']);
        add_action('edit_user_profile_update', [$this, 'save_user_metabox']);
    }


    public function generate_user_metabox($user)
    {
        ?>
        <h3><?php _e("WP Sync User From Authentication Key", "blank"); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="<?= parent::$authkey_name ?>"><?php _e("Authentication Key"); ?></label></th>
                <td>
                    <input type="text" name="<?= parent::$authkey_name ?>" id="<?= parent::$authkey_name ?>"
                           value="<?= esc_attr(get_the_author_meta(parent::$authkey_name, $user->ID)); ?>"
                           class="regular-text"/><br/>
                    <span class="description"><?php _e("Please enter authentication key."); ?></span>
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_user_metabox($user_id)
    {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }
        if (isset($_POST[parent::$authkey_name])) {
            $key = htmlspecialchars($_POST[parent::$authkey_name]);
            update_user_meta($user_id, parent::$authkey_name, $key);

            $db = parent::get_db();
            if (is_object($db) && get_current_user_id() === $user_id) {
                $table_id = $db->id;
                global $wpdb;
                $wpdb->update(parent::$table_name, [parent::$authkey_name => $key], ['ID' => $table_id]);
            }
        }
    }
}
