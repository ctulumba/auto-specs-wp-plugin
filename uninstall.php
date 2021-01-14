<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

if (get_option("remove_data_uninstall") == "on") {
	global $wpdb;
	$table = $wpdb->prefix."autospecs_table";
	$table3 = $wpdb->prefix."autospecs_performance_table";
	$table2 = $wpdb->prefix."autospecs_shortcodes";
	$sql = "DROP TABLE IF EXISTS $table;";
	$wpdb->query($sql);
	$sql = "DROP TABLE IF EXISTS $table2;";
	$wpdb->query($sql);
	$sql = "DROP TABLE IF EXISTS $table3;";
	$wpdb->query($sql);
}