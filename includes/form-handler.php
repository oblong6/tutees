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
        <textarea id="address" name="address" rows="3" placeholder="Enter the address"
