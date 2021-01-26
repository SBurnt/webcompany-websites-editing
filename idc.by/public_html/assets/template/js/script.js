if ($('.clients')) {
  $('.clients').slick({
    slidesToShow: 7,
    autoplay: true,
    autoplaySpeed: 2000,
    swipeToSlide: true,
    arrows: false,
  });
}

var phone = $('.block-form__phone');
var time = $('.time-mask');

if (phone) {
  jQuery(function ($) {
    $('.block-form__phone').mask('+375 (99) 999-99-99');
  });

  jQuery(function ($) {
    $('.time-mask').mask('99:99');
  });

  !(function (a) {
    'function' == typeof define && define.amd
      ? define(['jquery'], a)
      : a('object' == typeof exports ? require('jquery') : jQuery);
  })(function (a) {
    var b,
      c = navigator.userAgent,
      d = /iphone/i.test(c),
      e = /chrome/i.test(c),
      f = /android/i.test(c);
    (a.mask = {
      definitions: { 9: '[0-9]', a: '[A-Za-z]', '*': '[A-Za-z0-9]' },
      autoclear: !0,
      dataName: 'rawMaskFn',
      placeholder: '_',
    }),
      a.fn.extend({
        caret: function (a, b) {
          var c;
          if (0 !== this.length && !this.is(':hidden'))
            return 'number' == typeof a
              ? ((b = 'number' == typeof b ? b : a),
                this.each(function () {
                  this.setSelectionRange
                    ? this.setSelectionRange(a, b)
                    : this.createTextRange &&
                      ((c = this.createTextRange()),
                      c.collapse(!0),
                      c.moveEnd('character', b),
                      c.moveStart('character', a),
                      c.select());
                }))
              : (this[0].setSelectionRange
                  ? ((a = this[0].selectionStart), (b = this[0].selectionEnd))
                  : document.selection &&
                    document.selection.createRange &&
                    ((c = document.selection.createRange()),
                    (a = 0 - c.duplicate().moveStart('character', -1e5)),
                    (b = a + c.text.length)),
                { begin: a, end: b });
        },
        unmask: function () {
          return this.trigger('unmask');
        },
        mask: function (c, g) {
          var h, i, j, k, l, m, n, o;
          if (!c && this.length > 0) {
            h = a(this[0]);
            var p = h.data(a.mask.dataName);
            return p ? p() : void 0;
          }
          return (
            (g = a.extend({ autoclear: a.mask.autoclear, placeholder: a.mask.placeholder, completed: null }, g)),
            (i = a.mask.definitions),
            (j = []),
            (k = n = c.length),
            (l = null),
            a.each(c.split(''), function (a, b) {
              '?' == b
                ? (n--, (k = a))
                : i[b]
                ? (j.push(new RegExp(i[b])), null === l && (l = j.length - 1), k > a && (m = j.length - 1))
                : j.push(null);
            }),
            this.trigger('unmask').each(function () {
              function h() {
                if (g.completed) {
                  for (var a = l; m >= a; a++) if (j[a] && C[a] === p(a)) return;
                  g.completed.call(B);
                }
              }
              function p(a) {
                return g.placeholder.charAt(a < g.placeholder.length ? a : 0);
              }
              function q(a) {
                for (; ++a < n && !j[a]; );
                return a;
              }
              function r(a) {
                for (; --a >= 0 && !j[a]; );
                return a;
              }
              function s(a, b) {
                var c, d;
                if (!(0 > a)) {
                  for (c = a, d = q(b); n > c; c++)
                    if (j[c]) {
                      if (!(n > d && j[c].test(C[d]))) break;
                      (C[c] = C[d]), (C[d] = p(d)), (d = q(d));
                    }
                  z(), B.caret(Math.max(l, a));
                }
              }
              function t(a) {
                var b, c, d, e;
                for (b = a, c = p(a); n > b; b++)
                  if (j[b]) {
                    if (((d = q(b)), (e = C[b]), (C[b] = c), !(n > d && j[d].test(e)))) break;
                    c = e;
                  }
              }
              function u() {
                var a = B.val(),
                  b = B.caret();
                if (o && o.length && o.length > a.length) {
                  for (A(!0); b.begin > 0 && !j[b.begin - 1]; ) b.begin--;
                  if (0 === b.begin) for (; b.begin < l && !j[b.begin]; ) b.begin++;
                  B.caret(b.begin, b.begin);
                } else {
                  for (A(!0); b.begin < n && !j[b.begin]; ) b.begin++;
                  B.caret(b.begin, b.begin);
                }
                h();
              }
              function v() {
                A(), B.val() != E && B.change();
              }
              function w(a) {
                if (!B.prop('readonly')) {
                  var b,
                    c,
                    e,
                    f = a.which || a.keyCode;
                  (o = B.val()),
                    8 === f || 46 === f || (d && 127 === f)
                      ? ((b = B.caret()),
                        (c = b.begin),
                        (e = b.end),
                        e - c === 0 && ((c = 46 !== f ? r(c) : (e = q(c - 1))), (e = 46 === f ? q(e) : e)),
                        y(c, e),
                        s(c, e - 1),
                        a.preventDefault())
                      : 13 === f
                      ? v.call(this, a)
                      : 27 === f && (B.val(E), B.caret(0, A()), a.preventDefault());
                }
              }
              function x(b) {
                if (!B.prop('readonly')) {
                  var c,
                    d,
                    e,
                    g = b.which || b.keyCode,
                    i = B.caret();
                  if (!(b.ctrlKey || b.altKey || b.metaKey || 32 > g) && g && 13 !== g) {
                    if (
                      (i.end - i.begin !== 0 && (y(i.begin, i.end), s(i.begin, i.end - 1)),
                      (c = q(i.begin - 1)),
                      n > c && ((d = String.fromCharCode(g)), j[c].test(d)))
                    ) {
                      if ((t(c), (C[c] = d), z(), (e = q(c)), f)) {
                        var k = function () {
                          a.proxy(a.fn.caret, B, e)();
                        };
                        setTimeout(k, 0);
                      } else B.caret(e);
                      i.begin <= m && h();
                    }
                    b.preventDefault();
                  }
                }
              }
              function y(a, b) {
                var c;
                for (c = a; b > c && n > c; c++) j[c] && (C[c] = p(c));
              }
              function z() {
                B.val(C.join(''));
              }
              function A(a) {
                var b,
                  c,
                  d,
                  e = B.val(),
                  f = -1;
                for (b = 0, d = 0; n > b; b++)
                  if (j[b]) {
                    for (C[b] = p(b); d++ < e.length; )
                      if (((c = e.charAt(d - 1)), j[b].test(c))) {
                        (C[b] = c), (f = b);
                        break;
                      }
                    if (d > e.length) {
                      y(b + 1, n);
                      break;
                    }
                  } else C[b] === e.charAt(d) && d++, k > b && (f = b);
                return (
                  a
                    ? z()
                    : k > f + 1
                    ? g.autoclear || C.join('') === D
                      ? (B.val() && B.val(''), y(0, n))
                      : z()
                    : (z(), B.val(B.val().substring(0, f + 1))),
                  k ? b : l
                );
              }
              var B = a(this),
                C = a.map(c.split(''), function (a, b) {
                  return '?' != a ? (i[a] ? p(b) : a) : void 0;
                }),
                D = C.join(''),
                E = B.val();
              B.data(a.mask.dataName, function () {
                return a
                  .map(C, function (a, b) {
                    return j[b] && a != p(b) ? a : null;
                  })
                  .join('');
              }),
                B.one('unmask', function () {
                  B.off('.mask').removeData(a.mask.dataName);
                })
                  .on('focus.mask', function () {
                    if (!B.prop('readonly')) {
                      clearTimeout(b);
                      var a;
                      (E = B.val()),
                        (a = A()),
                        (b = setTimeout(function () {
                          B.get(0) === document.activeElement &&
                            (z(), a == c.replace('?', '').length ? B.caret(0, a) : B.caret(a));
                        }, 10));
                    }
                  })
                  .on('blur.mask', v)
                  .on('keydown.mask', w)
                  .on('keypress.mask', x)
                  .on('input.mask paste.mask', function () {
                    B.prop('readonly') ||
                      setTimeout(function () {
                        var a = A(!0);
                        B.caret(a), h();
                      }, 0);
                  }),
                e && f && B.off('input.mask').on('input.mask', u),
                A();
            })
          );
        },
      });
  });
}

