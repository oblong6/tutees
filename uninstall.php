<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;

$table_name = $wpdb->prefix . 'tnp_notes';
$subject_table_name = $wpdb->prefix . 'tnp_subjects';

$wpdb->query("DROP TABLE IF EXISTS $subject_table_name");
$wpdb->query("DROP TABLE IF EXISTS $table_name");
?>
