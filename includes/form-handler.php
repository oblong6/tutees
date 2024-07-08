<?php
function tnp_introductory_form_shortcode() {
    ob_start();
    ?>
    <form id="introductory-form">
        <label for="parent-name">Parent/Guardian Name:</label>
        <input type="text" id="parent-name" name="parent-name" placeholder="Enter the parent or guardian's name" required>
        
        <label for="student-name">Student Name:</label>
        <input type="text" id="student-name" name="student-name" placeholder="Enter the student's name" required>
        
        <label for="preferred-name">Preferred Name:</label>
        <input type="text" id="preferred-name" name="preferred-name" placeholder="Enter the student's preferred name">
        
        <label for="student-age">Student Age:</label>
        <input type="number" id="student-age" name="student-age" placeholder="Enter the student's age" required>
        
        <label for="student-gender">Student Gender:</label>
        <select id="student-gender" name="student-gender">
            <option value="" disabled selected>Select gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
            <option value="prefer-not-to-say">Prefer not to say</option>
        </select>

        <label for="previous-tutoring">Has the Student been Tutored before?</label>
        <select id="previous-tutoring" name="previous-tutoring">
            <option value="" disabled selected>Select History</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="other">Other (Add no notes)</option>
        </select>

        <label for="contact-email">Contact Email:</label>
        <input type="email" id="contact-email" name="contact-email" placeholder="Enter the contact email" required>

        <label for="contact-phone">Contact Phone:</label>
        <input type="tel" id="contact-phone" name="contact-phone" placeholder="Enter the contact phone number" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="3" placeholder="Enter the address" required></textarea>

        <label for="level">Level of Education:</label>
        <select id="level" name="level" required>
            <option value="" disabled selected>Select level</option>
            <option value="keystage1">Keystage 1</option>
            <option value="keystage2">Keystage 2</option>
            <option value="keystage3">Keystage 3</option>
            <option value="keystage4">Keystage 4</option>
            <option value="alevel">A Level</option>
            <option value="undergraduate">Undergraduate</option>
        </select>

        <label for="school-name">School Name:</label>
        <input type="text" id="school-name" name="school-name" placeholder="Enter the school name" required>

        <label for="year-group">Year Group:</label>
        <input type="text" id="year-group" name="year-group" placeholder="Enter the year group" required>

        <div id="subjects-container">
            <div class="subject-group">
                <label for="subject">Subject:</label>
                <input type="text" name="subject[]" placeholder="Enter the subject (e.g., Maths, Science)" required>
                
                <label for="teacher-name">Teacher's Name:</label>
                <input type="text" name="teacher-name[]" placeholder="Enter the teacher's name">
                
                <label for="current-attainment">Current Attainment/Grades:</label>
                <textarea name="current-attainment[]" rows="3" placeholder="Enter the current attainment/grades" required></textarea>
                
                <label for="exam-board">Exam Board (if applicable):</label>
                <input type="text" name="exam-board[]" placeholder="Enter the exam board (e.g., AQA, Edexcel)">
                
                <label for="tutoring-goals">Tutoring Goals:</label>
                <textarea name="tutoring-goals[]" rows="3" placeholder="Enter the tutoring goals" required></textarea>
            </div>
        </div>
        <button type="button" class="add-subject-btn" onclick="addSubject()">Add Another Subject</button>

        <div style="clear:both;"></div> <!-- Clear floats -->

        <label for="learning-style">Preferred Learning Style: <span class="help-icon" onclick="toggleHelpBox(event, 'learning-style-help')">(?)</span></label>
        <textarea id="learning-style" name="learning-style" rows="3" placeholder="Describe the student's preferred learning style"></textarea>
        <div id="learning-style-help" class="help-box">
            <p>Consider asking:</p>
            <ul>
                <li>Do you prefer visual aids, like diagrams and videos?</li>
                <li>Do you learn better through hands-on activities and practice?</li>
                <li>Do you like reading and writing notes?</li>
                <li>Do you prefer listening to explanations or audio materials?</li>
                <li>Do you benefit from group discussions or individual study?</li>
                <li>Do you find it easier to understand concepts through examples?</li>
                <li>Do you like using flashcards or other memory aids?</li>
                <li>Do you prefer structured lessons or more flexible learning?</li>
                <li>Do you find it helpful to relate concepts to real-life situations?</li>
                <li>Do you have any specific learning techniques that work best for you?</li>
            </ul>
            <button type="button" class="close-btn" onclick="toggleHelpBox(event, 'learning-style-help')">Close</button>
        </div>

        <label for="additional-support">Additional Support Needed (e.g., SEN, EAL): <span class="help-icon" onclick="toggleHelpBox(event, 'additional-support-help')">(?)</span></label>
        <textarea id="additional-support" name="additional-support" rows="3" placeholder="Describe any additional support needed"></textarea>
        <div id="additional-support-help" class="help-box">
            <p>Consider asking:</p>
            <ul>
                <li>Does the student have any special educational needs (SEN)?</li>
                <li>Does the student require English as an Additional Language (EAL) support?</li>
                <li>Are there any specific accommodations the student needs?</li>
                <li>Does the student have an Individual Education Plan (IEP)?</li>
                <li>Does the student need help with organisation or time management?</li>
                <li>Are there any sensory sensitivities to consider?</li>
                <li>Does the student need support with social skills?</li>
                <li>Does the student require assistive technology?</li>
                <li>Are there any medical conditions that affect learning?</li>
                <li>Does the student benefit from extra breaks or movement during lessons?</li>
            </ul>
            <button type="button" class="close-btn" onclick="toggleHelpBox(event, 'additional-support-help')">Close</button>
        </div>

        <label for="preferred-schedule">Preferred Tutoring Schedule: <span class="help-icon" onclick="toggleHelpBox(event, 'preferred-schedule-help')">(?)</span></label>
        <textarea id="preferred-schedule" name="preferred-schedule" rows="3" placeholder="Enter the preferred tutoring schedule"></textarea>
        <div id="preferred-schedule-help" class="help-box">
            <p>Consider asking:</p>
            <ul>
                <li>What days and times work best for tutoring sessions?</li>
                <li>How many sessions per week are preferred?</li>
                <li>Are there any upcoming holidays or events to consider?</li>
                <li>What time of day does the student learn best?</li>
                <li>Are there any extracurricular activities to work around?</li>
                <li>Does the student need a flexible schedule?</li>
                <li>Are there any preferred session lengths (e.g., 1 hour, 1.5 hours)?</li>
                <li>Would weekend sessions be preferable?</li>
                <li>Is there a preference for morning or afternoon sessions?</li>
                <li>Does the student need breaks during longer sessions?</li>
            </ul>
            <button type="button" class="close-btn" onclick="toggleHelpBox(event, 'preferred-schedule-help')">Close</button>
        </div>

        <label for="student-interests">Student's Interests and Hobbies: <span class="help-icon" onclick="toggleHelpBox(event, 'student-interests-help')">(?)</span></label>
        <textarea id="student-interests" name="student-interests" rows="3" placeholder="Describe the student's interests and hobbies"></textarea>
        <div id="student-interests-help" class="help-box">
            <p>Consider asking:</p>
            <ul>
                <li>What are the student's favourite subjects or topics?</li>
                <li>What activities or sports does the student enjoy?</li>
                <li>Does the student have any hobbies or extracurricular interests?</li>
                <li>What are the student's favourite books or movies?</li>
                <li>Does the student enjoy music or play any instruments?</li>
                <li>Does the student like to draw, paint, or engage in other creative activities?</li>
                <li>What games or apps does the student like to use?</li>
                <li>Does the student have any particular areas of curiosity or passion?</li>
                <li>Are there any clubs or groups the student is part of?</li>
                <li>Does the student have any goals related to their interests and hobbies?</li>
            </ul>
            <button type="button" class="close-btn" onclick="toggleHelpBox(event, 'student-interests-help')">Close</button>
        </div>

        <label for="extra-notes">Extra Notes: <span class="help-icon" onclick="toggleHelpBox(event, 'extra-notes-help')">(?)</span></label>
        <textarea id="extra-notes" name="extra-notes" rows="5" placeholder="Enter any additional notes or information"></textarea>
        <div id="extra-notes-help" class="help-box">
            <p>Consider asking:</p>
            <ul>
                <li>Is there any other information that might be helpful?</li>
                <li>Are there any specific challenges or concerns to address?</li>
                <li>What are the overall goals for tutoring?</li>
                <li>Are there any particular areas of strength or weakness?</li>
                <li>Does the student have any upcoming assessments or exams?</li>
                <li>Are there any learning strategies that have worked well in the past?</li>
                <li>Does the student have any particular dislikes or aversions in learning?</li>
                <li>Are there any behavioural concerns to be aware of?</li>
                <li>What motivates the student to learn?</li>
                <li>Are there any family or home circumstances that might affect learning?</li>
            </ul>
            <button type="button" class="close-btn" onclick="toggleHelpBox(event, 'extra-notes-help')">Close</button>
        </div>

        <button type="submit">Submit Notes</button>
    </form>
    <style>
        .help-box {
            display: none;
            position: absolute;
            background: #f4f4f4;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            z-index: 100;
            width: 300px;
        }
        .close-btn {
            background-color: #060097;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 10px;
        }
        .help-icon {
            cursor: pointer;
            color: #060097;
            margin-left: 5px;
        }
    </style>
    <script>
        function addSubject() {
            var subjectGroup = document.createElement('div');
            subjectGroup.className = 'subject-group';

            subjectGroup.innerHTML = `
                <label for="subject">Subject:</label>
                <input type="text" name="subject[]" placeholder="Enter the subject (e.g., Maths, Science)" required>
                
                <label for="teacher-name">Teacher's Name:</label>
                <input type="text" name="teacher-name[]" placeholder="Enter the teacher's name">
                
                <label for="current-attainment">Current Attainment/Grades:</label>
                <textarea name="current-attainment[]" rows="3" placeholder="Enter the current attainment/grades" required></textarea>
                
                <label for="exam-board">Exam Board (if applicable):</label>
                <input type="text" name="exam-board[]" placeholder="Enter the exam board (e.g., AQA, Edexcel)">
                
                <label for="tutoring-goals">Tutoring Goals:</label>
                <textarea name="tutoring-goals[]" rows="3" placeholder="Enter the tutoring goals" required></textarea>
            `;

            document.getElementById('subjects-container').appendChild(subjectGroup);
        }

        function toggleHelpBox(event, id) {
            var helpBox = document.getElementById(id);
            if (helpBox.style.display === 'none') {
                var rect = event.target.getBoundingClientRect();
                helpBox.style.top = (rect.top + window.scrollY - helpBox.offsetHeight) + 'px';
                helpBox.style.left = (rect.left + window.scrollX + 20) + 'px';
                helpBox.style.display = 'block';
            } else {
                helpBox.style.display = 'none';
            }
        }

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

    function tnp_update_note_field() {
    global $wpdb;

    $note_id = intval($_POST['note_id']);
    $field = sanitize_text_field($_POST['field']);
    $value = intval($_POST['value']);

    if ($field === 'inducted' || $field === 'processed') {
        $table_name = $wpdb->prefix . 'tnp_notes';
        $wpdb->update(
            $table_name,
            array($field => $value),
            array('id' => $note_id),
            array('%d'),
            array('%d')
        );

        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}

add_action('wp_ajax_update_note_field', 'tnp_update_note_field');


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