var btnMenu = document.querySelector('.header__nav-btn'),
  icon = document.querySelector('.flaticon-bars'),
  menu = document.querySelector('.header__menu');

CLASSES = {
  MENU_BUTTON: 'flaticon-bars',
  CLOSE_BUTTON: 'flaticon-cancel',
};

if (btnMenu && window.innerWidth < 866) {
  btnMenu.addEventListener('click', function () {
    var btn = event.target;

    icon.classList.toggle(CLASSES.MENU_BUTTON);
    icon.classList.toggle(CLASSES.CLOSE_BUTTON);

    menu.classList.toggle('open');
  });
}

if ($('.advantage')) {
  $(document).ready(function () {
    $('.advantage').on('click', '.advantage__more', function () {
      $('.advantage .advantage__item').removeClass('open');
      $(this).closest('.advantage__item').addClass('open');
    });
  });

  $(document).ready(function () {
    $('.advantage__less').on('click', function (ev) {
      ev.preventDefault();
      $('.advantage__less').closest('.advantage__item').removeClass('open');
    });
  });
}

if ($('.upper-header__nav')) {
  $('.upper-header__nav a').click(function () {
    var href = $.attr(this, 'href');
    $('html, body').animate(
      {
        scrollTop: $(href).offset().top,
      },
      500
    );
    return false;
  });
}

