<?php

function cute_testimonials_update()
{
  global $wpdb;
  $table_name = $wpdb->prefix . "cute_testimonials_v2";
  $id = $_GET["id"];
  $name = $_POST["name"];
  $image = $_POST["attachment_id"];
  $notes = $_POST["notes"];
  //update
  if (isset($_POST['update'])) {
    $wpdb->update(
      $table_name, //table
      array('name' => $name, 'image' => $image, 'notes' => $notes), //data
      array('ID' => $id), //where
      array('%s'), //data format
      array('%s') //where format
    );
  }
  //delete
  else if (isset($_POST['delete'])) {
    $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
  } else { //selecting value to update	
    $testimonial = $wpdb->get_results($wpdb->prepare("SELECT id,name,image,notes from $table_name where id=%s", $id));
    foreach ($testimonial as $t) {
      $name = $t->name;
      $image = $t->image;
      $notes = $t->notes;
    }
  }
?>
  <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/cute-testimonials/style-admin.css" rel="stylesheet" />
  <div class="wrap">
    <h2>Testimonials</h2>

    <?php if ($_POST['delete']) { ?>
      <div class="updated">
        <p>Testimonial deleted</p>
      </div>
      <a href="<?php echo admin_url('admin.php?page=cute_testimonials_list') ?>">&laquo; Back to Testimonials list</a>

    <?php } else if ($_POST['update']) { ?>
      <div class="updated">
        <p>Testimonial updated</p>
      </div>
      <a href="<?php echo admin_url('admin.php?page=cute_testimonials_list') ?>">&laquo; Back to Testimonials list</a>

    <?php } else { ?>
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <table class='wp-list-table widefat fixed'>
          <tr>
            <th>Name</th>
            <td><input type="text" name="name" value="<?php echo $name; ?>" /></td>
          </tr>
          <tr>
            <th>Image</th>
            <td>
              <input type="button" value="Upload Image" class="button-primary" id="upload_image" />
              <input type="hidden" name="attachment_id" class="wp_attachment_id" value="<?php echo $image; ?>" /> </br>
              <img src="<?php echo wp_get_attachment_url($image) ?>" class="image" style="margin-top:10px;width:200px;" />
            </td>
          </tr>
          <tr>
            <th>Review</th>
            <td><textarea rows="4" cols="100" name="notes"><?php echo $notes; ?></textarea></td>
          </tr>
        </table>
        <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
        <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure?')">
      </form>
    <?php } ?>

  </div>
<?php
}
