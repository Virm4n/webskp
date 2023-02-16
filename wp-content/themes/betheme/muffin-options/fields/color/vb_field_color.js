/**
 * mfnFieldColor
 */

(function($) {

  /* globals jQuery */

  "use strict";

  $(function($) {

    /**
     * Get contrast for icon background and border
     */

    function getContrastYIQ( hexcolor, tolerance ){

      hexcolor = hexcolor.replace( "#", "" );
      tolerance = typeof tolerance !== 'undefined' ? tolerance : 169;

      if( 6 != hexcolor.length ){
        return false;
      }

      var r = parseInt( hexcolor.substr(0,2),16 );
      var g = parseInt( hexcolor.substr(2,2),16 );
      var b = parseInt( hexcolor.substr(4,2),16 );

      var yiq = ( ( r*299 ) + ( g*587 ) + ( b*114 ) ) / 1000;

      return ( yiq >= tolerance ) ? 'light' : 'dark';
    }

    /**
     * Set color
     */

    function setColor( el, color ){

      var $form = el.closest('.color-picker-group');

      $('.mfn-form-input', $form).val( color );

      $('.label', $form).removeClass('light dark').addClass(getContrastYIQ(color));
      $('.label', $form).css('background-color', color);

      if( ! getContrastYIQ(color, 240) || 'light' == getContrastYIQ(color, 240) ){
        // very light colors need light grey border
        $('.label', $form).css('border-color', '');
      } else {
        $('.label', $form).css('border-color', color);
      }

    }

    /**
     * wpColorPicker init
     */

    function init(){

      $( '.modal-add-shortcode .modalbox-content .color-picker-group ' ).each(function() {

        var $colorinp = $(this).find('input.has-colorpicker');

        $colorinp.wpColorPicker({
          mode : 'hsl',
          width : 283,
          change : function(event, ui) {
            setColor( $(this), ui.color.toString() );
          },
          clear : function() {
            setColor( $(this), '' );
          }
        });


      });


    }
    
    /**
     * Input change
     * update color picker
     */

    $( '.modal-add-shortcode .modalbox-content .color-picker-group.mfn-form-input' ).on('change', function(){

      var $form = $(this).closest('.color-picker-group');
      var val = $(this).val();

      if( ! val ){
        return false;
      }

      $( 'input.has-colorpicker', $form ).wpColorPicker( 'color', val );

    });

    /**
     * Clear button
     * update color picker and remove input value
     */

    $( '.modal-add-shortcode .modalbox-content .color-picker-group .color-picker-clear' ).on('click', function(e){

      e.preventDefault();

      var $form = $(this).closest('.color-picker-group');

      $( 'input.has-colorpicker', $form ).wpColorPicker( 'color', '#fff' );
      $( '.mfn-form-input', $form ).val('');

    });


    $(document).on('mfn:vb:sc:edit', init);

  });

  

})(jQuery);
