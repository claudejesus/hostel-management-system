<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rpmusazecollegehostel';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch accommodation data
$sql_students = "
    SELECT 
        s.registration_number, 
        s.first_name, 
        s.last_name, 
        s.gender, 
        s.department, 
        s.year_of_study, 
        s.academic_year, 
        b.room_number, 
        b.bed_id, 
        b.date_of_accommodation
    FROM 
        bookings AS b
    JOIN 
        students AS s ON b.registration_number = s.registration_number";

$result_students = $conn->query($sql_students);

// Set headers for Excel file download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="hostel_report.xls"');

// Print column names
echo "Registration Number\tFirst Name\tLast Name\tGender\tDepartment\tYear of Study\tAcademic Year\tRoom Number\tBed ID\tDate of Accommodation\n";

// Print each row of data
if ($result_students->num_rows > 0) {
    while ($row = $result_students->fetch_assoc()) {
        echo "{$row['registration_number']}\t{$row['first_name']}\t{$row['last_name']}\t{$row['gender']}\t{$row['department']}\t{$row['year_of_study']}\t{$row['academic_year']}\t{$row['room_number']}\t{$row['bed_id']}\t{$row['date_of_accommodation']}\n";
    }
} else {
    echo "No students accommodated.";
}

$conn->close();
?>
