let body = document.body;
let btnCloseMenu = document.getElementById('burger-closeResponsiveMenu');
let btnOpenMenu = document.getElementById('burger-responsiveMenu');
let MenuResponsive = document.getElementById('container-menuMobile');
let navbar = document.getElementById('navbar');

btnOpenMenu.addEventListener('click', () => {

    MenuResponsive.style.right="0%"
    MenuResponsive.style.transition="ease-in-out 0.25s"
    MenuResponsive.style.top="0%"
    body.classList.toggle("bodystyle");
    navbar.style.position="fixed";
    navbar.style.top="-100%";
})

btnCloseMenu.addEventListener('click', () => {

    MenuResponsive.style.right="-100%"
    MenuResponsive.style.transition="ease-in-out 0.25s"
    body.classList.toggle("bodystyle");
    navbar.style.position="sticky";
    navbar.style.top="0%";
})