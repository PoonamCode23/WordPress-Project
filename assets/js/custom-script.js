document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.querySelector(
    ".mobile-nav .mobile-menu-toggle"
  );
  const mobileMenu = document.querySelector(".mobile-nav-container");

  toggleButton.addEventListener("click", function () {
    mobileMenu.classList.toggle("active");
  });
});

// document.addEventListener("scroll", function () {
//   const nav = document.querySelector(".site-header");

//   //if u scroll more than 50 px vertically alt: nav.classList.toggle("scrolled", window.scrollY > 50);

//   if (window.scrollY > 50) {
//     nav.classList.add("scrolled");
//   } else {
//     nav.classList.remove("scrolled");
//   }
// });

// document.addEventListener("DOMContentLoaded", function () {
//   const header = document.querySelector(".site-header");

//   window.addEventListener("scroll", function () {
//     if (window.scrollY > 50) {
//       header.classList.add("scrolled");
//     } else {
//       header.classList.remove("scrolled");
//     }
//   });
// });

document.addEventListener("DOMContentLoaded", function () {
  const header = document.querySelector(".site-header");
  const mobileIcon = document.querySelector(".mobile-icon");

  if (header) {
    window.addEventListener("scroll", function () {
      if (window.scrollY > 50) {
        header.classList.add("scrolled");

        if (mobileIcon) {
          mobileIcon.classList.remove("icon-white");
          mobileIcon.classList.add("icon-black");
        }
      } else {
        header.classList.remove("scrolled");

        if (mobileIcon) {
          mobileIcon.classList.remove("icon-black");
          mobileIcon.classList.add("icon-white");
        }
      }
    });
  }
});
