<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEMICHEMI HOSPITAL SYSTEM</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="heading">
        <header>
            <h1>CHEMICHEMI LA UZIMA HOSPITAL</h1>
        </header>
    </div>
    <div class="horizontalbar">
        <div class="tabs-box">
            <button id="btn1" onclick="openhome()">HOME</button>
            <button id="btn2" onclick="openrecords()">About us</button>
            <button id="btn3" onclick="openabout()">Records</button>
            <button id="btn4" onclick="openfaqs()">FAQs</button>
            <a href="logout.php">LOGOUT</a>
        </div>
        <div id="content1" class="content">
            <div class="content-left">
                <h1> Welcome our home
                    page </h1>
                <p>To register click the link below</p>

                <a href="#">register</a>
                <p>To login click the link below(if already registered)</p>
                <a href="#">login</a></p>
            </div>
            <div class="content-right">
                <img src="HOSPITAL IMAGE.jpg">
            </div>
        </div>

        <div id="content2" class="content">
            <div class="content-left">
                <h1> Welcome to our home page </h1>
                <p>To register click the link below</p>

                <a href="#">register</a>
                <p>To login click the link below(if already registered)</p>
                <a href="#">login</a></p>
            </div>
            <div class="content-right">
                <img src="woman.jpg">
            </div>
        </div>

        <div id="content3" class="content">
            <div class="content-left">
                <h1> Welcome to our home page </h1>
                <p>To register click the link below</p>

                <a href="#">register</a>
                <p>To login click the link below(if already registered)</p>
                <a href="#">login</a></p>
            </div>
            <div class="content-right">
                <img src="maledoc.jpg">
            </div>

        </div>

        <div id="content4" class=" content">
            <div class="content-left">
                <h1> Welcome to our home page kijana </h1>
                <p>To register click the link below</p>

                <a href="#">register</a>
                <p>To login click the link below(if already registered)</p>
                <a href="#">login</a></p>
            </div>
            <div class="content-right">
                <img src="maledoc.jpg">
            </div>

        </div>
    </div>
    <script src="script.js"></script>
</body>

</html> -->
<?php
session_start();

if (!isset($_SESSION['loggedin']) || !isset($_SESSION['username']) || !isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEMICHEMI HOSPITAL SYSTEM</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="sub-body">
        <header>
            <div class="image">
                <img src="image.jpg" alt="missing image" />
                <div class="title">Chemichemi La Uzima</div>
                <div class="logo">
                    <img src="logo.png" alt="missing image" />
                </div>
            </div>
        </header>
        <div id="horizontalbar">
            <a href="#" onclick="loadPage('home.php'); return false;">Home</a>
            <?php if ($_SESSION['user_type'] === 'doctor'): ?>
                <a href="#" onclick="loadPage('records.php'); return false;">Records</a>
                <a href="#" onclick="loadPage('appointments.php'); return false;">Appointments</a>
                <a href="#" onclick="loadPage('doctor_view_vitals.html'); return false;">VIEW VITALS</a>
                <a href="#" onclick="loadPage('enter_diagnosis_form.html'); return false;">Enter diagnosis</a>
                <a href="#" onclick="loadPage('view_diagnosis.php'); return false;">view diagnosis</a>
                <a href="#" onclick="loadPage('docnotifications.php'); return false;">Notifications <span id="notification-count">0</span></a>
            <?php elseif ($_SESSION['user_type'] === 'Patient'): ?>
                <a href="#" onclick="loadPage('my_appointments.php'); return false;">Book Appointment</a>
                <a href="#" onclick="loadPage('patnotifications.php'); return false;">Notifications <span id="notification-count">0</span></a>
            <?php elseif ($_SESSION['user_type'] === 'Nurse'): ?>
                <a href="#" onclick="loadPage('vitals.php'); return false;">Vitals</a>
            <?php endif; ?>
            
            <a href="logout.php">Logout</a>
        </div>

        <div class="content">
            <div class="sidebar">
                <nav>
                    <p>SITE NAVIGATION</p>
                    <ul>
                        <li><a href="#" onclick="loadPage('home.php'); return false;">Home</a></li>
                        <?php if ($_SESSION['user_type'] === 'doctor' || $_SESSION['user_type'] === 'Patient'): ?>
                            <li><a href="#" onclick="loadPage('records.php'); return false;">Records</a></li>
                            <li><a href="#" onclick="loadPage('appointments.php'); return false;">Appointments</a></li>
                            <li><a href="#" onclick="loadPage('doctor_view_vitals.html'); return false;">VIEW VITALS</a></li>
                            <li><a href="#" onclick="loadPage('enter_diagnosis_form.html'); return false;">Enter diagnosis</a></li>
                            <li><a href="#" onclick="loadPage('view_diagnosis.php'); return false;">view diagnosis</a></li>
                            <li><a href="#" onclick="loadPage('docnotifications.php'); return false;">Notifications <span id="notification-count">0</span></a></li>
                        <?php elseif ($_SESSION['user_type'] === 'Patient'): ?>
                            <li><a href="#" onclick="loadPage('my_appointments.php'); return false;">Book Appointment</a></li>
                            <li><a href="#" onclick="loadPage('patnotifications.php'); return false;">Notifications <span id="notification-count">0</span></a></li>
                        <?php elseif ($_SESSION['user_type'] === 'Nurse'): ?>
                            <li><a href="#" onclick="loadPage('vitals.php'); return false;">Vitals</a></li>
                        <?php endif; ?>
                        <li><a href="#" onclick="loadPage('profile2.php'); return false;">Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>

            <main id="main-content">
                <h1>Welcome to Our Hospital</h1>
                <p>THIS IS CHEMI CHEMI LA UZIMA HOSPITAL. WE TREAT GOD HEALS.</p>
                <p>you are very welcome</p>
            </main>
        </div>

        <footer class="border-top">
            <p>&copy; 2024 CHEGE MICHAEL NYAGA P15/1908/2022</p>
        </footer>
    </div>
    <script src="script.js"></script>
</body>

</html>
