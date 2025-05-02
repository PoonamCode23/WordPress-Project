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
  const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");

  const isHomePage =
    document.body.classList.contains("home") ||
    document.body.classList.contains("front-page");

  // Set icon color immediately based on page
  if (mobileIcon) {
    if (isHomePage) {
      mobileIcon.classList.add("icon-white");
    } else {
      mobileIcon.classList.add("icon-black");
    }
  }

  if (mobileMenuToggle) {
    mobileMenuToggle.addEventListener("click", function () {
      mobileMenuToggle.classList.toggle("active");
    });
  }

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

        if (mobileIcon && isHomePage) {
          mobileIcon.classList.remove("icon-black");
          mobileIcon.classList.add("icon-white");
        }
      }
    });
  }
});

//this code was not anchoring properly.

// for services toggling tab
// // Event listener for page load
// document.addEventListener("DOMContentLoaded", () => {
//   // Call the function to update section visibility based on URL fragment
//   updateSectionDisplay();

//   // If there is no specific fragment in the URL, scroll to the top of the page
//   if (!window.location.hash) {
//     window.scrollTo({ top: 0, behavior: "smooth" });
//   }
// });

// // Function to update the section visibility based on the URL fragment
// function updateSectionDisplay() {
//   const hash = window.location.hash.substring(1); // Get fragment without "#"
//   const sections = document.querySelectorAll(".services-section");
//   const buttons = document.querySelectorAll(".services-tab button");

//   if (hash) {
//     // Show the correct section based on the hash in the URL
//     sections.forEach((section) => {
//       console.log("test");
//       section.style.display = section.id === hash ? "flex" : "none";
//     });

//     // Highlight the correct button
//     buttons.forEach((btn) => {
//       if (btn.getAttribute("onclick")?.includes(hash)) {
//         btn.classList.add("active");
//       } else {
//         btn.classList.remove("active");
//         console.log("test");
//       }
//     });

//     // Scroll to the topmost h2 tag inside the cleaning-services section
//     const topHeading = document.querySelector(".cleaning-services h2");
//     if (topHeading) {
//       topHeading.scrollIntoView({ behavior: "smooth" });
//     }
//   } else {
//     // Default: Show the first section if no fragment exists
//     sections.forEach((section, index) => {
//       console.log("test");
//       section.style.display = index === 0 ? "flex" : "none";
//     });

//     // Highlight the first button as active
//     buttons.forEach((btn, index) => {
//       if (index === 0) {
//         btn.classList.add("active");
//         console.log("test");
//       } else {
//         btn.classList.remove("active");
//       }
//     });

//     // Scroll to the topmost h2 tag inside the cleaning-services section
//     const topHeading = document.querySelector(".cleaning-services h2");
//     if (topHeading) {
//       topHeading.scrollIntoView({ behavior: "smooth" });
//     }
//   }
// }

// // Function when tab is clicked manually
// function scrollToSection(id) {
//   const sections = document.querySelectorAll(".services-section");
//   const buttons = document.querySelectorAll(".services-tab button");

//   // Show the corresponding section
//   sections.forEach((section) => {
//     section.style.display = section.id === id ? "flex" : "none";
//   });

//   // Update active button
//   buttons.forEach((btn) => {
//     if (btn.getAttribute("onclick")?.includes(id)) {
//       btn.classList.add("active");
//     } else {
//       btn.classList.remove("active");
//     }
//   });

//   // Update URL hash manually
//   window.location.hash = id;

//   // Scroll to the topmost h2 tag inside the cleaning-services section
//   const topHeading = document.querySelector(".cleaning-services");
//   if (topHeading) {
//     topHeading.scrollIntoView({ behavior: "smooth" });
//   }
// }

// // Handle page load and hash change
// window.addEventListener("hashchange", updateSectionDisplay);
// document.addEventListener("DOMContentLoaded", () => {
//   const hash = window.location.hash.substring(1); // Get fragment without "#"

//   if (hash === "services") {
//     window.scrollTo({ top: 0, behavior: "smooth" });
//     return;
//   }

//   // Proceed with the usual section display logic
//   updateSectionDisplay();
// });

// // Function to update the section visibility based on the URL fragment
// function updateSectionDisplay() {
//   const hash = window.location.hash.substring(1); // Get fragment without "#"
//   const sections = document.querySelectorAll(".services-section");
//   const buttons = document.querySelectorAll(".services-tab button");

//   if (hash) {
//     // Show the correct section based on the hash in the URL
//     sections.forEach((section) => {
//       section.style.display = section.id === hash ? "flex" : "none";
//     });

