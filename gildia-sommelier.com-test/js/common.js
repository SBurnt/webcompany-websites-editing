function scrollAnimations() {
  inView.offset({ top: 0, bottom: 100 }),
    inView(".anim-cont").on("enter", function (e) {
      e.classList.add("active");
    });
}
function masktel() {
  var e = document.getElementById("nameInp"),
    t = new Inputmask({
      showMaskOnHover: !1,
      showMaskOnFocus: !1,
      regex:
        '^[а-яёА-ЯЁ()-/-+*?:%;№"!]+ [а-яёА-ЯЁ()-/-+*?:%;№"!]+ [а-яёА-ЯЁ()-/-+*?:%;№"!]+$',
    });
  t.mask(e);
  var n = document.getElementById("birth"),
    a = new Inputmask({
      showMaskOnHover: !1,
      alias: "date",
      placeholder: "ДД/ММ/ГГГГ",
      yearrange: { minyear: 1900, maxyear: new Date().getFullYear() - 15 },
    });
  a.mask(n);
  var o = document.getElementById("telInp"),
    r = new Inputmask("+375 (99) 999 99 99", { showMaskOnHover: !1 });
  r.mask(o);
}
function validateForms() {
  var e = $(".js-validate");
  e.length &&
    e.each(function () {
      var e = $(this);
      $.validate({
        form: e,
        borderColorOnError: !0,
        scrollToTopOnError: !1,
        onSuccess: function (t) {
          return (
            e[0].reset(),
            e.addClass("complete"),
            setTimeout(function () {
              e.removeClass("complete");
            }, 1500),
            !1
          );
        },
      });
    });
}
function Slider() {
  var e = $(".js-slider");
  if (e.length) {
    var t = document.querySelector(".carousel-status");
    setTimeout(function () {
      e.each(function () {
        function e() {
          var e = s.selectedIndex + 1;
          t.textContent = e + "/" + s.slides.length;
        }
        var n = $(this);
        n.flickity({
          imagesLoaded: !0,
          percentPosition: !0,
          cellSelector: ".slider-element",
          accessibility: !0,
          pageDots: !1,
          setGallerySize: !1,
          initialIndex: 0,
          autoPlay: 6500,
          pauseAutoPlayOnHover: !1,
          arrowShape: { x0: 10, x1: 60, y1: 50, x2: 65, y2: 45, x3: 20 },
        }),
          n.flickity("stopPlayer");
        var a = n.find(".slider-element .slider-element-inner"),
          o = document.documentElement.style,
          r = "string" == typeof o.transform ? "transform" : "WebkitTransform",
          s = n.data("flickity");
        n.on("scroll.flickity", function () {
          s.slides.forEach(function (e, t) {
            var n = a[t],
              o = ((e.target + s.x) * -1) / 3;
            n.style[r] = "translateX(" + o + "px)";
          });
        });
        var i = n.find(".flickity-prev-next-button");
        i.detach().appendTo($(".slider-counter")), e(), s.on("select", e);
      });
    }, 100);
  }
}
document.addEventListener("DOMContentLoaded", function () {
  validateForms(), Slider(), scrollAnimations(), masktel();
});
