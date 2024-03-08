// js for cookie
document.addEventListener("DOMContentLoaded", function () {
        const cookiePopup = document.querySelector(".cookie-popup");
        const acceptButton = document.querySelector(".cookie-button, .validate");
        const rejectButton = document.querySelector(".cookie-button, .decline");

        acceptButton.addEventListener("click", function () {
                // Make an AJAX request to the server
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "/ajax/accept-cookies", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("action=acceptCookies");
            }
        )
    }
)

