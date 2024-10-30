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
    // Get form data
    $registration_number = $_POST['registration_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $level = $_POST['level'];
    $academic_year = $_POST['academic_year'];

    // SQL query to insert data
    $sql = "INSERT INTO students (registration_number, first_name, last_name, gender, telephone, email, department, year_of_study, academic_year) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $registration_number, $first_name, $last_name, $gender, $telephone, $email, $department, $level, $academic_year);

    // Execute the query
    if ($stmt->execute()) {
        echo "Student details saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
