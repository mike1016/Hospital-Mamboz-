<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'doctor') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $action = $_POST['action'];

    // Update the appointment status based on the action
    $conn = open_db_connection();
    $status = $action === 'approve' ? 'approved' : ($action === 'complete' ? 'completed' : 'declined');
    $sql = "UPDATE appointments SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $appointment_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Redirect back to the homepage
header('Location: mwanzo.php');
exit();
?>
