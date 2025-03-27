<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

include 'db_connection.php'; // Assuming this file contains the database connection logic

$conn = open_db_connection(); // Assuming this function opens the database connection

$email = $_SESSION['email'];

$sql = "SELECT * FROM registration WHERE EMAIL = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Profile</h1>
        <form action="profile.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"
                value="<?php echo htmlspecialchars($user['USERNAME']); ?>"><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['DOB']); ?>"><br>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number"
                value="<?php echo htmlspecialchars($user['PHONE_NUMBER']); ?>"><br>

            <label for="emergency_contact">Emergency Contact:</label>
            <input type="text" id="emergency_contact" name="emergency_contact"
                value="<?php echo htmlspecialchars($user['EMERGENCY_CONTACT']); ?>"><br>

            <label for="county">County:</label>
            <input type="text" id="county" name="county" value="<?php echo htmlspecialchars($user['COUNTY']); ?>"><br>

            <input type="submit" name="submit" value="Save Changes">
        </form>
    </div>
</body>

</html>