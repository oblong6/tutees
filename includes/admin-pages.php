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
    // Code to display meeting notes form or data
    echo '<h1>Meeting Notes</h1>';
    // You can include a form here to add new notes manually if needed
}

function tnp_meeting_history_page() {
    global $wpdb;
    $notes = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tnp_notes");

    echo '<h1>Meeting History</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>ID</th><th>Parent Name</th><th>Student Name</th><th>Inducted</th><th>Processed</th></tr></thead>';
    echo '<tbody>';

    foreach ($notes as $note) {
        echo '<tr>';
        echo '<td>' . esc_html($note->id) . '</td>';
        echo '<td>' . esc_html($note->parent_name) . '</td>';
        echo '<td>' . esc_html($note->student_name) . '</td>';
        echo '<td><input type="checkbox" ' . checked($note->inducted, 1, false) . ' disabled></td>';
        echo '<td><input type="checkbox" ' . checked($note->processed, 1, false) . ' disabled></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}
?>
