/* globals ajaxurl, Cookies, jQuery, wp */
/* jshint esversion: 6 */

(function($) {

  "use strict";

  var MfnBuilder = (function($) {

    var $builder = $('#mfn-builder'),
      $desktop = $('#mfn-desk'),
      $modal = $('.mfn-modal', $builder),
      $currentModal = false,
      $sender = false, // curent action sender
      $guttenberg = false;

    var uids = [],
      openedModals = [], // array of opened modals
      loading = true, // prevent some functions until window load
      timerSerch = false; // search timer
      // previewTab = false; // builder preview window

    /**
     * Sortable
     */

    var sort = {

      // sort.desktop()

      desktop: function(){

        $desktop.sortable({

          items: '.mfn-section',
          cancel: '.dropdown-wrapper',
          // axis: 'y',

          cursor: 'move',
          cursorAt: { top:20, left:20 },
          distance: 5,
          opacity: 0.9,

          forcePlaceholderSize: true,
          placeholder: 'mfn-placeholder',
          forceHelperSize: false,
          helper: sort.helper

        });

      },

      // sort.section()

      section: function( $section ){

        $section.sortable({

          items: '.mfn-wrap, .mfn-section-new',
          cancel: '.mfn-section-new',
          connectWith: '.mfn-sortable-section',

          cursor: 'move',
          cursorAt: { top:20, left:20 },
          distance: 5,
          opacity: 0.9,

          forcePlaceholderSize: true,
          placeholder: 'mfn-placeholder',
          forceHelperSize: false,
          helper: sort.helper,

          over: sort.over,
          receive: sort.sectionReceive,
          out: sort.sectionOut

        });

      },

      // sort.helper()

      helper: function( event, ui ) {

        var title = ui.data('title');

        if( ui.hasClass('divider') ){
          title = ui.data('title-divider');
        }

        return $('<div class="mfn-helper">'+ title +'</div>');

      },

      // sort.over()

      over: function( event, ui ){

        var size = ui.item.attr('data-size'),
          parentW = ui.placeholder.parent().width(),
          margins = parentW * 0.01, // margin 2x 0.5%
          width = 0;

        width = ( parentW * size ) - margins ;

        ui.placeholder.width( width );

      },

      // sort.sectionReceive()

      sectionReceive: function( event, ui ){

        var $section = ui.item.closest('.mfn-section');
        var id = $section.find( '.mfn-section-id' ).val();

        ui.item.find('.mfn-wrap-parent').val( id );
        $section.removeClass('empty');

      },

      // sort.sectionOut()

      sectionOut: function( event, ui ){

        if( ! ui.sender.find('.mfn-wrap').length ){
          ui.sender.closest('.mfn-section').addClass('empty');
        }

      },

      // sort.wrap()

      wrap: function( $wrap ){

        $wrap.sortable({

          items: '.mfn-item', // .mfn-wrap-new
          // cancel: '.mfn-wrap-new',
          connectWith: '.mfn-sortable-wrap',

          cursor: 'move',
          cursorAt: { top:20, left:20 },
          distance: 5,
          opacity: 0.9,

          forcePlaceholderSize: true,
          placeholder: 'mfn-placeholder',
          forceHelperSize: false,
          helper: sort.helper,

          over: sort.over,
          receive: sort.wrapReceive,
          out: sort.wrapOut

        });

      },

      // sort.wrapReceive()

      wrapReceive: function( event, ui ){

        var $wrap = ui.item.closest('.mfn-wrap');
        var id = $wrap.find( '.mfn-wrap-id' ).val();

        ui.item.find('.mfn-item-parent').val( id );
        $wrap.removeClass('empty');

      },

      // sort.wrapOut()

      wrapOut: function( event, ui ){

        if( ! ui.sender.find('.mfn-item').length ){
          ui.sender.closest('.mfn-wrap').addClass('empty');
        }

      }

    };

    /**
     * Section
     */

    var section = {

      // section.add()

      add: function( $el ) {

        var $clone = $('#mfn-sections .mfn-section').clone(true),
          $section = $el.closest('.mfn-section');

        enableBeforeUnload();

        // enable sortable

        sort.section( $clone.find('.mfn-sortable-section') );

        // hide clone and set data

        $clone.hide();

        element.setNames( $clone );

        // section ID

        $clone.find('.mfn-section-id').val( uniqueID() );

        // first, prev or next

        if ( $el.hasClass('prev') ) {

          $section.before($clone).siblings('.mfn-section').fadeIn(300);

        } else if( $el.hasClass('next') ) {

          $section.after($clone).siblings('.mfn-section').fadeIn(300);

        } else {

          $desktop.append($clone).find('.mfn-section').fadeIn(300);

        }

        // hide intro screen

        if ( $('.mfn-section', $desktop).length ) {
          $builder.removeClass( 'empty' );
        }

        // trigger resize to recalculate some stuff

        triggerResize();

      },

      // section.clone()

      clone: function( $el ){

        var $element = $el.closest('.mfn-section'),
          $clone = false;

        enableBeforeUnload();

        // destroy sortable, clone element

        $element.find('.mfn-sortable').sortable('destroy');

        $clone = $element.clone(true);

        // reinitialize sortable

        sort.section( $element.find('.mfn-sortable-section') );
        sort.section( $clone.find('.mfn-sortable-section') );

        sort.wrap( $element.find('.mfn-sortable-wrap') );
        sort.wrap( $clone.find('.mfn-sortable-wrap') );

        // set section ID and wrap parent ID

        $clone.find('.mfn-section-id, .mfn-wrap-parent').val(uniqueID());

        // set wrap ID and items parent ID

        $clone.find('.mfn-wrap').each(function() {
          $(this).find('.mfn-wrap-id, .mfn-item-parent').val(uniqueID());
        });

        // set items ID

        clonedItemIDs( $clone );

        // insert after current section

        $element.after( $clone );

        // blink

        blink( $clone );

        // trigger resize to recalculate some stuff

        triggerResize();

      },

      // section.preBuilt()

      preBuilt: function( $el ){

        $sender = $el.closest('.mfn-section');

        preBuiltSections.modal.open();

      },

      // section.template()

      template: function( $el ){

        $sender = $el.closest('.mfn-section');

        exportImport.modal.open('templates');

      },

      // section.hide()

      hide: function( $el ){

        var $element = $el.closest('.mfn-section');

        if ( $element.hasClass('hide') ) {

          // show

          $element.removeClass('hide');

          $('.label', $el).text( $el.data('hide') );
          $element.find('input[name="mfn-sections[hide][]"]').val(0);

        } else {

          // hide

          $element.addClass('hide');

          $('.label', $el).text( $el.data('show') );
          $element.find('input[name="mfn-sections[hide][]"]').val(1);

        }

      },

      // section.collapse()

      collapse: function( $el ){

        var $element = $el.closest('.mfn-section'),
          $content = $('.section-content', $element);

        var currentHeight = 0;

        if ( $element.hasClass('collapse') ) {

          // expand

          $content.height('auto');

          currentHeight = $content.height();

          $content.height(0);
          $content.height(currentHeight);

          $element.addClass('is-collapsing');

          setTimeout(function(){
            $element.removeClass('collapse is-collapsing');
            $content.height('auto');
          }, 300);

          $('.label', $el).text( $el.data('hide') );
          $element.find('input[name="mfn-sections[collapse][]"]').val(0);

        } else {

          // hide

          $content.height( $content.height() );
          $content.outerHeight(0);

          $element.addClass('collapse');

          $('.label', $el).text( $el.data('show') );
          $element.find('input[name="mfn-sections[collapse][]"]').val(1);

        }

        // trigger resize to recalculate some stuff

        triggerResize();

      },

      // section.addRow()

      addRow: {

        // section.addRow.mouseEnter()

        mouseEnter: function( $el ){

          $el.closest('.mfn-section').addClass('add-section-'+ $el.data('position'));

        },

        // section.addRow.mouseLeave()

        mouseLeave: function( $el ){

          $el.closest('.mfn-section').removeClass('add-section-'+ $el.data('position'));

        }

      },

      // section.move()

      move: {

        // section.move.up()

        up: function( $el ){

          var $element = $el.closest('.mfn-section');

          $element.prev().insertAfter( $element );

        },

        // section.move.down()

        down: function( $el ){

          var $element = $el.closest('.mfn-section');

          $element.next().insertBefore( $element );

        },

      },

      // section.info()

      info: function( $el ){

        var $info = $('.mfn-section-info', $sender),
          $headerLabel = $('.header-label', $sender);

        var title = $('[name="mfn-sections[title][]"]', $el).val();
        var bgImage = $('[name="mfn-sections[bg_image][]"]', $el).val();
        var bgColor = $('[name="mfn-sections[bg_color][]"]', $el).val();
        var bgPosition = $('[name="mfn-sections[bg_position][]"]', $el).val();
        var bgSize = $('[name="mfn-sections[bg_size][]"]', $el).val();
        var paddingTop = $('[name="mfn-sections[padding_top][]"]', $el).val();
        var paddingBottom = $('[name="mfn-sections[padding_bottom][]"]', $el).val();
        var paddingSide = $('[name="mfn-sections[padding_horizontal][]"]', $el).val();
        var style = $('[name="mfn-sections[style][]"]', $el).val();
        var customClass = $('[name="mfn-sections[class][]"]', $el).val();
        var customID = $('[name="mfn-sections[section_id][]"]', $el).val();

        var styles = '';

        if( 'no-repeat;center top;fixed;;still' == bgPosition ){
          bgPosition = 'fixed';
          bgSize = 'auto';
        } else if( 'no-repeat;center;fixed;cover;still' == bgPosition ){
          bgPosition = 'fixed';
          bgSize = 'cover';
        } else if( 'no-repeat;center top;fixed;cover' == bgPosition ){
          bgPosition = 'parallax';
          bgSize = 'auto';
        } else {
          bgPosition = bgPosition.split(";");
          bgPosition = bgPosition[1];
        }

        if( 'cover-ultrawide' == bgSize ){
          bgSize = 'cover+';
        }

        // section title bar

        if( customID ){
          customID = '#' + customID;
        }

        $( '.header-label-title', $headerLabel ).text(title);
        $( '.header-label-hashtag', $headerLabel ).text(customID);

        // section info

        $( '.mfn-info-bg-image', $info ).attr('src', bgImage);
        $( '.mfn-info-bg-color', $info ).text(bgColor);
        $( '.mfn-info-bg-color-preview', $info ).css('background-color', bgColor);
        $( '.mfn-info-bg-position', $info ).text(bgPosition);
        $( '.mfn-info-bg-size', $info ).text(bgSize);
        $( '.mfn-info-padding-top', $info ).text(paddingTop);
        $( '.mfn-info-padding-bottom', $info ).text(paddingBottom);
        $( '.mfn-info-padding-side', $info ).text(paddingSide);

        // custom

        $( '.mfn-info-custom-class', $info ).text(customClass);
        $( '.mfn-info-custom-id', $info ).text(customID);

        if( customClass || customID ){
          $( '.dropdown-group-custom', $info ).removeClass( 'hide' );
        } else {
          $( '.dropdown-group-custom', $info ).addClass( 'hide' );
        }

        // styles

        $( '.mfn-info-style', $info ).empty();

        $('.checkboxes.pseudo .active', $el).each(function(){
          styles += '<li>'+ $(this).text() +'</li>';
        });

        if( styles ){
          $( '.dropdown-group-style', $info ).removeClass( 'hide' );
          $( '.mfn-info-style', $info ).html( styles );
        } else {
          $( '.dropdown-group-style', $info ).addClass( 'hide' );
        }

        // section classes

        $sender.removeClass('full-width');

        if( -1 != style.indexOf('full-') ){
          $sender.addClass('full-width');
        }

      },

      // section.menu()

      menu: function( $el ){

        if( $builder.hasClass('hover-effects') ){
          return false;
        }

        $el.closest('.mfn-option-dropdown').toggleClass('hover');

      }

    };

    /**
     * Wrap
     */

    var wrap = {

      // wrap.add()

      add: function( $el, divider, size ){

        var $clone = $('#mfn-wraps .mfn-wrap').clone(true),
          $parent = $el.closest('.mfn-section'),
          $parentID = $parent.find('.mfn-section-id').val();

        enableBeforeUnload();

        divider = typeof divider !== 'undefined' ? divider : false;
        size = typeof size !== 'undefined' ? size : false;

        // enable sortable

        if ( ! divider ) {
          sort.wrap( $clone.find('.mfn-sortable-wrap') );
        }

        // hide clone and set attributes

        $clone.hide();

        element.setNames( $clone );

        // set cloned wrap as divider

        if ( divider ) {
          $clone.addClass('divider')
            .find('.mfn-wrap-size').val('divider');
        }

        // set size

        if ( size ) {
          $clone.attr('data-size', sizeLabel2Index[size]);
          $clone.find('.mfn-wrap-size').val(size);
          $clone.find('.mfn-element-size-label').first().text(size);
        }

        // set wrap ID and parent section ID

        $clone.find('.mfn-wrap-id').val( uniqueID() );
        $clone.find('.mfn-wrap-parent').val( $parentID );

        // section is no longer empty

        $parent.removeClass('empty');

        // insert at the end of target section

        $parent.find('.mfn-sortable-section')
          .append($clone).find('.mfn-wrap').fadeIn(300);

        // blink

        blink( $clone );

        // trigger resize to recalculate some stuff

        triggerResize();

      },

      // wrap.predefined()

      predefined: function( $el ){

        var layout = $el.attr('data-tooltip');

        layout = layout.split(' | ');

        $.each( layout, function(i, obj){
          wrap.add( $el, false, layout[i] );
        });

      },

      // wrap.clone()

      clone: function( $el ) {

        var $element = $el.closest('.mfn-wrap'),
          $clone = false;

        enableBeforeUnload();

        // destroy sortable, clone element

        $element.find('.mfn-sortable').sortable('destroy');

        $clone = $element.clone(true);

        $clone.removeClass('hover');

        // reinitialize sortable

        sort.wrap( $element.find('.mfn-sortable-wrap') );
        sort.wrap( $clone.find('.mfn-sortable-wrap') );

        // set wrap ID and items parent ID

        $clone.find('.mfn-wrap-id, .mfn-item-parent').val(uniqueID());

        // set item ID

        clonedItemIDs( $clone );

        // insert after current wrap

        $element.after( $clone );

        // blink

        blink( $clone );

        // trigger resize to recalculate some stuff

        triggerResize();

      },

      // wrap.mouseEnter()

      mouseEnter: function( $el ){

        $el.addClass('hover');

      },

      // wrap.mouseLeave()

      mouseLeave: function( $el ){

        $el.removeClass('hover');

      }

    };

    /**
     * Item
     */

    var item = {

      // item.add()

      add: function( $el ){

        // set action sender

        $sender = $el.closest('.mfn-wrap');

        // open modal

        modal.open( $('.modal-add-items', $builder) );

        $('.mfn-search', $currentModal).focus();

      },

      // item.clone()

      clone: function( $el ) {

        var $element = $el.closest('.mfn-item'),
          $clone = $element.clone(true),
          uid = $clone.find('.mfn-item-id').val();

        enableBeforeUnload();

        $clone.removeClass('hover');

        // set new ID

        $clone.find('.mfn-item-id').val( uniqueID() );

        // insert after current item

        $element.after( $clone );

        // blink

        blink( $clone );

        // trigger resize to recalculate some stuff

        triggerResize();

        // trigger custom event

        $(document).trigger('mfn:builder:item:clone', [$clone, uid]);

      },

      modal: {

        // item.modal.add()

        add: function( $el ){

          var $target = $sender.find('.mfn-sortable-wrap').first(),
            $clone = false;

          var parentID = $sender.find('.mfn-wrap-id').val(),
            parentSize = $sender.closest('.mfn-wrap').attr('data-size'),
            type = $el.parent('li').attr('data-type'),
            uid = uniqueID();

          enableBeforeUnload();

          $clone = $('#mfn-items').find('div.mfn-item-' + type).clone(true);

          // close modal

          modal.close();

          // set attributes

          element.setNames( $clone );

          // set item ID and parent wrap ID

          $clone.find('input.mfn-item-id').val( uid );
          $clone.find('.mfn-item-parent').val( parentID );

          // small wrap fix | if wrap is smaller or equal 1/4 add 1/1 item

          if ( parentSize <= 0.5 ) {
            $clone.attr('data-size', 1);
            $clone.find('input.mfn-item-size').val('1/1');
            $clone.find('.mfn-element-size-label').text('1/1');
          }

          // wrap is no longer empty

          $sender.removeClass('empty');

          // insert at the end of target wrap

          $target.append($clone).find('.mfn-item');

          // blink

          blink( $clone );

          // trigger resize to recalculate some stuff

          triggerResize();

          // trigger custom event

          $(document).trigger('mfn:builder:item:add', [$clone]);

        },

        // item.modal.search()

        search: function( value ){

          var $items = $('.mfn-items-list li', $currentModal);

          value = value.replace(/ /g, '_').toLowerCase();

          if( value ){

            $items.filter('[data-type*=' + value + ']').show();
            $items.not('[data-type*=' + value + ']').hide();

            $('.modalbox-tabs li', $currentModal).removeClass('active');

          } else {

            $items.show();

            $('.modalbox-tabs li:first', $currentModal).addClass('active');

          }
        },

        // item.modal.searchTimer()

        searchTimer: function( $input ){

          clearTimeout( timerSerch );
          timerSerch = setTimeout(function() {
            item.modal.search( $input.val() );
          }, 300, $input);

        },

        // item.modal.tabs()

        tabs: function( $el ){

          var $items = $('.mfn-items-list', $currentModal);

          var filter = $el.attr('data-filter');

          // clear search field

          $('.mfn-search', $currentModal).val('');

          // add active on tab click and filter

          $el.addClass('active')
            .siblings().removeClass('active');

          if ( '*' == filter ) {
            $items.find('li').show();
          } else {
            $items.find('li.category-' + filter).show();
            $items.find('li').not('.category-' + filter).hide();
          }

        },

        // item.modal.close()

        close: function(){

          $('.modalbox-tabs li', $currentModal).removeClass('active')
            .first().children('a').trigger('click');

        }

      },

      // item.preview()

      preview: function( $el ){

        var type = $sender.attr('data-type');

        var $preview = $('.item-preview', $sender),
          $tabs = $('.preview-tabs', $el),
          $images = $('.preview-images', $el);

        var image = $('.preview-image', $el).val(),
          title = $('.preview-title', $el).val(),
          subtitle = $('.preview-subtitle', $el).val(),
          content = $('.preview-content', $el).val(),
          style = $('.preview-style', $el).val(),
          number = $('.preview-number', $el).val(),
          category = $('.preview-category option:selected', $el).text(),
          categoryAll = $('.preview-category-all', $el).val(),
          icon = $('.preview-icon', $el).val(),
          align = $('.preview-align input:checked', $el).val(),

          placeholder = '',
          tabs = '',
          images = '';

        // values

        if( ['code','content','fancy_divider','map','map_basic','sidebar_widget','slider_plugin','video'].includes(type) ){
          // these items has the placeholder image
          image = 'placeholder';
        } else {
          $( '.item-preview-image', $preview ).attr('src', image);
        }

        $( '.item-preview-title', $preview ).text(title);
        $( '.mfn-item-label', $sender ).text(title); // label used in simple view
        $( '.item-preview-subtitle', $preview ).text(subtitle);
        $( '.item-preview-number', $preview ).text(number);

        // align

        $preview.removeClass('align- align-left align-center align-right align-justify');

        if( align ){
          $preview.addClass( 'align-' + align );
        }

        // style

        if( ['blog','portfolio'].includes(type) ){

          if( ! style ){
            style = 'grid';
          }

          style = style.replace(/[, ]/g, '-');

          placeholder = $( '.item-preview-placeholder', $preview ).attr('data-dir');
          placeholder += style + '.svg';

          $( '.item-preview-placeholder', $preview ).attr('src', placeholder);

        }

        // icon

        if( ['counter','icon_box','list'].includes(type) && image ){
          // image replaces icon in some items
          icon = false;
        }

        $( '.item-preview-icon i', $preview ).attr('class', icon);

        // category

        if( categoryAll ){
          category = categoryAll;
        }

        $( '.item-preview-category', $preview ).text(category);

        // content

        if( content ){

          var excerpt;

          if( ['column','visual'].includes(type) ){

            var allowed_tags = '<a><b><blockquote><br><em><h1><h2><h3><h4><h5><h6><i><img><li><ol><p><span><strong><u><ul><table><tr><th><td>';

            // remove unwanted HTML tags
            excerpt = strip_tags( content, allowed_tags );

            // remove style=""
            excerpt = excerpt.replace(/(style=['"]([\w!@#$:; &()`.+,/"'-]*) ?: ?([\w!: ;@#$&()`.+,"/'-]*)['"])/g, '', excerpt);

            // wrap shortcodes into span to highlight
            excerpt = excerpt.replace(/(\[(.*?)?\[\/)((.*?)?\])|(\[(.*?)?\])/g, '<span class="item-preview-shortcode">$&</span>', excerpt);

          } else {

            var tmp = document.createElement( 'div' );
            tmp.innerHTML = content;

            excerpt = tmp.textContent || tmp.innerText || "";

            // strip_shortcodes

            excerpt = excerpt.replace(/\[.*?\]/g, ''); // do not put space before regex

            // 16 words

            excerpt = excerpt.split(" ").splice(0, 16).join(" ");

            if( excerpt.length < content.length ){
              excerpt += '...';
            }

          }

          content = excerpt;

          $( '.item-preview-content', $preview ).html(content);

        }

        // tabs

        if( $tabs.length ){
          $('li:not(.default)', $tabs).each(function(){
            tabs += '<li>'+ $(this).find('.title').text() +'</li>';
          });
        }

        $( '.item-preview-tabs', $preview ).html(tabs);

        // images

        if( $images.length ){
          $('li', $images).each(function(){
            images += '<li><img src="'+ $(this).find('img').attr('src') +'" /></li>';
          });
        }

        $( '.item-preview-images', $preview ).html(images);

        // empty

        if( image ){
          $( '.preview-group.image', $preview ).removeClass('empty');
        } else {
          $( '.preview-group.image', $preview ).addClass('empty');
        }

        if( title ){
          $( '.item-preview-title', $preview ).removeClass('empty');
        } else {
          $( '.item-preview-title', $preview ).addClass('empty');
        }

        if( subtitle ){
          $( '.item-preview-subtitle', $preview ).removeClass('empty');
        } else {
          $( '.item-preview-subtitle', $preview ).addClass('empty');
        }

        if( content ){
          $( '.item-preview-content', $preview ).removeClass('empty');
        } else {
          $( '.item-preview-content', $preview ).addClass('empty');
        }

        if( style ){
          $( '.item-preview-style', $preview ).parent().removeClass('empty');
        } else {
          $( '.item-preview-style', $preview ).parent().addClass('empty');
        }

        if( number ){
          $( '.item-preview-number', $preview ).removeClass('empty');
        } else {
          $( '.item-preview-number', $preview ).addClass('empty');
        }

        if( category ){
          $( '.item-preview-category', $preview ).parent().removeClass('empty');
        } else {
          $( '.item-preview-category', $preview ).parent().addClass('empty');
        }

        if( icon ){
          $( '.item-preview-icon', $preview ).removeClass('empty');
        } else {
          $( '.item-preview-icon', $preview ).addClass('empty');
        }

        if( tabs ){
          $( '.item-preview-tabs', $preview ).removeClass('empty');
        } else {
          $( '.item-preview-tabs', $preview ).addClass('empty');
        }

        if( images ){
          $( '.item-preview-images', $preview ).removeClass('empty');
        } else {
          $( '.item-preview-images', $preview ).addClass('empty');
        }

      },

      // item.mouseEnter()

      mouseEnter: function( $el ){

        $el.addClass('hover')
          .closest('.mfn-wrap').removeClass('hover');

      },

      // item.mouseLeave()

      mouseLeave: function( $el ){

        $el.removeClass('hover')
          .closest('.mfn-wrap').addClass('hover');

      }

    };

    /**
     * Element
     */

    var element = {

      // element.delete()

      delete: function( $el ){

        var $element = $el.closest('.mfn-element');

        // block window unload if any changes were made

        enableBeforeUnload();

        // set action sender

        $sender = $element;

        // open modal

        modal.open( $('.modal-confirm-element', $builder) );

        $currentModal.find('.btn-modal-confirm').focus();

      },

      // element.edit()

      edit: function( $el ){

        var $modalEdit = $('.modal-item-edit', $builder),
          $modalContent = $modalEdit.find('.modalbox-content'),
          $meta = false;

        var title = '',
          type = '';

        // block window unload if any changes were made

        enableBeforeUnload();

        // set action sender

        $sender = $el;

        // prepare modal content

        $meta = $sender.children('.mfn-element-meta');

        $meta.appendTo( $modalContent );

        // set modal title and icon

        title = $sender.data('title');
        type = $sender.data('type');

        $( '.modalbox-title', $modalEdit ).text(title);
        $modalEdit.attr('data-type', type);

        // trigger custom event

        $(document).trigger('mfn:builder:edit', [$modalEdit]);

        // open modal

        modal.open( $modalEdit );

        $( 'input:first', $currentModal ).focus();

      },

      modal: {

        // element.modal.close()

        close: function(){

          var $meta = $currentModal.find('.modalbox-content .mfn-element-meta');

          var type = $currentModal.attr('data-type');

          // 'column' == type

          if( 'column' == type ){
            $('.modalbox-tabs li:first a', $currentModal).trigger('click');
          }

          // trigger custom event

          $(document).trigger('mfn:builder:close', [$currentModal]);

          // section info, item preview

          if ( 'section' == type ) {
            section.info( $currentModal );
          } else if ( 'wrap' != type ) {
            item.preview( $currentModal );
          }

          // append modal data to sender

          $meta.appendTo( $sender );

          $currentModal.removeAttr('data-type');

          // blink

          blink( $sender );

        },

        // element.modal.delete()

        delete: function(){

          var $element = $sender;

          // close modal

          modal.close();

          $element.fadeOut( 300, function() {

            // show start section screen

            if( $element.hasClass( 'mfn-section' ) ){
              if ( ! $element.siblings('.mfn-section').length ) {
                $builder.addClass( 'empty' );
              }
            }

            // check if section will be empty

            if( $element.hasClass( 'mfn-wrap' ) ){
              if( ! $element.siblings('.mfn-wrap').length ){
                $element.closest('.mfn-section').addClass( 'empty' );
              }
            }

            // check if wrap will be empty

            if( $element.hasClass( 'mfn-item' ) ){
              if( ! $element.siblings('.mfn-item').length ){
                $element.closest('.mfn-wrap').addClass( 'empty' );
              }
            }

            // remove item

            $element.remove();

            // trigger resize to recalculate some stuff

            triggerResize();

          });

        },

        // element.modal.tabs()

        tabs: function( $el ){

          var $tab = $el.closest('li');

          var card = $tab.data('card');

          $tab.addClass('active')
            .siblings().removeClass('active');

          $( '.modalbox-card-' + card, $currentModal ).addClass('active')
            .siblings().removeClass('active');

        }

      },

      // element.setNames()
      // data-name -> name

      setNames: function( $el ){

        // element attributes: section-id, parent, size

        $el.find('.mfn-element-data').each(function() {
          $(this).attr('name', $(this).attr('data-name'))
            .removeAttr('data-name');
        });

        // element form options

        $el.find('.mfn-element-meta').find('input, select, textarea').each(function() {
          $(this).attr('name', $(this).attr('data-name'))
            .removeAttr('data-name');
        });

      }

    };

    /**
     *
     */

    var size = {

      // size.calculate()

      calculate: function( currentSize, type, plusMinus, longpress ){

        var elementSizes = items[type],
          currentLabel = sizeIndex2Label[currentSize],
          newSize = false,
          position = false;

        if( longpress ){

          // longpress - max/min size of item

          if( 1 == plusMinus ){
            newSize = '1/1';
          } else {
            newSize = elementSizes[0];
          }

        } else {

          position = elementSizes.indexOf(currentLabel);
          newSize = elementSizes[ position + plusMinus ];

        }

        if( newSize ){
          newSize = sizeLabel2Index[newSize];
        }

        return newSize;
      },

      // size.change()

      change: function( $el, plusMinus, longpress ){

        var $element = $el.closest('.mfn-element');

        var type = 'wrap',
          currentSize = $element.attr('data-size'),
          newSize = false;

        enableBeforeUnload();

        // is it and item or a wrap

        if ( ! $element.hasClass('mfn-wrap') ) {
          type = $element.find('.mfn-item-type').first().val();
        }

        // calculate and set new size

        newSize = this.calculate( currentSize, type, plusMinus, longpress );

        if( newSize ){

          $element.attr('data-size', newSize );
          $element.children('.mfn-element-size').val( sizeIndex2Label[newSize] );
          $element.find('.mfn-element-size-label').first().text( sizeIndex2Label[newSize] );

        }

        // trigger resize to recalculate some stuff

        triggerResize();

      },

      // size.increase()

      increase: function( $el ){
        this.change( $el, 1, false );
      },

      // size.increaseLong()

      increaseLong: function( $el ){
        this.change( $el, 1, true );
      },

      // size.decrease()

      decrease: function( $el ){
        this.change( $el, -1, false );
      },

      // size.decreaseLong()

      decreaseLong: function( $el ){
        this.change( $el, -1, true );
      }

    };

    var modal = {

      // modal.open()

      open: function( $senderModal ){

        $currentModal = $senderModal;

        $currentModal.addClass('show');

        $('body').addClass('mfn-modal-open');

        openedModals.push( $currentModal );

      },

      // modal.close()

      close: function(){

        if( ! $currentModal ){
          return false;
        }

        $currentModal = openedModals.pop();

        $('.modalbox-content', $currentModal).scrollTop(0);

        $currentModal.removeClass('show');

        // shortcode editor: tooltips like table builder

        $currentModal.find('.editor-header a.focus').removeClass('focus');

        // if other modals are open, do not remove body class

        if( ! $('.mfn-modal.show').length ){
          $('body').removeClass('mfn-modal-open');
        }

        // close add item

        if( $currentModal.hasClass('modal-add-items') ){
          item.modal.close();
        }

        // close element edit

        if( $currentModal.hasClass('modal-item-edit') ){
          element.modal.close();
        }

        // close export import

        if( $currentModal.hasClass('modal-export-import') ){
          exportImport.modal.close();
        }

        // set new current modal

        $currentModal = openedModals[openedModals.length - 1];

      }

    };

    var menu = {

      // menu.sticky()

      sticky: function(){

        if ( ! $guttenberg.length ){
          return false;
        }

        var $menu = $('.mfn-menu-inner', $builder),
          $wrapper = $('.mfn-wrapper', $builder);

        var guttenbergT = $guttenberg.offset().top,
          guttenbergFooterH = $('.interface-interface-skeleton__footer').height() || 0,
          guttenbergB = guttenbergT + $guttenberg.height() - guttenbergFooterH,
          wrapperT = $wrapper.offset().top,
          wrapperB = wrapperT + $wrapper.height(),
          top = $guttenberg.position().top + parseInt($('html').css('padding-top'));

        var offset = guttenbergT - wrapperT,
          limit = guttenbergB - wrapperB;

        if( limit > 0 ){
          offset = offset - limit;
        }

        if( limit > 0 ){

          $menu.removeClass( 'fixed' ).addClass( 'stick-bottom' );

        } else {

          $menu.removeClass( 'stick-bottom' );

          if( offset > 0 ){
            $menu.addClass( 'fixed' ).css( 'top', top + 'px' );
          } else {
            $menu.removeClass( 'fixed' ).css( 'top', 0 );
          }

        }

      }

    };

    /**
     * Pre-built sections
     */

    var preBuiltSections = {

      modal: {

        // preBuiltSections.modal.openNew()
        // open sections modal using the menu button so there is no sender section

        openNew: function(  ){

          $sender = false;

          this.open();

        },

        // preBuiltSections.modal.open()

        open: function(){

          // open modal

          modal.open( $('.modal-sections-library', $builder) );

          // open first tab

          $('.modalbox-tabs li:first a', $currentModal).trigger('click');

        },

        // preBuiltSections.modal.tabs()

        tabs: function( $el ){

          var $items = $('.mfn-sections-list', $currentModal);

          var filter = $el.attr('data-filter');

          // add active on tab click and filter

          $el.addClass('active')
            .siblings().removeClass('active');

          if ( '*' == filter ) {
            $items.find('li').show();
          } else {
            $items.find('li.category-' + filter).show();
            $items.find('li').not('.category-' + filter).hide();
          }

        }

      },

      // preBuiltSections.add()

      add: function( $el ){

        var id = $el.closest('li').attr('data-id'),
          btnText = $el.text();

        $el.addClass('disabled loading');

        // import and insert section

        $.ajax( ajaxurl, {

          type : "POST",
          data : {
            'mfn-builder-nonce': $('input[name="mfn-builder-nonce"]').val(),
            action: 'mfn_builder_pre_built_section',
            id: id
          }

        }).done(function( response ){

          if( '<' == response.charAt(0) ){

            if( $sender ){
              $sender.after(response);
              $sender = $sender.next();
              if( $sender.prev().hasClass('empty') ){
                $sender.prev().remove();
              }
            } else {
              $desktop.append(response);
            }

            if( $('.mfn-section', $desktop).length ){
              $builder.removeClass('empty');
            } else {
              $builder.addClass('empty');
            }

            // reinitialize sortable

            sort.section( $( '.mfn-sortable-section', $desktop ) );
            sort.wrap( $( '.mfn-sortable-wrap', $desktop ) );

            getIDs();

          } else if( response ) {

            alert(response);

          }

          // button and close

          $el.removeClass('loading').find('.text').text('Done');

          setTimeout(function(){
            $el.removeClass('disabled').find('.text').text(btnText);
          },1000);

          // trigger resize to recalculate some stuff

          triggerResize();

        });

      }

    };

    /**
     * Export import builder
     */

    var exportImport = {

      modal: {

        // exportImport.modal.open()

        open: function( $tab = false ){

          // open modal

          modal.open( $('.modal-export-import', $builder) );

          // reset to defaults

          $('textarea', $currentModal).val('');
          $('.mfn-import-type', $currentModal).val('before');
          $('.mfn-items-import-template li:first a', $currentModal).trigger('click');

          // which tab should be opened

          if( 'templates' == $tab ){

            $('.modalbox-tabs li', $currentModal).removeClass('active')
              .eq(2).children('a').trigger('click');

            $currentModal.addClass('templates-only');

          } else if( 'page' == $tab ){

            $('.modalbox-tabs li', $currentModal).removeClass('active')
              .eq(3).children('a').trigger('click');

          } else {

            // generate export

            exportImport.export();

          }

        },

        // exportImport.modal.close()

        close: function(){

          $('.modalbox-tabs li', $currentModal).removeClass('active')
            .first().children('a').trigger('click');

          $currentModal.removeClass('templates-only');

          $sender = false;

        },

        // exportImport.modal.tabs()

        tabs: function( $el ){

          var $tab = $el.closest('li');
          var card = $tab.data('card');

          $tab.addClass('active')
            .siblings().removeClass('active');

          $( '.modalbox-card-' + card, $currentModal ).addClass('active')
            .siblings().removeClass('active');

        },

      },

      // exportImport.export()

      export: function(){

        var $textarea = $('.mfn-items-export', $currentModal);

        var form = $builder.closest('form').serialize();

        form += '&action=mfn_builder_export';

        $.ajax( ajaxurl, {

          type : "POST",
          data : form

        }).done(function(response){

          $textarea.val(response);

        });

      },

      // exportImport.copy()

      copy: function( $el ){

        var $textarea = $('.mfn-items-export', $currentModal);

        var btnText = $el.text();

        $textarea.select();
        document.execCommand('copy');

        $el.addClass('disabled')
          .find('span').text('Copied, closing...');

        setTimeout(function(){
          $el.removeClass('disabled')
            .find('span').text(btnText);
          modal.close();
        },1000);

      },

      // exportImport.import()

      import: function( $el ){

        var $textarea = $('#mfn-items-import', $currentModal);

        var form = $builder.closest('form'),
          type = $('#mfn-import-type', $currentModal).val(),
          btnText = $el.text();

        if( ! $textarea.val() ){
          return false;
        }

        $el.addClass('disabled loading');

        // set input name

        $textarea.attr('name', $textarea.attr('id'));

        // set ajax action

        form = form.serialize(); // serialize AFTER input name set
        form += '&action=mfn_builder_import';

        $.ajax(ajaxurl, {

          type : "POST",
          data : form

        }).done(function(response){

          if( 'after' == type ){
            $desktop.append(response);
          } else if ( 'replace' == type ) {
            $desktop.empty().append(response);
          } else {
            $desktop.prepend(response);
          }

          if( $('.mfn-section', $desktop).length ){
            $builder.removeClass('empty');
          } else {
            $builder.addClass('empty');
          }

          // reinitialize sortable

          sort.section( $( '.mfn-sortable-section', $desktop ) );
          sort.wrap( $( '.mfn-sortable-wrap', $desktop ) );

          getIDs();

          // button and close

          $el.removeClass('loading')
            .find('span').text('Imported, closing...');

          setTimeout(function(){
            $el.removeClass('disabled')
              .find('span').text(btnText);
            modal.close();
          },1000);

          // trigger resize to recalculate some stuff

          triggerResize();

        }).always(function(){

          $textarea.removeAttr('name');

        });

      },

      // exportImport.page()

      page: function( $el ){

        var $input = $('#mfn-items-import-page', $currentModal);

        var form = $builder.closest('form'),
          type = $('#mfn-import-type-page', $currentModal).val(),
          btnText = $el.text();

        if( ! $input.val() ){
          return false;
        }

        $el.addClass('disabled loading');

        // set input name

        $input.attr('name', $input.attr('id'));

        // set ajax action

        form = form.serialize(); // serialize AFTER input name set
        form += '&action=mfn_builder_import_page';

        $.ajax(ajaxurl, {

          type : "POST",
          data : form

        }).done(function(response){

          if( 'after' == type ){
            $desktop.append(response);
          } else if ( 'replace' == type ) {
            $desktop.empty().append(response);
          } else {
            $desktop.prepend(response);
          }

          if( $('.mfn-section', $desktop).length ){
            $builder.removeClass('empty');
          } else {
            $builder.addClass('empty');
          }

          // reinitialize sortable

          sort.section( $( '.mfn-sortable-section', $desktop ) );
          sort.wrap( $( '.mfn-sortable-wrap', $desktop ) );

          getIDs();

          // button and close

          $el.removeClass('loading')
            .find('span').text('Imported, closing...');

          setTimeout(function(){
            $el.removeClass('disabled')
              .find('span').text(btnText);
            modal.close();
          },1000);

          // trigger resize to recalculate some stuff

          triggerResize();

        }).always(function(){

          $input.removeAttr('name');

        });

      },

      template: {

        // exportImport.template.select()

        select: function( $el ){

          var $li = $el.closest('li'),
            $input = $('#mfn-items-import-template');

          $li.addClass('active')
            .siblings('li').removeClass('active');

          $input.val( $li.attr('data-id') );

        },

        // exportImport.template.import()

        import: function( $el ){

          var $input = $('#mfn-items-import-template', $currentModal);

          var form = $builder.closest('form'),
            type = $('#mfn-import-type-template', $currentModal).val(),
            btnText = $el.text();

          if( ! $input.val() ){
            return false;
          }

          $el.addClass('disabled loading');

          // set input name

          $input.attr('name', $input.attr('id'));

          // set ajax action

          form = form.serialize(); // serialize AFTER input name set
          form += '&action=mfn_builder_template';

          $.ajax(ajaxurl, {

            type : "POST",
            data : form

          }).done(function(response){

            if( $sender ){
              $sender.after(response);
              $sender = $sender.next();
              if( $sender.prev().hasClass('empty') ){
                $sender.prev().remove();
              }
            } else if( 'after' == type ){
              $desktop.append(response);
            } else if ( 'replace' == type ) {
              $desktop.empty().append(response);
            } else {
              $desktop.prepend(response);
            }

            if( $('.mfn-section', $desktop).length ){
              $builder.removeClass('empty');
            } else {
              $builder.addClass('empty');
            }

            // reinitialize sortable

            sort.section( $( '.mfn-sortable-section', $desktop ) );
            sort.wrap( $( '.mfn-sortable-wrap', $desktop ) );

            getIDs();

            // button and close

            $el.removeClass('loading')
              .find('span').text('Imported, closing...');

            setTimeout(function(){
              $el.removeClass('disabled')
                .find('span').text(btnText);
              modal.close();
            },1000);

            // trigger resize to recalculate some stuff

            triggerResize();

          }).always(function(){

            $input.removeAttr('name');

          });

        },

      },

      seo: function( $el ){

        var form = $builder.closest('form').serialize(),
          btnText = $el.text();

        $el.addClass('disabled loading');

        form += '&action=mfn_builder_seo';

        $.ajax(ajaxurl, {

          type : "POST",
          data : form

        }).done(function(response){

          var itemsSEO = response.replace(/\n/g, '<br>');

          if( typeof window.wpEditorL10n === "undefined" ) {

            // WordPress 4.9
            $('#content-html').trigger('click');
            $('#content').val(itemsSEO).text(itemsSEO);

          } else {

            // WordPress 5.0
            var block = wp.blocks.createBlock( 'core/paragraph', { content: itemsSEO } );
            wp.data.dispatch( 'core/block-editor' ).insertBlocks( block );

          }

          // button and close

          $el.removeClass('loading')
            .find('span').text('Generated, closing...');

          setTimeout(function(){
            $el.removeClass('disabled')
              .find('span').text(btnText);
            modal.close();
          },1000);

          // trigger resize to recalculate some stuff

          triggerResize();

        });

      }

    };

    /**
     * Revisions
     */

    var revisions = {

      postID: $('input[name="post_ID"]').val(),
      autosaveInterval: 300000, // 5 minutes = 300000
      senderRevision: false, // revision to restore after confirm

      modal: {

        // revisions.modal.open()

        open: function(){

          // open modal

          modal.open( $('.modal-revisions', $builder) );

        },

        // revisions.modal.restore()

        restore: function( $el ){

          revisions.senderRevision = $el;

          // open modal

          modal.open( $('.modal-confirm-revision', $builder) );

        },

        // revisions.modal.confirm()

        confirm: function(){

          // close modal | do NOT change order, change of $currentModal required

          modal.close();

          // restore revision

          revisions.restore( revisions.senderRevision );

          revisions.senderRevision = false;

        }

      },

      // revisions.set()
      // types: revision, update, autosave, backup

      set: function( type ){

        var form = $builder.closest('form').serialize();

        form += '&action=mfn_builder_export';
        form += '&revision-type=' + type;
        form += '&post-id=' + this.postID;

        return $.ajax( ajaxurl, {
          type : "POST",
          data : form
        });

      },

      // revisions.save()

      save: function( $el ){

        var $list = $currentModal.find('ul[data-type="revision"]');

        var btnText = $el.text(),
          revision;

        $el.addClass('disabled loading');

        revision = revisions.set( 'revision' );
        revision.then(function(data) {

          if( data ) {

            $list.empty();

            $.each(JSON.parse(data), function(i, item) {
              $list.append('<li data-time="'+ i +'"><span class="revision-icon mfn-icon-clock"></span><div class="revision"><h6>'+ item +'</h6><a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a></div></li>');
            });

            // enable buttons and close

            $el.removeClass('loading')
              .find('span').text('Saved, closing...');

            setTimeout(function(){
              $el.removeClass('disabled')
                .find('span').text(btnText);
              modal.close();
            },1000);

          }

        });

      },

      // revisions.autosave()

      autosave: function(){

        var $list = $('.mfn-modal.modal-revisions', $builder).find('ul[data-type="autosave"]');

        var revision;

        window.setInterval(function(){

          revision = revisions.set( 'autosave' );
          revision.then(function(data) {

            if( data ) {

              $list.empty();

              $.each(JSON.parse(data), function(i, item) {
                $list.append('<li data-time="'+ i +'"><span class="revision-icon mfn-icon-clock"></span><div class="revision"><h6>'+ item +'</h6><a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a></div></li>');
              });

            }

          });

        }, this.autosaveInterval);

      },

      // revisions.publish()

      publish: function(){

        var $list = $('.mfn-modal.modal-revisions', $builder).find('ul[data-type="update"]');

        var revision = revisions.set( 'update' );

        revision.then(function(data) {

          if( data ) {

            $list.empty();

            $.each(JSON.parse(data), function(i, item) {
              $list.append('<li data-time="'+ i +'"><span class="revision-icon mfn-icon-clock"></span><div class="revision"><h6>'+ item +'</h6><a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a></div></li>');
            });

          }

        });
      },

      // revisions.restore()

      restore: function( $el ){

        var $list = $currentModal.find('ul[data-type="backup"]');

        var time = $el.closest('li').attr('data-time'),
          type = $el.closest('ul').attr('data-type'),
          btnText = $el.text(),
          revision;

        $currentModal.find('a').addClass('disabled');
        $el.addClass('loading');

        // save backup revision before restore

        if( 'backup' != type ){

          revision = revisions.set( 'backup' ); // do NOT move it up
          revision.then(function(data) {

            if( data ){

              $list.empty();

              $.each(JSON.parse(data), function(i, item) {
                $list.append('<li data-time="'+ i +'"><span class="revision-icon mfn-icon-clock"></span><div class="revision"><h6>'+ item +'</h6><a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a></div></li>');
              });

            }

          });

        }

        // restore revision

        $.ajax( ajaxurl, {

          type : "POST",
          data : {
            'mfn-builder-nonce': $('input[name="mfn-builder-nonce"]').val(),
            action: 'mfn_builder_revision_restore',
            time: time,
            type: type,
            post_id: this.postID
          }

        }).done(function(response){

          $desktop.empty().append(response);

          if( $('.mfn-section', $desktop).length ){
            $builder.removeClass('empty');
          } else {
            $builder.addClass('empty');
          }

          // reinitialize sortable

          sort.section( $( '.mfn-sortable-section', $desktop ) );
          sort.wrap( $( '.mfn-sortable-wrap', $desktop ) );

          getIDs();

          // button and close

          $el.removeClass('loading').find('span').text('Done');

          setTimeout(function(){
            $currentModal.find('a').removeClass('disabled');
            $el.find('span').text(btnText);
            modal.close();
          },1000);

          // trigger resize to recalculate some stuff

          triggerResize();

        });

      }

    };

    /**
     * Copy paste
     */

    var copyPaste = {

      // copyPaste.localStorageON();

      localStorageON: function(){

        var test = 'localStorage test';

        try {

          localStorage.setItem(test, test);
          localStorage.removeItem(test);
          return true;

        } catch(e) {

          console.info('Muffin Builder: Section copy/paste require local storage enabled');
          $('.mfn-section-copy').addClass('disabled');
          return false;

        }

      },

      // copyPaste.init()

      init: function(){

        if( this.localStorageON() && localStorage.hasOwnProperty('mfn-builder') ){
          $('.mfn-section-paste').removeClass('disabled');
        } else {
          $('.mfn-section-paste').addClass('disabled');
        }

      },

      section: {

        // copyPaste.section.copy()

        copy: function( $el ){

          var $section = $el.closest('.mfn-section'),
            $nonce = $('input[name="mfn-builder-nonce"]'),
            $fields = $section.find(':input');

          var form = $nonce.add($fields).serialize();

          form += '&action=mfn_builder_export';

          $.ajax( ajaxurl, {

            type : "POST",
            data : form

          }).done(function(response){

            // copy to clipboard

            var temp = $('<input id="mfn-builder-copied" />');

            $('body').append(temp);
            temp.val(response).select();
            document.execCommand('copy');

            temp.remove();

            // save in local storage

            localStorage.setItem( 'mfn-builder', JSON.stringify({
              clipboard: response
            }) );

            $('.mfn-section-paste').removeClass('disabled');

            // button text and icon change

            var btnText = $el.find('.label').text();

            $el.find('.label').text('Copied');
            $el.find('.mfn-icon').removeClass('mfn-icon-export')
              .addClass('mfn-icon-check-blue');

            setTimeout(function(){
              $el.find('.label').text(btnText);
              $el.find('.mfn-icon').removeClass('mfn-icon-check-blue')
                .addClass('mfn-icon-export');
            },1000);

          });

        },

        // copyPaste.section.paste()

        paste: function( $el ){

          var $section = $el.closest('.mfn-section'),
            $nonce = $('input[name="mfn-builder-nonce"]'),
            $temp = $('<input type="hidden" name="mfn-items-import" />');

          var copied = JSON.parse(localStorage.getItem('mfn-builder')).clipboard,
            type = 'after',
            form = false;

          if( ! copied ){
            return false;
          }

          $('body').append($temp);
          $temp.val(copied);

          form = $nonce.add($temp).serialize();
          form += '&action=mfn_builder_import';

          $temp.remove();

          $.ajax(ajaxurl, {

            type : "POST",
            data : form

          }).done(function(response){

            if( $el.hasClass('before') ){
              type = 'before';
            }

            if( 'before' == type ){
               $section.before(response);
            } else {
              $section.after(response);
            }

            $builder.removeClass('empty');

            // reinitialize sortable

            sort.section( $( '.mfn-sortable-section', $desktop ) );
            sort.wrap( $( '.mfn-sortable-wrap', $desktop ) );

            getIDs();

            // button text and icon change

            var btnText = $el.find('.label').text();

            $el.find('.label').text('Pasted');
            $el.find('.mfn-icon').removeClass('mfn-icon-import-' + type)
              .addClass('mfn-icon-check-blue');

            setTimeout(function(){
              $el.find('.label').text(btnText);
              $el.find('.mfn-icon').removeClass('mfn-icon-check-blue')
                .addClass('mfn-icon-import-' + type);
            },1000);

            // trigger resize to recalculate some stuff

            triggerResize();

          });

        }

      }

    };

    /**
     * Builder preview
     */

    var preview = {

      // preview.generate()

      generate: function( $el ){

        var tooltip = $el.data('tooltip'),
          postID = $('input[name="post_ID"]').val(),
          form = $builder.closest('form').serialize();
          // previewURL = $el.attr('href');

        $el.attr('data-tooltip', 'Generating preview...');

        // send save preview request

        form += '&action=mfn_builder_export&preview=' + postID;

        $.ajax( ajaxurl, {

          type : "POST",
          data : form

        }).done(function(response){

          // WordPress preview

          const mouseClickEvents = ['mousedown', 'click', 'mouseup']; // do NOT change order

          function simulateMouseClick(element){

            if( ! element ){
              return false;
            }

            mouseClickEvents.forEach(mouseEventType =>
              element.dispatchEvent(
                new MouseEvent(mouseEventType, {
                  view: window,
                  bubbles: true,
                  cancelable: true,
                  buttons: 1
                })
              )
            );

          }

          $('#post-preview').trigger('click');

          simulateMouseClick(document.querySelector('.edit-post-header-toolbar'));

          setTimeout(function(){

            simulateMouseClick(document.querySelector('.block-editor-post-preview__button-toggle'));

            setTimeout(function(){
              simulateMouseClick(document.querySelector('.edit-post-header-preview__button-external'));
            },10);

          },10);

          /*
          // custom preview tab
          if ( ! previewTab || previewTab.closed ) {
            previewTab = window.open( previewURL, 'preview' );
            if ( previewTab ) {
              previewTab.focus();
            } else {
              alert('Please allow popups to use preview');
            }
          } else {
            previewTab.location.reload();
            previewTab.focus();
          }
          */

          $el.attr('data-tooltip', tooltip);

        });

      }

    };

    /**
     * Builder settings
     */

    var settings = {

      // settings.open()

      open: function(){

        // open modal

        modal.open( $('.modal-settings', $builder) );

        // reset

        $('.mfn-row', $currentModal).removeClass('changed');

        // set options

        if( $builder.hasClass('simple-view') ){
          $currentModal.find('[data-option="simple-view"] li:first').removeClass('active')
            .siblings().addClass('active');
        }

        if( $builder.hasClass('hover-effects') ){
          $currentModal.find('[data-option="hover-effects"] li:first').removeClass('active')
            .siblings().addClass('active');
        }

        if( $builder.hasClass('pre-completed') ){
          $currentModal.find('[data-option="pre-completed"] li:first').removeClass('active')
            .siblings().addClass('active');
        }

      },

      // settings.change()

      change: function( $el ){

        var $li = $el.closest('li'),
          $row = $el.closest('.mfn-row');

        var options,
          option = $el.closest('.form-control').data('option'),
          value = false;

        $li.addClass('active')
          .siblings('li').removeClass('active');

        value = $li.data('value');

        if( value ){
          $builder.addClass(option);
        } else {
          $builder.removeClass(option);
        }

        // get cookie, save the option, set cookie

        options = JSON.parse(Cookies.get( 'mfn-builder' ));
        options[option] = value;

        Cookies.set( 'mfn-builder', JSON.stringify(options), { expires: 365, path: '' } );

        // show info for pre-completed option

        if( 'pre-completed' == option ){
          $row.addClass('changed');
        }

        if( 'hover-effects' == option ){
          triggerResize();
        }

      }

    };

    /**
     * Introduction slider
     */

    var introduction = {

      overlay: $('.mfn-intro-overlay'),

      cookie: {

        // introduction.cookie.get()

        get: function(){

          return Cookies.get('mfn-builder-intro');

        },

        // introduction.cookie.set()

        set: function(){

          Cookies.set( 'mfn-builder-intro', 1, { expires: 365, path: '' } );

        },

        // introduction.cookie.remove()

        remove: function(){

          Cookies.remove( 'mfn-builder-intro', { path: '' } );

        }

      },

      // introduction.open()

      open: function(){

        var $slider = $('.mfn-intro-container ul');

        var slidesAmount = $('.mfn-intro-container ul li').size() - 1;

        // slider has been skipped before and cookie is set
        if( introduction.cookie.get() ){
          return false;
        }

        $('body').addClass('mfn-modal-open');

        introduction.overlay.show();

        // slick has been initialized before so skip steps below
        if( $slider.hasClass('slick-slider') ){
          return false;
        }

        $slider.slick({
          cssEase: 'ease-out',
          dots: false,
          fade: true,
          infinite: false
        });

        $slider.on('afterChange', function(event, slick, currentSlide, nextSlide){
          if ( currentSlide === slidesAmount ){
            introduction.cookie.set();
          }
        });

        // close once on overlay click

        introduction.overlay.on('click', function(e){
          e.preventDefault();
          if ( $(e.target).hasClass('mfn-intro-overlay') ){
            introduction.close();
          }
        });

        // close permanently on X or 'skip' click

        $('.mfn-intro-close').on('click', function(e){
          e.preventDefault();
          introduction.cookie.set();
          introduction.close();
        });

      },

      // introduction.reopen()

      reopen: function(){
        introduction.cookie.remove();
        introduction.open();
      },

      // introduction.close()

      close: function(){
        $('body').removeClass('mfn-modal-open');
        introduction.overlay.fadeOut(200);
      }

    };

    /**
     * Shortcode Editor
     */

    var shortcodeEditor = {

      $popupPath: $('.modal-add-shortcode'),

      // .mfn-sc-editor is always wp.codeEditor.mfnScEditor.shortcodeParentDOM (__scEditor.shortcodeParentDOM) -- field_textarea.js
      $placeToCopy: $('.mfn-sc-editor').find('.modalbox-content'),

      createShortcodeBuilder( buttonName, closestDomLocation ){

        if( 'share_box' == buttonName ){

          wp.codeEditor.mfnFieldTextarea.methods.addCodeIntoTextArea('[share_box]');

        } else {

          if( 'lorem' == buttonName ){
            $(shortcodeEditor.$popupPath).find('.modalbox-title').html('Text generator');
            $(shortcodeEditor.$popupPath).find('.modalbox-footer .btn-modal-close').html('Generate');
          }else{
            $(shortcodeEditor.$popupPath).find('.modalbox-title').html('Shortcode');
            $(shortcodeEditor.$popupPath).find('.modalbox-footer .btn-modal-close').html('Add shortcode');
          }

          shortcodeEditor.modal.add(closestDomLocation);
        }

      },

      modal: {

        // shortcodeEditor.modal.add()

        add: function($el){
          shortcodeEditor.modal.clear();
          $el.clone(true).appendTo(shortcodeEditor.$placeToCopy);
          modal.open(shortcodeEditor.$popupPath);

          $(document).trigger('mfn:builder:edit', $('.mfn-sc-editor', $currentModal));
        },

        // shortcodeEditor.modal.clear()

        clear: function(){
          $('.modal-add-shortcode').removeClass('mfn-lipsum');
          $(shortcodeEditor.$placeToCopy).empty();
        }

      },

      toTextEditor: function(){

        const shortcodeName = $(shortcodeEditor.$placeToCopy).find('[data-shortcode]').attr('data-shortcode');
        const shortcodeAttributes = $(shortcodeEditor.$placeToCopy).find('input[data-name], select[data-name], textarea[data-name]');

        let readyCode = wp.codeEditor.mfnScEditor.methods.modal.createShortcode(shortcodeName, shortcodeAttributes);
        wp.codeEditor.mfnFieldTextarea.methods.addCodeIntoTextArea(readyCode);

      }

    };

    /**
     * Helper
     */

    /**
     * Unique ID
     * Generate unique ID and check for collisions
     */

    var uniqueID = function() {

      var uid = Math.random().toString(36).substr(2, 9);

      if ( -1 !== uids.indexOf( uid ) ) {
        return uniqueID();
      }

      uids.push( uid );

      return uid;
    };

    /**
     * Get IDs
     * Get all existing IDs and set if ID is empty
     */

    var getIDs = function() {

      $( '.mfn-section-id, .mfn-wrap-id, .mfn-item-id', $desktop ).each( function() {
        if ( $(this).val() ) {
          uids.push( $(this).val() );
        }
      });

    };

    /**
     * Set cloned items ID
     */

    var clonedItemIDs = function( $clone ){

      var itemID = '';

      $clone.find('.mfn-item').each(function() {

        // do not change order of these lines: get current id, set new uid, send prev value to replace

        itemID = $(this).find('.mfn-item-id').val();

        $(this).find('.mfn-item-id').val(uniqueID());

        // trigger custom event

        $(document).trigger('mfn:builder:item:clone', [this, itemID]);

      });

    };

    /**
     * Blink when element add, edit, clone, etc
     * blink()
     */

    var blink = function( $el ){

      $el.addClass('blink');

      setTimeout(function(){
        $el.removeClass('blink');
      }, 200);

    };

    /**
     * Go to top
     * goToTop()
     */

    var goToTop = function(){

      $('html, body, .interface-interface-skeleton__content, .edit-post-sidebar').animate({
        scrollTop: 0
      }, 500);

    };

    /**
     * PHP strip_tags
     * locutus.io/php/strip_tags/
     */

    function strip_tags (input, allowed) {

      // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
      allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');

      const tags = /<\/?([a-z0-9]*)\b[^>]*>?/gi;
      const commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;

      let after = input;
      // removes tha '<' char at the end of the string to replicate PHP's behaviour
      after = (after.substring(after.length - 1) === '<') ? after.substring(0, after.length - 1) : after;

      // recursively remove tags to ensure that the returned string doesn't contain forbidden tags after previous passes (e.g. '<<bait/>switch/>')
      while (true) {
        const before = after;
        after = before.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
          return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
        });

        // return once no more tags are removed
        if (before === after) {
          return after;
        }

      }
    }

    /**
     * window.trigger resize
     * triggerResize()
     */

    var triggerResize = function(){

      if ( ! $guttenberg.length ){
        return false;
      }

      $(window).trigger('resize');

    };

    /**
     * window.onbeforeunload
     * Warn user before leaving web page with unsaved changes
     */

    var enableBeforeUnload = function() {
      window.onbeforeunload = function(e) {
        return 'The changes you made will be lost if you navigate away from this page';
      };
    };

    /**
     * Bind
     */

    var bind = function() {

      // -- click

      // section add

      $builder.on( 'click', '.mfn-section-add', function(e){
        e.preventDefault();
        section.add($(this));
      });

      // section clone

      $builder.on( 'click', '.mfn-section-clone', function(e){
        e.preventDefault();
        section.clone($(this));
      });

      // section pre-built

      $builder.on( 'click', '.mfn-section-pre-built', function(e){
        e.preventDefault();
        section.preBuilt($(this));
      });

      // section template

      $builder.on( 'click', '.mfn-template', function(e){
        e.preventDefault();
        section.template($(this));
      });

      // section hide

      $builder.on( 'click', '.mfn-section-hide', function(e){
        e.preventDefault();
        section.hide($(this));
      });

      // section collapse

      $builder.on( 'click', '.mfn-section-collapse', function(e){
        e.preventDefault();
        section.collapse($(this));
      });

      // section add row hover

      $builder.on( 'mouseenter', '.mfn-section-add.siblings', function(e){
        section.addRow.mouseEnter( $(this) );
      });

      $builder.on( 'mouseleave', '.mfn-section-add.siblings', function(e){
        section.addRow.mouseLeave( $(this) );
      });

      // section move

      $builder.on( 'click', '.mfn-section-move-up', function(e){
        e.preventDefault();
        section.move.up($(this));
      });

      $builder.on( 'click', '.mfn-section-move-down', function(e){
        e.preventDefault();
        section.move.down($(this));
      });

      // section menu

      $builder.on( 'click', '.mfn-option-dropdown > a', function(e){
        e.preventDefault();
        section.menu($(this));
      });

      // wrap add

      $builder.on( 'click', '.mfn-wrap-add', function(e){
        e.preventDefault();
        wrap.add($(this));
      });

      // divider add

      $builder.on( 'click', '.mfn-divider-add', function(e){
        e.preventDefault();
        wrap.add( $(this), 'divider' );
      });

      // predefined wrap

      $builder.on( 'click', '.wrap-layout', function(e){
        e.preventDefault();
        wrap.predefined( $(this) );
      });

      // wrap clone

      $builder.on( 'click', '.mfn-wrap-clone', function(e){
        e.preventDefault();
        wrap.clone($(this));
      });

      // wrap hover

      $builder.on( 'mouseenter', '.mfn-wrap', function(e){
        wrap.mouseEnter( $(this) );
      });

      $builder.on( 'mouseleave', '.mfn-wrap', function(e){
        wrap.mouseLeave( $(this) );
      });

      // item add

      $builder.on( 'click', '.mfn-item-add', function(e){
        e.preventDefault();
        item.add($(this));
      });

      // item modal add

      $builder.on( 'click', '.modal-add-items .modalbox-items a', function(e){
        e.preventDefault();
        item.modal.add($(this));
      });

      // item modal search

      $builder.on( 'keyup', '.modal-add-items .mfn-search', function() {
        item.modal.searchTimer( $(this) );
      });

      // item modal tabs

      $builder.on( 'click', '.modal-add-items .modalbox-tabs li a', function(e) {
        e.preventDefault();
        item.modal.tabs( $(this).closest('li') );
      });

      // item clone

      $builder.on( 'click', '.mfn-item-clone', function(e){
        e.preventDefault();
        item.clone($(this));
      });

      // item hover

      $builder.on( 'mouseenter', '.mfn-item', function(e){
        item.mouseEnter( $(this) );
      });

      $builder.on( 'mouseleave', '.mfn-item', function(e){
        item.mouseLeave( $(this) );
      });

      // element delete

      $builder.on( 'click', '.mfn-element-delete', function(e){
        e.preventDefault();
        element.delete($(this));
      });

      // element delete confirm

      $modal.on( 'click', '.btn-modal-confirm', function(e){
        e.preventDefault();
        element.modal.delete($(this));
      });

      // element modal tabs

      $builder.on( 'click', '.modal-item-edit .modalbox-tabs a', function(e){
        e.preventDefault();
        element.modal.tabs($(this));
      });

      // element edit - icon click

      $builder.on( 'click', '.mfn-element-edit', function(e){
        e.preventDefault();
        element.edit( $(this).closest('.mfn-element') );
      });

      // element edit - double click

      $builder.on( 'dblclick', '.mfn-section', function(e){

        if( $(e.target).closest('.mfn-header').length && ! $(e.target).is('.mfn-header') ){
          return; // prevent open when header icons click
        } else if( $(e.target).closest('.mfn-item').length ){
          element.edit( $(e.target).closest('.mfn-item') );
        } else if( $(e.target).closest('.mfn-wrap').length ){
          if( $(e.target).closest('.mfn-wrap').hasClass('divider') ){
            return;
          }
          element.edit( $(e.target).closest('.mfn-wrap') );
        } else {
          element.edit( $(e.target).closest('.mfn-section') );
        }

      });

      // size +

      $builder.on( 'click', '.mfn-size-increase', function(e){
        e.preventDefault();
        size.increase($(this));
      });

      // size ++

      $( '.mfn-size-increase', $builder ).longpress(function(e) {
        e.preventDefault();
        size.increaseLong($(this));
      });

      // size -

      $builder.on( 'click', '.mfn-size-decrease', function(e){
        e.preventDefault();
        size.decrease($(this));
      });

      // size --

      $( '.mfn-size-decrease', $builder ).longpress(function(e) {
        e.preventDefault();
        size.decreaseLong($(this));
      });

      // pre-built sections

      $builder.on( 'click', '.mfn-menu-sections a', function(e){
        e.preventDefault();
        preBuiltSections.modal.openNew();
      });

      $builder.on( 'click', '.modal-sections-library .modalbox-tabs li a', function(e) {
        e.preventDefault();
        preBuiltSections.modal.tabs( $(this).closest('li') );
      });

      $modal.on( 'click', '.mfn-btn-insert', function(e) {
        e.preventDefault();
        preBuiltSections.add( $(this) );
      });

      // export import

      $builder.on( 'click', '.mfn-menu-export a', function(e){
        e.preventDefault();
        exportImport.modal.open();
      });

      $builder.on( 'click', '.modal-export-import .modalbox-tabs li a', function(e) {
        e.preventDefault();
        exportImport.modal.tabs( $(this).closest('li') );
      });

      $modal.on( 'click', '.btn-copy-text', function(e) {
        e.preventDefault();
        exportImport.copy( $(this) );
      });

      $modal.on( 'click', '.btn-import', function(e) {
        e.preventDefault();
        exportImport.import( $(this) );
      });

      $modal.on( 'click', '.mfn-items-import-template li a', function(e) {
        e.preventDefault();
        exportImport.template.select( $(this) );
      });

      $modal.on( 'click', '.btn-template', function(e) {
        e.preventDefault();
        exportImport.template.import( $(this) );
      });

      $modal.on( 'click', '.btn-seo', function(e) {
        e.preventDefault();
        exportImport.seo( $(this) );
      });

      // import single page

      $builder.on( 'click', '.mfn-menu-page a', function(e){
        e.preventDefault();
        exportImport.modal.open('page');
      });

      $modal.on( 'click', '.btn-page', function(e) {
        e.preventDefault();
        exportImport.page( $(this) );
      });

      // revisions

      $builder.on( 'click', '.mfn-menu-revisions a', function(e){
        e.preventDefault();
        revisions.modal.open();
      });

      $modal.on( 'click', '.btn-revision', function(e) {
        e.preventDefault();
        revisions.save( $(this) );
      });

      $modal.on( 'click', '.revision-restore', function(e) {
        e.preventDefault();
        revisions.modal.restore( $(this) );
      });

      $modal.on( 'click', '.btn-modal-confirm-revision', function(e) {
        e.preventDefault();
        revisions.modal.confirm();
      });

      $('body').on( 'click', '.editor-post-publish-button', function(e) {
        revisions.publish();
      });

      // export import section

      $builder.on( 'click', '.mfn-section-copy', function(e){
        e.preventDefault();
        copyPaste.section.copy( $(this) );
      });

      $builder.on( 'click', '.mfn-section-paste', function(e){
        e.preventDefault();
        copyPaste.section.paste( $(this) );
      });

      // preview

      $builder.on( 'click', '.mfn-menu-preview a', function(e){
        e.preventDefault();
        preview.generate( $(this) );
      });

      // settings

      $builder.on( 'click', '.mfn-menu-settings a', function(e){
        e.preventDefault();
        settings.open( $(this) );
      });

      $modal.on( 'click', '.segmented-options.settings .form-control li:not(.active) a', function(e){
        e.preventDefault();
        settings.change( $(this) );
      });

      $modal.on( 'click', '.segmented-options.settings .introduction-reopen', function(e){
        e.preventDefault();
        modal.close();
        introduction.reopen();
      });

      // modal close

      $modal.on( 'click', '.btn-modal-close', function(e) {
        e.preventDefault();
        modal.close();
      });

      $modal.on( 'mousedown', function(e) {
        if ( $(e.target).hasClass('mfn-modal') && ! $(e.target).hasClass('modal-add-shortcode') ){
          modal.close();
        } else if( $(e.target).hasClass('modal-add-shortcode') ){
          // click only single button!
          $('.mfn-sc-editor .modalbox-header .btn-modal-close').trigger('click');
        } else if ( $('.mfn-table-creator-btn.focus') && ! $( e.target ).closest('.mfn-table-creator-btn')[0] ){
          $('.mfn-table-creator-btn.focus').removeClass('focus');
        }
      });

      $( 'body' ).on( 'keydown', function(event) {
        if ( 27 == event.keyCode ) {
          modal.close();
        }
      });

      // section menu close

      $builder.on( 'click', function(e) {

        if( $builder.hasClass('hover-effects') ){
          return;
        }

        var $parent = e.target.closest('.mfn-option-dropdown.hover');

        $('.mfn-option-dropdown.hover').not($parent).removeClass('hover');

      });

      // external modal

      $(document).on('mfn:modal:open', function( $this, el ){
        modal.open( $(el) );
      });

      $(document).on('mfn:modal:close', function(){
        modal.close();
      });

      // textarea buttons

      $builder.on('click', '.editor-header .mfn-option-btn', function(e){

        var buttonName = $(e.currentTarget).attr('data-type') ? $(e.currentTarget).attr('data-type') : false;
        wp.codeEditor.mfnFieldTextarea.methods.mfn_textarea_actions(buttonName);

      });

      $builder.on('click', '.editor-header .mfn-option-dropdown .mfn-dropdown-item', function(e){

        var buttonName = $(this).attr('data-type');
        var isItSCEditor = $(this).closest('.mfn-option-dropdown').hasClass('dropdown-megamenu');

        if(isItSCEditor){
          var closestDomLocation = $('.modal-add-shortcode .mfn-isc-builder').find('.mfn-isc-builder-'+buttonName+'');
          shortcodeEditor.createShortcodeBuilder(buttonName, closestDomLocation);
        }else{
          wp.codeEditor.mfnFieldTextarea.methods.mfn_textarea_actions(buttonName);
        }

        // FIX: prevent scroll to top while using classic editor
        e.preventDefault();

      });

      $builder.on('click', '.mfn-sc-editor .btn-modal-close', function(e){

        if( $('.modal-add-shortcode').hasClass('mfn-lipsum') ){
          // lipsum generator is not a shortcode
          wp.codeEditor.mfnFieldTextarea.methods.addCodeIntoTextArea( wp.codeEditor.mfnLipsum.createLorem() );
        }else{
          shortcodeEditor.toTextEditor();
        }

        // FIX: prevent scroll to top while using classic editor
        e.preventDefault();

      });

      // table generator

      $builder.on('click', '.mfn-table-creator-btn', function() {

        var el = $(this).get(0);
        var list = $(el).closest('.mfn-option-btn').find('.mfn-table-creator');

        wp.codeEditor.mfnTable.displayTooltip(el, list);

      });

      $builder.on('click', '.mfn-table-creator td, .mfn-table-creator-btn th', function() {

        wp.codeEditor.mfnTable.toTextArea();

      });

      // lorem generator

      $builder.on('click', '.mfn-lorem-creator-btn', function(e){

        var buttonName = $(e.currentTarget).attr('data-type') ? $(e.currentTarget).attr('data-type') : false;
        var closestDomLocation = $('.mfn-isc-builder').find('.mfn-isc-builder-'+buttonName+'');

        shortcodeEditor.createShortcodeBuilder(buttonName, closestDomLocation);
        $('.modal-add-shortcode').addClass('mfn-lipsum');

      });

      // go to top

      $builder.on('click', '#mfn-go-to-top', function() {
        goToTop();
      });

      // disable onbeforeunload

      $('body').on('click', '.editor-post-publish-button', function() {
        window.onbeforeunload = null;
      });

      $('form').on('submit', function() {
        window.onbeforeunload = null;
      });

      // window.scroll

      // $(window).scroll(function() {
      //
      // });

      // window resize

      // $(window).on('debouncedresize', function() {
      //
      // });

    };

    /**
     * Bind on window load
     * bindLoad()
     */

    var bindLoad = function(){

      $guttenberg = $( '.interface-interface-skeleton__content' );

      // WP 5.4 | .block-editor-editor-skeleton__content
      // WP 5.5 | .interface-interface-skeleton__content

      // scroll

      $guttenberg.on( 'scroll', function() {

        menu.sticky();

      });

      // resize

      $( window ).on( 'resize', function() {

        menu.sticky();

      });

    };

    /**
     * Ready
     * document.ready
     */

    var ready = function() {

      if( ! $desktop.length ){
        return false;
      }

      getIDs();

      sort.desktop();
      sort.section( $( '.mfn-sortable-section', $desktop ) );
      sort.wrap( $( '.mfn-sortable-wrap', $desktop ) );

      copyPaste.init();

      revisions.autosave();

      bind();

    };

    /**
     * Load
     * window.load
     */

    var load = function() {

      if( ! $desktop.length ){
        return false;
      }

      setTimeout(function(){

        bindLoad();

        triggerResize();

        introduction.open();

        // disable guttenberg welcome guide
        wp.data && wp.data.select( 'core/edit-post' ).isFeatureActive( 'welcomeGuide' ) && wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'welcomeGuide' );

      }, 0); // jQuery 3.5 window.load

    };

    /**
     * Item sizes
     */

    var sizeIndex2Label = {
      '0.1666' : '1/6',
      '0.2' : '1/5',
      '0.25' : '1/4',
      '0.3333' : '1/3',
      '0.4' : '2/5',
      '0.5' : '1/2',
      '0.6' : '3/5',
      '0.6667' : '2/3',
      '0.75' : '3/4',
      '0.8' : '4/5',
      '0.8333' : '5/6',
      '1' : '1/1',
    };

    var sizeLabel2Index = {
      '1/6' : '0.1666',
      '1/5' : '0.2',
      '1/4' : '0.25',
      '1/3' : '0.3333',
      '2/5' : '0.4',
      '1/2' : '0.5',
      '3/5' : '0.6',
      '2/3' : '0.6667',
      '3/4' : '0.75',
      '4/5' : '0.8',
      '5/6' : '0.8333',
      '1/1' : '1'
    };

    var items = {
      'wrap': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],

      'accordion': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'article_box': ['1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'before_after': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'blockquote': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'blog': ['1/1'],
      'blog_news': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'blog_slider': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'blog_teaser': ['1/1'],
      'button': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'call_to_action': ['1/1'],
      'chart': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'clients': ['1/1'],
      'clients_slider': ['1/1'],
      'code': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'column': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'contact_box': ['1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'content': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'countdown': ['1/1'],
      'counter': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'divider': ['1/1'],
      'fancy_divider': ['1/1'],
      'fancy_heading': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'feature_box': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'feature_list': ['1/1'],
      'faq': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'flat_box': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'helper': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'hover_box': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'hover_color': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'how_it_works': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'icon_box': ['1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'image': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'image_gallery': ['1/1'],
      'info_box': ['1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'list': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'map_basic': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'map': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'offer': ['1/1'],
      'offer_thumb': ['1/1'],
      'opening_hours': ['1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'our_team': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'our_team_list': ['1/1'],
      'photo_box': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'placeholder': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'portfolio': ['1/1'],
      'portfolio_grid': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'portfolio_photo': ['1/1'],
      'portfolio_slider': ['1/1'],
      'pricing_item': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'progress_bars': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'promo_box': ['1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'quick_fact': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'shop': ['1/1'],
      'shop_slider': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'sidebar_widget': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'slider': ['1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'slider_plugin': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'sliding_box': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'story_box': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'tabs': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'testimonials': ['1/1'],
      'testimonials_list': ['1/1'],
      'trailer_box': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'timeline': ['1/1'],
      'video': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'visual': ['1/6', '1/5', '1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1'],
      'zoom_box': ['1/4', '1/3', '2/5', '1/2', '3/5', '2/3', '3/4', '4/5', '5/6', '1/1']
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
   * Specify a function to execute when the DOM is fully loaded.
   */

  $(function() {
    MfnBuilder.ready();
  });

  /**
   * $(window).load
   */

  $(window).on('load', function(){
    MfnBuilder.load();
  });

  /**
   * Clone fix
   * Fixed native clone function for textarea and select fields
   */

  (function(original) {
    jQuery.fn.clone = function() {
      var result = original.apply(this, arguments),
        my_textareas = this.find('textarea:not(.editor), select'),
        result_textareas = result.find('textarea:not(.editor), select');

      for (var i = 0, l = my_textareas.length; i < l; ++i) {
        jQuery(result_textareas[i]).val(jQuery(my_textareas[i]).val());
      }

      return result;
    };
  })(jQuery.fn.clone);

})(jQuery);
