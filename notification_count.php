<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    echo json_encode(['count' => 0]);
    exit();
}

include 'db_connection.php';
$conn = open_db_connection();
$count = 0;

if ($_SESSION['user_type'] === 'doctor') {
    $doctor_email = $_SESSION['email'];
    $sql = "SELECT COUNT(*) AS count FROM appointments WHERE doctor_email = ? AND status = 'pending'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $doctor_email);
} else if ($_SESSION['user_type'] === 'Patient') {
    $patient_email = $_SESSION['email'];
    $sql = "SELECT COUNT(*) AS count FROM appointments WHERE patient_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patient_email);
}

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
}

$stmt->close();
$conn->close();

echo json_encode(['count' => $count]);
?>
