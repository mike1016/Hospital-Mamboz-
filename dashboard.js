document.addEventListener("DOMContentLoaded", function () {
    updateNotificationCount();

    function updateNotificationCount() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "notifications.php", true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    var notificationCount = response.notifications.length;
                    var notificationCountElement = document.querySelector(".notification-count");
                    notificationCountElement.textContent = notificationCount;
                } else {
                    showMessage(response.message, "error");
                }
            } else {
                showMessage("Error: Failed to load notification count.", "error");
            }
        };
        xhr.onerror = function () {
            showMessage("Error: Request failed.", "error");
        };
        xhr.send();
    }

    function showMessage(message, type) {
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
