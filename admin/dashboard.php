<?php
session_start();

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

// Fetch data for reports
$report_sql = "SELECT * FROM bookings";
$report_result = $conn->query($report_sql);

$staff_sql = "SELECT COUNT(*) AS staff_count FROM staff";
$staff_result = $conn->query($staff_sql);
$staff_count = $staff_result->fetch_assoc()['staff_count'] ?? 0;

$students_sql = "SELECT COUNT(*) AS student_count FROM students";
$students_result = $conn->query($students_sql);
$student_count = $students_result->fetch_assoc()['student_count'] ?? 0;

$bookings_sql = "SELECT COUNT(*) AS bookings_count FROM bookings";
$bookings_result = $conn->query($bookings_sql);
$bookings_count = $bookings_result->fetch_assoc()['bookings_count'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar Navigation -->
    <div class="sidebar" >
        <h2>Dashboard</h2>
        <a href="dashboard.php">Home</a>
        <a href="generate_report.php">Reports</a>
        <a href="add_staff.php">Add Staff</a>      
        <a href="add_room.php">Add Rooms</a>
        <a href="add_bed.php">Add Beds</a>
        <a href="add_staff.php">Add Students</a>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <h1>Welcome to the Staff Dashboard</h1>

        <!-- Quick Stats Panels -->
        <div class="quick-stats">
            <div class="stat">
                <h3>Total Staff</h3>
                <p><?php echo $staff_count; ?></p>
            </div>
            <div class="stat">
                <h3>Total Students</h3>
                <p><?php echo $student_count; ?></p>
            </div>
            <div class="stat">
                <h3>Number of accomodeted students</h3>
                <p><?php echo $bookings_count; ?></p>
        