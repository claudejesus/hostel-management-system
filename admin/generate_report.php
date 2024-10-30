<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="validation.js"></script>
</head>
<body>
    
</body></html>
<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rpmusazecollegehostel'; // Updated database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default gender filter
$gender_filter = isset($_POST['gender_filter']) ? $_POST['gender_filter'] : 'All';

// Fetch accommodation data with optional gender filter
$sql_students = "SELECT * FROM bookings";
if ($gender_filter != 'All') {
    $sql_students .= " WHERE gender = '$gender_filter'";
}
$result_students = $conn->query($sql_students);

// Fetch room and accommodation summary
$sql_rooms_ladies = "SELECT COUNT(*) as total_rooms FROM rooms WHERE room_category = 'Ladies_Hostel'";
$result_rooms_ladies = $conn->query($sql_rooms_ladies);
$total_rooms_ladies = $result_rooms_ladies->fetch_assoc()['total_rooms'];

$sql_rooms_gents = "SELECT COUNT(*) as total_rooms FROM rooms WHERE room_category = 'Gents_Hostel'";
$result_rooms_gents = $conn->query($sql_rooms_gents);
$total_rooms_gents = $result_rooms_gents->fetch_assoc()['total_rooms'];

$sql_booked_ladies = "SELECT COUNT(DISTINCT room_number) as booked_rooms FROM bookings WHERE gender = 'Female'";
$result_booked_ladies = $conn->query($sql_booked_ladies);
$booked_rooms_ladies = $result_booked_ladies->fetch_assoc()['booked_rooms'];

$sql_booked_gents = "SELECT COUNT(DISTINCT room_number) as booked_rooms FROM bookings WHERE gender = 'Male'";
$result_booked_gents = $conn->query($sql_booked_gents);
$booked_rooms_gents = $result_booked_gents->fetch_assoc()['booked_rooms'];

$available_rooms_ladies = $total_rooms_ladies - $booked_rooms_ladies;
$available_rooms_gents = $total_rooms_gents - $booked_rooms_gents;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Accommodation Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            margin: 10px;
        }
        .filter-container {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h2>Hostel Accommodation Report</h2>

    <h3>Summary</h3>
    <p>Ladies Hostel:</p>
    <p>Total Rooms: <?php echo $total_rooms_ladies; ?></p>
    <p>Booked Rooms: <?php echo $booked_rooms_ladies; ?></p>
    <p>Available Rooms: <?php echo $available_rooms_ladies; ?></p>

    <p>Gents Hostel:</p>
    <p>Total Rooms: <?php echo $total_rooms_gents; ?></p>
    <p>Booked Rooms: <?php echo $booked_rooms_gents; ?></p>
    <p>Available Rooms: <?php echo $available_rooms_gents; ?></p>

    <div class="filter-container">
        <form method="POST" action="">
            <label for="gender_filter">Filter by Gender:</label>
            <select name="gender_filter" id="gender_filter">
                <option value="All" <?php echo $gender_filter == 'All' ? 'selected' : ''; ?>>All</option>
                <option value="Male" <?php echo $gender_filter == 'Male' ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo $gender_filter == 'Female' ? 'selected' : ''; ?>>Female</option>
            </select>
            <button type="submit">Filter</button>
        </form>
    </div>

    <h3>Students Accommodated:</h3>
    <table>
        <tr>
            <th>Registration Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Year of Study</th>
            <th>Academic Year</th>
            <th>Room Number</th>
            <th>Bed Number</th>
            <th>Date of Accommodation</th>
        </tr>
        <?php if ($result_students && $result_students->num_rows > 0): ?>
            <?php while ($row = $result_students->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['registration_number']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['year_of_study']; ?></td>
                    <td><?php echo $row['academic_year']; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['bed_number']; ?></td>
                    <td><?php echo $row['date_of_accommodation']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">No students accommodated.</td>
            </tr>
        <?php endif; ?>
    </table>

    <button onclick="window.print()">Print Report</button>
    <button onclick="window.location.href='download_excel.php'">Download Excel</button>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
