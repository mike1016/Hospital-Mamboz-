<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'doctor') {
    header('Location: login.php');
    exit();
}

$conn = open_db_connection();
$doctor_email = $_SESSION['email'];

// Join appointments with registration to get patient names
$sql = "
    SELECT appointments.*, registration.USERNAME as patient_name 
    FROM appointments 
    JOIN registration ON appointments.patient_email = registration.EMAIL 
    WHERE appointments.doctor_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $doctor_email);
$stmt->execute();
$result = $stmt->get_result();
$appointments = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Appointments</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        .completed {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointments</h1>
        <table>
            <tr>
                <th>Patient</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($appointment['patient_name']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['date_']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['time_slot']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['status']); ?></td>
                    <td>
                        <?php if ($appointment['status'] === 'pending'): ?>
                            <form action="process_action.php" method="POST">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                <button type="submit" name="action" value="approve">Approve</button>
                                <button type="submit" name="action" value="decline">Decline</button>
                            </form>
                        <?php elseif ($appointment['status'] === 'approved'): ?>
                            <form action="process_action.php" method="POST">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                <button type="submit" name="action" value="complete">Mark as Completed</button>
                            </form>
                        <?php elseif ($appointment['status'] === 'completed'): ?>
                            <span class="completed">Completed</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
