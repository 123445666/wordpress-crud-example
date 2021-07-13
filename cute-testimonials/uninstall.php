<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit();
global $wpdb;
$table_name = $wpdb->prefix . "cute_testimonials";
$wpdb->query("DROP TABLE IF EXISTS " . $table_name);
delete_option("my_plugin_db_version");
