<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rpmusazecollegehostel';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data
    $registration_number = $_POST['registration_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $level = $_POST['level'];
    $academic_year = $_POST['academic_year'];
    $password = $_POST['password'];

    // Validate password strength
    if (strlen($password) < 8) {
        die("Password must be at least 8 characters long.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL statement with error handling
    $sql = "INSERT INTO studentlogs (registration_number, first_name, last_name, gender, telephone, email, department, year_of_study, academic_year, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("ssssssssss", $registration_number, $first_name, $last_name, $gender, $telephone, $email, $department, $level, $academic_year, $hashed_password);

    // Execute and check if the query was successful
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
