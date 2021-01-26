var Landing = {
    
    buyProduct: function (btn, obj) {
        $('body').find('.popup-order').remove();
        $('body').append('<div class="popup popup-order"></div>');

        var params = "?" + encodeURIComponent('productName=' + obj.NAME + '&productPrice=' + obj.PRICE);
        
        $(".popup-order").jqm({
            ajax: BX.message('SITE_DIR') + BX.message('FORM_ORDER_URL') + params,
            target: false,
            onLoad: function (self) {
                    self.w.addClass('open').css({
			marginLeft: ($(window).width() > self.w.outerWidth() ? '-' + self.w.outerWidth() / 2 + 'px' : '-' + $(window).width() / 2 + 'px'),
			top: $(document).scrollTop() + (($(window).height() > self.w.outerHeight() ? ($(window).height() - self.w.outerHeight()) / 2 : 10))   + 'px',
                    });
                    self.w.find('input[id*="_PRODUCT"]').val(obj.NAME);
                    self.w.find('input[id*="_PRODUCT_ID"]').val(obj.ID);
                    self.w.find('input[id*="_PRICE"]').val(obj.PRICE);
                },
                onShow: function (hash) {
                    if(hash.c.overlay > 0) {
                        hash.o.prependTo('body');
                    }

                    hash.w.show();
                    $.jqm.focusFunc(hash.w,true);
                    $('body').addClass('open-modal');
                },
                onHide: function (hash) {
                    if(hash.w.hide() && hash.o) {
                        hash.o.remove();
                    }
                    $('body').removeClass('open-modal');
                    return true;
                }
        });
        
        $(".popup-product").jqmHide();
        $(".popup-order").jqmShow();
    },
    
    viewProduct: function (url) {
        $('body').find('[data-popup-id="'+url+'"]').remove();
        $('body').append('<div data-popup-id="'+url+'" class="popup popup-product"></div>');

        $('[data-popup-id="'+url+'"]').jqm({
            ajax: url,
            target: false,
            onLoad: function (self) {
                    self.w.addClass('open').css({
			marginLeft: ($(window).width() > self.w.outerWidth() ? '-' + self.w.outerWidth() / 2 + 'px' : '-' + $(window).width() / 2 + 'px'),
			top: $(document).scrollTop() + (($(window).height() > self.w.outerHeight() ? ($(window).height() - self.w.outerHeight()) / 2 : 10))   + 'px',
                    });
                },
                onShow: function (hash) {
                    if(hash.c.overlay > 0) {
                        hash.o.prependTo('body');
                    }

                    hash.w.show();
                    $.jqm.focusFunc(hash.w,true);
                    $('body').addClass('open-modal');
                },
                onHide: function (hash) {
                    if(hash.w.hide() && hash.o) {
                        hash.o.remove();
                    }
                    $('body').removeClass('open-modal');
                    return true;
                }
        });

        $('[data-popup-id="'+url+'"]').jqmShow();
    },
    
    changePhoto: function (thumb, container) {
        var thumb = $(thumb), container = $('#' + container);
        if (thumb.attr('href') != "") {
            thumb.parent().find("> a").removeClass('active');
            thumb.addClass('active');
            
            container.attr('src', thumb.attr('href'));
        }
    },
    
    goToBlock: function (block) {
        var block = $("#" + block);
        if (block.length > 0) {
            var offset = block.offset();
            $("html, body").stop().animate({scrollTop: offset.top - 100}, 500, 'swing');
        }
    }
    
    
    
};

$(function() {
    $("body").on('click', '.popup [data-close]', function (event) {
        event.preventDefault();
        var popup = $(this).parents('.popup');
        if (popup.hasClass('inline')) popup.hide();
        else popup.jqmHide();
        return false;
    });
    
    $("body").on('click', '.popup.inline', function (event) {
        if ($(event.target).closest(".popup.inline .box").length) return;
        $(".popup.inline").hide();
    });
    

    $("body").on('click', '.agreement-popup-btn', function (event) {
        $("#agreement-popup").show();
        var offset = $("#agreement-popup .box").offset();
        $("html, body").stop().animate({scrollTop: offset.top - 100}, 500, 'swing');
    });
    
    $("body").on('change', '.fields input[type="file"]', function (e) {
        var fileName = e.target.value.split( '\\' ).pop(),
            label = $(this).next(),
            defaultValue = label.data('default');

        if( fileName )
            label.find('span').text(fileName);
        else
            label.text(defaultValue);
    });
    
    if ($("#company").length > 0) {
        $("#company-counts .spincrement").each (function () {
            $(this).attr('data-to', parseInt($(this).text())).text('0');
        });
    
        $("#company").bind('inview', function(event, isInView) {
            var $this = $(this);
            if (isInView) {
                $this.find(".spincrement").removeClass('spincrement').spincrement({
                    thousandSeparator: "",
                    duration: 1200
                });	
            }
        });
    }
    
    
    
    
    
    
    $(".fields select").selecter({
        mobile: true,
    });
    
    jqmPopup('callback', BX.message('FORM_CALLBACK_URL'));
    jqmPopup('reviews', BX.message('FORM_REVIEWS_URL'));
    
});