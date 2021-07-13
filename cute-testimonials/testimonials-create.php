<?php
function cute_testimonials_create()
{
  $id = $_POST["id"];
  $name = $_POST["name"];
  // $image = $_POST["image"];
  $image = $_POST["attachment_id"];
  $notes = $_POST["notes"];
  //insert

  if (isset($_POST['insert'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . "cute_testimonials";

    $wpdb->insert(
      $table_name, //table
      array('name' => $name, 'image' => $image, 'notes' => $notes), //data
      array('%s', '%s') //data format			
    );
    $message .= "Testimonial inserted";
  }

  $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
  echo $wpdb->get_var( $query );
?>
  <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/cute-testimonials/style-admin.css" rel="stylesheet" />
  <div class="wrap">
    <h2>Add New Testimonial</h2>
    <?php if (isset($message)) : ?><div class="updated">
        <p><?php echo $message; ?></p>
      </div><?php endif; ?>
    <?php if (!isset($_POST['insert'])) { ?>
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <table class='wp-list-table widefat fixed'>
          <tr>
            <th class="ss-th-width">Name</th>
            <td><input type="text" name="name" value="<?php echo $name; ?>" class="ss-field-width" /></td>
          </tr>
          <tr>
            <th class="ss-th-width">Image</th>
            <td>
              <input type="button" value="Upload Image" class="button-primary" id="upload_image" />
              <input type="<?php echo (empty($image) ? "hidden" : "text"); ?>" name="attachment_id" class="wp_attachment_id" value="<?php echo $image; ?>" /> </br>
              <img src="" class="image" style="display:none;margin-top:10px;width:200px;" />
              <!-- <input type="file" id="upload_image" name="image" value="<?php echo $image; ?>" class="ss-field-width" /> -->
            </td>
          </tr>
          <tr>
            <th class="ss-th-width">Review</th>
            <td><textarea rows="4" cols="100" name="notes" value="<?php echo $notes; ?>" class="ss-field-width"></textarea></td>
          </tr>
        </table>
        <input type='submit' name="insert" value='Save' class='button'>
      </form>
    <?php } else { ?>
      <a href="<?php echo admin_url('admin.php?page=cute_testimonials_list') ?>">&laquo; Back to Testimonials list</a>
    <?php } ?>

  </div>
<?php
}
