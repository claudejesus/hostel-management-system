<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        .error { color: red; }
    </style>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="validation.js"></script>
</head>
<body>
    <h2>Student Registration</h2>
    <form action="register_student.php" method="POST">
        <label for="registration_number">Enter Registration Number:</label>
        <input type="text" id="registration_number" name="registration_number" required>
        <button type="submit">Verify Identification</button>
    </form>

    <?php
    // Database connection
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'rpmusazecollegehostel';
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration_number'])) {
        $registration_number = $_POST['registration_number'];
        
        // Fetch student data
        $sql = "SELECT * FROM students WHERE registration_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $registration_number);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Display form with fetched data as read-only fields and password input
            $student = $result->fetch_assoc();
            echo '
                <form action="save_user.php" method="POST">
                    <label for="registration_number">Registration Number:</label>
                    <input type="text" name="registration_number" value="' . $student['registration_number'] . '" readonly>

                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="' . $student['first_name'] . '" readonly>

                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" value="' . $student['last_name'] . '" readonly>

                    <label for="gender">Gender:</label>
                    <input type="text" name="gender" value="' . $student['gender'] . '" readonly>

                    <label for="telephone">Telephone:</label>
                    <input type="text" name="telephone" value="' . $student['telephone'] . '" readonly>

                    <label for="email">Email:</label>
                    <input type="text" name="email" value="' . $student['email'] . '" readonly>

                    <label for="department">Department:</label>
                    <input type="text" name="department" value="' . $student['department'] . '" readonly>

                    <label for="level">Level:</label>
                    <input type="text" name="level" value="' . $student['year_of_study'] . '" readonly>

                    <label for="academic_year">Academic Year:</label>
                    <input type="text" name="academic_year" value="' . $student['academic_year'] . '" readonly>
                    
                    <label for="password">Set Password (8+ characters):</label>
                    <input type="password" id="password" name="password" required minlength="8" pattern=".{8,}" title="Minimum 8 characters">
                    <button type="submit">Register</button>
                </form>
            ';
        } else {
            echo '<p class="error">Registration number not found.</p>';
        }
        
        // Close statement and connection
        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
