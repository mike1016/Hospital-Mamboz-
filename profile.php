

<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

include 'db_connection.php'; // Include database connection file
$conn = open_db_connection(); // Establish database connection
$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Validate form data
    $username = trim($_POST['username']);
    $dob = $_POST['dob'];
    $phoneNumber = $_POST['phone_number'];
    $emergencyContact = $_POST['emergency_contact'];
    $county = $_POST['county'];

    // You can add more validation logic here

    // Update user information
    $sql = "UPDATE registration SET USERNAME=?, DOB=?, PHONE_NUMBER=?, EMERGENCY_CONTACT=?, COUNTY=? WHERE EMAIL=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing update statement: " . $conn->error;
        exit();
    }
    $stmt->bind_param("ssssss", $username, $dob, $phoneNumber, $emergencyContact, $county, $email);
    if (!$stmt->execute()) {
        echo "Error updating user information: " . $stmt->error;
        exit();
    }

    // Update successful
    header('Location: mwanzo.php'); // Redirect to mwanzo.php
    exit();
}

// Fetch user information
$sql = "SELECT * FROM registration WHERE EMAIL = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
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
