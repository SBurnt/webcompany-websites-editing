document.addEventListener(
  "DOMContentLoaded",
  function () {
    const registrationDiscount = document.querySelector(".registration-discount");
    const registrationDiscountToggle = document.querySelector(".registration-discount__toggle");

    if (window.localStorage.getItem("hide") == "hidden") {
      registrationDiscount.classList.add("hide");
    } else {
      registrationDiscount.classList.remove("hide");
    }

    registrationDiscountToggle.addEventListener("click", function (e) {
      e.preventDefault;
      if (window.localStorage.getItem("hide") == "hidden") {
        registrationDiscount.classList.remove("hide");
        window.localStorage.setItem("hide", "visible");
      } else {
        registrationDiscount.classList.add("hide");
        window.localStorage.setItem("hide", "hidden");
      }
    });
  },
  false
);