if ($('.header__content')) {
  $('.header__content a').click(function () {
    var href = $.attr(this, 'href');
    $('html, body').animate(
      {
        scrollTop: $(href).offset().top,
      },
      500
    );
    return false;
  });
}

if ($('.contact-address').length > 0) {
  window.onscroll = function () {
    var formWidth = 585;
    var widthFromTop;
    var contactHeight = $('.contact-address').height();
    var contactPadding = 140;
    var contactHeightPadding = contactHeight + contactPadding;
    var scrollBottom = formWidth - contactHeightPadding;
    var scrolled = window.pageYOffset || document.documentElement.scrollTop;
    widthFromTop = $('.contact-address').offset().top - $(window).scrollTop();
    if (widthFromTop > 55) {
      $('.block-form__waypoint').removeClass('pos-fix');
    }
    if (widthFromTop <= 55) {
      $('.block-form__waypoint').addClass('pos-fix');
    }
    if (widthFromTop <= 55 && widthFromTop > scrollBottom + 30) {
      $('.block-form__waypoint').addClass('pos-fix').removeClass('pos-re');
    }
    if (widthFromTop < scrollBottom + 30) {
      $('.block-form__waypoint').removeClass('pos-fix').addClass('pos-re');
    }
  };
}

//popup

var popupOpen = document.querySelectorAll('.popup-open');
var popupClose = document.querySelector('.popup-close');
var popup = document.querySelector('.popup');
var popupWrapper = document.querySelector('.popup-wrapper');
var body = document.querySelector('body');

// if (popupOpen) {
//   popupOpen.forEach(function(btn) {
//     btn.addEventListener('click', function(event) {
//       event.preventDefault();

//       popupWrapper.classList.toggle('popup-wrapper-hide');
//       body.classList.toggle('fixed');
//       popup.classList.toggle('open');
//     });
//   });
//   popupClose.addEventListener('click', function(event) {
//     event.preventDefault();

//     popupWrapper.classList.toggle('popup-wrapper-hide');
//     body.classList.toggle('fixed');
//     popup.classList.toggle('open');
//   });

//   window.onclick = function(event) {
//     if (event.target == popupWrapper) {
//       popupWrapper.classList.toggle('popup-wrapper-hide');
//       body.classList.toggle('fixed');
//       popup.classList.toggle('open');
//     }
//   }
// }

//popup ie

if ($('.popup-open')) {
  $('.popup-open').on('click', function (e) {
    e.preventDefault();
    $('.popup-wrapper').toggleClass('popup-wrapper-hide');
    $('body').toggleClass('fixed');
    $('.popup').toggleClass('open');
  });
  $('.popup-close').on('click', function () {
    $('.popup-wrapper').toggleClass('popup-wrapper-hide');
    $('body').removeClass('fixed');
    $('.popup').toggleClass('open');
  });

  $(window).on('click', function (event) {
    if ($(event.target).hasClass('popup-wrapper')) {
      popupWrapper.classList.toggle('popup-wrapper-hide');
      body.classList.toggle('fixed');
      popup.classList.toggle('open');
    }
  });
}

