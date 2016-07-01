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

<!--            <tr valign="top">-->
<!--                <th scope="row">Clubnaam (volgens KNVB-site)</th>-->
<!--                <td>-->
<!--                    <input type="text" name="knvb_api_clubname" value="--><?php //echo esc_attr(get_option('knvb_api_clubname')); ?><!--" />-->
<!--                </td>-->
<!--            </tr>-->
        </table>

        <?php submit_button(); ?>
    </form>

    <h1>Short codes</h1>
        <table style="width:100%">
            <tr>
                <td>Team</td>
                <td>Stand van een team</td>
            </tr>
            <?php foreach($teams as $team): ?>
                <tr>
                    <td><?php echo $team->getName(); ?></td>
                    <td>[knvb-ranking id="<?php echo $team->teamid ?>" showLogo="yes"]</td>
                </tr>
            <?php endforeach; ?>
        </table>
</div>