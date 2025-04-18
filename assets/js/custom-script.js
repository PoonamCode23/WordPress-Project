document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.querySelector(".mobile-menu-toggle");
  const mobileMenu = document.querySelector(".mobile-nav-container");

  toggleButton.addEventListener("click", function () {
    mobileMenu.classList.toggle("active");
  });
});

document.addEventListener("scroll", function () {
  const nav = document.querySelector(".site-header");

  //if u scroll more than 50 px vertically alt: nav.classList.toggle("scrolled", window.scrollY > 50);

  if (window.scrollY > 50) {
    nav.classList.add("scrolled");
  } else {
    nav.classList.remove("scrolled");
  }
});
