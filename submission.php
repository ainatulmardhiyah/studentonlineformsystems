<?php
$conn = new mysqli("localhost", "root", "", "studentonlineformdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the student ID (you may retrieve this from session data if using login)
$student_id = 1; // Replace this with dynamic logic for logged-in student

// Handle form submission for new assignment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_submission'])) {
    $assignment_name = $_POST['assignment_name'];
    $submission_date = date('Y-m-d'); // Current date
    $file = $_FILES['file'];

    if ($file['error'] === 0) {
        $upload_dir = "uploads/";
        $file_name = uniqid() . "-" . basename($file['name']);
        $file_path = $upload_dir . $file_name;

        // Move file to the uploads directory
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            // Insert the new submission into the database
            $sql = "INSERT INTO submission (student_id, assignment_name, submission_date, file_url) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $student_id, $assignment_name, $submission_date, $file_path);

            if ($stmt->execute()) {
                echo "<script>alert('Submission added successfully!');</script>";
            } else {
                echo "<script>alert('Error adding submission: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Error uploading file.');</script>";
        }
    } else {
        echo "<script>alert('Error with the uploaded file.');</script>";
    }
}

// Fetch submissions for the current student
$sql = "SELECT * FROM submission WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Submissions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
.sidebar {
    width: 250px;
    background-color: #f8f9fa;
    min-height: 100vh;
    padding: 20px;
}

.sidebar .profile {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar .profile img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto; 
    display: block; 
}

.sidebar .profile h2 {
    font-size: 14px;
    font-weight: 600;
    margin-top: 10px;
}

.sidebar .profile p {
    font-size: 14px;
    color: #6c757d;
}

.sidebar .nav-title {
    font-size: 14px;
    text-transform: uppercase;
    margin-bottom: 10px;
    color: #6c757d;
}

.sidebar .nav-item {
    list-style: none;
    margin-bottom: 10px;
}

.sidebar .nav-item a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #333;
    font-size: 15px;
    padding: 10px;
    border-radius: 8px;
    transition: background-color 0.3s;
}

.sidebar .nav-item a:hover {
    background-color: #66c2a6;
    color: #fff;
}

.sidebar .nav-item a svg {
    margin-right: 10px;
}
       .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #66c2a6;
    padding: 10px 20px;
}
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
<div class="navbar">
 <div class="search-bar">
   <input type="text" placeholder="Search...">
   </div>
   <button class="bg-red-500 px-3 py-1 rounded-md"  onclick="window.location.href='login.php';">Logout</button>
    </div>
      
   
 </div>

 </div>
 <div class="flex">
     <!-- Sidebar -->
     <aside class="sidebar">
         <div class="profile">
             <img src="img/img 1.png" alt="Profile Picture"> 
             <h2>NUR AINATUL MARDHIYAH BINTI MOHAMAD</h2>
             <p>2024388929</p>
         </div>


         <h3 class="nav-title">Navigation</h3>
            <ul>
                <li class="nav-item">
                    <a href="student.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21H3a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="courses.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h16" />
                        </svg>
                        My Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a href="attandance.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3" />
                        </svg>
                        Attendance
                    </a>
                </li>
                <li class="nav-item">
                    <a href="submission.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        Submissions
                    </a>
                </li>
                <li class="nav-item">
                    <a href="contact.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        Contact
                    </a>
                </li>
            </ul>
        </aside>


      <!-- Main Content -->
      <div class="flex-1 p-6">
            <header class="mb-4">
                <h1 class="text-2xl font-bold">Submissions</h1>
            </header>

            <!-- Add New Submission Form -->
            <section class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Add New Submission</h2>
                <form action="" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-4">
                    <div class="mb-4">
                        <label for="assignment_name" class="block font-medium">Assignment Name:</label>
                        <input type="text" id="assignment_name" name="assignment_name" class="w-full border border-gray-300 p-2 rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="file" class="block font-medium">Upload File:</label>
                        <input type="file" id="file" name="file" class="w-full border border-gray-300 p-2 rounded-lg" required>
                    </div>
                    <button type="submit" name="add_submission" class="bg-green-500 text-white px-4 py-2 rounded-lg">Add Submission</button>
                </form>
            </section>

            <!-- Submissions Table -->
            <section>
                <h2 class="text-xl font-semibold mb-2">Your Submissions</h2>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="p-2 border border-gray-300">Submission ID</th>
                                <th class="p-2 border border-gray-300">Assignment Name</th>
                                <th class="p-2 border border-gray-300">Submission Date</th>
                                <th class="p-2 border border-gray-300">File</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $submission_id = $row['submission_id'];
            $assignment_name = htmlspecialchars($row['assignment_name']);
            $submission_date = $row['submission_date'];
            $file_url = htmlspecialchars($row['file_url']);
            echo "<tr>
                <td class='p-2 border border-gray-300'>$submission_id</td>
                <td class='p-2 border border-gray-300'>$assignment_name</td>
                <td class='p-2 border border-gray-300'>$submission_date</td>
                <td class='p-2 border border-gray-300 flex space-x-2'>
                    <a href='$file_url' class='bg-green-500 text-white px-3 py-1 rounded-lg text-sm' target='_blank'>View PDF</a>
                    <a href='$file_url' download class='bg-red-500 text-white px-3 py-1 rounded-lg text-sm'>Download PDF</a>
                    <form action='upload_pdf.php' method='POST' enctype='multipart/form-data' class='inline'>
                        <input type='hidden' name='submission_id' value='$submission_id'>
                        <input type='file' name='upload_file' class='hidden' onchange='this.form.submit()'>
                        <button type='button' onclick='this.previousElementSibling.click()' class='bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm'>Upload PDF</button>
                    </form>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4' class='text-center text-gray-600'>No submissions found</td></tr>";
    }
    ?>
</tbody>

                    </table>
                </div>
            </section>
        </div>
    </div>

    <?php
    // Clean up
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>