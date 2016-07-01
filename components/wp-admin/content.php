<div class="wrap">
    <h1>KNVB</h1>

    <form method="post" action="options.php">
        <?php settings_fields('knvb-api-settings-group'); ?>
        <?php do_settings_sections('knvb-api-settings-group'); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row">API key</th>
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

        </table>

        <?php submit_button(); ?>
    </form>

    <h1>Short codes</h1>
        <table style="width:100%">
            <tr>
                <td>Team</td>
                <?php foreach($codes as $code): ?>
                    <td><?php echo $code['description']; ?></td>
                <?php endforeach; ?>
            </tr>
            <?php foreach($teams as $team): ?>
                <tr>
                    <td><?php echo $team->getName(); ?></td>
                    <?php foreach($codes as $name => $code): ?>
                        <td>
                            [knvb name="<?php echo $name ?>"
                            <?php foreach($code['parameters'] as $key => $defaultValue): ?>
                                <?php echo $key; ?>="<?php echo $key == 'team-id' ? $team->teamid : $defaultValue; ?>"
                            <?php endforeach; ?>
                            ]
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
</div>