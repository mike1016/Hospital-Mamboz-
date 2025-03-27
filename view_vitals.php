<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "management_hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$vitals_data = [];
$userid = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];

    $stmt = $conn->prepare("SELECT VITALS_ID, BLOOD_PRESSURE, TEMPARATURE, MASS, HEIGHT FROM vitals WHERE PATIENT_ID = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $userid);
    if (!$stmt) {
        die("Error binding parameters: " . $stmt->error);
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $vitals_data[] = $row;
            }
        }
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
    <title>View Patient Vitals</title>
    <link rel="stylesheet" href="style5.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="container">
        <h2>Vitals for Patient ID: <?php echo $userid; ?></h2>
        <?php if (!empty($vitals_data)) : ?>
            <table class='styled-table'>
                <thead>
                    <tr>
                        <th>VITALS_ID</th>
                        <th>BLOOD_PRESSURE</th>
                        <th>TEMPERATURE</th>
                        <th>MASS</th>
                        <th>HEIGHT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vitals_data as $data) : ?>
                        <tr>
                            <td><?php echo $data['VITALS_ID']; ?></td>
                            <td><?php echo $data['BLOOD_PRESSURE']; ?></td>
                            <td><?php echo $data['TEMPARATURE']; ?></td>
                            <td><?php echo $data['MASS']; ?></td>
                            <td><?php echo $data['HEIGHT']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No vitals found for Patient ID: <?php echo $userid; ?></p>
        <?php endif; ?>
        <br>
        <a href="mwanzo.php">Go to Home Page</a>
    </div>
</body>
</html>

