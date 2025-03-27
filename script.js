/*var content1 = document.getElementById("content1");
var content2 = document.getElementById("content2");
var content3 = document.getElementById("content3");
var content4 = document.getElementById("content4");
var btn1 = document.getElementById("btn1");
var btn2 = document.getElementById("btn2");
var btn3 = document.getElementById("btn3");
var btn4 = document.getElementById("btn4");

function openhome() {
    content1.style.transform = "translateX(0)";
    content2.style.transform = "translateX(250%)";
    content3.style.transform = "translateX(250%)";
    content4.style.transform = "translateX(250%)";
    btn1.style.color = "#ff7846";
    btn2.style.color = "#000";
    btn3.style.color = "#000";
    btn4.style.color = "#000";
    content1.style.transitionDelay = "0.4s";
    content2.style.transitionDelay = "0s";
    content3.style.transitionDelay = "0s";
    content4.style.transitionDelay = "0s"


}
function openrecords() {
    content1.style.transform = "translateX(250%)";
    content2.style.transform = "translateX(0)";
    content3.style.transform = "translateX(250%)";
    content4.style.transform = "translateX(250%)";
    btn1.style.color = "#000";
    btn2.style.color = "#ff7846";
    btn3.style.color = "#000";
    btn4.style.color = "#000";
    content1.style.transitionDelay = "0s";
    content2.style.transitionDelay = "0.3s";
    content3.style.transitionDelay = "0s";
    content4.style.transitionDelay = "0s"



}
function openabout() {
    content1.style.transform = "translateX(250%)";
    content2.style.transform = "translateX(250%)";
    content3.style.transform = "translateX(0)";
    content4.style.transform = "translateX(250%)";
    btn1.style.color = "#000";
    btn2.style.color = "#000";
    btn3.style.color = "#ff7846";
    btn4.style.color = "#000";
    content1.style.transitionDelay = "0s";
    content2.style.transitionDelay = "0s";
    content3.style.transitionDelay = "0.3s";
    content4.style.transitionDelay = "0s"

}*/
function openfaqs() {
    content1.style.transform = "translateX(250%)";
    content2.style.transform = "translateX(250%)";
    content3.style.transform = "translateX(250%)";
    content4.style.transform = "translateX(0)";
    btn1.style.color = "#000";
    btn2.style.color = "#000";
    btn3.style.color = "#000";
    btn4.style.color = "#ff7846";
    content1.style.transitionDelay = "0s";
    content2.style.transitionDelay = "0s";
    content3.style.transitionDelay = "0s";
    content4.style.transitionDelay = "0.3s";


}

/*function loadPage(page) {
    fetch(page)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then((html) => {
            document.getElementById("main-content").innerHTML = html;
        })
        .catch((error) => {
            console.error("There was a problem fetching the page:", error);
        });
}*/
function loadPage(page) {
    fetch(page)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then((html) => {
            document.getElementById("main-content").innerHTML = html;
            if (page === 'docnotifications.php' || page === 'patnotifications.php') {
                updateNotificationCount();
            }
        })
        .catch((error) => {
            console.error("There was a problem fetching the page:", error);
        });
}

function updateNotificationCount() {
    fetch('notification_count.php')
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            document.getElementById('notification-count').textContent = data.count;
        })
        .catch((error) => {
            console.error("There was a problem fetching the notification count:", error);
        });
}

document.addEventListener('DOMContentLoaded', function () {
    updateNotificationCount();
});
