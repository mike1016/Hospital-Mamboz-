<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'doctor') {
    header('Location: login.php');
    exit();
}

include 'db_connection.php';
$conn = open_db_connection();
$doctor_email = $_SESSION['email'];

$sql = "SELECT * FROM appointments WHERE doctor_email = ? AND status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $doctor_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Notifications</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    <div class="container">
        <h1>Pending Appointments</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Patient Email</th>
                        <th>Date</th>
                        <th>Time Slot</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['patient_email']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_']); ?></td>
                            <td><?php echo htmlspecialchars($row['time_slot']); ?></td>
                            <td>
                                <form method="POST" action="update_appointment.php">
                                    <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="action" value="approve">Approve</button>
                                    <button type="submit" name="action" value="decline">Decline</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending appointments.</p>
        <?php endif; ?>
    </div>
</body>
</html>
