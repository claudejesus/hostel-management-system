<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rpmusazecollegehostel'; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if registration number is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registration_number = $conn->real_escape_string($_POST['registration_number']);

    // Fetch student details based on registration number
    $sql = "SELECT first_name, last_name, gender, department, year_of_study, academic_year 
            FROM students WHERE registration_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $registration_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();

        // Determine room and bed availability based on gender
        $gender = $student['gender'];
        $room_category = $gender == 'Female' ? 'Ladies_Hostel' : 'Gents_Hostel';

        // Find the first available room and bed based on the room category
        $sql = "SELECT r.room_number, b.bed_number FROM rooms r 
                JOIN beds b ON r.room_number = b.room_number 
                WHERE r.room_category = ? 
                AND b.bed_number NOT IN (SELECT bed_number FROM bookings WHERE room_number = r.room_number) 
                LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $room_category);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $room_data = $result->fetch_assoc();
            $room_number = $room_data['room_number'];
            $bed_number = $room_data['bed_number'];

            // Insert booking details into bookings table
            $sql = "INSERT INTO bookings (registration_number, first_name, last_name, gender, department, year_of_study, academic_year, room_number, bed_number, date_of_accommodation) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssis", $registration_number, $student['first_name'], $student['last_name'], $gender, $student['department'], $student['year_of_study'], $student['academic_year'], $room_number, $bed_number);

            if ($stmt->execute()) {
                echo "Booking successful! Room Number: $room_number, Bed Number: $bed_number.";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "All rooms are fully booked for $room_category.";
        }
    } else {
        echo "Student not found with the given registration number.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
