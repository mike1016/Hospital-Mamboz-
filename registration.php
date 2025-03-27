<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrationform</title>
    <link rel="stylesheet" href="registration.css">
    </link>
</head>


<body>
 
 <div class="reg">
<form class="registration-form" method="POST" action="REGISTERNEW.php">
        
            <div class="part" id="nation"><label for="USER">NATIONAL ID</label>
                <input type="int" name="USERID" id="USERID"><br>
            </div>

            <div><label for="USERNAME">NAME</label>
                <input type="text" name="USERNAME" id="USERNAME" placeholder="surname then other names" required><br>
            </div>

            <div><label for="DOB">DATE OF BIRTH</label>
                <input type="date" name="DOB" id="DOB"><br>
            </div>

            <div><label for="EMAIL">EMAIL</label>
            <input type="email" name="EMAIL" id="EMAIL" required><br>
          </div>

        <div> <label for="PHONE_NUMBER">PHONE NUMBER</label>
            <input type="int" name="PHONE_NUMBER" id="PHONE_NUMBER" required><br>
        </div>

               <div> <label for="EMERGENCY_CONTACT">EMERGENCY CONTACT </label>
            <input type="int" name="EMERGENCY_CONTACT" id="EMERGENCY_CONTACT" required><br>
                 </div>

            <div>
            <label for="COUNTY">COUNTY</label>
                <input type="text" name="COUNTY" id="COUNTY" required><br>
</div>
<div >
            <label for="USERTYPE">User Type:</label>
            <select id="USERTYPE" name="USERTYPE" required>
              <option value="doctor">DOCTOR</option>
              <option value="Patient">Patient</option>
              <option value="Nurse">Nurse</option>
              

            </select>
          </div>
            
            <div>
            <label for="PASSWORD">PASSWORD</label>
                <input type="password" name="PASSWORD" id="PASSWORD" required><br>
</div>
            <div>
            <label for="CONFIRM_PASSWORD">CONFIRM PASSWORD</label>
                <input type="password" name="CONFIRM_PASSWORD" id="CONFIRM_PASSWORD" required><br></div><br>
           <div>
               <button type="submit">REGISTER </button>
               <!--<input type="submit" value="REGISTER">-->
            </div>
            <div>
                <p>click here to login if already registered</p>
                <button type="button" onclick="window.location.href='login.php'">LOGIN</button>
        

</form>
</div>
<script src="submit.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>