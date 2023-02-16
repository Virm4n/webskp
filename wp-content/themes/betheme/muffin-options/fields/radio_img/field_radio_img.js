(function($) {

  /* globals jQuery */

  "use strict";

  function mfnFieldRadioImg() {

    var $group = $('.mfn-ui .form-group.visual-options');

    $group.on('click', '.form-control li a', function(e) {

      e.preventDefault();

      var $li = $(this).closest('li');

      $li.addClass('active').find('input').prop('checked', 'checked').trigger('change');
      $li.siblings('li').removeClass('active').find('input').prop('checked', false);

    });

  }

  /**
   * $(document).ready
   * Specify a function to execute when the DOM is fully loaded.
   */

  $(function($) {
    mfnFieldRadioImg();
  });

})(jQuery);
