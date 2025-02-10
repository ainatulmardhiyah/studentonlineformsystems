<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #66c2a6;
            padding: 10px 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .search-bar input {
            border: none;
            outline: none;
            margin-right: 5px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 350px;
            text-align: center;
        }

        .login-box img {
            display: block;
            margin: 0 auto;
            width: 100px;
        }

        .login-box form {
            display: flex;
            flex-direction: column;
        }

        .login-box label {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .login-box input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-box .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .login-box button {
            padding: 10px;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px 0;
        }

        .login-box .student {
            background-color: #4CAF50;
        }

        .login-box .staff {
            background-color: #007BFF;
        }

        .signup {
            text-align: center;
            margin-top: 15px;
        }

        .signup a {
            text-decoration: none;
            color: #66c2a6;
        }

        .signup a:hover {
            text-decoration: underline;
        }
    </style>
<?php
session_start();
include 'db_config.php'; // Ensure you have a database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username) || empty($password)) {
        die("Username and password are required.");
    }

    // Check credentials
    $query = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Password verification (without hash as requested)
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];
            
            if ($user['role'] == 'student') {
                header("Location: student.php"); // Redirect to student dashboard
            } elseif ($user['role'] == 'staff') {
                header("Location: staff.php"); // Redirect to staff dashboard
            }
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
        }
    } else {
        $_SESSION['error'] = "User not found.";
    }

    $stmt->close();
    $conn->close();
    header("Location: login.php");
    exit();
}
?>
<body>
    <div class="navbar">
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
        <div>
            <a href="login.php">Log In</a>
            <a href="signup.php">Sign Up</a>
        </div>
    </div>
    <div class="container">
        <div class="login-box">
            <img src="img/logo.png" alt="UiTM Logo">
            <h2>Login</h2>
            <?php if(isset($_SESSION['error'])): ?>
                <p style="color: red;"> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?> </p>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="username">Username or Email</label>
                <input type="text" name="username" placeholder="Enter your username or email" required>
                
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
                
                <button type="submit" name="role" value="student" class="student">Login as Student</button>
                <button type="submit" name="role" value="staff" class="staff">Login as Staff</button>
            </form>
            <div class="signup">
                Don’t have an account? <a href="signup.php">Sign Up</a>
            </div>
        </div>
    </div>
</body>
</html>