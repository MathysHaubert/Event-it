import { sendAjaxRequest } from "../tools.js";

// js for cookie
// if the ajax request is successful: send the cookie popup
const cookiePopup = document.querySelector(".cookie-popup");
const acceptButton = document.querySelector(".cookie-button.validate");
const rejectButton = document.querySelector(".cookie-button.decline");
if (cookiePopup !== null || acceptButton !== null || rejectButton !== null) {
    acceptButton.addEventListener("click", function () {
        // Make an AJAX request to the server
        console.log("Accept cookies");
        sendAjaxRequest(
            "/ajax/accept-cookies",
            "GET",
            "action=acceptCookies",
            function() {
                // Succes
                setTimeout(function() {
                    cookiePopup.style.display = "none";
                }, 1000);
            },
            function() {
                Error
                console.log("Error while accepting cookies");
            }
        )})
    rejectButton.addEventListener("click", function () {
        // Make an AJAX request to the server
        console.log("Decline cookies");
        sendAjaxRequest(
            "/ajax/decline-cookies",
            "GET",
            "action=declineCookies",
            function() {
                // Succes
                setTimeout(function() {
                    cookiePopup.style.display = "none";
                }, 1000);
            },
            function() {
                Error
                console.log("Error while accepting cookies");
            }
        )})
}

