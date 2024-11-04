<!-- profile.php -->

<?php
session_start();
require 'db_connection.php';

$registration_number = $_SESSION['registration_number'];

// Fetch student profile information
$sql = "SELECT registration_number, first_name, last_name, gender, telephone, email, department, year_of_study, academic_year 
        FROM students WHERE registration_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $registration_number);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update profile information
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    $sql_update = "UPDATE students SET telephone = ?, email = ? WHERE registration_number = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sss", $telephone, $email, $registration_number);
    $stmt_update->execute();
    echo "Profile updated successfully.";
    $stmt_update->close();
}
?>

<h2>My Profile</h2>
<form method="post">
    <label>Registration Number:</label> <?php echo $student['registration_number']; ?><br>
    <label>First Name:</label> <?php echo $student['first_name']; ?><br>
    <label>Last Name:</label> <?php echo $student['last_name']; ?><br>
    <label>Gender:</label> <?php echo $student['gender']; ?><br>
    <label>Department:</label> <?php echo $student['department']; ?><br>
    <label>Year of Study:</label> <?php echo $student['year_of_study']; ?><br>
    <label>Academic Year:</label> <?php echo $student['academic_year']; ?><br>

    <label>Telephone:</label>
    <input type="text" name="telephone" value="<?php echo $student['telephone']; ?>"><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $student['email']; ?>"><br>

    <button type="submit">Update Profile</button>
</form>

<?php
$stmt->close();
$conn->close();
?>