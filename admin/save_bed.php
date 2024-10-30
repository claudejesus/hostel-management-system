<?php
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

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize data
    $bed_number = $conn->real_escape_string($_POST['bed_number']);
    $room_number = $conn->real_escape_string($_POST['room_number']);

    // Insert data into `beds` table using room_number
    $sql = "INSERT INTO beds (room_number, bed_number) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $room_number, $bed_number);

    // Execute and check if the query was successful
    if ($stmt->execute()) {
        echo "Bed added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
