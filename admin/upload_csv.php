<?php
// Database connection parameters
$host = 'localhost';    
$username = 'root';       
$password = '';            
$database = 'rpmusazecollegehostel'; 

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted and a file is uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    $fileName = $_FILES['csv_file']['tmp_name'];

    if ($_FILES['csv_file']['size'] > 0) {
        // Open the CSV file
        $file = fopen($fileName, 'r');

        // Skip the header row if needed
        fgetcsv($file);

        // Prepare SQL statement
        $sql = "INSERT INTO students (registration_number, first_name, last_name, gender, telephone, email, department, year_of_study, academic_year) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Parse the CSV file line by line
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            // Bind parameters and insert data
            $stmt->bind_param("sssssssss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]);
            $stmt->execute();
        }

        // Close the statement and file
        $stmt->close();
        fclose($file);

        echo "Your admitted student have been uploaded successfuly";
    } else {
        echo "Please upload a valid CSV file.";
    }
} else {
    echo "No file uploaded.";
}

// Close the database connection
$conn->close();
?>
