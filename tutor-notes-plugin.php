<?php
/**
 * Plugin Name: Tutor Notes Plugin
 * Description: A plugin to store and display introductory session notes for tutees.
 * Version: 1.3
 * Author: Liam Jordan - www.liamjordan.co.uk
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Function to create the database tables
function tnp_create_tables() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'tnp_notes';
    $subject_table_name = $wpdb->prefix . 'tnp_subjects';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        parent_name VARCHAR(255) NOT NULL,
        student_name VARCHAR(255) NOT NULL,
        preferred_name VARCHAR(255),
        student_age INT NOT NULL,
        student_gender VARCHAR(50),
        previous_tutoring VARCHAR(10),
        contact_email VARCHAR(255) NOT NULL,
        contact_phone VARCHAR(20) NOT NULL,
        address TEXT NOT NULL,
        level VARCHAR(50) NOT NULL,
        school_name VARCHAR(255) NOT NULL,
        year_group VARCHAR(50) NOT NULL,
        learning_style TEXT,
        additional_support TEXT,
        preferred_schedule TEXT,
        student_interests TEXT,
        extra_notes TEXT,
        inducted TINYINT(1) DEFAULT 0,
        processed TINYINT(1) DEFAULT 0,
        PRIMARY KEY  (id)
    ) $charset_collate;

    CREATE TABLE IF NOT EXISTS $subject_table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        note_id mediumint(9) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        teacher_name VARCHAR(255),
        current_attainment TEXT,
        exam_board VARCHAR(255),
        tutoring_goals TEXT,
        PRIMARY KEY  (id),
        FOREIGN KEY (note_id) REFERENCES $table_name(id) ON DELETE CASCADE
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Hook the function to plugin activation
register_activation_hook(__FILE__, 'tnp_create_tables');

// Include the necessary files.
include_once plugin_dir_path(__FILE__) . 'includes/form-handler.php';
include_once plugin_dir_path(__FILE__) . 'includes/admin-pages.php';

// Shortcodes for forms and history page.
add_shortcode('tnp_introductory_form', 'tnp_introductory_form_shortcode');
add_shortcode('tnp_meeting_history', 'tnp_meeting_history_shortcode');
?>