if ($('.plans-compare')) {
  $('.plans-compare__row').each(function () {
    var html = $(this).html();

    switch (html) {
      case '-':
        $(this).html('<i class="flaticon-cancel"></i>');
        break;
      case '+':
        $(this).html('<i class="flaticon-check"></i>');
        break;
      default:
        break;
    }
  });
}

/*popup on window tab close*/
var ctr;

if ('' == window.name) {
  window.name = 'visited';
  ctr = localStorage.getItem('tabsCounter');
  console.log(ctr);

  if (ctr !== null) {
    ctr = parseInt(ctr) + 1;
    localStorage.setItem('tabsCounter', ctr);
  } else {
    localStorage.setItem('tabsCounter', '1');
    localStorage.setItem('popupStatus', '0');
  }
}

$(window).on('beforeunload', function () {
  ctr = localStorage.getItem('tabsCounter');

  if (ctr !== '1') {
    ctr = parseInt(ctr) - 1;
    localStorage.setItem('tabsCounter', ctr);
  } else {
    localStorage.removeItem('tabsCounter');
    localStorage.removeItem('popupStatus');
  }
});

$(document).mouseleave(function () {
  if (localStorage.getItem('tabsCounter') === '1' && localStorage.getItem('popupStatus') === '0') {
    popupWrapper.classList.toggle('popup-wrapper-hide');
    body.classList.toggle('fixed');
    popup.classList.toggle('open');

    localStorage.setItem('popupStatus', '1');
  }
});

//form to sms

$('.formToSms').submit(function (ev) {
  ev.preventDefault();

  var msg, t;

  if (formValidation($(this))) {
    $(this)
      .find('input')
      .each(function () {
        t = $(this);

        if (t.attr('name') !== 'validation') {
          if (t.attr('name') === 'page') {
            msg = t.val();
          } else {
            if (t.val()) {
              if (t.attr('name') === 'phone') {
                msg = msg + ', ' + t.val().replace(/[ \-\+\(\)]/g, '');
              } else {
                msg =
                  msg +
                  ', ' +
                  t
                    .val()
                    .replace(/[^ а-яА-Яa-zA-Z0-9]/g, '')
                    .replace(/\s+/g, ' ');
              }
            }
          }
        }
      });

    var reqMessage = msg.replace(/ /g, '+');

    smsMessageReq(reqMessage);
    //console.log(reqMessage);
  } else {
    alert('Валидация не пройдена');
  }
});

function formValidation(form) {
  if (form.find('input[name="validation"]').val() === '') {
    //return true;
    if (form.find('input[name="phone"]').val().indexOf('_') !== -1) {
      alert('Пожалуйста введите номер телефона');
    } else {
      return true;
    }
  } else {
    return false;
  }
}

function smsMessageReq(message) {
  $.post(
    '/assets/components/smssending/smsSending.php',
    {
      smsmessage: message,
    },
    onAjaxSuccess
  );
}

//subscrib on email

$('.formSubscrib').submit(function (ev) {
  ev.preventDefault();

  var form = $(this);

  //if(formValidation(form)) {

  var req = '/assets/components/mailerlite/addSubscribers.php?' + $(this).serialize();

  $.get(req, function (data, status) {
    if (data) {
      alert('Подписка прошла успешно');

      form.find('input').each(function () {
        if ($(this).attr('name') !== 'group') {
          $(this).val('');
        }
      });
    }
  });

  // } else {
  //   alert('Валидация не пройдена');
  // }
});

