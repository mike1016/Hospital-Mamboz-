<?php
session_start();
include 'db_connection.php'; // Include your database connection script

$response = ['success' => false, 'message' => '', 'email' => '', 'confirm_password' => '', 'user_type' => '', 'username' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if user is already logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $response['success'] = true;
        $response['message'] = 'Already logged in.';
        $response['email'] = $_SESSION['email'];
        $response['confirm_password'] = $_SESSION['confirm_password']; // Retrieve confirm_password if needed
        $response['user_type'] = $_SESSION['user_type'];
        $response['username'] = $_SESSION['username']; // Retrieve username
        echo json_encode($response);
        exit();
    } else {
        $response['message'] = 'Not logged in.';
        echo json_encode($response);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['EMAIL']) && isset($_POST['PASSWORD']) && isset($_POST['USERTYPE'])) {
        $email = $_POST['EMAIL'];
        $password = $_POST['PASSWORD'];
        $user_type = $_POST['USERTYPE'];

        // Connect to the database
        $conn = open_db_connection();

        // Query to check if email exists and retrieve the corresponding password, user type, and username
        $sql = "SELECT USERID, EMAIL, CONFIRM_PASSWORD, USERTYPE, USERNAME FROM registration WHERE EMAIL = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($USERID, $EMAIL, $CONFIRM_PASSWORD, $USERTYPE, $USERNAME);
                $stmt->fetch();

                // Compare the provided password with the stored confirm_password
                // and check if the provided user type matches the stored user type
                if ($password === $CONFIRM_PASSWORD && $user_type === $USERTYPE) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $EMAIL;
                    $_SESSION['confirm_password'] = $CONFIRM_PASSWORD; // Store confirm_password in session if needed
                    $_SESSION['user_type'] = $USERTYPE; // Store user type in session
                    $_SESSION['user_id'] = $USERID; // Store user id in session
                    $_SESSION['username'] = $USERNAME; // Store username in session

                    $response['success'] = true;
                    $response['message'] = 'Login successful!';
                    $response['email'] = $EMAIL;
                    $response['confirm_password'] = $CONFIRM_PASSWORD;
                    $response['user_type'] = $USERTYPE;
                    $response['username'] = $USERNAME;
                } else {
                    $response['message'] = 'Invalid password or user type.';
                }
            } else {
                $response['message'] = 'Invalid email.';
            }
        } else {
            $response['message'] = 'Error executing query.';
        }

        $stmt->close();
        $conn->close();
    } else {
        $response['message'] = 'Required fields missing.';
    }
} else {
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
?>
