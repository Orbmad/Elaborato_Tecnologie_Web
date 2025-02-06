const minRangeInput = document.getElementById('min-price');
const maxRangeInput = document.getElementById('max-price');
const minTextOutput = document.getElementById('min-price-selected');
const maxTextOutput = document.getElementById('max-price-selected');

const minRatingInput = document.getElementById('min-rating');
const minRatingOutput = document.getElementById('min-rating-selected');
const searchedText = document.getElementById('fastSearch');

minRangeInput.addEventListener('input', updateMinText);
minRatingInput.addEventListener('input', updateRatingText);
maxRangeInput.addEventListener('input', updateMaxText);

function updateMinText() {
    if (parseFloat(minRangeInput.value) > parseFloat(maxRangeInput.value)) {
        minRangeInput.value = maxRangeInput.value;
    }
    minTextOutput.value = minRangeInput.value;
}

function updateMaxText() {
    if (parseFloat(maxRangeInput.value) < parseFloat(minRangeInput.value)) {
        maxRangeInput.value = minRangeInput.value;
    }
    maxTextOutput.value = maxRangeInput.value;
}

function updateRatingText() {
    minRatingOutput.value = minRatingInput.value;
}

updateMinText();
updateMaxText();

const moreFiltersButton = document.getElementById('more-filters-btn');
moreFiltersButton.addEventListener('click', function () {
    const hideableSections = document.querySelectorAll("aside > form > ul > li, #apply-filters-btn, #reset-filters-btn");
    hideableSections.forEach(function (section) {
        section.classList.toggle('hidden');
    });
    if (moreFiltersButton.value == "Nascondi filtri") {
        moreFiltersButton.setAttribute("value", "Mostra filtri");
    } else {
        moreFiltersButton.setAttribute("value", "Nascondi filtri");
    }
})

const categoryOptions = document.querySelectorAll('.category-selection');
categoryOptions.forEach(function (categoryOption) {
    categoryOption.addEventListener('click', function () {
        const categorySelected = categoryOption.id;
        const subClass = "." + categorySelected + "-sub";
        const subCategoriesList = document.querySelector(subClass);
        subCategoriesList.classList.toggle("hidden");
        if (subCategoriesList.classList.contains("hidden")) {
            document.querySelectorAll(`${subClass} > li > input`).forEach(function (checkbox) {
                checkbox.checked = false;
            });
        } else {
            document.querySelectorAll(`${subClass} > li > input`).forEach(function (checkbox) {
                checkbox.checked = true;
            });
        }
    });
});

const filtersForm = document.getElementById("filtered-search");
filtersForm.addEventListener('reset', function () {
    setTimeout(resetFilters, 0);
});

function resetFilters() {
    const checkCategories = document.querySelectorAll("aside > form > ul > li:nth-child(3).filter-checkbox > ul > li > input[type='checkbox']");
    checkCategories.forEach(function (checkBox) {
        if (!checkBox.checked) {
            const parent = checkBox.closest("li");
            const subFiltersUl = parent.querySelector("ul");
            if (subFiltersUl) {
                subFiltersUl.classList.add("hidden");
            }
        } else {
            const parent = checkBox.closest("li");
            const subFiltersUl = parent.querySelector("ul");
            if (subFiltersUl) {
                subFiltersUl.classList.remove("hidden");
            }
        }
    });
    applyFilters();
}

const applyButton = document.getElementById("apply-filters-btn");
applyButton.addEventListener('click', applyFilters);

function applyFilters() {
    const checkCategories = document.querySelectorAll("aside > form > ul > li:nth-child(3).filter-checkbox > ul > li > ul > li > input[type='checkbox']");
    const checkBoxes = document.querySelectorAll("aside > form > ul > li:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(3)):not(:last-child).filter-checkbox > ul > li > input[type='checkbox']");
    const checkGroups = document.querySelectorAll("aside > form > ul > li:last-child.filter-checkbox > ul > li > input[type='checkbox']");

    let categoriesChecked = [];
    let groupsChecked = [];
    let attributesChecked = [];
    checkCategories.forEach(function (checkBox) {
        if (checkBox.checked) {
            categoriesChecked.push(checkBox.name.replace(/^[^-]*-/, '').replace(/_/g, ' '));
        }
    });

    checkGroups.forEach(function (checkBox) {
        if (checkBox.checked) {
            groupsChecked.push(checkBox.name.replace(/^[^-]*-/, '').replace(/_/g, ' '));
        }
    });

    checkBoxes.forEach(function (checkBox) {
        if (checkBox.checked) {
            let key = checkBox.name.replace(/-.*$/, '');
            let value = checkBox.name.replace(/^[^-]*-/, '').replace(/_/g, ' ');

            if (!attributesChecked[key]) {
                attributesChecked[key] = [];
            }

            attributesChecked[key].push(value);
        }
    });

    fetch('utils/api-search-results.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            categoriesChecked: categoriesChecked,
            groupsChecked: groupsChecked,
            famiglia:attributesChecked["famiglia"],
            profumo:attributesChecked["profumo"],
            tipologia_foglia:attributesChecked["tipologia_foglia"],
            colore_foglia:attributesChecked["colore_foglia"],
            prezzomin: minRangeInput.value,
            prezzomax: maxRangeInput.value,
            ratingmin: minRatingInput.value,
            text:searchedText.value
        }),
    })
        .then(response => response.json())
        .then(data => {
            document.getElementsByClassName("search-results-list")[0].innerHTML = data.productListHTML;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

window.addEventListener('load', function () {
    setTimeout(function () {
        resetFilters();
    }, 1);
});