<?php
session_start();
// Establishing a connection to MySQL database
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "management_hospital"; // Replace with your MySQL database name

if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'Patient') {
    header('Location: login.php');
    exit();
}

// Creating connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_email = $_SESSION['email']; // Retrieve patient email from session
    $doctor_email = $_POST['doctor_email'];
    $date_ = $_POST['date_'];
    $time_slot = $_POST['time_slot'];

    try {
        $insert_sql = "INSERT INTO appointments (patient_email, doctor_email, date_, time_slot) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ssss", $patient_email, $doctor_email, $date_, $time_slot);
        $insert_stmt->execute();
        $insert_stmt->close();
        header('Location: my_appointments.php?success_message=Appointment booked successfully.');
        exit();
    } catch (Exception $e) {
        $error_message = 'Error: ' . $e->getMessage();
        header('Location: my_appointments.php?error_message=' . urlencode($error_message));
        exit();
    }
}
?>



$conn->close();
?>
