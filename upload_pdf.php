<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "studentonlineformdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a file is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_file']) && isset($_POST['submission_id'])) {
    $submission_id = $_POST['submission_id'];
    $file = $_FILES['upload_file'];

    if ($file['error'] === 0) {
        $upload_dir = "uploads/";
        $file_name = uniqid() . "-" . basename($file['name']);
        $file_path = $upload_dir . $file_name;

        // Create uploads directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            // Update the file URL in the database for the specific submission
            $sql = "UPDATE submission SET file_url = ? WHERE submission_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $file_path, $submission_id);

            if ($stmt->execute()) {
                echo "<script>
                    alert('File uploaded successfully!');
                    window.location.href = 'submission.php';
                </script>";
            } else {
                echo "<script>
                    alert('Error updating database: " . $stmt->error . "');
                    window.history.back();
                </script>";
            }

            $stmt->close();
        } else {
            echo "<script>
                alert('Error moving the uploaded file.');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Error with the uploaded file.');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Invalid request.');
        window.history.back();
    </script>";
}

// Close the connection
$conn->close();
?>

<form action="upload_pdf.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="submission_id" value="<?php echo $row['submission_id']; ?>">
    <input type="file" name="upload_file" accept="application/pdf" required>
    <button type="submit" class="btn btn-warning">Upload PDF</button>
</form>
