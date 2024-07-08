<?php
// admin-pages.php

// Register admin pages
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
        null,
        'Student Details',
        'Student Details',
        'manage_options',
        'tnp_student_details',
        'tnp_student_details_page'
    );
}
add_action('admin_menu', 'tnp_register_admin_pages');

// Meeting notes page callback
function tnp_meeting_notes_page() {
    echo '<h2>Meeting Notes</h2>';
    // Your form or content for meeting notes page
}

// Meeting history page callback
function tnp_meeting_history_page() {
    echo '<h2>Meeting History</h2>';
    echo do_shortcode('[tnp_meeting_history]');
}

// Student details page callback
function tnp_student_details_page() {
    global $wpdb;
    
    $student_id = intval($_GET['student_id']);
    $table_name = $wpdb->prefix . 'tnp_notes';
    $subject_table_name = $wpdb->prefix . 'tnp_subjects';
    
    $student = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $student_id));
    $subjects = $wpdb->get_results($wpdb->prepare("SELECT * FROM $subject_table_name WHERE note_id = %d", $student_id));
    
    if (!$student) {
        echo '<h2>Student Not Found</h2>';
        return;
    }
    
    echo '<h2>Student Details</h2>';
    
    // Output student details
    echo '<p>Parent Name: ' . esc_html($student->parent_name) . '</p>';
    echo '<p>Student Name: ' . esc_html($student->student_name) . '</p>';
    echo '<p>Preferred Name: ' . esc_html($student->preferred_name) . '</p>';
    echo '<p>Student Age: ' . esc_html($student->student_age) . '</p>';
    echo '<p>Student Gender: ' . esc_html($student->student_gender) . '</p>';
    echo '<p>Previous Tutoring: ' . esc_html($student->previous_tutoring) . '</p>';
    echo '<p>Contact Email: ' . esc_html($student->contact_email) . '</p>';
    echo '<p>Contact Phone: ' . esc_html($student->contact_phone) . '</p>';
    echo '<p>Address: ' . esc_html($student->address) . '</p>';
    echo '<p>Level of Education: ' . esc_html($student->level) . '</p>';
    echo '<p>School Name: ' . esc_html($student->school_name) . '</p>';
    echo '<p>Year Group: ' . esc_html($student->year_group) . '</p>';
    echo '<p>Learning Style: ' . esc_html($student->learning_style) . '</p>';
    echo '<p>Additional Support: ' . esc_html($student->additional_support) . '</p>';
    echo '<p>Preferred Schedule: ' . esc_html($student->preferred_schedule) . '</p>';
    echo '<p>Student Interests: ' . esc_html($student->student_interests) . '</p>';
    echo '<p>Extra Notes: ' . esc_html($student->extra_notes) . '</p>';
    
    // Output subjects
    echo '<h3>Subjects</h3>';
    if ($subjects) {
        echo '<ul>';
        foreach ($subjects as $subject) {
            echo '<li>';
            echo '<p>Subject: ' . esc_html($subject->subject) . '</p>';
            echo '<p>Teacher Name: ' . esc_html($subject->teacher_name) . '</p>';
            echo '<p>Current Attainment: ' . esc_html($subject->current_attainment) . '</p>';
            echo '<p>Exam Board: ' . esc_html($subject->exam_board) . '</p>';
            echo '<p>Tutoring Goals: ' . esc_html($subject->tutoring_goals) . '</p>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No subjects found for this student.</p>';
    }
}

// Shortcode for meeting history
function tnp_meeting_history_shortcode() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tnp_notes';

    $notes = $wpdb->get_results("SELECT * FROM $table_name");

    ob_start();
    ?>
    <h1>Meeting History</h1>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Parent Name</th>
                <th>Inducted</th>
                <th>Processed</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $note): ?>
                <tr>
                    <td><a href="<?php echo esc_url(admin_url('admin.php?page=tnp_student_details&student_id=' . $note->id)); ?>"><?php echo esc_html($note->student_name); ?></a></td>
                    <td><?php echo esc_html($note->parent_name); ?></td>
                    <td><input type="checkbox" class="inducted-checkbox" data-id="<?php echo esc_attr($note->id); ?>" <?php checked($note->inducted, 1); ?>></td>
                    <td><input type="checkbox" class="processed-checkbox" data-id="<?php echo esc_attr($note->id); ?>" <?php checked($note->processed, 1); ?>></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.inducted-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var noteId = this.dataset.id;
                    var inducted = this.checked ? 1 : 0;
                    updateNoteField(noteId, 'inducted', inducted);
                });
            });

            document.querySelectorAll('.processed-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var noteId = this.dataset.id;
                    var processed = this.checked ? 1 : 0;
                    updateNoteField(noteId, 'processed', processed);
                });
            });
        });

        function updateNoteField(noteId, field, value) {
            var data = {
                'action': 'update_note_field',
                'note_id': noteId,
                'field': field,
                'value': value,
            };

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: new URLSearchParams(data),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Field updated successfully.');
                } else {
                    console.error('Error updating field.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('tnp_meeting_history', 'tnp_meeting_history_shortcode');


// AJAX handler to update checkbox status
add_action('wp_ajax_update_checkbox_status', 'tnp_update_checkbox_status');
function tnp_update_checkbox_status() {
    check_ajax_referer('update-checkbox-status', 'security');
    
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Permission denied');
    }
    
    $studentId = intval($_POST['student_id']);
    $checkboxType = sanitize_text_field($_POST['checkbox_type']);
    $isChecked = intval($_POST['checked']);
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'tnp_notes';
    $result = $wpdb->update(
        $table_name,
        array($checkboxType => $isChecked),
        array('id' => $studentId),
        array('%d'),
        array('%d')
    );
    
    if ($result !== false) {
        wp_send_json_success('Checkbox updated successfully');
    } else {
        wp_send_json_error('Error updating checkbox');
    }
}
