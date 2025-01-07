const minRangeInput = document.getElementById('min-price');
const maxRangeInput = document.getElementById('max-price');
const minTextOutput = document.getElementById('min-price-selected');
const maxTextOutput = document.getElementById('max-price-selected');

minRangeInput.addEventListener('input', updateMinText);
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

updateMinText();
updateMaxText();

const moreFiltersButton = document.getElementById('more-filters-btn');
moreFiltersButton.addEventListener('click', function() {
    const hideableSections = document.querySelectorAll("aside > form > ul > li");
    hideableSections.forEach(function(section) {
        section.classList.toggle('hidden');
        if(section.classList.contains('hidden')){
            moreFiltersButton.setAttribute("value","Mostra filtri");
        }else{
            moreFiltersButton.setAttribute("value","Nascondi filtri");
        }
    });
})

const categoryOptions = document.querySelectorAll('.category-selection');  
categoryOptions.forEach(function(categoryOption) {
    categoryOption.addEventListener('click', function() {
        const categorySelected = categoryOption.id;
        const subClass = "." + categorySelected + "-sub";
        const subCategoriesList=document.querySelector(subClass);
        subCategoriesList.classList.toggle("hidden");
        if (subCategoriesList.classList.contains("hidden")) {
            document.querySelectorAll(`${subClass} > li > input`).forEach(function(checkbox) {
                checkbox.checked = false;
            });
        } else {
            document.querySelectorAll(`${subClass} > li > input`).forEach(function(checkbox) {
                checkbox.checked = true;
            });
        }
    });
});

