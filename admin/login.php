<?php
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rpmusazecollegehostel';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Fetch user details from studentlogs table
    $sql = "SELECT * FROM studentlogs WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user'] = $user['email'];
            $_SESSION['success'] = "Login successful!";
            header("Location: book_hostel.html");
            exit();
        }
    }

    // If login fails
    $_SESSION['error'] = "Invalid email or password. Please try again.";
    header("Location: login.html");
    exit();
}

// Close connection
$conn->close();
?>
