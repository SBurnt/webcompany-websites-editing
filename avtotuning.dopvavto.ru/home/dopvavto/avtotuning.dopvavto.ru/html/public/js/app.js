    $(function() {

     // Replace all SVG images with inline SVG 
     $('img.svg').each(function(){
      var $img = jQuery(this);
      var imgID = $img.attr('id');
      var imgClass = $img.attr('class');
      var imgURL = $img.attr('src');

      jQuery.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');
                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                  $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                  $svg = $svg.attr('class', imgClass+' replaced-svg');
                }
                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');
                // Replace image with new SVG
                $img.replaceWith($svg);
              }, 'xml');
    });

   });

    function ShowOpen(){
      this.dropButton = document.querySelectorAll('.dropdown-button');
      this.listIn = document.querySelectorAll('.dropdown-list');
      this.navlink = document.querySelector(".navlink");
      this.aLink = this.navlink.getElementsByClassName("li a");
console.log(document.querySelector(".navlink"));
      this.selectShow = function(){
        for( var i = 0; i < this.dropButton.length; i++ ){
          var dropButtonCl = this.dropButton[i];
          dropButtonCl.addEventListener('click', function(e) {
            this.classList.toggle('active');
            this.nextElementSibling.classList.toggle('active');
          }, false)
        }
      }

      this.navLinkShow = function(){
        for (var i = 0; i < this.aLink.length; i++) {
          this.aLink[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
          });
        }
      }

    }

    var newObjNav = new ShowOpen();

    newObjNav.selectShow();
    newObjNav.navLinkShow();

    var searchVal = document.getElementById('searchVal');
    searchVal.addEventListener('keyup', function(e) {
      console.log( e.target.value )
      var sub = document.querySelector('#submit');
      if( e.target.value ){
        sub.style.background = '#1d5d83';
        sub.style.border = '2px dashed #1d5d83';
        sub.style.color = '#fff';
        this.style.border = '2px solid #ffdb6b';
        this.style.boxShadow = '0 0 12px rgba(255,219,107, 1)';
      } else {
        this.style.border = '2px solid #b0b0b0';
        this.style.boxShadow = '0 0 12px rgba(255,219,107, 0)';
      }
    })

    var headerChild = document.querySelector('#nav');
    var contentHeight = document.querySelector('#content');
    var fixPos = {
      fix: 'fixed',
      nofix: 'inherit'
    }

    window.addEventListener('scroll', function(e) {
      if ( this.pageYOffset > 140 ){
        $('#fixed-elements').addClass('fixed');
        $('#content').addClass('active');

      } else {
        $('#fixed-elements').removeClass('fixed');
        $('#content').removeClass('active');
      }
    });

    window.FontAwesomeConfig = {
      searchPseudoElements: true
    }


    $(function() {

      // toggle mobile menus
      $('.mobile-menu-toggler').click(function(){
        $('.mobile-menu-toggler').not($(this)).siblings('.mobile-menu').removeClass('active');
        $(this).siblings('.mobile-menu').toggleClass('active');
        $('#fixed-elements').addClass('active');
      });

      $('.close-circle').click(function() {
        $(this).parent().removeClass('active');
        $('#fixed-elements').removeClass('active');
      });

      // toggle submenus
      $('.arrow_in').click(function(){
      	$(this).parent().next('.content__nav--show').slideToggle();
      	$(this).toggleClass('rotated');
      })

      // open-close spoilers
      $('.order__block').click(function(e) {
        $('.order__block').not($(this)).find('.arrow').removeClass('active');
        $('.order__block').not($(this)).next('.order__table').slideUp();
        $(this).find('.arrow').toggleClass('active');
        $(this).next('.order__table').slideToggle();
      });

      //dropdown selects
      $('.dropdown-list > li').click(function(){
        $(this).parent().siblings('.dropdown-button').text($(this).data('value')).addClass('active close');
        $(this).parent().removeClass('active');
      });

      // clear dropdown
      $(document).on('click', ".dropdown > svg", function(e){
        e.stopPropagation();
        btn = $(this).siblings('.dropdown-button');
        btn.text(btn.data('text')).removeClass('active close');
      });

      // show basket content
      // $('#nav .basket').hover(
      //   function(){
      //     $(this).find('.basket__open').addClass('active');
      //   }, function(){
      //     $(this).find('.basket__open').removeClass('active');
      // });

      $(".nav .basket > a").click(function(e) {
        if ($(window).width() < 768) {
          e.preventDefault();
          return false;
        }
      });

      // show hints on buttons
      $('.has-hint').hover(
        function(){
          $(this).find('.cloud').addClass('is-open');
        }, function(){
          $(this).find('.cloud').removeClass('is-open');
      });

      // select product image
      $( '.thumbs img' ).click(function(e){
        $( '.thumbs img' ).css('opacity', 0.7);
        $( '#current' ).attr('src', $(e.target).attr('src'));
        $(e.target).css('opacity', 1);
      });

      // close modal window
      $('.modal-window .close').click(function(){
        $('.modal-window').hide();
      });

      // scroll page to top
      $('.scrollTop').click(function () {
        $('body,html').animate({
          scrollTop: 0
        }, 800);
      });

    });