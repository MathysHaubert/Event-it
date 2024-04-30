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