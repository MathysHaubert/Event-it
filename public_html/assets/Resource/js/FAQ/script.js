const headers = document.querySelectorAll(".accordion-header");

headers.forEach((header) => {
  const icon = header.querySelector("i");

  header.addEventListener("click", function () {
    const expanded = this.getAttribute("aria-expanded") === "true";

    headers.forEach((h) => {
      h.setAttribute("aria-expanded", "false");
      h.querySelector("i").classList.remove("fa-angle-down");
      h.querySelector("i").classList.add("fa-angle-right");
      h.nextElementSibling.style.maxHeight = null;
    });

    if (!expanded) {
      this.setAttribute("aria-expanded", "true");
      icon.classList.remove("fa-angle-right");
      icon.classList.add("fa-angle-down");
      this.nextElementSibling.style.maxHeight =
        this.nextElementSibling.scrollHeight + "px";
    } else {
      this.setAttribute("aria-expanded", "false");
      icon.classList.remove("fa-angle-down");
      icon.classList.add("fa-angle-right");
      this.nextElementSibling.style.maxHeight = null;
    }
  });
});
