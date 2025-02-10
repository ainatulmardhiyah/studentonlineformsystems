<?php
$conn = new mysqli("localhost", "root", "", "studentonlineformdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if (!empty($_POST['student_id']) && !empty($_POST['assignment_name']) && isset($_FILES['file'])) {
    $student_id = $_POST['student_id'];
    $assignment_name = $_POST['assignment_name'];
    $file_name = $_FILES['file']['name'];
    
    // File upload logic
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file_name);
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO submission (student_id, assignment_name, submission_date, file_url, status) 
                VALUES (?, ?, NOW(), ?, 'Pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $student_id, $assignment_name, $target_file);

        if ($stmt->execute()) {
            echo "Submission successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "All fields are required.";
}

$conn->close();
?>
