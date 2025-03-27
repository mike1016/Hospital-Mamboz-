<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "management_hospital"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientId = $_POST['patientId'];
    $bloodPressure = $_POST['bloodPressure'];
    $temperature = $_POST['temperature'];
    $mass = $_POST['mass'];
    $height = $_POST['height'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO vitals (PATIENT_ID, BLOOD_PRESSURE, TEMPARATURE, MASS, HEIGHT) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sssss", $patientId, $bloodPressure, $temperature, $mass, $height);
    if (!$stmt) {
        die("Error binding parameters: " . $stmt->error);
    }

    if ($stmt->execute()) {
        // Close the statement
        $stmt->close();
        // Redirect to mwanzo.php
        header("Location: mwanzo.php");
        exit();
    } else {
        echo "Error executing statement: " . $stmt->error;
    }
}

$conn->close();
?>


