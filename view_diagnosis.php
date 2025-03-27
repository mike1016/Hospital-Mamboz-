<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "management_hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    // Assuming you have a file named view_diagnosis_details.php to display patient diagnosis details
    header("Location: view_diagnosis_details.php?userid=$userid");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Diagnosis</title>
</head>
<body>
    <h2>View Patient Diagnosis</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="patientIdView">Patient ID:</label>
        <input type="text" id="patientIdView" name="userid" required><br><br>

        <input type="submit" name="submit" value="View Diagnosis">
    </form>
    
    <br>
    <a href="home.php">Go to Home Page</a>
</body>
</html>
