import { sendAjaxRequest } from "../tools.js";

// js for cookie
// if the ajax request is successful: send the cookie popup
document.addEventListener("DOMContentLoaded", function() {
    const cookiePopup = document.querySelector(".cookie-popup");
    const acceptButton = document.querySelector(".cookie-button.validate");
    const rejectButton = document.querySelector(".cookie-button.decline");
    if (cookiePopup && acceptButton && rejectButton) {
        acceptButton.addEventListener("click", function () {
            // Make an AJAX request to the server
            console.log("Accept cookies");
            sendAjaxRequest(
                "/ajax/accept-cookies",
                "GET",
                "action=acceptCookies",
                function() {
                    // Success
                    setTimeout(function() {
                        cookiePopup.style.display = "none";
                    }, 1000);
                },
                function() {
                    // Error
                    console.log("Error while accepting cookies");
                }
            );
        });
        
        rejectButton.addEventListener("click", function () {
            // Make an AJAX request to the server
            console.log("Decline cookies");
            sendAjaxRequest(
                "/ajax/decline-cookies",
                "GET",
                "action=declineCookies",
                function() {
                    // Success
                    setTimeout(function() {
                        cookiePopup.style.display = "none";
                    }, 1000);
                },
                function() {
                    // Error
                    console.log("Error while declining cookies");
                }
            );
        });
    }

    // Slideshow functionality
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    document.querySelector(".prev").addEventListener("click", function() {
        plusSlides(-1);
    });

    document.querySelector(".next").addEventListener("click", function() {
        plusSlides(1);
    });

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("slide");
        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex - 1].style.display = "block";
    }

    // FAQ accordion functionality
    const headers = document.querySelectorAll(".accordion-header");
    headers.forEach(header => {
        console.log("Attaching event listener to:", header);
        header.addEventListener("click", function() {
            // Determine if the current panel is already open
            const isCurrentlyExpanded = this.getAttribute('aria-expanded') === 'true';

            // Close all panels
            headers.forEach(h => {
                h.classList.remove("active");
                h.nextElementSibling.style.maxHeight = null;
                h.setAttribute('aria-expanded', 'false');
                h.querySelector("i").classList.remove("fa-angle-down");
                h.querySelector("i").classList.add("fa-angle-right");
            });

            // If the current panel wasn't open, open it
            if (!isCurrentlyExpanded) {
                this.classList.add("active");
                const content = this.nextElementSibling;
                content.style.maxHeight = content.scrollHeight + "px";
                this.setAttribute('aria-expanded', 'true');
                this.querySelector("i").classList.remove("fa-angle-right");
                this.querySelector("i").classList.add("fa-angle-down");
            }
        });
    });
});
