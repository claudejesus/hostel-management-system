<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bed</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="validation.js"></script>
</head>
<body>
    <h2>Add Bed Details</h2>
    <form action="save_bed.php" method="POST">
        <label for="bed_number">Bed Number:</label>
        <input type="text" id="bed_number" name="bed_number" required>
        <br><br>

        <label for="room_number">Select Room Number:</label>
        <select id="room_number" name="room_number" required onchange="fetchRoomCategory(this)">
            <option value="">Select Room Number</option>
            <?php
            // Database connection parameters
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'rpmusazecollegehostel';

            // Connect to the database
            $conn = new mysqli($host, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch room numbers and categories
            $result = $conn->query("SELECT room_number, room_category FROM rooms");

            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['room_number']) . "' data-category='" . htmlspecialchars($row['room_category']) . "'>" . htmlspecialchars($row['room_number']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No rooms available</option>";
                }
            } else {
                echo "<option value=''>Error: " . $conn->error . "</option>";
            }

            $conn->close();
            ?>
        </select>
        <br><br>

        <label for="room_category">Room Category:</label>
        <input type="text" id="room_category" name="room_category" readonly>
        <br><br>

        <button type="submit">Add Bed</button>
    </form>

    <script>
        function fetchRoomCategory(select) {
            const category = select.options[select.selectedIndex].getAttribute("data-category");
            document.getElementById("room_category").value = category || "";
        }
    </script>
</body>
</html>
