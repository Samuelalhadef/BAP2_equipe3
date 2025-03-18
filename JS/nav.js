//document.addEventListener("DOMContentLoaded", function () {
//    const toggleButton = document.querySelector(".menu-toggle");
//    const menu = document.querySelector(".nav-menu");
//
//    toggleButton.addEventListener("click", function () {
//        const isExpanded = toggleButton.getAttribute("aria-expanded") === "true";
//        toggleButton.setAttribute("aria-expanded", !isExpanded);
//        menu.classList.toggle("active");
//    });
//});

const hamMenu = document.querySelector('.ham-menu');
const offScreenMenu = document.querySelector('.off-screen-menu');

hamMenu.addEventListener("click", function () {
    hamMenu.classList.toggle("active");
    offScreenMenu.classList.toggle("active");
});