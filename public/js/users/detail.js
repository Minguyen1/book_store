function decreaseQuantity() {
    let quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

function increaseQuantity() {
    let quantityInput = document.getElementById('quantity');
    quantityInput.value = parseInt(quantityInput.value) + 1;
}

document.addEventListener("DOMContentLoaded", function () {
    let quantityInput = document.getElementById("quantity");
    let hiddenQuantity = document.getElementById("hiddenQuantity");

    function updateHiddenQuantity() {
        hiddenQuantity.value = quantityInput.value;
    }

    quantityInput.addEventListener("input", updateHiddenQuantity);

    function increaseQuantity() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateHiddenQuantity();
    }

    function decreaseQuantity() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateHiddenQuantity();
        }
    }

    window.increaseQuantity = increaseQuantity;
    window.decreaseQuantity = decreaseQuantity;
});
