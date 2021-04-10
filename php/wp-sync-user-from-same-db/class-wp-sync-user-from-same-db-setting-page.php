<?php

class WP_Sync_User_From_SameDB_Setting_Page extends WP_Sync_User_From_SameDB
{
    public function init()
    {
        add_action('admin_menu', [$this, 'register_plugin_page']);
    }

    public function register_plugin_page()
    {
        add_menu_page('WP Sync User From Authentication Key', 'WP Sync User', 'manage_options', 'wp-sync-user-from-authkey', [$this, 'plugin_page_html'], 'dashicons-update-alt', 999);
    }

    public function plugin_page_html()
    {
        ?>
        <div class="wrap">
            <h2><?php _e("WP Sync User From Authentication Key", "blank"); ?></h2>
            <?php $this->update_plugin_key(); ?>
            <form action="<?php the_permalink(); ?>" method="post">
                <?php wp_nonce_field('update_plugin_key', 'update_plugin_key_nonce_field'); ?>
                <table class="form-table">
                    <tr>
                        <th><label for="<?= parent::$plugin_key_name ?>"><?php _e("Plugin Key"); ?></label></th>
                        <td>
                            <input type="text" name="<?= parent::$plugin_key_name ?>" id="<?= parent::$plugin_key_name ?>"
                                   value="<?= parent::get_plugin_key() ?>"
                                   class="regular-text"/><br/>
                            <span class="description"><?php _e("if you wanna change plugin key."); ?></span>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function update_plugin_key()
    {
        if (isset($_POST['update_plugin_key_nonce_field'])) {
            if (wp_verify_nonce($_POST['update_plugin_key_nonce_field'], 'update_plugin_key')
                && isset($_POST[parent::$plugin_key_name])
                && false != $trim = str_replace(array(" ", "　"), "", $_POST[parent::$plugin_key_name])) {
                $db = parent::get_db();
                if (is_object($db)) {
                    $table_id = $db->id;
                    $plugin_key_value = htmlspecialchars($trim);
                    global $wpdb;
                    $wpdb->update(parent::$table_name, [parent::$plugin_key_name => $plugin_key_value], ['ID' => $table_id]);
                }
                ?>
                <p style="color: red;">Update.</p>
                <?php
            } else {
                ?>
                <p style="color: red;">Sorry, your nonce did not verify.</p>
                <?php
            }
        }
    }
}
