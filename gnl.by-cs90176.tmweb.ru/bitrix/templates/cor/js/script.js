var needOffset = 0;
var elementsWidth = 0;
function ARCORP_hideLis(resize) {
  if ($('.main-menu-nav').length > 0) {
    var $menu = $('.main-menu-nav');
    $menu.find('.other').removeAttr('style');
    if ($(document).width() >= 970) {
      element = $menu.find('.lvl1')[0];
      needOffset = $(element).offset();
      needOffset = needOffset.top;
      $menu.find('.lvl1').each(function (index) {
        offset = $(this).offset();
        offset = offset.top;
        if (offset != needOffset) {
          $(this).addClass('invisible');
          $menu.find('.other').removeClass('invisible');
          if ($menu.find('.other #element' + $(this).attr('id')).length >= 1) {
            $menu.find('.other #element' + $(this).attr('id')).show();
          } else {
            if (resize) {
              $menu
                .find('.other ul.dropdown-menu')
                .prepend('<li class="other_li" id="element' + $(this).attr('id') + '">' + $(this).html() + '</li>');
            } else {
              $menu
                .find('.other ul.dropdown-menu')
                .append('<li class="other_li" id="element' + $(this).attr('id') + '">' + $(this).html() + '</li>');
            }
          }
        } else {
          $(this).removeClass('invisible');
          if ($menu.find('.other #element' + $(this).attr('id')).length >= 1) {
            $menu.find('.other #element' + $(this).attr('id')).hide();
          }
        }
      });
    } else {
      $menu.find('.lvl1').each(function (index) {
        $(this).removeClass('invisible');
        $menu.find('.other').addClass('invisible');
      });
    }
    elementsWidth = 0;
    $menu.find('li.lvl1').each(function (index) {
      if (!$(this).hasClass('invisible')) {
        elementsWidth = elementsWidth + $(this).outerWidth(true);
      }
    });
    width = $menu.width() - elementsWidth;
    $menu.find('.other').css('width', width - 1);
    $menu.removeAttr('style');
    if ($menu.find('.lvl1.invisible').length == 0) {
      $menu.find('.other').hide();
    } else {
      $menu.find('.other').show();
    }
  }
}
function ARCORP_Area2Darken(areaObj) {
  areaObj.toggleClass('area2darken');
}
function ARCORP_DropFancy() {}
function ARCORP_PopupGallerySetHeight() {
  if ($('.popupgallery').length > 0) {
    if ($(document).width() > 767) {
      var innerHeight = parseInt($('.popupgallery').parents('.fancybox-inner').height()),
        h1 = innerHeight - 55,
        h2 = h1 - 30,
        h3 = innerHeight - 55 - parseInt($('.popupgallery').find('.preview').height());
      $('.popupgallery').find('.thumbs.style1').css('maxHeight', h3);
    } else {
      var fullrightHeight = parseInt($('.popupgallery').find('.fullright').height());
      var innerHeight = parseInt($('.popupgallery').parents('.fancybox-inner').height()),
        h1 = innerHeight - 55 - fullrightHeight - 25,
        h2 = h1 - 30 - fullrightHeight - 25,
        h3 = innerHeight - 55 - parseInt($('.popupgallery').find('.preview').height());
      $('.popupgallery').find('.thumbs.style1').css('maxHeight', 100);
    }
    $('.popupgallery').find('.changeit').css('height', h1);
    $('.popupgallery').find('.changeit').find('img').css('maxHeight', h2);
  }
}
function ARCORP_PopupGallerySetPicture() {
  if ($('.popupgallery').length > 0) {
    $('.js-gallery')
      .find('.thumbs')
      .find('a[href="' + $('.changeFromSlider:not(.cantopen)').find('img').attr('src') + '"]')
      .trigger('click');
  }
}
function ARCORP_SetSet() {
  ARCORP_SetCompared();
}
function ARCORP_SetCompared() {
  $('.js-compare').removeClass('checked');
  for (element_id in ARCORP_COMPARE) {
    if (ARCORP_COMPARE[element_id] == 'Y' && $('.js-elementid' + element_id).find('.js-compare').length > 0) {
      $('.js-elementid' + element_id)
        .find('.js-compare')
        .addClass('checked')
        .find('.count')
        .html(' (' + AR_CORP_COUNT_COMPARE + ')');
    }
  }
  $('.js-compare:not(.checked)').find('.count').html('');
}
$(document).ready(function () {
  $(document).on('click', 'a.area2darken', function (e) {
    console.info('Area2Darken - block click');
    e.preventDefault();
    e.stopImmediatePropagation();
  });
  ARCORP_DropFancy();
  $(window).resize(function () {
    setTimeout(function () {
      ARCORP_hideLis(true);
      ARCORP_DropFancy();
    }, 100);
  });
  $(window).load(function () {
    setTimeout(function () {
      ARCORP_hideLis(false);
      ARCORP_DropFancy();
    }, 100);
  });
  $(document).on('click', '.main-menu-nav .dropdown a > span', function () {
    $(this).parent().parent().toggleClass('open');
    return false;
  });
  $(document).on('click', '.reloadCaptcha', function () {
    var $object = $(this).parents('.captcha_wrap');
    BX.ajax.loadJSON('/bitrix/tools/ajax_captcha.php', function (data) {
      $object.find('.captchaImg').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + data.captcha_sid);
      $object.find('.captchaSid').val(data.captcha_sid);
    });
    return false;
  });
  $(document).on('click', '.nav .search-btn', function () {
    var $searchBtn = $(this);
    if ($searchBtn.hasClass('lupa')) {
      $('.search-open').fadeIn(500, function () {
        $searchBtn.removeClass('lupa');
        $searchBtn.addClass('remove');
      });
    } else {
      $('.search-open').fadeOut(500, function () {
        $searchBtn.addClass('lupa');
        $searchBtn.removeClass('remove');
      });
    }
  });
  $(document).on(
    'show.bs.dropdown',
    'header .main-menu-nav li.dropdown, header .main-menu-nav li.dropdown > a',
    function (e) {
      console.warn('script.js -> preventDefault');
      e.preventDefault();
    }
  );
  $(document)
    .on('shown.bs.collapse', '.nav-sidebar', function (e) {
      $(e.target).parent().addClass('showed');
    })
    .on('hidden.bs.collapse', '.nav-sidebar', function (e) {
      $(e.target).parent().removeClass('showed');
    });
  $('.owl').each(function () {
    var $owl = $(this),
      ARCORP_change_speed = 2000,
      ARCORP_change_delay = 8000,
      ARCORP_margin = 0,
      ARCORP_responsive = { 0: { items: 1 }, 768: { items: 1 }, 1200: { items: 1 } };
    if (parseInt($owl.data('changespeed')) > 0) {
      ARCORP_change_speed = $owl.data('changespeed');
    }
    if (parseInt($owl.data('changedelay')) > 0) {
      ARCORP_change_delay = $owl.data('changedelay');
    }
    if (parseInt($owl.data('margin')) > 0) {
      ARCORP_margin = $owl.data('margin');
    }
    if ($owl.data('responsive') != '' && typeof $owl.data('responsive') == 'object') {
      ARCORP_responsive = $owl.data('responsive');
    }
    if ($owl.find('.item').length > 1) {
      $owl.owlCarousel({
        items: 4,
        margin: ARCORP_margin,
        loop: true,
        autoplay: true,
        nav: true,
        navText: ['<span></span>', '<span></span>'],
        navClass: ['prev', 'next'],
        autoplaySpeed: ARCORP_change_speed,
        autoplayTimeout: ARCORP_change_delay,
        smartSpeed: ARCORP_change_speed,
        onInitialize: function (e) {
          $owl.addClass('owl-carousel owl-theme');
          if (this.$element.children().length <= this.settings.items) {
            this.settings.loop = false;
          }
        },
        onResize: function (e) {
          if (this._items.length <= this.settings.items) {
            this.settings.loop = false;
          }
        },
        onRefreshed: function () {
          $owl.removeClass('noscroll');
          if ($owl.find('.cloned').length < 1) {
            $owl.addClass('noscroll');
          }
        },
        responsive: ARCORP_responsive,
      });
    }
  });
  var RSGoPro_FancyOptions1 = {},
    RSGoPro_FancyOptions2 = {};
  RSGoPro_FancyOptions1 = {
    maxWidth: 400,
    maxHeight: 750,
    minWidth: 200,
    minHeight: 100,
    openEffect: 'none',
    closeEffect: 'none',
    padding: [20, 24, 15, 24],
    helpers: { title: { type: 'inside', position: 'top' } },
    beforeShow: function () {
      var $element = $(this.element);
      if ($element.data('insertdata') != '' && typeof $element.data('insertdata') == 'object') {
        setTimeout(function () {
          var obj = $element.data('insertdata');
          for (fieldName in obj) {
            $('.fancybox-inner')
              .find('[name="' + fieldName + '"]')
              .val(obj[fieldName]);
          }
        }, 50);
      }
      $(document).trigger('ARCORP_fancyBeforeShow');
    },
    afterShow: function () {
      setTimeout(function () {
        $.fancybox.toggle();
        ARCORP_PopupGallerySetHeight();
        ARCORP_PopupGallerySetPicture();
        $(document).trigger('ARCORP_fancyAfterShow');
      }, 50);
    },
    onUpdate: function () {
      setTimeout(function () {
        ARCORP_PopupGallerySetHeight();
        $(document).trigger('ARCORP_fancyOnUpdate');
      }, 50);
    },
  };
  $('.fancyajax').fancybox(RSGoPro_FancyOptions1);
  RSGoPro_FancyOptions2 = $.extend({}, RSGoPro_FancyOptions1);
  RSGoPro_FancyOptions2.ajax = { type: 'POST', cache: false, data: { AJAX_CALL: 'Y', POPUP_GALLERY: 'Y' } };
  delete RSGoPro_FancyOptions2.minHeight;
  delete RSGoPro_FancyOptions2.maxHeight;
  RSGoPro_FancyOptions2.maxWidth = 1091;
  RSGoPro_FancyOptions2.minWidth = 600;
  RSGoPro_FancyOptions2.width = '90%';
  RSGoPro_FancyOptions2.height = '90%';
  RSGoPro_FancyOptions2.autoSize = false;
  if (!RSDevFunc_PHONETABLET) {
    $('.changeFromSlider:not(.cantopen)').fancybox(RSGoPro_FancyOptions2);
  }
  $(document).on('click', '.fancyajaxwait, .cantopen', function () {
    return false;
  });
  $(document).on('click', '.thumbs .thumb a', function () {
    var $link = $(this);
    var $thumbs = $link.parents('.thumbs');
    $thumbs.find('.thumb').removeClass('checked');
    $thumbs.find('.thumb.pic' + $link.data('index')).addClass('checked');
    $($thumbs.data('changeto')).attr('src', $(this).attr('href'));
    $(document).trigger('ARCORP_changePicture');
    return false;
  });
  $(document)
    .on('click', '.js-nav', function () {
      var $btn = $(this),
        $gallery = $(this).parents('.js-gallery'),
        $curPic = $gallery.find('.thumb.checked'),
        $prev = $curPic.prev().hasClass('thumb') ? $curPic.prev() : $gallery.find('.thumb:last'),
        $next = $curPic.next().hasClass('thumb') ? $curPic.next() : $gallery.find('.thumb:first');
      if ($btn.hasClass('prev')) {
        $prev.find('a').trigger('click');
      } else {
        $next.find('a').trigger('click');
      }
      return false;
    })
    .on('mouseenter mouseleave', '.js-nav', function () {
      $('html').toggleClass('disableSelection');
    });
  $(document).on('click', '.popupgallery .changeit img', function () {
    $('.popupgallery').find('.js-nav.next').trigger('click');
  });
  $(document).on('focusin', '.form-control', function () {
    $(this).next().addClass('focused');
  });
  $(document).on('focusout', '.form-control', function () {
    $(this).next().removeClass('focused');
  });
  $(document)
    .on('focusout', '.req-input', function () {
      if ($(this).val() == '') {
        $(this).addClass('must-be-filled almost-filled');
        $(this).attr('placeholder', BX.message('ARCORP_JS_REQUIRED_FIELD'));
      }
    })
    .on('focusin', '.req-input', function () {
      if ($(this).hasClass('must-be-filled')) {
        $(this).removeClass('must-be-filled almost-filled');
      }
    });
  $(document).on('click', '.dropdown-menu .variable', function () {
    $(this)
      .parents('.dropdown')
      .find('.dropdown-button')
      .html($(this).html() + '<span class="right-arrow-caret"></span>');
    $(this).parents('.dropdown').find('input[type="hidden"]').val($(this).data('value'));
  });
  $(document).on('click', '.btn.btn-primary', function () {
    submittedFlag = false;
    $(this)
      .parents('form')
      .find('.field-wrap.req')
      .each(function () {
        if (
          ($(this).find('input.req-input').val() == '' && $(this).hasClass('text-wrap')) ||
          ($(this).find('select option:selected').length == 0 && $(this).hasClass('select-wrap')) ||
          ($(this).find('input.req-input').val() == '' && $(this).hasClass('calendar-wrap')) ||
          ($(this).find('textarea').val() == '' && $(this).hasClass('textarea-wrap')) ||
          ($(this).find('input.req-input').val() == '' && $(this).hasClass('file-wrap')) ||
          ($(this).find('input:checked').length == 0 && $(this).hasClass('choice-wrap'))
        ) {
          $(this).addClass('has-error');
          submittedFlag = true;
        } else {
          $(this).removeClass('has-error');
        }
      });
    if (submittedFlag) {
      return false;
    }
  });
  $(document).on('click', '.checkbox label', function () {
    $(this).parent().find('input').checked = !$(this).parent().find('input').checked;
  });
  $(document).on('change', '.almost-filled', function () {
    $(this).removeClass('almost-filled').attr('placeholder', '');
  });
  $(document).on('click', '.js-compare', function () {
    console.info('AJAX -> add2compare ');
    var $linkObj = $(this),
      url = $linkObj.parents('.js-element').find('.js-detail_page_url').attr('href'),
      id = parseInt($linkObj.parents('.js-element').data('elementid')),
      action = '';
    if (id > 0) {
      if (url.indexOf('?') == -1) {
        url = url + '?';
      }
      if (ARCORP_COMPARE[id] == 'Y' || parseInt(ARCORP_COMPARE[id]) > 0) {
        action = 'DELETE_FROM_COMPARE_LIST';
      } else {
        action = 'ADD_TO_COMPARE_LIST';
      }
      url = url + 'AJAX_CALL=Y&action=' + action + '&id=' + id;
      ARCORP_Area2Darken($('.js-compare'));
      $.getJSON(url, {}, function (json) {
        if (json.TYPE == 'OK') {
          if (action == 'DELETE_FROM_COMPARE_LIST') {
            delete ARCORP_COMPARE[id];
          } else {
            ARCORP_COMPARE[id] = 'Y';
          }
          AR_CORP_COUNT_COMPARE = json.COUNT;
          if (AR_CORP_COUNT_COMPARE > 0) {
            $('.comparelist').removeClass('hidden').find('.count').html(json.COUNT_WITH_WORD);
          } else {
            $('.comparelist').addClass('hidden');
          }
        } else {
          console.warn('compare - error responsed');
        }
      })
        .fail(function (data) {
          console.warn('compare - fail request');
        })
        .always(function () {
          ARCORP_Area2Darken($('.js-compare'));
          ARCORP_SetCompared();
        });
    }
    return false;
  });
});
$(function () {
  var wrapper = $('.file_upload'),
    inp = wrapper.find('input'),
    btn = wrapper.find('.file-link'),
    lbl = wrapper.find('.file-link');
  btn.add(lbl).click(function () {
    inp.click();
  });
  var file_api = window.File && window.FileReader && window.FileList && window.Blob ? true : false;
  inp
    .change(function () {
      var file_name;
      if (file_api && inp[0].files[0]) file_name = inp[0].files[0].name;
      else file_name = inp.val().replace('C:\\fakepath\\', '');
      if (!file_name.length) return;
      if (lbl.is(':visible')) {
        lbl.text(file_name);
        btn.text(file_name);
      } else btn.text(file_name);
    })
    .change();
});

