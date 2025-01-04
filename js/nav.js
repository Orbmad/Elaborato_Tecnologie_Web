const nav = document.querySelector("nav.main-nav");
const menuIcon = document.querySelector("nav button.menu-icon");

document.addEventListener("DOMContentLoaded", function() {

    /*Quando viene cliccato menu-icon il nav ottiene la classe
    'mobile-open', se questa e' gia' presente viene rimossa.*/
    menuIcon.addEventListener("click", function() {
        nav.classList.remove("closed-nav");
        nav.classList.add("opened-nav");
        nav.classList.toggle("mobile-open");
    });

    /*Quando il nav e' 'mobile-open' e la finestra viene ingrandita
    il nav perde tale proprieta' */
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            nav.classList.remove("mobile-open");
        } else {
            nav.classList.remove("desktop-open");
        }
    });
})

/*
function openSubcategories(categoryName) {
    const subcategoriesList = document.querySelector("nav.main-nav .categories ul.subcategories.${categoryName}")

    nav.classList.remove("closed-nav");
    nav.classList.add("opened-nav");
    nav.classList.toggle("desktop-open");


}
*/