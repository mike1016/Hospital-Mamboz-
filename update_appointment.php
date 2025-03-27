<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'doctor') {
    header('Location: login.php');
    exit();
}

$conn = open_db_connection();
$doctor_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $action = $_POST['action'];

    $status = $action === 'approve' ? 'approved' : 'declined';
    $sql = "UPDATE appointments SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $appointment_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to mwanzo.php after processing appointments
    header('Location: mwanzo.php');
    exit();
}
?>

