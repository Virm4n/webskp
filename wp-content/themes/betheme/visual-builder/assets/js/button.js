(function ($) {
	'use strict';


	var MfnGutenberg = {
		init: function () {
			//if( !$('body').hasClass('post-new-php') ){
		      MfnGutenberg.addButton();
			//}
		},

		addButton: function() {
			setTimeout(function() {
				if( !$('#editor .mfn-live-edit-page-button').length ){
					$('#editor').find('.edit-post-header .edit-post-header__toolbar').append('<div style="margin:0 20px;" class="mfn-live-edit-page-button"><a href="post.php?post='+wp.data.select("core/editor").getCurrentPostId()+'&action=mfn-live-builder" class="mfn-btn mfn-switch-live-editor mfn-btn-green">Edit with Muffin Live Builder</a></div>');
					if( $('body').hasClass('post-new-php') ){ MfnGutenberg.buttonAction(); }
				}
			}, 2000);
		},


		buttonAction: function() {

			$('.mfn-switch-live-editor').on('click', function(e) {
				e.preventDefault();
				var $btn = $(this);

				if(!$btn.hasClass('loading')){
					$btn.addClass('loading');
					$.ajax({
			            url: ajaxurl,
			            data: {
			                'mfn-builder-nonce': $('input[name="mfn-builder-nonce"]').val(),
			                action: 'mfnvbsavedraft',
			                posttype: wp.data.select( 'core/editor' ).getCurrentPostType(),
			                id: wp.data.select("core/editor").getCurrentPostId()
			            },
			            type: 'POST',
			            success: function(response){

			            	window.history.pushState("data", "Edit Page", 'post.php?post='+wp.data.select("core/editor").getCurrentPostId()+'&action=edit');
			            	window.location.href = $btn.attr('href');


			            }
			        });
				}

			});
		}

	};

	$(function () {

		wp.domReady(function() {
			MfnGutenberg.init();
		});

	});


})(jQuery);
