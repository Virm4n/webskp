(function($) {

  /* globals jQuery */

  "use strict";

  var MfnFieldDimensions = (function() {

    var $group = $('.mfn-ui .form-group.multiple-inputs');

    /**
     * Change field values on keypress
     */

    function changeVal( $el, key ){

      var $form = $el.closest( '.form-group' );

      var val = $el.val();

      if( 38 == key.which ){
        val = parseInt( val ) + 1;
        $el.val( val );
      }

      if( 40 == key.which ){
        val = parseInt( val ) - 1;
        $el.val( val );
      }

      if( $form.hasClass('isLinked') ){
        $( '.disableable input', $form ).val( val );
      }

      $( '.numeral', $form ).trigger( 'change' );

    }

    /**
     * Link values
     */

    function link( $el ){

      var $form = $el.closest( '.form-group' ),
        $input = $( 'input', $el );

      var val = $('input[data-key="top"]', $form).val();

      if( 1 == $input.val() ){

        $input.val(0);
        $form.removeClass('isLinked');

        $( '.disableable input', $form )
          .removeClass('readonly').removeAttr('readonly');

      } else {

        $input.val(1);
        $form.addClass('isLinked');

        $( '.disableable input', $form ).val(val).trigger('change')
          .addClass('readonly').attr('readonly','readonly');

      }

    }

    /**
     * Attach events to buttons.
     */

    function bind() {

      $( '.numeral', $group ).on('keyup', function(key) {
        changeVal( $(this), key );
      });

      $( '.link', $group ).on('click', function(key) {
        link( $(this) );
      });

    }

    /**
     * Runs whole script.
     */

    function init() {
      bind();
    }

    /**
     * Return
     * Method to start the closure
     */

    return {
      init: init
    };

  })();

  /**
   * $(document).ready
   * Specify a function to execute when the DOM is fully loaded.
   */

  $(function() {
    MfnFieldDimensions.init();
  });

})(jQuery);
