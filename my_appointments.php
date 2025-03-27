


<?php
session_start();

// Establishing a connection to MySQL database
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "management_hospital"; // Replace with your MySQL database name

$error_message = '';

if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'Patient') {
    header('Location: login.php');
    exit();
}

// Creating connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Fetch doctors
$sql = "SELECT * FROM registration WHERE USERTYPE = 'doctor'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$doctors = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <h1>Book Appointment</h1>
        <?php if (!empty($_GET['error_message'])): ?>
            <p class="message error"><?php echo htmlspecialchars($_GET['error_message']); ?></p>
        <?php endif; ?>
        <?php if (!empty($_GET['success_message'])): ?>
            <p class="message success"><?php echo htmlspecialchars($_GET['success_message']); ?></p>
            <p><a href="mwanzo.php">Go to Homepage</a></p>
        <?php endif; ?>
        <form method="POST" action="process.php">
            <label for="doctor_email">Select Doctor:</label>
            <select name="doctor_email" id="doctor_email" required>
                <?php foreach ($doctors as $doctor): ?>
                    <option value="<?php echo htmlspecialchars($doctor['EMAIL']); ?>"><?php echo htmlspecialchars($doctor['USERNAME']); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="date_">Date:</label>
            <input type="date" name="date_" id="date_" required>

            <label for="time_slot">Time Slot:</label>
            <select name="time_slot" id="time_slot" required>
                <option value="8-9">8:00 AM - 9:00 AM</option>
                <option value="11-12">11:00 AM - 12:00 PM</option>
                <option value="14-15">2:00 PM - 3:00 PM</option>
            </select>

            <button type="submit">Book Appointment</button>
        </form>
    </div>
</body>
</html>
