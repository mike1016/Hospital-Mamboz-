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
    $patientId = $_POST['patientId'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date_']; // Get the date from the form

    $stmt = $conn->prepare("INSERT INTO diagnosis (PATIENT_ID, DIAGNOSIS, DATE_) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sss", $patientId, $diagnosis, $date);
    if (!$stmt) {
        die("Error binding parameters: " . $stmt->error);
    }

    if ($stmt->execute()) {
        echo "Diagnosis added successfully";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Diagnosis</title>
</head>
<body>
    <h2>Fill Diagnosis</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="patientId">Patient ID:</label>
        <input type="text" id="patientId" name="patientId" required><br><br>

        <label for="diagnosis">Diagnosis:</label>
        <input type="text" id="diagnosis" name="diagnosis" required><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date_" required><br><br> <!-- Added date input field -->

        <input type="submit" name="submit" value="Submit">
    </form>
    
    <br>
    <a href="mwanzo.php">Go to Home Page</a>
</body>
</html>
