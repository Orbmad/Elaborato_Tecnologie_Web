document.addEventListener("DOMContentLoaded", function() {
    const nav = document.querySelector("nav.main-nav");
    const menuIcon = document.querySelector("nav menu-icon");
    const categoryButton = document.querySelector("nav category-button");


    /*Quando viene cliccato menu-icon il nav ottiene la classe
    'mobile-open', se questa e' gia' presente viene rimossa.*/
    menuIcon.addEventListener("click", function() {
        nav.classList.toggle("mobile-open");
    });

    /*Quando il nav e' 'mobile-open' e la finestra viene ingrandita
    il nav perde tale proprieta' */
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            navLinks.classList.remove("mobile-open");
        }
    });
})