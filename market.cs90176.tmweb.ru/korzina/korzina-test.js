$(document).ready(function () {
  const colorSelect = document.querySelectorAll('.color-select');
  const sizeSelect = document.querySelectorAll('.size-select');

  function stepper() {
    $('.stepper__btn').on('click', function (e) {
      const counter = $(this).closest('.js-stepper').find('.stepper__input');

      if ($(this).data('step') === 'up') {
        counter.val(parseInt(counter.val()) + 1);
      } else {
        counter.val(parseInt(counter.val()) - 1);

        if (parseInt(counter.val()) < 1) {
          counter.val(1);
        }
      }
    });
  }
  stepper();

  // выбор цвета товата
  if (colorSelect) {
    colorSelect.forEach((item) => {
      item.addEventListener('click', (e) => {
        if (e.target.classList.contains('color-select__btn')) {
          item.querySelectorAll('.color-select__btn').forEach((el) => {
            el.classList.remove('color-select__btn--active');
          });
          e.target.classList.add('color-select__btn--active');
        }
      });
    });
  }

  // выбор размера товара
  if (sizeSelect) {
    sizeSelect.forEach((item) => {
      item.addEventListener('click', (e) => {
        if (e.target.classList.contains('size-select__btn')) {
          item.querySelectorAll('.size-select__btn').forEach((el) => {
            el.classList.remove('size-select__btn--active');
          });
          e.target.classList.add('size-select__btn--active');
        }
      });
    });
  }
});
