<?php
session_start();

// Check if user is logged in and session variables are set
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['username']) || !isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    // Redirect to login page or show appropriate message
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Hospital</title>
</head>

<body>
    <h1>Welcome to Our Hospital</h1>
    <p>
        THIS IS CHEMI CHEMI LA UZIMA HOSPITAL. WE TREAT, GOD HEALS.
    </p>
    <p>
        You are very welcome,<br> 
        NAME :<?php echo $_SESSION['username']; ?><br>
        Your ID: <?php echo $_SESSION['user_id']; ?><br>
        Your User Type: <?php echo $_SESSION['user_type']; ?>
    </p>

</body>

</html>