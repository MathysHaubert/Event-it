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

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("slide");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
}

// Attach event listeners to buttons
document.querySelector(".prev").addEventListener("click", function() {
  plusSlides(-1);
});

document.querySelector(".next").addEventListener("click", function() {
  plusSlides(1);
});



// Début FAQ gestion boutons

const headers = document.querySelectorAll(".accordion-header");
headers.forEach(header => {
  header.addEventListener("click", function() {
    // Déterminer si le panneau actuel est déjà ouvert
    const isCurrentlyExpanded = this.getAttribute('aria-expanded') === 'true';

    // Fermer tous les panneaux
    headers.forEach(h => {
      h.classList.remove("active");
      h.nextElementSibling.style.maxHeight = null;
      h.setAttribute('aria-expanded', 'false');
      h.querySelector("i").classList.remove("fa-angle-down");
      h.querySelector("i").classList.add("fa-angle-right");
    });

    // Si le panneau actuel n'était pas ouvert, l'ouvrir
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

// Fin FAQ gestion boutons

redirectToFaqPage()
function redirectToFaqPage() {
  const button = document.getElementById("RedirectToFaq")
  button.addEventListener('click',function(){
    window.location.href = '/faq'
  })
}