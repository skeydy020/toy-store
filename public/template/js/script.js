// Ham + - so luong san pham
document.querySelectorAll('.increment').forEach(function (button) {
  button.addEventListener('click', function () {
      let quantityDisplay = this.parentElement.querySelector('.quantityDisplay');
      let quantity = parseInt(quantityDisplay.value);
      quantityDisplay.value = quantity + 1;
      calculateTotal(this);
  });
});

document.querySelectorAll('.decrement').forEach(function (button) {
  button.addEventListener('click', function () {
      let quantityDisplay = this.parentElement.querySelector('.quantityDisplay');
      let quantity = parseInt(quantityDisplay.value);
      if (quantity > 1) {
          quantityDisplay.value = quantity - 1;
      }
      calculateTotal(this);
  });
});