<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentonlineformdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Fetch student details
    $sql = "SELECT * FROM student WHERE student_id = $student_id";
    $result = $conn->query($sql);
    $student = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    // Update student information
    $sql = "UPDATE student SET name = '$name', email = '$email', status = '$status' WHERE student_id = $student_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student updated successfully!'); window.location.href='managestudent.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM student WHERE student_id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student deleted successfully!'); window.location.href='managestudent.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <h2 class="text-2xl font-semibold mb-6">Edit Student</h2>
    <form action="editstudent.php?student_id=<?php echo $student_id; ?>" method="post" class="bg-white p-6 rounded shadow space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required class="mt-1 block w-full p-2 border rounded">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required class="mt-1 block w-full p-2 border rounded">
        </div>
        <div>
            <label for="status" class="block text-sm font-medium">Status</label>
            <select id="status" name="status" required class="mt-1 block w-full p-2 border rounded">
                <option value="Active" <?php if ($student['status'] == 'Active') echo 'selected'; ?>>Active</option>
                <option value="Inactive" <?php if ($student['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">Update</button>
        <a href="managestudent.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-400">Cancel</a>
    </form>
</body>
</html>
