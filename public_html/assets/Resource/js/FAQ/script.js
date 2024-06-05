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
});



// FAQ accordion functionality
document.addEventListener('DOMContentLoaded', function () {
  // Sélectionner tous les éléments avec la classe 'accordion-header'
  const headers = document.querySelectorAll('.accordion-header');

  headers.forEach(header => {
    // Ajouter un écouteur d'événement pour chaque header
    header.addEventListener('click', function () {
      const expanded = this.getAttribute('aria-expanded') === 'true';

      // Fermer toutes les autres sections de l'accordéon
      headers.forEach(h => {
        h.setAttribute('aria-expanded', 'false');
        h.querySelector('i').classList.remove('fa-angle-down');
        h.querySelector('i').classList.add('fa-angle-right');
        h.nextElementSibling.style.maxHeight = null;
      });

      // Basculer l'état de la section actuelle
        if (!expanded) {
        this.setAttribute('aria-expanded', 'true');
        this.querySelector('i').classList.remove('fa-angle-right');
        this.querySelector('i').classList.add('fa-angle-down');
        this.nextElementSibling.style.maxHeight = this.nextElementSibling.scrollHeight + 'px';
      } else {
        this.setAttribute('aria-expanded', 'false');
        this.querySelector('i').classList.remove('fa-angle-down');
        this.querySelector('i').classList.add('fa-angle-right');
        this.nextElementSibling.style.maxHeight = null;
      }
    });
  });
});


redirectToFaqAdd()
function redirectToFaqAdd() {
  const button = document.getElementById("RedirectToFaqAdd")
  button.addEventListener('click',function(){
    window.location.href = '/AjoutFaq'
  })
}