!function(n){"object"==typeof module&&"object"==typeof module.exports?module.exports=n(require("jquery")):n(jQuery)}(function(n){n.fn.jqm=function(o){return this.each(function(){var t=n(this).data("jqm")||n.extend({ID:m++},n.jqm.params),e=n.extend(t,o);n(this).data("jqm",e).addClass("jqm-init")[0]._jqmID=e.ID,n(this).jqmAddTrigger(e.trigger)})},n.fn.jqmAddTrigger=function(t){return t?this.each(function(){a(n(this),"jqmShow",t)||o("jqmAddTrigger must be called on initialized modals")}):void 0},n.fn.jqmAddClose=function(t){return t?this.each(function(){a(n(this),"jqmHide",t)||o("jqmAddClose must be called on initialized modals")}):void 0},n.fn.jqmShow=function(o){return this.each(function(){this._jqmShown||t(n(this),o)})},n.fn.jqmHide=function(o){return this.each(function(){this._jqmShown&&e(n(this),o)})};var o=function(n){window.console&&window.console.error&&window.console.error(n)},t=function(o,t){t=t||window.event;var e=o.data("jqm"),i=parseInt(o.css("z-index"),10)||3e3,s=n("<div></div>").addClass(e.overlayClass).css({height:"100%",width:"100%",position:"fixed",left:0,top:0,"z-index":i-1,opacity:e.overlay/100}),a={w:o,c:e,o:s,t:t};if(o.css("z-index",i),e.ajax){var d=e.target||o,c=e.ajax;d="string"==typeof d?n(d,o):n(d),"@"===c.substr(0,1)&&(c=n(t).attr(c.substring(1))),d.load(c,function(){e.onLoad&&e.onLoad.call(this,a),l.call(o,e,d)}),e.ajaxText&&d.html(e.ajaxText),r(a)}else r(a)},e=function(n,o){o=o||window.event;var t=n.data("jqm"),e={w:n,c:t,o:n.data("jqmv"),t:o};d(e)},i=function(o){return o.c.overlay>0&&o.o.prependTo("body"),o.w.show(),n.jqm.focusFunc(o.w,!0),!0},s=function(n){return n.w.hide()&&n.o&&n.o.remove(),!0},a=function(o,t,e){var i=o.data("jqm");return i?n(e).each(function(){this[t]=this[t]||[],n.inArray(i.ID,this[t])<0&&(this[t].push(i.ID),n(this).click(function(n){return n.isDefaultPrevented()||o[t](this),!1}))}):void 0},r=function(o){var t=o.w,e=o.o,i=o.c;i.onShow(o)!==!1&&(t[0]._jqmShown=!0,i.modal?(j[0]||c("bind"),j.push(t[0])):t.jqmAddClose(e),l.call(t,i),i.toTop&&e&&t.before('<span id="jqmP'+i.ID+'"></span>').insertAfter(e),t.data("jqmv",e),t.unbind("keydown",n.jqm.closeOnEscFunc),i.closeOnEsc&&t.attr("tabindex",0).bind("keydown",n.jqm.closeOnEscFunc).focus())},d=function(o){var t=o.w,e=o.o,i=o.c;i.onHide(o)!==!1&&(t[0]._jqmShown=!1,i.modal&&(j.pop(),j[0]||c("unbind")),i.toTop&&e&&n("#jqmP"+i.ID).after(t).remove())},c=function(o){n(document)[o]("keypress keydown mousedown",u)},u=function(o){var t=n(o.target).data("jqm")||n(o.target).parents(".jqm-init:first").data("jqm"),e=j[j.length-1];return t&&t.ID===e._jqmID?!0:n.jqm.focusFunc(e,o)},l=function(o,t){t=t||this,o.closeClass&&this.jqmAddClose(n("."+o.closeClass,t))},m=0,j=[];return n.jqm={params:{overlay:50,overlayClass:"jqmOverlay",closeClass:"jqmClose",closeOnEsc:!1,trigger:".jqModal",ajax:!1,target:!1,ajaxText:"",modal:!1,toTop:!1,onShow:i,onHide:s,onLoad:!1},focusFunc:function(o,t){return t&&n(":input:visible:first",o).focus(),!1},closeOnEscFunc:function(o){return 27===o.keyCode?(n(this).jqmHide(),!1):void 0}},n.jqm});

(function($) {
    
    window.jqmPopup = function (popupName, url) {
        
        var trigger = '.' + popupName + '-popup-btn',
            popup = popupName + '-popup';
    
        $('body').find('.' + popup).remove();
        $('body').append('<div data-id="'+popup+'" class="'+popup+' popup"></div>');
    
        
            $('.' + popup).jqm({
                ajax: BX.message('SITE_DIR') + url,
                trigger: trigger,
                ajaxText: '<div class="popup-loading"></div>',
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
        
        
    };
    
})(jQuery);