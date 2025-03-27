<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'Patient') {
    header('Location: login.php');
    exit();
}

include 'db_connection.php';
$conn = open_db_connection();
$patient_email = $_SESSION['email'];

// Join appointments with registration to get doctor names
$sql = "
    SELECT appointments.*, registration.USERNAME as doctor_name 
    FROM appointments 
    JOIN registration ON appointments.doctor_email = registration.EMAIL 
    WHERE appointments.patient_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $patient_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Notifications</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <h1>Your Appointments</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="striped-table">
                <thead>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Date</th>
                        <th>Time Slot</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_']); ?></td>
                            <td><?php echo htmlspecialchars($row['time_slot']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No appointments booked.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
