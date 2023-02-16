(function($) {

  /* globals jQuery */

  "use strict";

  var MfnOptions = (function($) {

    var $options = $('#mfn-options'),

      $menu = $('.mfn-menu', $options),
      $content = $('.mfn-wrapper', $options),
      $subheader = $('.mfn-subheader', $options),
      $modal = $('.mfn-modal', $options),
      $currentModal = false,

      $title = $('.topbar-title .page-title', $options),
      $subtitle = $('.topbar-title .subpage-title', $options),
      $tabs = $('.subheader-tabs', $options),

      $last_tab = $('#last_tab', $options);

    var loading = true, // prevent some functions until window load
      scrollLock = false; // prevent active on scroll after click

    /**
     * Main menu
     */

    var menu = {

      init: function() {

        var last_tab = $last_tab.val();

        if( window.location.hash.replace('#','') ){
          return false;
        }

        if( ! last_tab ){
          last_tab = 'general';
        }

        this.click( $('li[data-id="'+ last_tab +'"] a', $menu) );

      },

      click: function($el) {

        var $li = $el.closest('li'),
          tab = $li.data('id'),
          title, subtitle;

        if( $li.hasClass('active') ){
          return false;
        }

        $menu.find('li').removeClass('active');

        $li.addClass('active');

        if( $li.is('[data-id]') ){

          // second level

          $li.parents('li').addClass('active');

          title = $li.parent().closest('li').children('a').text();
          subtitle = $li.children('a').text();

        } else {

          // first level

          $li.find('li:first').addClass('active');

          tab = $li.find('li:first').data('id');

          title = $li.children('a').text();
          subtitle = $li.find('li:first a').text();

        }

        $('.mfn-card-group', $options).removeClass('active');
        $('.mfn-card-group[data-tab="'+ tab +'"]', $options).addClass('active');

        $last_tab.val( tab );

        $title.text( title );
        $subtitle.text( subtitle );

        subheader.init();

        $('html, body').animate({
          scrollTop: 0
        }, 300);

      },

      hash: function( link ){

        var tab, card;

        link = ( typeof link !== 'undefined' ) ?  link : window.location.hash;
        link = link.replace('#','');

        if( ! link ){
          return false;
        }

        tab = link.split('&')[0];
        card = link.split('&')[1];

        this.click( $('li[data-id="'+ tab +'"] a', $menu) );

        if( card ){
          subheader.click( $('li[data-card-id="'+ card +'"] a', $subheader) );
        }

      }

    };

    var subheader = {

      startY: 0,
      topY: 0,
      width: 0,
      headerH: 0,
      $placeholder: $('.mfn-subheader-placeholder', $content),

      init: function(){

        var $tab = $('.mfn-card-group.active', $options);

        var link = $tab.data('tab');

        if( ! link ){
          return false;
        }

        $tabs.empty();

        $('.mfn-card', $tab).each(function( index ){

          var title = $(this).find('.card-title').text(),
            id = $(this).data('card'),
            attr = $(this).data('attr'),
            cssClass = '';

          if( ! index ){
            cssClass = 'active';
          }

          if( attr ){
            attr = ' data-attr="'+ attr +'"' ;
          } else {
            attr = '';
          }

          $tabs.append( '<li class="'+ cssClass +'" data-card-id="'+ id +'"'+ attr +'><a href="#'+ link +'&'+ id +'">'+ title +'</a></li>' );

        });

        window.location.hash = '#'+ link;

        this.set();

      },

      click: function($el){

        var $li = $el.closest('li');

        var id = $li.data('card-id'),
          adminH = $('#wpadminbar').height();

        $li.addClass('active').siblings('li').removeClass('active');

        this.setScrollLock();

        $('html, body').animate({
          scrollTop: $('.mfn-card-group.active .mfn-card[data-card="'+ id +'"]').offset().top - ( adminH + this.headerH + 20 )
        }, 300);

      },

      set: function(){

        this.topY = $content.offset().top;
        this.width = $content.innerWidth();
        this.headerH = $subheader.height();

        this.startY = this.topY + $('.mfn-topbar', $content).height();

        this.$placeholder.height( $subheader.height() );

      },

      setScrollLock: function(){

        scrollLock = true;

        setTimeout(function(){
          scrollLock = false;
        }, 300);

      },

      sticky: function(){

        var windowY = $(window).scrollTop();

        if( windowY >= this.startY ){

          this.$placeholder.show(0);
          $subheader.addClass('sticky').css({
            position: 'fixed',
            top: this.topY,
            width: this.width
          });

        } else {

          this.$placeholder.hide(0);
          $subheader.removeClass('sticky').css({
            position: 'static',
            top: 0,
            width: 'unset'
          });

        }

      },

      scrollActive: function(){

        if( scrollLock ){
          return false;
        }

        var $tab = $('.mfn-card-group.active', $options);

        var first = false;

        $('.mfn-card:visible', $tab).each(function() {

          var windowY = $(window).scrollTop();
          var cardY = $(this).offset().top + $(this).height();

          cardY = cardY - subheader.topY - subheader.headerH;

          if( first ){
            return false;
          }

          if ( cardY > windowY ) {
            first = $(this).data('card');
          }

        });

        if ( first ) {

          $tabs.find('li[data-card-id="'+ first +'"]').addClass('active')
            .siblings('li').removeClass('active');

        }

      }

    };

    var mobile = {

      menu: function(){

        var $overlay = $('.mfn-overlay', $options);

        if( $menu.hasClass('show') ){

          $overlay.fadeOut(300);

        } else {

          $overlay.fadeIn(300);
          $menu.scrollTop(0);

        }

        $menu.toggleClass('show');
        $('body').toggleClass('mfn-modal-open');

      }

    };

    var backup = {

      export: function(){

        $( '.backup-export-textarea', $content ).toggle();
        $( '.backup-export-input', $content ).hide();

      },

      exportLink: function(){

        $( '.backup-export-input', $content ).toggle();
        $( '.backup-export-textarea', $content ).hide();

      },

      import: function(){

        $( '.backup-import-textarea', $content ).toggle()
          .find('textarea').val('');
        $( '.backup-import-input', $content ).hide();

      },

      importLink: function(){

        $( '.backup-import-input', $content ).toggle()
          .find('.mfn-form-input').val('');
        $( '.backup-import-textarea', $content ).hide();

      },

      resetPre: function(){

        $( '.backup-reset-step.step-1', $content ).hide().next().show();

      },

      reset: function( $el ){

        if ( $( '.backup-reset-security-code', $content ).val() != 'r3s3t' ) {
          alert( 'Please insert correct security code: r3s3t' );
          return false;
        }

        if ( confirm( "Are you sure?\n\nAll custom values across your entire Theme Options panel will be reset" ) ) {
          $el.val( 'Resetting...' );
          return true;
        } else {
          return false;
        }

      }

    };

    var modal = {

      // modal.open()

      open: function( $senderModal ){

        $currentModal = $senderModal;

        $currentModal.addClass('show');

        $('body').addClass('mfn-modal-open');

      },

      // modal.close()

      close: function(){

        if( ! $currentModal ){
          return false;
        }

        $currentModal.removeClass('show');

        $('body').removeClass('mfn-modal-open');

        $currentModal = false;

      }

    };

    var goToCard = function( el, e ){

      var locationURL = location.href.replace(/\/#.*|#.*/, ''),
        thisURL = el.href.replace(/\/#.*|#.*/, ''),
        hash = el.hash;

      if ( locationURL == thisURL ) {
        e.preventDefault();
      } else {
        return false;
      }

      menu.hash( hash );

    };

    var survey = function(){

      $('.mfn-survey').on( 'click', '.close', function(e){
        e.preventDefault();

        var $el = $(this);

        $.ajax({
          url: ajaxurl,
          data: {
            action: 'mfn_survey',
          },
          success: function(response){
            console.log(response);
          },
          complete: function(){
            $el.closest('.mfn-survey').hide();
          }
        });

      });

    }

    /**
     * Bind
     */

    var bind = function() {

      // click

      // main menu

      $menu.on( 'click', 'a', function(e){
        e.preventDefault();
        menu.click( $(this) );
      });

      // subheader tabs

      $tabs.on( 'click', 'a', function(e){
        subheader.click( $(this) );
      });

      // link in description to another tab

      $( '.mfn-card-group', $options ).on( 'click', 'a', function(e){
        goToCard( this, e );
      });

      // mobile menu

      $( '.responsive-menu, .mfn-overlay', $options ).on( 'click', function(e){
        e.preventDefault();
        mobile.menu();
      });

      // backup

      $( '.backup-export-show-textarea', $content ).on( 'click', function(e){
        e.preventDefault();
        backup.export();
      });

      $( '.backup-export-show-input', $content ).on( 'click', function(e){
        e.preventDefault();
        backup.exportLink();
      });

      $( '.backup-import-show-textarea', $content ).on( 'click', function(e){
        e.preventDefault();
        backup.import();
      });

      $( '.backup-import-show-input', $content ).on( 'click', function(e){
        e.preventDefault();
        backup.importLink();
      });

      $( '.backup-reset-pre-confirm', $content ).on( 'click', function(e){
        e.preventDefault();
        backup.resetPre();
      });

      $( '.backup-reset-confirm', $content ).on( 'click', function(e){
        return backup.reset( $(this) );
      });

      // modal close

      $modal.on( 'click', '.btn-modal-close', function(e) {
        e.preventDefault();
        modal.close();
      });

      $modal.on( 'click', function(e) {
        if ( $(e.target).hasClass('mfn-modal') ) {
          modal.close();
        }
      });

      $( 'body' ).on( 'keydown', function(event) {
        if ( 27 == event.keyCode ) {
          modal.close();
        }
      });

      // external modal

      $(document).on('mfn:modal:open', function( $this, el ){
        modal.open( $(el) );
      });

      $(document).on('mfn:modal:close', function(){
        modal.close();
      });

      // window.scroll

      $(window).on('scroll', function() {

        subheader.sticky();
        subheader.scrollActive();

      });

      // window resize

      $(window).on('debouncedresize', function() {

        subheader.set();
        subheader.sticky();

      });

    };

    /**
     * Ready
     * document.ready
     */

    var ready = function() {

      survey();

      if( ! $('#mfn-options').length ){
        return false;
      }

      menu.init();
      bind();

    };

    /**
     * Load
     * window.load
     */

    var load = function() {

      if( ! $('#mfn-options').length ){
        return false;
      }

      loading = false;
      $options.removeClass('loading');
      menu.hash();

      $(window).trigger('resize');

    };

    /**
     * Return
     */

    return {
      ready: ready,
      load: load
    };

  })(jQuery);

  /**
   * $(document).ready
   */

  $(function() {

    MfnOptions.ready();

    /* visual builder */

    if( $('body').hasClass('post-new-php') ){

      $('.mfn-switch-live-editor').on('click', function(e) {
        e.preventDefault();

        var $btn = $(this);

        if( ! $btn.hasClass('loading') ){
          $btn.addClass('loading');
          $.ajax({
            url: ajaxurl,
            data: {
              'mfn-builder-nonce': $('input[name="mfn-builder-nonce"]').val(),
              action: 'mfnvbsavedraft',
              posttype: $('input#post_type').val(),
              id: $('input#post_ID').val()
            },
            type: 'POST',
            success: function(response){
              window.history.pushState("data", "Edit Page", 'post.php?post='+$('input#post_ID').val()+'&action=edit');
              window.location.href = $btn.attr('href');
            }
          });
        }

      });

    }

    /* END visual builder */

  });

  /**
   * $(window).load
   */

  $(window).on('load', function(){
    MfnOptions.load();
  });

})(jQuery);
