var $moreBtn = $('#more');
$moreBtn.on('click tap', '>a', function () {
  if ($moreBtn.is('ajax')) return;
  var file = '../../ajax.php';
  var skuInfo = $moreBtn.data();
  $.ajax({
    url: file,
    cache: false,
    data: {
      id: skuInfo.productId || 0,
      pager: skuInfo.pager || 1,
      debug: skuInfo.debug || 0,
    },
    dataType: 'json',
    beforeSend: function () {
      $moreBtn.addClass('ajax');
    },
    success: function (json) {
      json = json || {};
      $('#fabrics .flex').append(json.html || '');
      json.last ? $moreBtn.remove() : $moreBtn.data('pager', json.pager || 0);
    },
    complete: function () {
      $moreBtn.removeClass('ajax');
    },
  });
});

var scrollToAnchor = function (hash) {
  if (hash) {
    window.scrollTo(0, 0);
    var term = $(hash);
    if (term) {
      var scrollto = term.offset().top;
      var id = term.attr('id');
      var name = term.attr('name');
      term.removeAttr('id').removeAttr('name');
      $('html, body').animate({ scrollTop: scrollto }, 1000);
    }
  }
};

if (location.hash) {
  scrollToAnchor(location.hash);
}

$(document).ready(function () {
  var $wcProductCard = $('.product-card');
  var $wcAdvantages = $('.wc-af-advantages');
  $wcProductCard.wcProductCard({
    test: true,
  });
  //mobile menu toggle
  $('.h-menu__btn').click(function () {
    $('.h-menu').slideDown();
  });
  $('.h-menu__btn-close').click(function () {
    $('.h-menu').slideUp();
  });
  //mobile submenu
  if ($(window).width() < 768) {
    var btn = $('.sub > a');
    btn.click(function (e) {
      e.preventDefault();
      var parent = $(this).closest('.sub');
      var submenu = parent.find('.h-submenu');
      parent.toggleClass('open');
      if (parent.hasClass('open')) {
        submenu.slideDown();
      } else {
        submenu.slideUp();
      }
    });
  }
  //js-parnters-slider
  if ($('.js-parnters-slider')) {
    $('.js-parnters-slider').slick({
      arrows: false,
      dots: true,
      slidesToShow: 7,
      slidesToScroll: 7,
      responsive: [
        {
          breakpoint: 1560,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5,
          },
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 400,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }
  //js-news-slider
  if ($('.js-news-slider')) {
    $('.js-news-slider').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }

  $('.customers__slider').slick({
    dots: false,
    infinite: true,
    speed: 500,
    cssEase: 'linear',
    autoplay: true,
    autoplaySpeed: 3000,
    //adaptiveHeight: true,
    variableWidth: true,
    centerMode: true,
    //centerPadding: 50px,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 2,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
    ],
  });

  $('.sert__slider').slick({
    dots: false,
    infinite: true,
    speed: 1000,
    cssEase: 'linear',
    autoplay: true,
    autoplaySpeed: 3000,
    variableWidth: true,
    centerMode: true,
    arrows: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
    ],
  });

  $('.slider-range').slider({
    min: 80,
    max: 160,
  });
  $('.slider-range').on('slidechange', function (event, ui) {
    $(ui.handle)
      .parent()
      .parent()
      .find('.slider-head .ff-b')
      .text(ui.value + 'см');
  });

  //lightbox
  $(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox();
  });

  $('.js-open-filter').on('click', function () {
    var $this = $(this),
      $parent = $this.parent(),
      $spanText = $this.find('span');
    if ($parent.hasClass('is-show')) {
      $spanText.text('Открыть фильтр');
    } else {
      $spanText.text('Закрыть фильтр');
    }

    $parent.toggleClass('is-show');
    return false;
  });

  $('.js-open-filter2').on('click', function () {
    var $this = $(this),
      $parent = $this.parent(),
      $spanText = $this.find('span');
    if ($parent.hasClass('is-show')) {
      $spanText.text('Открыть разделы');
    } else {
      $spanText.text('Скрыть разделы');
    }

    $parent.toggleClass('is-show');
    return false;
  });

  $(
    '.btn.btn-contur.btn-consultation, .btn.btn-contur-orange.btn-consult, .product-card__promos .btn.btn-gradient.btn-gradient--2.btn-block.ff-b, .worry-customer .info-block-button'
  ).on('click', function () {
    $('#modal_consultation').addClass('active');
  });

  $('.btn_zamerschik').on('click', function () {
    $('#form_text_43').val(window.location.origin + window.location.pathname);
    $('#modal_zamerschik').addClass('active');
    /**/
  });

  var $offerList = $('.product-card__color ul li');

  $('.btn-lg.form').on('click', function () {
    var $color = $('.product-card__color'),
      $glass = $('.product-card__glass input:checked + label'),
      text = [];
    $.map($offerList.filter('.selected'), function (elem) {
      var $elem = $(elem),
        $group = $('>span', $elem.closest('.product-card__color'));
      text.push($group.text() + ': ' + $elem.attr('title'));
    });

    $('#form_text_15').val(window.location.origin + window.location.pathname);
    $('#form_text_16').val(text.join(', '));
    $('#form_text_17').val(' ');

    $('#modal_order').addClass('active');
  });

  $('.btn_calc_order').on('click', function () {
    $('#form_text_37').val(window.location.origin + window.location.pathname);
    $('#modal_calc_order').addClass('active');
  });

  $('.btn-window-calculator').on('click', function () {
    var search = window.location.search.substr(1),
      keys = [];

    search.split('&').forEach(function (item) {
      item = item.split('=');
      keys[item[0]] = item[1];
    });
    $('#form_text_50').val(keys['type']);

    var $type = $('.calculator-block > .nav-tabs--calc li.active a'),
      $conf = $('.calculator-block > .tab-content input:checked'),
      $params = $('#form_text_23');

    $('#form_text_21').val($type.data('type'));
    $('#form_text_22').val($conf.attr('id'));

    $('#window-f1, #window-f2, #window-f3, #window-f4, #window-f5, #window-f6, #window-f7, #window-f8').each(
      function () {
        var $this = $(this);
        if ($this.prop('checked')) {
          $params.val($params.val() + $this.next().text() + ': Да \r\n');
        }
      }
    );

    $('#form_text_24').val($('#window-width').text() + '/' + $('#window-height').text());
    $('#form_text_25').val($('#window-amount').val());

    $('#modal_order_window').addClass('active');
  });

  $('.btn-frame-calculator').on('click', function () {
    var $type = $('.calculator-block > .nav-tabs--calc li.active a'),
      $conf = $('.calculator-block > .tab-content input:checked'),
      $params = $('#form_text_31');

    $('#form_text_29').val($type.data('type'));
    $('#form_text_30').val($conf.attr('id'));

    $('#window-f1, #window-f2, #window-f3, #window-f4, #window-f5, #window-f6, #window-f7, #window-f8').each(
      function () {
        var $this = $(this);
        if ($this.prop('checked')) {
          $params.val($params.val() + $this.next().text() + ': Да \r\n');
        }
      }
    );

    $('#form_text_32').val($('#window-width').text() + '/' + $('#window-height').text());
    $('#form_text_33').val($('#window-amount').val());

    $('#modal_order_frame').addClass('active');
  });

  $('button.close').on('click', function () {
    $('.consultation').removeClass('active');
    $('.order-form').removeClass('active');
  });

  //filter
  $('.js-filter-btn').click(function (e) {
    e.preventDefault();
    var btn = $(this),
      parent = btn.closest('.js-filter-block'),
      body = parent.find('.js-filter-body');

    parent.toggleClass('filter-close');
    if (parent.hasClass('filter-close')) {
      body.slideUp();
    } else {
      body.slideDown();
    }
  });
  //$wcAdvantages.wcAdvantages();

  //mobile btns
  $('.h-top__mobile-phones-btn').click(function () {
    $('.h-top__phones').slideToggle();
  });
  $('.h-top__mobile-contacts-btn').click(function () {
    $('.h-top__contacts').slideToggle();
  });

  $('.h-top__phones-block .inner a, .info-block-phone, .contact-phone').on('click', function () {
    yaCounter50150053.reachGoal('phone_call');
    dataLayer.push({ event: 'zvonok' });
    console.log('Звонок по телефону');
  });

  //section-filter
  // $(".js-filter-submenu").click(function (e) {
  //     // e.preventDefault();
  //     var btn = $(this);
  //     var parent = btn.closest(".section-filter__item2");
  //     var body = parent.find(".section-filter__list3");

  //     parent.toggleClass("filter-submenu-close");
  //     if (parent.hasClass("filter-submenu-close")) {
  //         body.slideUp();
  //     } else {
  //         body.slideDown();
  //     }
  // });

  $('.inner.section-filter').on('click', '.open-button', function () {
    $(this).toggleClass('active').parent().next('ul.menu-sub').slideToggle();
  });
});