$(document).ready(function () {
  var planning = $('.planning-pic');

  if (planning) {
    $(planning).each(function () {
      var imgSource = [];
      var imgAlt = [];

      $(this)
        .addClass('d-flex flex-wrap')
        .find('img')
        .each(function () {
          imgSource.push($(this).attr('src'));
          imgAlt.push($(this).attr('alt'));
        });

      $(this).html('');

      for (var i = 0; i < imgSource.length; i++) {
        $(this).append(
          '<div class="planning-pic__item d-flex flex-direction-column align-items-center"><div class="planning-pic__img"><a href="' +
            imgSource[i] +
            '" class="pos-relative flaticon-search text-decoration-none d-flex justify-content-center pos-relative"><img src="' +
            imgSource[i] +
            '" alt="' +
            imgAlt[i] +
            '"><span class="text-uppercase pos-absolute">Посмотреть</span></a></div><div class="planning-pic__title text-align-center">' +
            imgAlt[i] +
            '</div></div>'
        );
      }
    });

    baguetteBox.run('.planning-pic');
  }
});

if ($('.sticky').length > 0) {
  var win = $(window),
    nav = $('.sticky'),
    pos = nav.offset().top,
    aaa = function () {
      win.scrollTop() > 150 ? nav.addClass('visib') : nav.removeClass('visib');
    };
  win.scroll(aaa);
}

$(document).ready(function () {
  // кнопка наверх при скролле страницы вниз
  $(window).scroll(function () {
    if ($(this).scrollTop() > 700) {
      $('#upButton').show();
    } else {
      $('#upButton').hide();
    }
  });

  $(document).on('click', '#upButton', function () {
    $('html, body').animate({ scrollTop: 0 }, 500);
  });

  // попап телефонов в шапке мобилка
  var headerPhoneBtnMob = $('.header__phone-btn_mob');
  var upperHeaderPhones = $('.header__phones-wrap .upper-header__phones');
  headerPhoneBtnMob.on('click', function () {
    upperHeaderPhones.toggleClass('open');
    headerPhoneBtnMob.toggleClass('open');
  });

  var btnFirstMenu = $('.submenu_wrapp > a.first');
  btnFirstMenu.on('click', function (e) {
    e.preventDefault();
  });

  $('.slider-wrap').each(function () {
    $('.slider-for', $(this)).slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      fade: true,
      arrows: false,
      // draggable: false,
      // variableWidth: true,
      asNavFor: $(this).find('.slider-nav'),
    });

    $('.slider-nav', $(this)).slick({
      slidesToShow: 6,
      slidesToScroll: 1,
      infinite: true,
      // centerMode: true,
      focusOnSelect: true,
      arrows: true,
      asNavFor: $(this).find('.slider-for'),
      dots: false,
      variableWidth: true,
      responsive: [
        {
          breakpoint: 500,
          settings: {
            slidesToShow: 5,
            arrows: false,
          },
        },
        {
          breakpoint: 320,
          settings: {
            slidesToShow: 4,
            arrows: false,
          },
        },
      ],
    });
    $('.slider-nav .slick-prev').addClass('flaticon-arrows-2');
    $('.slider-nav .slick-next').addClass('flaticon-arrows-3');
  });
});

