<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loginform</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

<div class="container">
    <h1> WELCOME BACK</h1>
    <form class="login-form">
        <label for="EMAIL">EMAIL</label>
        <input type="email" name="EMAIL" placeholder="EMAIL" id="EMAIL" required><br>
        <label for="PASSWORD">PASSWORD</label>
        <input type="password" name="PASSWORD" placeholder="PASSWORD" id="PASSWORD" required><br>
        <label for="USERTYPE">USER TYPE</label>
        <select name="USERTYPE" id="USERTYPE" required>
            <option value="doctor">DOCTOR</option>
            <option value="Patient">Patient</option>
            <option value="Nurse">Nurse</option>
        </select><br>
        <input type="submit" value="LOGIN"><br>
        <a href="registration.php">Not Registered? Click to Register</a>
    </form>
</div>

<script src="login.js"></script>

</body>
</html>
