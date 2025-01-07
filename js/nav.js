const nav = document.querySelector("nav.main-nav");

document.addEventListener("DOMContentLoaded", function() {

    

    /*Quando il nav e' 'mobile-open' e la finestra viene ingrandita
    il nav perde tale proprieta' */
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768 && nav.classList.contains("opened-nav")) {
            nav.classList.remove("opened-nav");
            nav.classList.add("closed-nav");
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
}


function openSubcategories(categoryName) {
    const AllSubcategoryList = document.querySelectorAll("nav.main-nav ul.subcategories");
    const subcategoryList = document.querySelector("nav.main-nav ul.subcategories." + categoryName);

    const menuArrowSide = document.querySelector("nav.main-nav img.toggleArrow.side." + categoryName);
    const menuArrowDown = document.querySelector("nav.main-nav img.toggleArrow.down." + categoryName);
    const allArrowSide = document.querySelectorAll("nav.main-nav img.toggleArrow.side");
    const allArrowDown = document.querySelectorAll("nav.main-nav img.toggleArrow.down");

    if (!nav.classList.contains("opened-subcategories") /*Il sottomenu è chiuso*/) {
        nav.classList.add("opened-subcategories");
        subcategoryList.classList.add("opened-subcategories");

        menuArrowSide.classList.add("hidden");
        menuArrowDown.classList.remove("hidden");
    } else if (nav.classList.contains("opened-subcategories") && !menuArrowSide.classList.contains("hidden")) {
        AllSubcategoryList.forEach(function (item) { //All'apertura di una categoria si chiudono le altre
            item.classList.remove("opened-subcategories");
        })
        subcategoryList.classList.add("opened-subcategories");

        //Tutte le altre frecce tornano chiuse
        allArrowSide.forEach(function (item) {
            item.classList.remove("hidden")
        })
        menuArrowSide.classList.add("hidden");

        //Le frecce aperte vengono nascoste tranne quella attuale che viene aperta
        allArrowDown.forEach(function (item) {
            item.classList.add("hidden")
        })
        menuArrowDown.classList.remove("hidden");
    } else if (nav.classList.contains("opened-subcategories") && menuArrowSide.classList.contains("hidden")) {
        nav.classList.remove("opened-subcategories");
        subcategoryList.classList.remove("opened-subcategories");

        menuArrowSide.classList.remove("hidden");
        menuArrowDown.classList.add("hidden");
    } 
}
