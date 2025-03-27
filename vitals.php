<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Vitals Form</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h2>Submit Your Vitals</h2>
    <form action="process2.php" method="POST">
        <label for="patientId">Patient ID:</label>
        <input type="text" id="patientId" name="patientId" required><br><br>

        <label for="bloodPressure">Blood Pressure:</label>
        <input type="text" id="bloodPressure" name="bloodPressure" required><br><br>

        <label for="temperature">Temperature:</label>
        <input type="text" id="temperature" name="temperature" required><br><br>

        <label for="mass">Mass:</label>
        <input type="text" id="mass" name="mass" required><br><br>

        <label for="height">Height:</label>
        <input type="text" id="height" name="height" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
