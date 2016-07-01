<div class="wrap">
    <h2>KNVB</h2>

    <form method="post" action="options.php">
        <?php settings_fields('knvb-api-settings-group'); ?>
        <?php do_settings_sections('knvb-api-settings-group'); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row">API sleutel</th>
                <td>
                    <input type="text" name="knvb_api_key" value="<?php echo esc_attr(get_option('knvb_api_key')); ?>" />
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Pathname</th>
                <td>
                    <input type="text" name="knvb_api_pathname" value="<?php echo esc_attr(get_option('knvb_api_pathname')); ?>" />
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Clubnaam (volgens KNVB-site)</th>
                <td>
                    <input type="text" name="knvb_api_clubname" value="<?php echo esc_attr(get_option('knvb_api_clubname')); ?>" />
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>

    <h2>Short codes</h2>
</div>