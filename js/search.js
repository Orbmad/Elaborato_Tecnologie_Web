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