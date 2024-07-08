<?php
function tnp_register_admin_pages() {
    add_menu_page(
        'Meeting Notes',
        'Meeting Notes',
        'manage_options',
        'tnp_meeting_notes',
        'tnp_meeting_notes_page',
        'dashicons-welcome-learn-more',
        6
    );

    add_submenu_page(
        'tnp_meeting_notes',
        'Meeting History',
        'Meeting History',
        'manage_options',
        'tnp_meeting_history',
        'tnp_meeting_history_page'
    );
}

add_action('admin_menu', 'tnp_register_admin_pages');

function tnp_meeting_notes_page() {
    echo '<h1>Meeting Notes</h1>';
}

function tnp_meeting_history_page() {
    echo do_shortcode('[tnp_meeting_history]');
}

function tnp_meeting_history_shortcode() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tnp_notes';

    $notes = $wpdb->get_results("SELECT * FROM $table_name");

    ob_start();
    echo '<h1>Meeting History</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>Student Name</th><th>Parent Name</th><th>Inducted</th><th>Processed</th></tr></thead>';
    echo '<tbody>';

    foreach ($notes as $note) {
        $student_url = admin_url('admin.php?page=tnp_student_details&student_id=' . $note->id);
        echo '<tr>';
        echo '<td><a href="' . esc_url($student_url) . '">' . esc_html($note->student_name) . '</a></td>';
        echo '<td>' . esc_html($note->parent_name) . '</td>';
        echo '<td><input type="checkbox" ' . checked($note->inducted, 1, false) . ' disabled></td>';
        echo '<td><input type="checkbox" ' . checked($note->processed, 1, false) . ' disabled></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

    return ob_get_clean();
}

add_shortcode('tnp_meeting_history', 'tnp_meeting_history_shortcode');
?>
