<?php
function tnp_introductory_form_shortcode() {
    ob_start();
    ?>
    <form id="introductory-form">
        <!-- Your form fields here -->
        <button type="submit">Submit Notes</button>
    </form>
    <script>
        document.getElementById('introductory-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            formData.append('action', 'tnp_save_form_data'); // This specifies the action to be taken by WordPress

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Form submitted successfully.');
                } else {
                    alert('There was an error submitting the form.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    <?php
    return ob_get_clean();
}

add_action('wp_ajax_tnp_save_form_data', 'tnp_save_form_data');
add_action('wp_ajax_nopriv_tnp_save_form_data', 'tnp_save_form_data');

function tnp_save_form_data() {
    global $wpdb;

    // Validate and sanitize form data here

    $wpdb->insert(
        $wpdb->prefix . 'tnp_notes',
        array(
            'parent_name' => sanitize_text_field($_POST['parent-name']),
            'student_name' => sanitize_text_field($_POST['student-name']),
            'preferred_name' => sanitize_text_field($_POST['preferred-name']),
            'student_age' => intval($_POST['student-age']),
            'student_gender' => sanitize_text_field($_POST['student-gender']),
            'previous_tutoring' => sanitize_text_field($_POST['previous-tutoring']),
            'contact_email' => sanitize_email($_POST['contact-email']),
            'contact_phone' => sanitize_text_field($_POST['contact-phone']),
            'address' => sanitize_textarea_field($_POST['address']),
            'level' => sanitize_text_field($_POST['level']),
            'school_name' => sanitize_text_field($_POST['school-name']),
            'year_group' => sanitize_text_field($_POST['year-group']),
            'learning_style' => sanitize_textarea_field($_POST['learning-style']),
            'additional_support' => sanitize_textarea_field($_POST['additional-support']),
            'preferred_schedule' => sanitize_textarea_field($_POST['preferred-schedule']),
            'student_interests' => sanitize_textarea_field($_POST['student-interests']),
            'extra_notes' => sanitize_textarea_field($_POST['extra-notes']),
            'inducted' => 0,
            'processed' => 0
        )
    );

    $note_id = $wpdb->insert_id;

    foreach ($_POST['subject'] as $index => $subject) {
        $wpdb->insert(
            $wpdb->prefix . 'tnp_subjects',
            array(
                'note_id' => $note_id,
                'subject' => sanitize_text_field($subject),
                'teacher_name' => sanitize_text_field($_POST['teacher-name'][$index]),
                'current_attainment' => sanitize_textarea_field($_POST['current-attainment'][$index]),
                'exam_board' => sanitize_text_field($_POST['exam-board'][$index]),
                'tutoring_goals' => sanitize_textarea_field($_POST['tutoring-goals'][$index])
            )
        );
    }

    wp_send_json_success();
}
?>
