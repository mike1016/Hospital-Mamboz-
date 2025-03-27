function loadPage(url) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('main-content').innerHTML = xhr.responseText;
            if (url === 'docnotifications.php' || url === 'patnotifications.php') {
                updateNotificationCount();
            }
        }
    };
    xhr.send();
}

function updateNotificationCount() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'notification_count.php', true);
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 400) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById('notification-count').textContent = response.count;
        }
    };
    xhr.send();
}

document.addEventListener('DOMContentLoaded', function () {
    updateNotificationCount();
});
