const nav = document.querySelector("nav.main-nav");
const menuIcon = document.querySelector("nav.main-nav button.menu-icon");

document.addEventListener("DOMContentLoaded", function() {

    

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

/*Quando viene cliccato menu-icon il nav ottiene la classe
    'mobile-open', se questa e' gia' presente viene rimossa.*/
function mobileToggleMenu() {
    //A ogni click la classe 'opened-nav' fa switch con la classe 'closed-nav'
    setTimeout(function () {
        if (nav.classList.contains("closed-nav")) {
            nav.classList.remove("closed-nav");
            nav.classList.add("opened-nav");
        } else if (nav.classList.contains("opened-nav")) {
            nav.classList.remove("opened-nav");
            nav.classList.add("closed-nav");
        }
    }, 150);

    nav.classList.toggle("mobile-open");
}


function openSubcategories(categoryName) {
    const subcategoryList = document.querySelector("nav.main-nav ul.subcategories." + categoryName);
    const subcategoryButtons = document.querySelectorAll("nav.main-nav ul.subcategories." + categoryName + " button.subcategory-button");

    subcategoryList.classList.toggle("opened-subcategories");
    
    subcategoryButtons.forEach(function (item) {
        item.classList.toggle("opened-subcategories");
    })
}
