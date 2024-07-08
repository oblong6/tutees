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

    add_submenu_page(
        null, // This makes the page a hidden submenu
        'Student Details',
        'Student Details',
        'manage_options',
        'tnp_student_details',
        'tnp_student_details_page'
    );
}

add_action('admin_menu', 'tnp_register_admin_pages');

function tnp_meeting_notes_page() {
    echo '<h1>Meeting Notes</h1>';
}

function tnp_meeting_history_page() {
    echo do_shortcode('[tnp_meeting_history]');
}

function tnp_student_details_page() {
    global $wpdb;
    $student_id = intval($_GET['student_id']);
    $table_name = $wpdb->prefix . 'tnp_notes';
    $subject_table_name = $wpdb->prefix . 'tnp_subjects';

    $student = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $student_id));
    $subjects = $wpdb->get_results($wpdb->prepare("SELECT * FROM $subject_table_name WHERE note_id = %d", $student_id));

    if (!$student) {
        echo '<h1>Student Not Found</h1>';
        return;
    }

    echo '<h1>Student Details</h1>';
    echo '<p><strong>Parent Name:</strong> ' . esc_html($student->parent_name) . '</p>';
    echo '<p><strong>Student Name:</strong> ' . esc_html($student->student_name) . '</p>';
    echo '<p><strong>Preferred Name:</strong> ' . esc_html($student->preferred_name) . '</p>';
    echo '<p><strong>Student Age:</strong> ' . esc_html($student->student_age) . '</p>';
    echo '<p><strong>Student Gender:</strong> ' . esc_html($student->student_gender) . '</p>';
    echo '<p><strong>Previous Tutoring:</strong> ' . esc_html($student->previous_tutoring) . '</p>';
    echo '<p><strong>Contact Email:</strong> ' . esc_html($student->contact_email) . '</p>';
    echo '<p><strong>Contact Phone:</strong> ' . esc_html($student->contact_phone) . '</p>';
    echo '<p><strong>Address:</strong> ' . esc_html($student->address) . '</p>';
    echo '<p><strong>Level of Education:</strong> ' . esc_html($student->level) . '</p>';
    echo '<p><strong>School Name:</strong> ' . esc_html($student->school_name) . '</p>';
    echo '<p><strong>Year Group:</strong> ' . esc_html($student->year_group) . '</p>';
    echo '<p><strong>Learning Style:</strong> ' . esc_html($student->learning_style) . '</p>';
    echo '<p><strong>Additional Support:</strong> ' . esc_html($student->additional_support) . '</p>';
    echo '<p><strong>Preferred Schedule:</strong> ' . esc_html($student->preferred_schedule) . '</p>';
    echo '<p><strong>Student Interests:</strong> ' . esc_html($student->student_interests) . '</p>';
    echo '<p><strong>Extra Notes:</strong> ' . esc_html($student->extra_notes) . '</p>';
    echo '<h2>Subjects</h2>';

    if ($subjects) {
        echo '<ul>';
        foreach ($subjects as $subject) {
            echo '<li><strong>Subject:</strong> ' . esc_html($subject->subject) . '<br>';
            echo '<strong>Teacher Name:</strong> ' . esc_html($subject->teacher_name) . '<br>';
            echo '<strong>Current Attainment:</strong> ' . esc_html($subject->current_attainment) . '<br>';
            echo '<strong>Exam Board:</strong> ' . esc_html($subject->exam_board) . '<br>';
            echo '<strong>Tutoring Goals:</strong> ' . esc_html($subject->tutoring_goals) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No subjects found for this student.</p>';
    }
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
