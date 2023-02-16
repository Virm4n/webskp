(function($) {

  /* globals jQuery */

  "use strict";

  function mfnFieldAjax() {

    var $group = $('.mfn-ui .form-group.ajax');

    $group.on('click', '.mfn-btn', function(e) {

      e.preventDefault();

      if ( confirm( "Are you sure you want to do this?\nIt can not be restored at a later time! Continue?" ) ) {

        var el = $(this);
        var ajax = el.attr('data-ajax');
        var param = el.attr('data-param');

        var post = {
          action: 'mfn_love_randomize',
          post_type: param
        };

        $.post(ajax, post, function(data) {
          $('.btn-wrapper', el).text(data);
        });

      } else {
        return false;
      }

    });

  }

  /**
   * $(document).ready
   * Specify a function to execute when the DOM is fully loaded.
   */

  $(function() {
    mfnFieldAjax();
  });

})(jQuery);
