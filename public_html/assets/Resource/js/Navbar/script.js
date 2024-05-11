const links = document.querySelectorAll('.nav-link');

links.forEach(link => {
  if (link.href === window.location.href) {
    link.classList.add('active');
  }
});
