<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qr_complaints";

// Collect form data
$form_type = $_POST['form_type'] ?? 'unknown';
$location = $_POST['location'] ?? '';
$issue = $_POST['issue'] ?? '';
$description = $_POST['description'] ?? '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set timezone and get current datetime
date_default_timezone_set('Asia/Kolkata'); // Change this as needed
$submitted_at = date('Y-m-d H:i:s');

// Insert query with form type and timestamp
$sql = "INSERT INTO campus_complaints (location, issue, description, form_type, submitted_at) 
        VALUES (?, ?, ?, ?, ?)";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $location, $issue, $description, $form_type, $submitted_at);

// Execute
if ($stmt->execute()) {
    echo "<h2>Complaint submitted successfully from $form_type form!</h2>";
    echo "<a href='{$form_type}_form.html'>Submit another</a>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