//     // Highlight the correct button
//     buttons.forEach((btn) => {
//       if (btn.getAttribute("onclick")?.includes(hash)) {
//         btn.classList.add("active");
//       } else {
//         btn.classList.remove("active");
//       }
//     });
//   } else {
//     // Default: Show the first section if no fragment exists
//     sections.forEach((section, index) => {
//       section.style.display = index === 0 ? "flex" : "none";
//     });

//     // Highlight the first button as active
//     buttons.forEach((btn, index) => {
//       if (index === 0) {
//         btn.classList.add("active");
//       } else {
//         btn.classList.remove("active");
//       }
//     });
//   }

//   // ✅ Scroll to the .cleaning-services section AFTER visibility is updated
//   setTimeout(() => {
//     const topHeading = document.querySelector(".cleaning-services");
//     if (topHeading) {
//       topHeading.scrollIntoView({ behavior: "smooth" });
//     }
//   }, 50);
// }

// // Function when tab is clicked manually
// function scrollToSection(id) {
//   const sections = document.querySelectorAll(".services-section");
//   const buttons = document.querySelectorAll(".services-tab button");

//   // Show the corresponding section
//   sections.forEach((section) => {
//     section.style.display = section.id === id ? "flex" : "none";
//   });

//   // Update active button
//   buttons.forEach((btn) => {
//     if (btn.getAttribute("onclick")?.includes(id)) {
//       btn.classList.add("active");
//     } else {
//       btn.classList.remove("active");
//     }
//   });

//   // Update URL hash manually
//   window.location.hash = id;

//   // ✅ Scroll to the .cleaning-services section AFTER visibility is updated
//   setTimeout(() => {
//     const topHeading = document.querySelector(".cleaning-services");
//     if (topHeading) {
//       topHeading.scrollIntoView({ behavior: "smooth" });
//     }
//   }, 50);
// }

// // Handle page load and hash change
// window.addEventListener("hashchange", updateSectionDisplay);
document.addEventListener("DOMContentLoaded", () => {
  const hash = window.location.hash.substring(1); // Get fragment without "#"

  // If only "services" is clicked, scroll to the top of the page
  if (!hash || hash === "services") {
    setTimeout(() => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    }); // Increased delay ensures elements are updated first

    return; // Stop further execution
  }

  // Proceed with normal section display logic
  updateSectionDisplay();
});

// Function to update section visibility based on the URL fragment
function updateSectionDisplay() {
  const hash = window.location.hash.substring(1);
  const sections = document.querySelectorAll(".services-section");
  const buttons = document.querySelectorAll(".services-tab button");

  if (!hash || hash === "services") {
    // Hide all sections so clicking "Services" doesn't default to "cleaning-services"
    sections.forEach((section) => {
      section.style.display = "none";
    });

    buttons.forEach((btn) => {
      btn.classList.remove("active");
    });

    return; // Stop execution to avoid showing an unwanted section
  }

  // Show the correct section based on the hash
  sections.forEach((section) => {
    section.style.display = section.id === hash ? "flex" : "none";
  });

  // Highlight the correct button
  buttons.forEach((btn) => {
    if (btn.getAttribute("onclick")?.includes(hash)) {
      btn.classList.add("active");
    } else {
      btn.classList.remove("active");
    }
  });
  // Get top offset of .cleaning-services

  setTimeout(() => {
    const topHeading = document.querySelector(".cleaning-services");
    if (topHeading) {
      topHeading.scrollIntoView({ behavior: "smooth" });
    }
  }, 50);
  // Scroll to the selected section smoothly
  // setTimeout(() => {
  //   const sectionToScroll = document.getElementById(hash);
  //   console.log(sectionToScroll);
  //   if (sectionToScroll) {
  //     sectionToScroll.scrollIntoView({ behavior: "smooth" });
  //   }
  // }, 50);
}

// Function when a tab is clicked manually
function scrollToSection(id) {
  const sections = document.querySelectorAll(".services-section");
  const buttons = document.querySelectorAll(".services-tab button");

  // Show the correct section
  sections.forEach((section) => {
    section.style.display = section.id === id ? "flex" : "none";
  });

  // Update active button
  buttons.forEach((btn) => {
    if (btn.getAttribute("onclick")?.includes(id)) {
      btn.classList.add("active");
    } else {
      btn.classList.remove("active");
    }
  });

  // Update URL hash WITHOUT triggering browser auto scroll
  history.replaceState(null, null, "#" + id);

  // Get top offset of .cleaning-services
  setTimeout(() => {
    const topHeading = document.querySelector(".cleaning-services");
    if (topHeading) {
      topHeading.scrollIntoView({ behavior: "smooth" });
    }
  }, 50);
}

// Handle hash change events
window.addEventListener("hashchange", updateSectionDisplay);
