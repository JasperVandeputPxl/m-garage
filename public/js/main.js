function changeTireQuantity(tire) {
  const value = document.getElementById(`tire-quantity-${tire}-value`);
  value.value = value.dataset.lastQuantity;

  const viewer = document.getElementById(`tire-quantity-${tire}-viewer`);
  const changer = document.getElementById(`tire-quantity-${tire}-changer`);

  viewer.classList.toggle("d-none");
  viewer.classList.toggle("d-flex");

  changer.classList.toggle("d-flex");
  changer.classList.toggle("d-none");
};

function subtractTireQuantity(tire) {
  const tireValue = document.getElementById(`tire-quantity-${tire}-value`);

  tireValue.value = parseInt(tireValue.value) - 1;
};
function addTireQuantity(tire) {
  const tireValue = document.getElementById(`tire-quantity-${tire}-value`);

  tireValue.value = parseInt(tireValue.value) + 1;
};
