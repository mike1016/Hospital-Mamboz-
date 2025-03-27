<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Records</h2>

    <?php
    // Include database connection
    include 'db_connection.php';
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "management_hospital";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch patient records
    $sql = "SELECT * FROM registration WHERE USERTYPE = 'patient'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output table headers
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>USERID</th>";
        echo "<th>USERNAME</th>";
        echo "<th>DOB</th>";
        echo "<th>EMAIL</th>";
        echo "<th>PHONE NUMBER</th>";
        echo "<th>EMERGENCY CONTACT</th>";
        echo "<th>COUNTY</th>";
        echo "<th>USER TYPE</th>";
        
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["USERID"] . "</td>";
            echo "<td>" . $row["USERNAME"] . "</td>";
            echo "<td>" . $row["DOB"] . "</td>";
            echo "<td>" . $row["EMAIL"] . "</td>";
            echo "<td>" . $row["PHONE_NUMBER"] . "</td>";
            echo "<td>" . $row["EMERGENCY_CONTACT"] . "</td>";
            echo "<td>" . $row["COUNTY"] . "</td>";
            echo "<td>" . $row["USERTYPE"] . "</td>";
            
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close database connection
    $conn->close();
    ?>

</body>
</html>
