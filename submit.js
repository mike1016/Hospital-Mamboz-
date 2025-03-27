document.addEventListener("DOMContentLoaded", function () {
    // Get the registration form element
    var registrationForm = document.querySelector(".registration-form");

    // Add event listener for form submission
    registrationForm.addEventListener("submit", function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Submit the form using AJAX
        submitForm();
    });

    // Function to submit the form using AJAX
    function submitForm() {
        // Create a new FormData object to capture form data
        var formData = new FormData(registrationForm);

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure the request
        xhr.open("POST", "REGISTERNEW.php", true);

        // Set up onload function to handle response
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Success: display response from server
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Display success message
                    showMessage(response.message, "success");
                    // Optionally, redirect to another page
                    // window.location.href = 'success.html';
                } else {
                    // Display error message
                    showMessage(response.message, "error");
                }
            } else {
                // Error: display error message
                showMessage("Error: Failed to submit form.", "error");
            }
        };

        // Set up onerror function to handle errors
        xhr.onerror = function () {
            showMessage("Error: Request failed.", "error");
        };

        // Send the request with form data
        xhr.send(formData);
    }

    // Function to display message inside the current window
    function showMessage(message, type) {
        // Create a new div element for the message
        var messageDiv = document.createElement("div");
        messageDiv.textContent = message;
        messageDiv.classList.add("message", type); // Add appropriate class for styling

        // Apply styles to center the messageDiv horizontally
        messageDiv.style.position = "fixed";
        messageDiv.style.top = "10px"; // Adjust the top position as needed
        messageDiv.style.left = "50%";
        messageDiv.style.transform = "translateX(-50%)";
        messageDiv.style.zIndex = "9999"; // Ensure messageDiv is on top of other elements

        // Change color of the message based on the type
        if (type === "success") {
            messageDiv.style.color = "green";
        } else if (type === "error") {
            messageDiv.style.color = "red";
        } else {
            messageDiv.style.color = "black";
        }
        // Append the message div to the document body
        document.body.appendChild(messageDiv);

        // Automatically remove the message after 5 seconds
        setTimeout(function () {
            messageDiv.remove();
        }, 5000);
    }
});