<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentonlineformdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$course_id = $course_name = $credits = $instructor = "";
$is_edit = false;

// Check if course_id is passed for editing
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $is_edit = true;

    // Fetch course details
    $sql = "SELECT * FROM course WHERE course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $course = $result->fetch_assoc();
        $course_name = $course['course_name'];
        $credits = $course['credits'];
        $instructor = $course['instructor'];
    } else {
        echo "Course not found!";
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $credits = $_POST['credits'];
    $instructor = $_POST['instructor'];

    // Update course details
    $sql = "UPDATE course SET course_name = ?, credits = ?, instructor = ? WHERE course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $course_name, $credits, $instructor, $course_id);

    if ($stmt->execute()) {
        header("Location: managecourses.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #565e64;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="form-container">
    <h1>Edit Course</h1>
    <form action="editcourse.php" method="post">
        <input type="hidden" name="course_id" value="<?= htmlspecialchars($course_id) ?>">
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" name="course_name" id="course_name" value="<?= htmlspecialchars($course_name) ?>" required>
        </div>
        <div class="form-group">
            <label for="credits">Credits</label>
            <input type="number" name="credits" id="credits" value="<?= htmlspecialchars($credits) ?>" min="1" required>
        </div>
        <div class="form-group">
            <label for="instructor">Instructor</label>
            <input type="text" name="instructor" id="instructor" value="<?= htmlspecialchars($instructor) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Course</button>
        <a href="managecourses.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
