<?php

function cute_testimonials_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/cute-testimonials/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Testimonials</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=cute_testimonials_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "cute_testimonials_v2";

        $rows = $wpdb->get_results("SELECT id,name,image,notes from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Name</th>
                <th class="manage-column ss-list-width">Image</th>
                <th class="manage-column ss-list-width">Review</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo stripslashes($row->name); ?></td>
                    <td class="manage-column ss-list-width"><img src="<?php echo wp_get_attachment_url($row->image) ?>" class="image" style="margin-top:10px;width:200px;" /></td>
                    <td class="manage-column ss-list-width"><?php echo stripslashes($row->notes); ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=cute_testimonials_update&id=' . $row->id); ?>">Edit</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}
