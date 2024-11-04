<!-- request_status.php -->

<?php
session_start();
require 'db_connection.php';

$registration_number = $_SESSION['registration_number'];

// Fetch the booking status
$sql = "SELECT b.booking_status, r.room_number, b.bed_id 
        FROM bookings b 
        JOIN rooms r ON b.room_number = r.room_number 
        WHERE b.registration_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $registration_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $booking = $result->fetch_assoc();
    echo "<h2>Booking Status</h2>";
    echo "Status: " . $booking['booking_status'] . "<br>";
    echo "Room Number: " . $booking['room_number'] . "<br>";
    echo "Bed ID: " . $booking['bed_id'] . "<br>";
} else {
    echo "No booking request found.";
}

$stmt->close();
$conn->close();
?>
