<?php
// Database connection parameters
$host = 'localhost';       // Replace with your host name
$username = 'root';        // Replace with your MySQL username
$password = '';            // Replace with your MySQL password
$database = 'rpmusazecollegehostel'; // Replace with your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize data
    //$room_number = $conn->real_escape_string($_POST['room_number']);
    //$room_category = $conn->real_escape_string($_POST['room_category']);
    $room_number = $_POST['room_number'];
    $room_category = $_POST['room_category'];

    // Insert data into `rooms` table; `room_id` will auto-increment
    $sql = "INSERT INTO rooms (room_number, room_category) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $room_number, $room_category);

    // Execute and check if the query was successful
    if ($stmt->execute()) {
        echo "Room added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
