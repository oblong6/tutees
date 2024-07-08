<?php
/**
 * Plugin Name: Tutor Notes Plugin
 * Description: A plugin to store and display introductory session notes for tutees.
 * Version: 1.5
 * Author: Liam Jordan - www.liamjordan.co.uk
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function tnp_create_tables() {
    global $wpdb;

    try {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $table_name = $wpdb->prefix . 'tnp_notes';
        $subject_table_name = $wpdb->prefix . 'tnp_subjects';

        $sql_notes = "CREATE TABLE IF NOT EXISTS $table_name (
            id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
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
            PRIMARY KEY (id)
        )";

        $sql_subjects = "CREATE TABLE IF NOT EXISTS $subject_table_name (
            id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
            note_id MEDIUMINT(9) NOT NULL,
            subject VARCHAR(255) NOT NULL,
            teacher_name VARCHAR(255),
            current_attainment TEXT,
            exam_board VARCHAR(255),
            tutoring_goals TEXT,
            PRIMARY KEY (id),
            FOREIGN KEY (note_id) REFERENCES $table_name(id) ON DELETE CASCADE
        )";

        $pdo->exec($sql_notes);
        $pdo->exec($sql_subjects);

    } catch (PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
    }
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
