<?php
// function to create the DB / Options / Defaults					
function ss_options_install() {

    $table_name = $wpdb->prefix . "cute_testimonials";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(100) CHARACTER SET utf8 NOT NULL,
            `image` varchar(50) CHARACTER SET utf8 NOT NULL,
            `notes` varchar(500) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'ss_options_install');

//menu items
add_action('admin_menu','cute_testimonials_modifymenu');
function cute_testimonials_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Testimonials', //page title
	'Cute Testimonials', //menu title
	'manage_options', //capabilities
	'cute_testimonials_list', //menu slug
	'cute_testimonials_list' //function
	);
	
	//this is a submenu
	add_submenu_page('cute_testimonials_list', //parent slug
	'Add New Testimonial', //page title
	'Add New', //menu title
	'manage_options', //capability
	'cute_testimonials_create', //menu slug
	'cute_testimonials_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Testimonial', //page title
	'Update', //menu title
	'manage_options', //capability
	'cute_testimonials_update', //menu slug
	'cute_testimonials_update'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'testimonials-list.php');
require_once(ROOTDIR . 'testimonials-create.php');
require_once(ROOTDIR . 'testimonials-update.php');
