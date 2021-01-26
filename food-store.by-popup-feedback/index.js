document.addEventListener(
  "DOMContentLoaded",
  function () {
    const feedbackUp = document.querySelector(".feedback-up");
    const feedbackTurn = document.querySelector(".feedback-turn");
    const feedbackUpForm = document.querySelector(".feedback-up__form");
    const feedbackUpClose = document.querySelector(".feedback-up__close");

    const feedbackUpBtnSend = document.querySelector(".feedback-up__btn-send");

    if (window.localStorage.getItem("feedbackUp") == "hidden") {
      feedbackTurn.classList.add("active");
    } else {
      setTimeout(function () {
        feedbackUp.classList.add("active");
      }, 5000);
    }

    feedbackUpBtnSend.addEventListener("click", function (e) {
      e.preventDefault();
      const answer = document.querySelector(".feedback-up__answer");

      const formData = new FormData(feedbackUpForm);
      const captcha = grecaptcha.getResponse();
      if (captcha.length) {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
          if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            feedbackUp.classList.remove("active");
            feedbackTurn.classList.add("active");
            window.localStorage.setItem("feedbackUp", "hidden");
            answer.value = "";
          }
        };
        xmlHttp.open("POST", "send.php");
        xmlHttp.send(formData);
      } else {
        console.log("бот");
      }
    });

    feedbackUpClose.addEventListener("click", function (e) {
      e.preventDefault();
      feedbackUp.classList.remove("active");
      feedbackTurn.classList.add("active");
    });

    feedbackTurn.addEventListener("click", function (e) {
      e.preventDefault();
      feedbackUp.classList.add("active");
      feedbackTurn.classList.remove("active");
    });
  },
  false
);
