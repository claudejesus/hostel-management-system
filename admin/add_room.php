<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="validation.js"></script>
        
<body>
    <h2>Add Room Details</h2>

    <?php
    session_start();
    include('save_room.php');
    
    ?>
    <form action="save_room.php" method="POST">
    <!-- <form action="#" method="POST"> -->
        <label for="room_number">Room Number:</label>
        <input type="number" id="room_number" name="room_number" required>
        <br><br>

        <label for="room_category">Room Category:</label>
        <select id="room_category" name="room_category" required>
                <option value="" disabled selected>Select room category</option>
                <option value="Ladies_Hostel">Ladies Hostel</option>
                <option value="Gents_Hostel">Gentlemen Hostel</option>
                
            </select>
        <br><br>

        <button type="submit">Add Room</button>
    </form>
</body>
</html>
