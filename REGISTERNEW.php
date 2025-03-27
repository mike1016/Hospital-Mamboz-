<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Initialize response array
     $response = array();

    // Retrieving form data
    $USERID = $_POST['USERID'];
    $USERNAME = $_POST['USERNAME'];
    $DOB = $_POST['DOB'];
    $EMAIL = $_POST['EMAIL'];
    $PHONE_NUMBER= $_POST['PHONE_NUMBER'];
    $EMERGENCY_CONTACT = $_POST['EMERGENCY_CONTACT'];
    $COUNTY = $_POST['COUNTY'];
    $USERTYPE=$_POST['USERTYPE'];
    $PASSWORD=$_POST['PASSWORD'];
    $CONFIRM_PASSWORD=$_POST['CONFIRM_PASSWORD'];

    // Establishing a connection to MySQL database
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "management_hospital"; // Replace with your MySQL database name

    // Creating connection
    $conn = new mysqli($servername, $username, $password, $dbname);
 
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     // Check for validation errors
     $errors = array();

// Validate USER ID
if (empty($USERID)) {
    $errors['USERID'] = "USER ID  is required";
}
//
// Validate USERNAME
if (empty($USERNAME)) {
    $errors['USERNAME'] = "Your Name is required";
}
// Validate DOB
if (empty($DOB)) {
    $errors['DOB'] = "DOB is required";
}

 // Validate EMAIL
 if (!filter_var($EMAIL, FILTER_VALIDATE_EMAIL)) {
    $errors['EMAIL'] = "Invalid email address";
}
//VALIDATE PHONE NUMBER
if (empty($PHONE_NUMBER)) {
    $errors['PHONE_NUMBER'] = "PHONE NUMBER is required";
}
// VALIDATE EMERGENCY CONTACT
if (empty($EMERGENCY_CONTACT)) {
    $errors['EMERGENCY_CONTACT'] = "EMERGENCY CONTACT is required";
}

if (empty($COUNTY)) {
    $errors['COUNTY'] = " COUNTY is required";
}

if (empty($PASSWORD)) {
    $errors['PASSWORD'] = "Password is required.";
} elseif (strlen($PASSWORD) < 8) {
    $errors['PASSWORD'] = "Password must be at least 8 characters long.";
} elseif (!preg_match("/[A-Z]/", $PASSWORD)) {
    $errors['PASSWORD'] = "Password must contain at least one uppercase letter.";
} elseif (!preg_match("/[^\w\s]/", $PASSWORD)) {
    $errors['PASSWORD'] = "Password must contain at least one special character (! or ?).";
}

 // Check if passwords match
 if ($PASSWORD != $CONFIRM_PASSWORD) {
    $errors[] = "Passwords do not match.";
}
 // Check if there are any validation errors
  // Check if there are any validation errors
if (count($errors) > 0) {
    // Send validation errors as JSON response
    $response['success'] = false;
    $response['message'] = "Error:\n";
    foreach ($errors as $error) {
        $response['message'] .= "" . $error . "\n";
    }
  
} else { // Move this else block outside of the foreach loop
    $sql = "SELECT EMAIL as EMAIL FROM registration WHERE EMAIL='$EMAIL'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $response['success'] = false;
        $response['message'] = 'You have already registered. Click the link below to login';
    } else {
        // Hash password - This is encryption
       // $hashedPassword = hashPassword($PASSWORD);

        // SQL query to insert data into the table
        $sql = "INSERT INTO registration (USERID , USERNAME, DOB , EMAIL, PHONE_NUMBER, EMERGENCY_CONTACT ,COUNTY,USERTYPE,CONFIRM_PASSWORD)
                VALUES ('$USERID', '$USERNAME', '$DOB ', '$EMAIL', '$PHONE_NUMBER', '$EMERGENCY_CONTACT', '$COUNTY','$USERTYPE','$CONFIRM_PASSWORD')";

        // Executing the SQL query
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

 //Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Closing the database connection
$conn->close();}
?>