$(document).on('click', '.more_text_ajax', function () {
  var url = $(this).closest('.right_block').find('.module-pagination .flex-direction-nav .flex-next').attr('href'),
    th = $(this);
  th.addClass('loading');

  $.ajax({
    url: url,
    data: { ajax_get: 'Y' },
    success: function (html) {
      var new_html = $.parseHTML(html);
      th.removeClass('loading');
      if ($('.display_list').length) {
        //$('.display_list').append($(new_html).find('.display_list').html());
        $('.display_list').append(html);
      } else if ($('.products.showcase').length) {
        $('.products.showcase').append(html);
        touchItemBlock('.item.js-element a');
        $('.products.showcase').ready(function () {
          $('.products.showcase').equalize({ children: '.item.js-element .name', reset: true });
          $('.products.showcase').equalize({ children: '.item.js-element', reset: true });
        });
      } else if ($('.module_products_list').length) {
        $('.module_products_list tbody').append(html);
      }
      setStatusButton();
      $('.bottom_nav').html($(html).find('.bottom_nav').html());
    },
  });
});

// basked START

$(document).ready(function () {
  const sideBasket = document.querySelector('.side-basket');
  const modalFastWrap = document.querySelector('.modal-fast-wrap');
  const modalSizeTable = document.querySelector('.modal-size-table');
  const colorSelect = document.querySelector('.color-select');
  const sizeSelect = document.querySelector('.size-select');
  const previewtextHeight = document.querySelector('.js-detail .previewtext');

  if (sideBasket) {
    function sideBasketDesktopListener() {
      $('.side-basket').toggleClass('show');
    }
    $(document).on('click', '.js-btn-show', sideBasketDesktopListener);

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
  }

  // модалка для быстрого заказа в корзине и карточке товара
  if (modalFastWrap) {
    $('.modal-fast-wrap').fancybox({
      margin: 0,
      padding: [14, 35, 30, 35],
      maxWidth: 350,
      height: 'auto',
      // autoSize: false,
      autoScale: true,
      wrapCSS: 'modal-fast',
      transitionIn: 'none',
      transitionOut: 'none',
      type: 'inline',
      helpers: {
        overlay: {
          locked: false,
        },
      },
    });
  }

  // модалка для таблицы размеров в карточке товара
  if (modalSizeTable) {
    $('.modal-size-table').fancybox({
      margin: 0,
      padding: [45, 60, 45, 60],
      maxWidth: 825,
      height: 'auto',
      // autoSize: false,
      autoScale: true,
      wrapCSS: 'size-table-wrap',
      transitionIn: 'none',
      transitionOut: 'none',
      type: 'inline',
      helpers: {
        overlay: {
          locked: false,
        },
      },
    });
  }

  // выбор цвета товата
  if (colorSelect) {
    colorSelect.addEventListener('click', (e) => {
      if (e.target.classList.contains('color-select__btn')) {
        document
          .querySelectorAll('.color-select__btn')
          .forEach((el) => el.classList.remove('color-select__btn--active'));
        e.target.classList.add('color-select__btn--active');
      }
    });
  }

  // выбор размера товара
  if (sizeSelect) {
    sizeSelect.addEventListener('click', (e) => {
      if (e.target.classList.contains('size-select__btn')) {
        document.querySelectorAll('.size-select__btn').forEach((el) => el.classList.remove('size-select__btn--active'));
        e.target.classList.add('size-select__btn--active');
      }
    });
  }

  // расскрытие текста в карточке товара
  if (previewtextHeight) {
    const previewtextBtn = document.querySelector('.previewtext__btn');
    const previewtextBtnSvg = document.querySelector('.previewtext__btn-wrap svg')

    previewtextBtn.addEventListener('click', () => {
      if (previewtextHeight.classList.contains('previewtext-height')) {
        previewtextHeight.classList.remove('previewtext-height');
        previewtextBtn.innerHTML = 'Скрыть';
        previewtextBtnSvg.style.transform = 'rotate(180deg)';
      } else {
        previewtextHeight.classList.add('previewtext-height');
        previewtextBtn.innerHTML = 'Раскрыть';
        previewtextBtnSvg.style.transform = '';
      }
    });
  }
});
// basked END