$(document).ready(function () {
  function getContentMapInfoWindow(phone, time, street, undeground, title, imgSrc) {
    return (
      '<div class="map__info-window">' +
      '<p class="map__phone">' +
      phone +
      '</p>' +
      '<p class="map__time">' +
      time +
      '</p>' +
      '<p class="map__street">' +
      street +
      '</p>' +
      '<p class="map__undeground">' +
      undeground +
      '</p>' +
      '<p class="map__title">' +
      title +
      '</p>' +
      '<img class="map__img" src="' +
      imgSrc +
      '">' +
      '</div>'
    );
  }
  function initMap() {
    const academy = {
      lat: 53.914451,
      lng: 27.602013,
    };
    const terminal = {
      lat: 53.921381,
      lng: 27.56355,
    };
    const hermes = {
      lat: 53.865435,
      lng: 27.524159,
    };
    const valeo = {
      lat: 53.923049,
      lng: 27.671737,
    };
    const alians = {
      lat: 53.883537,
      lng: 27.511742,
    };

    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      center: terminal,
      zoomControl: true,
      // mapTypeControl: false,
      scaleControl: true,
      streetViewControl: false,
      scrollwheel: false,
    });

    const infowindowAcademy = new google.maps.InfoWindow({
      content: getContentMapInfoWindow(
        '+375 (29) 6 835 835,<br> +375 (44) 5 235 235',
        '24/7',
        'ул. Платонова, 49',
        'ст.м. Академия Наук',
        'БЦ Академия',
        'images/objects/academy/object-bg1.jpg'
      ),
      maxWidth: 268,
      minWidth: 268,
    });
    const markerAcademy = new google.maps.Marker({
      position: academy,
      map: map,
      title: 'БЦ Академия',
    });
    markerAcademy.addListener('click', function () {
      infowindowTerminal.close();
      infowindowAlians.close();
      infowindowValeo.close();
      infowindowHermes.close();
      infowindowAcademy.open(map, markerAcademy);
    });

    const infowindowTerminal = new google.maps.InfoWindow({
      content: getContentMapInfoWindow(
        '+375 (44) 7 833 833',
        '24/7',
        'ул. В.Хоружей, 25/3',
        'ст.м. пл. Якуба Коласа',
        'БЦ Терминал',
        'images/objects/terminal/Terminal.jpg'
      ),
      maxWidth: 268,
      minWidth: 268,
    });
    const markerTerminal = new google.maps.Marker({
      position: terminal,
      map: map,
      title: 'БЦ Терминал',
    });
    markerTerminal.addListener('click', function () {
      infowindowAcademy.close();
      infowindowAlians.close();
      infowindowValeo.close();
      infowindowHermes.close();
      infowindowTerminal.open(map, markerTerminal);
    });

    const infowindowHermes = new google.maps.InfoWindow({
      content: getContentMapInfoWindow(
        '+375 (17) 278 70 52',
        '24/7',
        'ул. Казинца, 11а',
        'ст.м. Институт Культуры',
        'БЦ Гермес',
        'images/objects/hermes/Hermes.jpg'
      ),
      maxWidth: 268,
      minWidth: 268,
    });
    const markerHermes = new google.maps.Marker({
      position: hermes,
      map: map,
      title: 'БЦ Гермес',
    });
    markerHermes.addListener('click', function () {
      infowindowAcademy.close();
      infowindowAlians.close();
      infowindowValeo.close();
      infowindowTerminal.close();
      infowindowHermes.open(map, markerHermes);
    });

    const infowindowValeo = new google.maps.InfoWindow({
      content: getContentMapInfoWindow(
        '+375 (17) 263 21 83',
        '24/7',
        'ул. Ф.Скорины, 12',
        'ст.м. Восток',
        'БЦ Valeo',
        'images/objects/valeo/Valeo.jpg'
      ),
      maxWidth: 268,
      minWidth: 268,
    });
    const markerValeo = new google.maps.Marker({
      position: valeo,
      map: map,
      title: 'БЦ Valeo',
    });
    markerValeo.addListener('click', function () {
      infowindowAcademy.close();
      infowindowAlians.close();
      infowindowHermes.close();
      infowindowTerminal.close();
      infowindowValeo.open(map, markerValeo);
    });

    const infowindowAlians = new google.maps.InfoWindow({
      content: getContentMapInfoWindow(
        '+375 (17) 328 94 82',
        '24/7',
        'ул. 3-я ул. Щорса, д.9',
        'ст.м. Грушевка',
        'БЦ Альянс',
        'images/objects/alians/Alians.jpg'
      ),
      maxWidth: 268,
      minWidth: 268,
    });
    const markerAlians = new google.maps.Marker({
      position: alians,
      map: map,
      title: 'БЦ Альянс',
    });
    markerAlians.addListener('click', function () {
      infowindowAcademy.close();
      infowindowValeo.close();
      infowindowHermes.close();
      infowindowTerminal.close();
      infowindowAlians.open(map, markerAlians);
    });
  }
  initMap();
});

$(document).ready(function () {
  // $('body,html').scrollTop(0);
  // $('.offer-main__medium').on('click', 'a', function (event) {
  //   var id = $(this).attr('href'),
  //     top = $(id).offset().top - 150; //-70px это у меня приклеиное меню, если подскажите как якоря сдлеать -70px, буду признателен
  //   $('body,html').animate({ scrollTop: top }, 1500);
  // });
  // var hash = location.hash;
  // if ($(hash).length) {
  //   var top = $(hash).offset().top - 150;
  //   $('body,html').animate({ scrollTop: top }, 0);
  // }
});
