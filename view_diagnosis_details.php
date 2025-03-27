<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosis</title>
    <link rel="stylesheet" href="style6.css">
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
        exit();
    }

    include 'db_connection.php';
    $conn = open_db_connection();

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['userid'])) {
        $userid = $_GET['userid'];

        $stmt = $conn->prepare("SELECT DIAGNOSIS, DATE_ FROM diagnosis WHERE PATIENT_ID = ?");
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
                echo "<h2>Diagnosis for Patient ID: $userid</h2>";
                echo "<table>
                        <tr>
                            <th>Diagnosis</th>
                            <th>Date</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['DIAGNOSIS'] . "</td>";
                    echo "<td>" . $row['DATE_'] . "</td>"; // Display the date
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No diagnosis found for Patient ID: $userid";
            }
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
    ?>

    <br>
    <a href="mwanzo.php">Go to Mwanzo Page</a>
</body>
</html>



