<?php
// db_config.php
$host = 'localhost'; // Your database host
$user = 'root'; // Your database username
$password = ''; // Your database password
$database = 'studentonlineformdb'; // Your database name

// Connect to the database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
