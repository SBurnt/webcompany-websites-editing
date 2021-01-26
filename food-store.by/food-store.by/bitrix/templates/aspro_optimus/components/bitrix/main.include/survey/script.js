document.addEventListener(
  "DOMContentLoaded",
  function () {
    const feedbackUp = document.querySelector(".feedback-up");
    const feedbackTurn = document.querySelector(".feedback-turn");
    const feedbackUpForm = document.querySelector(".feedback-up__form");
    const feedbackUpClose = document.querySelector(".feedback-up__close");
    const feedbackUpBtnSend = document.querySelector(".feedback-up__btn-send");
    const content = document.querySelector("#content");

    if (window.localStorage.getItem("feedbackUp") == "hidden") {
      feedbackTurn.classList.add("active");
      content.style.zIndex = "15";
    } else if (
      document.URL == "https://food-store.by/" &&
      window.localStorage.getItem("feedbackUp-close") == "hidden-close"
    ) {
      // console.log("главная ", document.URL);
      setTimeout(function () {
        feedbackUp.classList.add("active");
        content.style.zIndex = "15";
      }, 5000);
    } else if (
      document.URL != "https://food-store.by/" &&
      window.localStorage.getItem("feedbackUp-close") == "hidden-close"
    ) {
      feedbackTurn.classList.add("active");
      content.style.zIndex = "15";
    } else {
      setTimeout(function () {
        feedbackUp.classList.add("active");
        content.style.zIndex = "15";
      }, 5000);
    }

    // if (window.localStorage.getItem("feedbackUp") == "hidden") {
    //   feedbackTurn.classList.add("active");
    //   content.style.zIndex = "15";
    // } else {
    //   setTimeout(function () {
    //     feedbackUp.classList.add("active");
    //     content.style.zIndex = "15";
    //   }, 5000);
    // }

    feedbackUpBtnSend.addEventListener("click", function (e) {
      e.preventDefault();
      const answer = document.querySelector(".feedback-up__answer");
      const captcha_yes = document.querySelector(".capcha_yes");
      // console.log(captcha_yes.value);
      const formData = new FormData(feedbackUpForm);
      // const captcha = grecaptcha.getResponse().length;
      // console.log(grecaptcha.getResponse().length);
      if (captcha_yes.value === "Нет") {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
          if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            feedbackUp.classList.remove("active");
            feedbackTurn.classList.add("active");
            content.style.zIndex = "";
            window.localStorage.setItem("feedbackUp", "hidden");
            answer.value = "";
          }
        };
        xmlHttp.open(
          "POST",
          "https://food-store.by/bitrix/templates/aspro_optimus/components/bitrix/main.include/survey/send.php"
        );
        xmlHttp.send(formData);
      } else {
        if (grecaptcha.getResponse().length) {
          const xmlHttp = new XMLHttpRequest();
          xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
              feedbackUp.classList.remove("active");
              feedbackTurn.classList.add("active");
              content.style.zIndex = "";
              window.localStorage.setItem("feedbackUp", "hidden");
              answer.value = "";
            }
          };
          xmlHttp.open(
            "POST",
            "https://food-store.by/bitrix/templates/aspro_optimus/components/bitrix/main.include/survey/send.php"
          );
          xmlHttp.send(formData);
        } else {
          $("#recaptchaError").text('* Вы не прошли проверку "Я не робот"');
          console.log("бот");
        }
      }
    });

    feedbackUpClose.addEventListener("click", function (e) {
      e.preventDefault();
      feedbackUp.classList.remove("active");
      feedbackTurn.classList.add("active");
      content.style.zIndex = "";
      window.localStorage.setItem("feedbackUp-close", "hidden-close");
    });

    feedbackTurn.addEventListener("click", function (e) {
      e.preventDefault();
      feedbackUp.classList.add("active");
      feedbackTurn.classList.remove("active");
      content.style.zIndex = "15";
    });
  },
  false
);
