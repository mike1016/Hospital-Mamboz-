document.addEventListener("DOMContentLoaded", function () {
    // Get the login form element
    var loginForm = document.querySelector(".login-form");

    // Check if user is already logged in
    checkSession();

    // Add event listener for form submission
    loginForm.addEventListener("submit", function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get user type from the form
        var userType = document.getElementById("USERTYPE").value;

        // Log the form data
        console.log("Form data:", {
            email: document.getElementById("EMAIL").value,
            password: document.getElementById("PASSWORD").value,
            userType: userType
        });

        // Submit the form using AJAX
        submitForm(userType);
    });

    // Function to check session
    function checkSession() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "LOGIN_USER.php", true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    showMessage(response.message, "success");
                    console.log("Already logged in:", response);
                    // Optionally, redirect to another page
                    window.location.href = 'mwanzo.php';
                } else {
                    console.log("Not logged in:", response.message);
                }
            } else {
                console.error("Failed to check session, status:", xhr.status);
            }
        };
        xhr.onerror = function () {
            console.error("Error checking session.");
        };
        xhr.send();
    }

    // Function to submit the form using AJAX
    function submitForm(userType) {
        var formData = new FormData(loginForm);
        formData.append('USERTYPE', userType); // Append the user type to the form data
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "LOGIN USER.php", true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    showMessage(response.message, "success");
                    console.log("Login successful:", response);
                    // Optionally, redirect to another page
                    window.location.href = 'mwanzo.php';
                } else {
                    showMessage(response.message, "error");
                    console.error("Login failed:", response.message);
                }
            } else {
                showMessage("Error: Failed to log in.", "error");
                console.error("Login request failed, status:", xhr.status);
            }
        };
        xhr.onerror = function () {
            showMessage("Error: Request failed.", "error");
            console.error("Login request error.");
        };
        xhr.send(formData);
    }

    // Function to display message inside the current window
    function showMessage(message, type) {
        console.log("Displaying message:", message, "Type:", type);
        var messageDiv = document.createElement("div");
        messageDiv.textContent = message;
        messageDiv.classList.add("message", type);
        messageDiv.style.position = "fixed";
        messageDiv.style.top = "10px";
        messageDiv.style.left = "50%";
        messageDiv.style.transform = "translateX(-50%)";
        messageDiv.style.zIndex = "9999";

        if (type === "success") {
            messageDiv.style.color = "green";
        } else if (type === "error") {
            messageDiv.style.color = "red";
        } else {
            messageDiv.style.color = "black";
        }
        document.body.appendChild(messageDiv);

        setTimeout(function () {
            messageDiv.remove();
        }, 5000);
    }
});
