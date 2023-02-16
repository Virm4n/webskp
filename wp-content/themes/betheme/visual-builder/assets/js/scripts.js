!function(t){if(!t.wp.wpColorPicker.prototype._hasAlpha){var o="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAAHnlligAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAHJJREFUeNpi+P///4EDBxiAGMgCCCAGFB5AADGCRBgYDh48CCRZIJS9vT2QBAggFBkmBiSAogxFBiCAoHogAKIKAlBUYTELAiAmEtABEECk20G6BOmuIl0CIMBQ/IEMkO0myiSSraaaBhZcbkUOs0HuBwDplz5uFJ3Z4gAAAABJRU5ErkJggg==";Color.fn.toString=function(){if(this._alpha<1)return this.toCSS("rgba",this._alpha).replace(/\s+/g,"");var t=parseInt(this._color,10).toString(16);return this.error?"":(t.length<6&&(t=("00000"+t).substr(-6)),"#"+t)},t.widget("wp.wpColorPicker",t.wp.wpColorPicker,{_hasAlpha:!0,_create:function(){if(t.support.iris){var i=this,a=i.element,e="Color value",r="Select color",s="Default",n="Clear";if(t.extend(i.options,a.data()),"hue"===i.options.type)return i._createHueOnly();i.close=t.proxy(i.close,i),i.initialValue=a.val(),a.addClass("wp-color-picker"),a.parent("label").length||(a.wrap("<label></label>"),i.wrappingLabelText=t('<span class="screen-reader-text"></span>').insertBefore(a).text(e)),i.wrappingLabel=a.parent(),i.wrappingLabel.wrap('<div class="wp-picker-container" />'),i.wrap=i.wrappingLabel.parent(),i.toggler=t('<button type="button" class="button wp-color-result" aria-expanded="false"><span class="wp-color-result-text"></span></button>').insertBefore(i.wrappingLabel).css({backgroundColor:i.initialValue}),i.toggler.find(".wp-color-result-text").text(r),i.pickerContainer=t('<div class="wp-picker-holder" />').insertAfter(i.wrappingLabel),i.button=t('<input type="button" class="button button-small" />'),i.options.defaultColor?i.button.addClass("wp-picker-default").val(s):i.button.addClass("wp-picker-clear").val(n),i.wrappingLabel.wrap('<span class="wp-picker-input-wrap hidden" />').after(i.button),i.inputWrapper=a.closest(".wp-picker-input-wrap"),a.iris({target:i.pickerContainer,hide:i.options.hide,width:i.options.width,mode:i.options.mode,palettes:i.options.palettes,change:function(a,e){i.options.alpha?(i.toggler.css({"background-image":"url("+o+")"}),i.toggler.css({position:"relative"}),0==i.toggler.find("span.color-alpha").length&&i.toggler.append('<span class="color-alpha" />'),i.toggler.find("span.color-alpha").css({width:"30px",height:"100%",position:"absolute",top:0,left:0,"border-top-left-radius":"2px","border-bottom-left-radius":"2px",background:e.color.toString()})):i.toggler.css({backgroundColor:e.color.toString()}),t.isFunction(i.options.change)&&i.options.change.call(this,a,e)}}),a.val(i.initialValue),i._addListeners(),i.options.hide||i.toggler.click()}},_addListeners:function(){var o=this;o.wrap.on("click.wpcolorpicker",function(t){t.stopPropagation()}),o.toggler.click(function(){o.toggler.hasClass("wp-picker-open")?o.close():o.open()}),o.element.on("change",function(i){(""===t(this).val()||o.element.hasClass("iris-error"))&&(o.options.alpha?o.toggler.find("span.color-alpha").css("backgroundColor",""):o.toggler.css("backgroundColor",""),t.isFunction(o.options.clear)&&o.options.clear.call(this,i))}),o.button.on("click",function(i){t(this).hasClass("wp-picker-clear")?(o.element.val(""),o.options.alpha?o.toggler.find("span.color-alpha").css("backgroundColor",""):o.toggler.css("backgroundColor",""),t.isFunction(o.options.clear)&&o.options.clear.call(this,i),o.element.trigger("change")):t(this).hasClass("wp-picker-default")&&o.element.val(o.options.defaultColor).change()})}}),t.widget("a8c.iris",t.a8c.iris,{_create:function(){if(this._super(),this.options.alpha=this.element.data("alpha")||!1,this.element.is(":input")||(this.options.alpha=!1),void 0!==this.options.alpha&&this.options.alpha){var o=this,i=o.element,a=t('<div class="iris-strip iris-slider iris-alpha-slider"><div class="iris-slider-offset iris-slider-offset-alpha"></div></div>').appendTo(o.picker.find(".iris-picker-inner")),e=a.find(".iris-slider-offset-alpha"),r={aContainer:a,aSlider:e};void 0!==i.data("custom-width")?o.options.customWidth=parseInt(i.data("custom-width"))||0:o.options.customWidth=100,o.options.defaultWidth=i.width(),(o._color._alpha<1||-1!=o._color.toString().indexOf("rgb"))&&i.width(parseInt(o.options.defaultWidth+o.options.customWidth)),t.each(r,function(t,i){o.controls[t]=i}),o.controls.square.css({"margin-right":"0"});var s=o.picker.width()-o.controls.square.width()-20,n=s/6,l=s/2-n;t.each(["aContainer","strip"],function(t,i){o.controls[i].width(l).css({"margin-left":n+"px"})}),o._initControls(),o._change()}},_initControls:function(){if(this._super(),this.options.alpha){var t=this;t.controls.aSlider.slider({orientation:"vertical",min:0,max:100,step:1,value:parseInt(100*t._color._alpha),slide:function(o,i){t._color._alpha=parseFloat(i.value/100),t._change.apply(t,arguments)}})}},_change:function(){this._super();var t=this,i=t.element;if(this.options.alpha){var a=t.controls,e=parseInt(100*t._color._alpha),r=t._color.toRgb(),s=["rgb("+r.r+","+r.g+","+r.b+") 0%","rgba("+r.r+","+r.g+","+r.b+", 0) 100%"],n=t.options.defaultWidth,l=t.options.customWidth,p=t.picker.closest(".wp-picker-container").find(".wp-color-result");a.aContainer.css({background:"linear-gradient(to bottom, "+s.join(", ")+"), url("+o+")"}),p.hasClass("wp-picker-open")&&(a.aSlider.slider("value",e),t._color._alpha<1?(a.strip.attr("style",a.strip.attr("style").replace(/rgba\(([0-9]+,)(\s+)?([0-9]+,)(\s+)?([0-9]+)(,(\s+)?[0-9\.]+)\)/g,"rgb($1$3$5)")),i.width(parseInt(n+l))):i.width(n))}(i.data("reset-alpha")||!1)&&t.picker.find(".iris-palette-container").on("click.palette",".iris-palette",function(){t._color._alpha=1,t.active="external",t._change()}),i.trigger("change")},_addInputListeners:function(t){var o=this,i=function(i){var a=new Color(t.val()),e=t.val();t.removeClass("iris-error"),a.error?""!==e&&t.addClass("iris-error"):a.toString()!==o._color.toString()&&("keyup"===i.type&&e.match(/^[0-9a-fA-F]{3}$/)||o._setOption("color",a.toString()))};t.on("change",i).on("keyup",o._debounce(i,100)),o.options.hide&&t.on("focus",function(){o.show()})}})}}(jQuery);

/**
 * Longpress 0.1.2
 * Vaidik Kapoor | MIT License | http://github.com/vaidik/jquery-longpress/
 */

!function(o){o.fn.longpress=function(e,n,t){return void 0===t&&(t=500),this.each(function(){var u,i,r=o(this);function c(n){u=(new Date).getTime();var r=o(this);i=setTimeout(function(){"function"==typeof e?e.call(r,n):o.error("Callback required for long press. You provided: "+typeof e)},t)}function s(e){(new Date).getTime()-u<t&&(clearTimeout(i),"function"==typeof n?n.call(o(this),e):void 0===n||o.error("Optional callback for short press should be a function."))}function a(o){clearTimeout(i)}r.on("mousedown",c),r.on("mouseup",s),r.on("mousemove",a),r.on("touchstart",c),r.on("touchend",s),r.on("touchmove",a)})}}(jQuery);

var $content;

var MfnVbApp = (function($){

let new_widget_wrap, new_widget_wrap_size, new_widget_section, new_widget_wcount, new_widget_container, new_widget_position = 'after';
let $editpanel = $('.mfn-visualbuilder .sidebar-panel-content .panel-edit-item .mfn-form');
let releaser = 0;
let prebuiltType = 'end';
let context_el;
let sortableL = 20;
let sample_img = mfnvbvars.themepath+'/functions/builder/assets/images/svg-items/image-placeholder.svg';
let sample_icon = 'icon-lamp';
let dragging_new = 0;
let historyIndex = 0;
let mfncopy = localStorage.getItem('mfncopy') ? JSON.parse(localStorage.getItem('mfncopy')) : {};
let mfnbuilder = localStorage.getItem('mfn-builder') ? JSON.parse(localStorage.getItem('mfn-builder')) : {};
let pending = false;
let colorchange = false;
let colorchangefirsttime = true;
let scroll_top;
let formaction = $('.btn-save-form-primary').attr('data-action');
let savebutton = $('.btn-save-form-primary span').text();
let previewTab;
let pageid = $('#mfn-vb-form input[name="pageid"]').val();
let wpnonce = $('#mfn-vb-form input[name="mfn-builder-nonce"]').val();
let ajaxurl = mfnvbvars.ajaxurl;
let history = localStorage.getItem('mfnhistory') ? JSON.parse(localStorage.getItem('mfnhistory')) : [];
let themecolor = mfn.themecolor;

var sizes = [
    {index: 1, key: '1/6', value: 'one-sixth'},
    {index: 2, key: '1/5', value: 'one-fifth'},
    {index: 3, key: '1/4', value: 'one-fourth'},
    {index: 4, key: '1/3', value: 'one-third'},
    {index: 5, key: '2/5', value: 'two-fifth'},
    {index: 6, key: '1/2', value: 'one-second'},
    {index: 7, key: '3/5', value: 'three-fifth'},
    {index: 8, key: '2/3', value: 'two-third'},
    {index: 9, key: '3/4', value: 'three-fourth'},
    {index: 10, key: '4/5', value: 'four-fifth'},
    {index: 11, key: '5/6', value: 'five-sixth'},
    {index: 12, key: '1/1', value: 'one'}
];

var items_size = {
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

function getUid(){
    return Math.random().toString(36).substring(4);
}

// show shortcode add icon
$('.modal-add-shortcode .browse-icon .mfn-button-upload').on('click', function(e) {
    e.preventDefault();
    $('.mfn-modal.modal-select-icon .mfn-items-list li').removeClass('active');
    $('.mfn-modal.modal-select-icon').addClass('show');
});

function backToWidgets(){
    $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-header .header-items .title-group .sidebar-panel-desc .sidebar-panel-title').text('Add Item');
    $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-header .header-items .title-group .sidebar-panel-icon').attr('class', 'sidebar-panel-icon mfn-icon-add-big');

    $(".panel").hide();
    $(".header").hide();
    $(".panel-items").show();
    $(".header-items").show();

    $('.panel-items .mfn-search').focus();

    resetSaveButton();
}

function showPrebuilts(){
    $(".panel").hide();
    $(".header").hide();
    $(".panel-prebuilt-sections").show();
    $(".header-prebuilt-sections").show();
}

function addHistory(){

    setTimeout(function() {
    
    localStorage.removeItem("mfnhistory");

    let mfn_his_helper = [];
    let mfn_his_form = $('.mfn-visualbuilder .sidebar-panel-content .panel-edit-item .mfn-form').html();

    $('#mfn-vb-form .mfn-form-row').each(function() {
        var $field = $(this).find('.preview-'+$(this).attr('data-name')+'input');
        if( $field.length && $field.val().length ){

            mfn_his_helper.push({
                val: $field.val(),
                class: '.'+$(this).attr('data-group')+'.'+$(this).attr('data-name')+' .preview-'+$(this).attr('data-name')+'input'
            });

        }
    });

    history.unshift({
        'html': $content.find('.mfn-builder-content').html(),
        'sidebar': mfn_his_form,
        'values': mfn_his_helper,
        'active': $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-content .panel:visible').attr('class'),
        'activeheader': $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-header .header:visible').attr('id'),
        'header': $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-header .header-edit-item .title-group').html()
    });

    firstHistory = 1;

    historyIndex = 0;
    checkHistoryIndex();

    try {
        localStorage.setItem('mfnhistory', JSON.stringify( history.filter((item,i) => { return i < 5 }) ));
    } catch (e) {
        localStorage.setItem('mfnhistory', JSON.stringify( history.filter((item,i) => { return i < 1 }) ));
    }

    }, 200);
}


var enableBeforeUnload = function() {
    if( !$('.mfn-form-options').is(':visible') ){
        window.onbeforeunload = function(e) {
            return 'The changes you made will be lost if you navigate away from this page';
        };
    }
};


$('.mfn-visualbuilder .sidebar-panel-content ul.items-list li a').on('click', function(e) {
    e.preventDefault();
});

function init() {
    checkEmptyPage();
    checkEmptySections();

    runMedia('releaser-first');
    runEdit('releaser-first');
    runTools(); // sections toolbar buttons
    sectionMenu(); // sections context menu
    historyClick(); // history back click
    addNewSection(); // add new section "+"
    addItem(); // add item button in wrap

    checkEmptyWraps();

    runSorting();

    //calculateIframeHeight();

    saveForm();

    if(window.location.hash && window.location.hash == '#page-options-tab') {
        $(window.location.hash).trigger('click');
    }

    $('.mfn-visualbuilder .sidebar-panel-content ul.items-list li').on('mousedown', calculateIframeHeight).on('mouseup', resetIframeHeight);

    if($content.find('.masonry').length){
        $content.find('.masonry').each(function() {
            $(this).addClass('msnry-initialized');
        });
    }

    if($content.find('.isotope').length){
        $content.find('.isotope').each(function() {
            $(this).addClass('msnry-initialized');
        });
    }

    if($content.find('.chart').length){
        $content.find('.chart').each(function() {
            var $box = $(this).closest('.mcb-column');
            $('.mfn-vb-formrow.mfn-vb-'+$box.attr('data-uid')+' .color-picker-group .mfn-form-control').val( $(this).attr('data-bar-color') );
        });
    }

    if(!mfnbuilder.clipboard){
        $content.find('.section-header .mfn-section-import').addClass('mfn-disabled');
    }

    addHistory();

    checkHistoryIndex();
    colorchange = false;
}

$(document).on('click', function(e) {
    if(!$(e.target).is('.form-group.color-picker') && colorchange == true){
        colorchange = false;

        if($('.mfn-ui .mfn-form .widget-chart.color').hasClass('mfn-fr-show')){
            let it = $('.mfn-ui .mfn-form .widget-chart.color').data('element');
            let val = $('.mfn-ui .mfn-form .widget-chart.color .mfn-form-input').val();
            // chart update
            $content.find('.'+it+' .chart').attr('data-bar-color', val);
            mfnChart();
        }
        enableBeforeUnload();
        addHistory();
    }
});

function sectionMenu(){
    $content.find('.mfn-builder-content').on('click', '.section .mfn-option-dropdown .dropdown-wrapper a.mfn-dropdown-item', function(e) {
        e.preventDefault();

        let $it = $(this).closest('.mcb-section');
        let sec_uid = $it.data('uid');
        let sections_count = $content.find('.mcb-section').length-1;

        if($(this).hasClass('mfn-section-hide')){
            // hide
            if($it.hasClass('hide')){
                $(this).find('.label').text($(this).attr('data-hide'));
                $('.mfn-vb-'+sec_uid+'.mfn-type-section.hide input').val('');
            }else{
                $(this).find('.label').text($(this).attr('data-show'));
                $('.mfn-vb-'+sec_uid+'.mfn-type-section.hide input').val('1');
            }
            $it.toggleClass('hide');
        }else if($(this).hasClass('mfn-section-move-down')){
            // move down
            if($it.attr('data-order') < sections_count){
                $it.insertAfter($it.next());
                reSortSections();
            }
        }else if($(this).hasClass('mfn-section-move-up')){
            // move up
            if($it.attr('data-order') > 0){
                $it.insertBefore($it.prev());
                reSortSections();
            }
        }else if( $(this).hasClass('mfn-section-export') ){
            // export
            elementToClipboard(sec_uid);
        }else if( !$(this).hasClass('mfn-disabled') && $(this).hasClass('mfn-section-import-before') ){
            // import before
            importFromClipboard(sec_uid, 'before');
        }else if( !$(this).hasClass('mfn-disabled') && $(this).hasClass('mfn-section-import-after') ){
            // import after
            importFromClipboard(sec_uid, 'after');
        }

    });
}


/* Sidebar Resizer */

var resizer = document.getElementById('mfn-sidebar-resizer');
var sidebar = document.getElementById('mfn-vb-sidebar');
var preview = document.getElementById('mfn-preview-wrapper-holder');
var codemir = document.getElementsByClassName("CodeMirror");
var startY, startX, startWidth, endWidth = 420;

resizer.addEventListener('mousedown', initDrag, false);

function initDrag(e) {
    startX = e.clientX;
    sidebar.classList.add("resizing-active");
    startWidth = parseInt(sidebar.offsetWidth, 10);
    document.documentElement.addEventListener('mousemove', doDrag, false);
    document.documentElement.addEventListener('mouseup', stopDrag, false);
}

function doDrag(e) {
    endWidth = (startWidth + e.clientX - startX);
    if(endWidth < 1200 && endWidth > 380){
        sidebar.style.width = endWidth+"px";
        sidebar.style.maxWidth = endWidth+"px";
        preview.style.marginLeft = endWidth+"px";

        if(codemir){
            for (var i = 0; i < codemir.length; i++) {
               codemir[i].style.maxWidth = (endWidth-96)+"px";
            }
        }

    }
}

function stopDrag(e) {
    sidebar.classList.remove("resizing-active");
    document.documentElement.removeEventListener('mousemove', doDrag, false);
    document.documentElement.removeEventListener('mouseup', stopDrag, false);
}

function historyClick(){
    $('.sidebar-panel-footer .mfn-history-btn').on('click', function(e) {
        e.preventDefault();

        $el = $(this);

        if(!$el.hasClass('loading')){

            $el.addClass('loading');

            setTimeout(function() {

                let historyAction = 'undo';

                if( $el.hasClass('btn-redo') && historyIndex > 0 ){
                    historyAction = 'redo';
                    historyIndex--;
                }else if( $el.hasClass('btn-undo') && historyIndex < history.length-1 ){
                    historyIndex++;
                }else{
                    return;
                }

             historyRun(historyAction, historyIndex); 

            }, 800);

        }

    });
}

function historyRun(historyAction, historyIndex){

        colorchange = false;

        let h_event = history[historyIndex];

        $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-header .header').hide();

        $('.mfn-visualbuilder .sidebar-panel-content .panel-edit-item .mfn-form').html(h_event.sidebar);
        $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-header .header-edit-item .title-group').html(h_event.header);
        $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-header #'+h_event.activeheader).show();

        $content.find('.mfn-builder-content').html(h_event.html);

        h_event.values ? $.each( h_event.values, function( k, v ) { $(v.class).val( v.val ); }) : null;

        let active_panel = h_event.active.replace(' ', '.')

        $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-content .panel').hide();

        $('.'+active_panel).show();

        $('#mfn-vb-form .mfn-form-row').addClass('history-back'+releaser);

        runMedia('history-back'+releaser);
        runEdit('history-back'+releaser);

        blink();

        checkHistoryIndex();

        mfnChart();

        saveForm();

        setTimeout(function() {
            $(document).trigger('mfn:vb:edit');
        }, 200);

        $('.sidebar-panel-footer .mfn-history-btn').removeClass('loading');

        colorchange = false;
        releaser++;
}

function checkHistoryIndex(){
    if(historyIndex == 0){
        $('.sidebar-panel-footer .mfn-history-btn.btn-redo').addClass('inactive');
    }else{
        $('.sidebar-panel-footer .mfn-history-btn.btn-redo').removeClass('inactive');
    }
    if(historyIndex == history.length-1){
        $('.sidebar-panel-footer .mfn-history-btn.btn-undo').addClass('inactive');
    }else{
        $('.sidebar-panel-footer .mfn-history-btn.btn-undo').removeClass('inactive');
    }
}


function calculateIframeHeight(){
    $content.find('body').addClass('hover');
    scroll_top = $content.find("html, body").scrollTop();
    $('.frameOverlay').height( $content.find("body").height() );
    $content.find("html").css({ 'overflow': 'hidden' });
    $(window).scrollTop( scroll_top );
    $('iframe#mfn-vb-ifr').css({ 'margin-top': scroll_top });
    $(window).on('scroll', function() {
        $content.find('html, body').scrollTop( $(this).scrollTop() );
        $('iframe#mfn-vb-ifr').css({ 'margin-top': $(this).scrollTop() });
    });
    runSorting();
}

function resetIframeHeight(){
    $(window).off('scroll');
    $content.find("html").css({ 'overflow': 'auto' });
    $('.frameOverlay').height( '100%' );
    $('iframe#mfn-vb-ifr').css({ 'margin-top' : 0 });

    runSorting();
}

function hideContext(e) {
    var context = $content.find('.mfn-contextmenu');

    if (!context.is(e.target) && context.has(e.target).length === 0){
       $content.find('.mfn-contextmenu').hide();
    }

    $content.find('body').unbind('click', hideContext);
}

function runTools(){

    $content.find('body').append('<div style="position: absolute; z-index: 999;" class="mfn-contextmenu"><p class="mfn-context-header"></p><ul><li><a href="#" data-action="edit">Edit</a></li><li><a href="#" class="mfn-context-copy" data-action="copy">Copy</a></li><li><a href="#" class="mfn-context-paste" data-action="paste">Paste</a></li><li><a href="#" data-action="delete">Delete</a></li></ul></div>');

    $content.find('.mfn-builder-content').on('click', '.mfn-element-drag', function(e) { e.preventDefault(); });

    $content.find('.mfn-builder-content').on('click', '.mfn-header .mfn-option-dropdown a', function(e) { e.preventDefault(); });

    // Context menu

    $content.find('.mfn-builder-content').contextmenu(function(e) {
        e.preventDefault();

        mfncopy = localStorage.getItem('mfncopy') ? JSON.parse(localStorage.getItem('mfncopy')) : {};

        if(e.target.closest('.vb-item')){

            context_el = e.target.closest('.vb-item').attributes['data-uid']['nodeValue'];
            $content.find('.mfn-contextmenu').show().css({left:e.pageX, top: e.pageY});

            if($content.find('.vb-item[data-uid="'+context_el+'"]').hasClass('mcb-section')){
                $content.find('.mfn-contextmenu .mfn-context-header').text('Section');
            }else if($content.find('.vb-item[data-uid="'+context_el+'"]').hasClass('mcb-wrap')){
                $content.find('.mfn-contextmenu .mfn-context-header').text('Wrap');
            }else if($content.find('.vb-item[data-uid="'+context_el+'"]').hasClass('mcb-column')){
                $content.find('.mfn-contextmenu .mfn-context-header').text('Item');
            }

            if(!mfncopy.html){
                $content.find('.mfn-contextmenu .mfn-context-paste').addClass('mfn-context-inactive');
            }else{
                $content.find('.mfn-contextmenu .mfn-context-paste').removeClass('mfn-context-inactive');
            }

        }

        $content.find('body').bind('click', hideContext);
    });

    // context menu actions

    $content.find('.mfn-contextmenu li a').on('click', function(e) {
        e.preventDefault();
        let action = $(this).data('action');

        if(action == 'delete'){
            $content.find('.vb-item[data-uid="'+context_el+'"] > .mfn-header').find('.mfn-element-delete').trigger('click');
        }else if(action == 'edit'){
            $content.find('.vb-item[data-uid="'+context_el+'"] > .mfn-header').find('.mfn-element-edit').trigger('click');
        }else if(action == 'copy'){

            copyToClipboard(context_el);

            $content.find('.mfn-contextmenu').hide();

        }else if(action == 'paste'){
            $content.find('.mfn-contextmenu').hide();
            let $el = $content.find('.vb-item[data-uid="'+context_el+'"]');

            pasteElement($el);
        }
    });
    
    // edit
    $content.find('.mfn-builder-content').on('click', '.mfn-header .mfn-element-edit', function(e) {
        e.preventDefault();

        $(document).trigger('mfn:vb:close');

        resetSaveButton();

        $(".header").hide();
        if( $(".panel-edit-item").is(":visible") ) { $(".sidebar-panel-content").animate({ scrollTop: 0 }, 300); }else{ $('.panel').hide(); $(".panel-edit-item").show(); $(".panel-edit-item").animate({ scrollTop: 0 }, 300); }
        $(".header-edit-item").show();
        $(".mfn-vb-formrow").removeClass('mfn-fr-show');

        let title = "Wrap";
        let type = "card";

        let $dom_el = $(this).closest('.vb-item');

        if($dom_el.hasClass('mcb-section')){
            title = "Section";
        }

        let id = $dom_el.data('uid');

        $('.panel-edit-item .mfn-vb-'+id).addClass('mfn-fr-show');

        if($dom_el.hasClass('mcb-column')){
            title = $('.sidebar-panel .mfn-fr-show .typeinput').val().replaceAll('_', ' ');
            type = $('.sidebar-panel .mfn-fr-show .typeinput').val().replaceAll('_', '-');
        }

        $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-header .header-edit-item .title-group .sidebar-panel-desc .sidebar-panel-title').text(title);
        $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-header .header-edit-item .title-group .sidebar-panel-icon').attr('class', 'sidebar-panel-icon mfn-icon-'+type);


        $(document).trigger('mfn:vb:edit');
        addHistory();
    });

    // resize
    $content.find('.mfn-builder-content').on('click', '.mfn-header .mfn-size-change', function(e) {
        e.preventDefault();
        let uid = $(this).closest('.vb-item').data('uid');
        let type = $('.mfn-vb-'+uid+'.type input').val();
        let currInput = $('.mfn-vb-'+uid+' .sizeinput').val();
        let currClass = sizes.filter(size => size.key === currInput)[0];

        
        let newIndex = currClass.index;

        if($(this).hasClass('mfn-size-decrease')){
            newIndex = newIndex - 1 < 1 ? 1 : newIndex - 1;
        }else{
            newIndex = newIndex + 1 > 12 ? 12 : newIndex + 1;
        }
    
        let newClass = sizes.filter(size => size.index === newIndex)[0];

        if( !items_size[type] || 
            ( items_size[type].length && items_size[type].includes(newClass.key) ) ){

            if($content.find('.vb-item[data-uid='+uid+'] .mfn-element-size-label').length){
                $content.find('.vb-item[data-uid='+uid+'] .mfn-element-size-label').text(newClass.key);
            }

            $content.find('.vb-item[data-uid='+uid+']').removeClass(currClass.value).addClass(newClass.value).attr('data-size', newClass.key);
            $('.mfn-vb-'+uid+' .sizeinput').val(newClass.key);

        }

        // before after
        if($content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container').length){ 

            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container .twentytwenty-overlay').remove();
            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container .twentytwenty-after-label').remove();
            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container .twentytwenty-handle').remove();
            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container').unwrap(); 

            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container').twentytwenty(); 

        }
        enableBeforeUnload();
        addHistory();
    })

    // resize long
    $content.find('.mfn-header .mfn-size-change').longpress(function(e) {
        e.preventDefault();
        let uid = $(this).parent().parent().data('uid');
        let currInput = $('.mfn-vb-'+uid+' .sizeinput').val();
        let currClass = sizes.filter(size => size.key === currInput)[0];
        let newIndex = currClass.index;

        if($(this).hasClass('mfn-size-decrease')){
            newIndex = 3;
        }else{
            newIndex = 12;
        }
        
        let newClass = sizes.filter(size => size.index === newIndex)[0];

        if($content.find('.vb-item[data-uid='+uid+'] .mfn-element-size-label').length){
            $content.find('.vb-item[data-uid='+uid+'] .mfn-element-size-label').text(newClass.key);
        }

        $content.find('.vb-item[data-uid='+uid+']').removeClass(currClass.value).addClass(newClass.value).attr('data-size', newClass.key);
        $('.mfn-vb-'+uid+' .sizeinput').val(newClass.key);

        // before after
        if($content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container').length){ 

            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container .twentytwenty-overlay').remove();
            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container .twentytwenty-after-label').remove();
            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container .twentytwenty-handle').remove();
            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container').unwrap(); 

            $content.find('.vb-item[data-uid='+uid+'] .before_after.twentytwenty-container').twentytwenty(); 

        }
        enableBeforeUnload();
        addHistory();
    });

    // delete
    $content.find('.mfn-builder-content').on('click', '.mfn-header .mfn-element-delete', function(e) {
        e.preventDefault();

        let $dom_el = $(this).closest('.vb-item');
        let uid = $dom_el.attr('data-uid');

        $('.mfn-ui').addClass('mfn-modal-open').append('<div class="mfn-modal modal-confirm show"> <div class="mfn-modalbox mfn-form mfn-shadow-1"> <div class="modalbox-header"> <div class="options-group"> <div class="modalbox-title-group"> <span class="modalbox-icon mfn-icon-delete"></span> <div class="modalbox-desc"> <h4 class="modalbox-title">Delete element</h4> </div></div></div><div class="options-group"> <a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" title="Close" href="#"><span class="mfn-icon mfn-icon-close"></span></a> </div></div><div class="modalbox-content"> <img class="icon" alt="" src="'+mfnvbvars.themepath+'/muffin-options/svg/warning.svg"> <h3>Delete element?</h3> <p>Please confirm. There is no undo.</p><a class="mfn-btn mfn-btn-red btn-wide btn-modal-confirm" href="#"><span class="btn-wrapper">Delete</span></a> </div></div></div>');

        $('.btn-modal-close').on('click', function(e) {
            e.preventDefault();
            $('.mfn-ui').removeClass('mfn-modal-open');
            $('.modal-confirm.show').remove();
        });

        $('.btn-modal-confirm').on('click', function(e){
            e.preventDefault();

            $('.mfn-form .mfn-vb-formrow.mfn-vb-'+uid).remove();

            stopVideo( $content.find('.vb-item[data-uid="'+uid+'"]') );

            $content.find('.mcb-section-'+uid+' .vb-item').each(function() {
                let x = $(this).attr('data-uid');
                stopVideo($content.find('.vb-item[data-uid="'+x+'"]'));
                $('.mfn-form .mfn-vb-formrow.mfn-vb-'+x).remove();
            });

            $content.find('.mcb-wrap-'+uid+' .vb-item').each(function() {
                let x = $(this).attr('data-uid');
                stopVideo($content.find('.vb-item[data-uid="'+x+'"]'));
                $('.mfn-form .mfn-vb-formrow.mfn-vb-'+x).remove();
            });

            $content.find('.mcb-section-'+uid).remove();
            $content.find('.mcb-wrap-'+uid).remove();
            $content.find('.mcb-item-'+uid).remove();

            

            $('.mfn-ui').removeClass('mfn-modal-open');
            $('.modal-confirm.show').remove();

            checkEmptyPage();
            checkEmptyWraps()
            checkEmptySections();
            backToWidgets();
            runSorting();

            setTimeout(reSortSections, 500);
            enableBeforeUnload();
            addHistory();
        });
    });

    // clone section 

    $content.find('.mfn-builder-content').on('click', '.mfn-module-clone', function(e) {
        e.preventDefault();

        let $el = $(this).closest('.vb-item');

        copyToClipboard( $el.attr('data-uid') );
        pasteElement($el);
        
        
    });
    
    // add wrap

    $content.find('.mfn-builder-content').on('click', '.mfn-wrap-add', function(e) {
        e.preventDefault();
        let thisid = $(this).parent().parent().parent().data('uid');
        let is_divider = 0;
        if($(this).hasClass('mfn-divider-add')){ is_divider = 1; }
        addNewWrap(thisid, is_divider);
    });
}

function saveForm(){
    // save changes
    $('.btn-save-changes').off().on('click', function(e){
        e.preventDefault();
        formaction = $(this).attr('data-action');

        if(!$('.btn-save-changes').hasClass('loading disabled')){
            $(this).addClass('loading disabled');
            $('form#mfn-vb-form').submit(); 
        }
    });

    $('.sidebar-panel-footer .btn-save-option').off().on('click', function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('s-opt-show');
        $(document).bind('click', closeSaveOpt);
        $content.bind('click', closeSaveOpt);
    });

    $('form#mfn-vb-form').submit(function(e) {
        e.preventDefault();

        if(pending == false){
            pending = true;

            let mfnVbForm = document.getElementById('mfn-vb-form');
            let formData = new FormData(mfnVbForm);

            if( $('.mfn-form-options').is(':visible') ){

                let options = $(document.forms['mfn-options-form']).serializeArray();

                for (var i=0; i<options.length; i++)
                    formData.append(options[i].name, options[i].value);

                if( window.onbeforeunload != null ){

                    $('.mfn-ui').addClass('mfn-modal-open').append('<div class="mfn-modal modal-confirm show"> <div class="mfn-modalbox mfn-form mfn-shadow-1"> <div class="modalbox-header"> <div class="options-group"> <div class="modalbox-title-group"> <span class="modalbox-icon mfn-icon-options"></span> <div class="modalbox-desc"> <h4 class="modalbox-title">Confirm changes</h4> </div></div></div><div class="options-group"> <a class="mfn-option-btn mfn-option-blank btn-large btn-modal-close" title="Close" href="#"><span class="mfn-icon mfn-icon-close"></span></a> </div></div><div class="modalbox-content"> <img class="icon" alt="" src="'+mfnvbvars.themepath+'/muffin-options/svg/warning.svg"> <h3>Save options</h3> <p>Changes made in Muffin Live Builder will also be saved.</p><a class="mfn-btn mfn-btn-green btn-wide btn-modal-confirm" href="#"><span class="btn-wrapper">Save all</span></a> <a class="mfn-btn btn-wide btn-modal-close" href="#"><span class="btn-wrapper">Cancel</span></a></div></div></div>');

                    $('.btn-modal-close').on('click', function(e) {
                        e.preventDefault();
                        $('.mfn-ui').removeClass('mfn-modal-open');
                        $('.modal-confirm.show').remove();

                        $('.btn-save-changes').removeClass('loading disabled');
                        $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-footer .s-opt-show').removeClass('s-opt-show');

                        $(document).unbind('click', closeSaveOpt);
                        $content.unbind('click', closeSaveOpt);

                        pending = false;

                        return false;
                    });

                    $('.btn-modal-confirm').on('click', function(e) {
                        e.preventDefault();
                        $('.mfn-ui').removeClass('mfn-modal-open');
                        $('.modal-confirm.show').remove();

                        sendUpdateForm(formData, 'options');
                    });

                }else{
                    sendUpdateForm(formData, 'options');
                }
                
            }else{
                sendUpdateForm(formData, 'content');
            }
        }else{
            alert('Another action is still being processed. Please wait for a while and try again.');
            $('.btn-save-changes').removeClass('loading disabled');
        }
    });
}

function sendUpdateForm(formData, type){
    $list = $(".panel.panel-revisions-update ul.revisions-list");

    formData.append('action', 'updatevbview');
    formData.append('savetype', formaction);

    $.ajax({
        url: ajaxurl,
        'mfn-builder-nonce': wpnonce,
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(response){
            if(response){ displayRevisions(response, $list); }

            if(formaction == 'publish'){
                $('.btn-save-form-primary').attr('data-action', 'update');
                $('.btn-save-form-primary span').text('Update');

                savebutton = 'Update';
                formaction = 'update';

                //setTimeout(function() {$('.btn-save-form-primary span').text('Update');}, 1000);

                $('.btn-save-form-secondary').attr('data-action', 'draft');
                $('.btn-save-form-secondary span').text('Save as draft');
            }else if(formaction == 'draft'){
                $('.btn-save-form-primary').attr('data-action', 'publish');
                $('.btn-save-form-primary span').text('Publish');

                savebutton = 'Publish';
                formaction = 'publish';

                //setTimeout(function() {$('.btn-save-form-primary span').text('Publish');}, 1000);

                $('.btn-save-form-secondary').attr('data-action', 'update');
                $('.btn-save-form-secondary span').text('Save draft');
            }

            $(document).unbind('click', closeSaveOpt);
            $content.unbind('click', closeSaveOpt);

            window.onbeforeunload = null;

            if(type == 'options'){
                if(!window.location.hash){
                    window.location.href = window.location+'#page-options-tab';
                }
                window.location.reload(true);
            }else{
                pending = false;
                $('.btn-save-changes').removeClass('loading disabled');
                $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-footer .s-opt-show').removeClass('s-opt-show');
            }
            
        }
    });
}

function closeSaveOpt(e) {
    var container = $('.mfn-visualbuilder .sidebar-panel .sidebar-panel-footer .btn-save-action');

    if (!container.is(e.target) && container.has(e.target).length === 0){
        container.removeClass('s-opt-show');
        $(document).unbind('click', closeSaveOpt);
        $content.unbind('click', closeSaveOpt);
    }

    

}

// stop video if exists
function stopVideo(element){

    if(element.find( 'video' ).length){

        var video = element.find( 'video' );
        video.get(0).pause();

    }
}

function addItem(){
    $content.find('.mfn-builder-content').on('click', '.mfn-item-add', function(e) {
        e.preventDefault();
        backToWidgets();
    });
}

// check Empty Page

function checkEmptyPage(){
    if(!$content.find('.mfn-builder-content .mcb-section').length){
        if(!$content.find('.mfn-builder-content .mfn-section-start').length){
            $content.find('body').addClass('mfn-ui-empty-page');
            $content.find('.mfn-builder-content').prepend('<div class="mfn-section-start"><a href="#" class="mfn-section-add"><svg class="welcome-pic" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51.84 51.84"><defs><style>.cls-1{fill:none;stroke-width:1.5px;}.cls-1,.cls-3{stroke:#304050;stroke-miterlimit:10;}.cls-2,.cls-3{fill:#304050;}.cls-2{fill-rule:evenodd;}.cls-3{stroke-width:0.7px;}</style></defs><polyline class="cls-1" points="24.92 12.92 24.92 29.38 28.92 29.38"/><line class="cls-1" x1="24.92" y1="29.38" x2="24.92" y2="45.84"/><polyline class="cls-1" points="45.35 16.92 45.35 12.92 4.49 12.92 4.49 45.84 45.35 45.84 45.35 39.11"/><polyline class="cls-1" points="47.32 33.38 49.35 33.38 49.35 16.92 28.92 16.92 28.92 33.38 35.83 33.38"/><polyline class="cls-1" points="4.49 12.92 4.49 6 45.35 6 45.35 12.92"/><path class="cls-2" d="M39.41,9.41a1.24,1.24,0,1,0-1.24,1.22A1.23,1.23,0,0,0,39.41,9.41Z"/><path class="cls-2" d="M43,9.41a1.24,1.24,0,1,0-1.24,1.22A1.24,1.24,0,0,0,43,9.41Z"/><path class="cls-2" d="M35.83,9.41a1.24,1.24,0,1,0-1.24,1.22A1.24,1.24,0,0,0,35.83,9.41Z"/><path class="cls-2" d="M9.18,9.41a1.25,1.25,0,1,0-1.25,1.22A1.24,1.24,0,0,0,9.18,9.41Z"/><path class="cls-3" d="M46,29.7h0a1.3,1.3,0,0,0-.86.33,1.33,1.33,0,0,0-1.24-.91,1.32,1.32,0,0,0-.91.4,1.33,1.33,0,0,0-1.18-.75h0A1.16,1.16,0,0,0,41,29V25.83a1.33,1.33,0,1,0-2.65,0v6.32L38,31.72a1.77,1.77,0,0,0-2.6-.2l-.31.26a.27.27,0,0,0-.07.34l3,5.82a3.11,3.11,0,0,0,2.74,1.72h3.41a3.25,3.25,0,0,0,3.14-3.34V34.38c0-1.33,0-1.82,0-3.29A1.35,1.35,0,0,0,46,29.7Zm.77,4.68v1.94a2.71,2.71,0,0,1-2.59,2.79h-3.4a2.56,2.56,0,0,1-2.25-1.43l-2.93-5.62.15-.12h0a1.25,1.25,0,0,1,.92-.33,1.29,1.29,0,0,1,.89.47l.84,1a.29.29,0,0,0,.31.09.28.28,0,0,0,.18-.26v-7.1a.78.78,0,1,1,1.55,0V32A.28.28,0,1,0,41,32V30.12a.78.78,0,0,1,.76-.8h0a.81.81,0,0,1,.78.84v1.67a.28.28,0,1,0,.55,0V30.52a.76.76,0,1,1,1.52,0v1.23a.28.28,0,1,0,.56,0v-.67a.81.81,0,0,1,.78-.83h0a.81.81,0,0,1,.77.84Z"/></svg></a><h2>Welcome to Muffin Builder <sup>3.0</sup></h2> <a class="mfn-btn mfn-btn-green btn-icon-left btn-large mfn-section-add" href="#"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add-light"></span>Start creating</span></a> <p><a class="view-tutorial" href="#">View tutorial</a></p></div>');
            $content.find('.view-tutorial').on('click', function(e) {
                e.preventDefault();
                introduction.cookie.remove();
                introduction.open();
            });
        }
    }else{
        $content.find('body').removeClass('mfn-ui-empty-page');
        $content.find('.mfn-builder-content .mfn-section-start').remove();
    }
}

// check empty wraps

function checkEmptyWraps(){
    $content.find('.mfn-builder-content .mcb-wrap:not(.divider) .mcb-wrap-inner').each(function(i) {
        if( !$(this).find('.mcb-column').length && !$(this).hasClass('empty') ){
            $(this).addClass('empty');
            $(this).append('<div class="mfn-drag-helper placeholder-wrap ui-droppable"></div>');
            $(this).append('<div class="mfn-wrap-new"><a href="#" class="mfn-item-add mfn-btn btn-icon-left btn-small mfn-btn-blank2"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add"></span>Add item</span></a></div>');
        }else if( $(this).find('.mcb-column').length && $(this).find('.mfn-wrap-new').length ){
            $(this).removeClass('empty');
            $(this).find('.mfn-wrap-new').remove();
        }
    });
    runSorting();
}


// check empty sections

function checkEmptySections(){
    $content.find('.mfn-builder-content .mcb-section').each(function(i) {
        if(!$(this).find('.mcb-wrap').length){
            $(this).addClass('empty')
            $(this).children('.section_wrapper').html('<div class="mfn-section-new"> <h5>Select a wrap layout</h5> <div class="wrap-layouts"> <div class="wrap-layout wrap-11" data-type="wrap-11" data-tooltip="1/1"></div><div class="wrap-layout wrap-12" data-type="wrap-12" data-tooltip="1/2 | 1/2"><span></span></div><div class="wrap-layout wrap-13" data-type="wrap-13" data-tooltip="1/3 | 1/3 | 1/3"><span></span><span></span></div><div class="wrap-layout wrap-14" data-type="wrap-14" data-tooltip="1/4 | 1/4 | 1/4 | 1/4"><span></span><span></span><span></span></div><div class="wrap-layout wrap-13-23" data-type="wrap-1323" data-tooltip="1/3 | 2/3"><span></span></div><div class="wrap-layout wrap-23-13" data-type="wrap-2313" data-tooltip="2/3 | 1/3"><span></span></div><div class="wrap-layout wrap-14-12-14" data-type="wrap-141214" data-tooltip="1/4 | 1/2 | 1/4"><span></span><span></span></div></div><p>or choose from</p><a class="mfn-btn prebuilt-button mfn-btn-green btn-icon-left" href="#"><span class="btn-wrapper"><span class="mfn-icon mfn-icon-add-light"></span>Pre-built sections</span></a> </div>');
            runPrebuilt();
        }else if( $(this).find('.mfn-section-new').length ){
            $(this).find('.mfn-section-new').remove();
            $(this).removeClass('empty');
        }
    });
    addWrapLayout();
}

function runPrebuilt(){
    $content.find('.prebuilt-button').on('click', function(e) {
        e.preventDefault();
        showPrebuilts();
        prebuiltType = $(this).closest('.mcb-section').data('uid');
    });
}

// add Wrap Layout

function addWrapLayout() {

    $content.find('.wrap-layout').on('click', function(e) {
        e.preventDefault();
        pending = true;
        if(!$content.find('.wrap-layouts').hasClass('loading')){

            $content.find('.wrap-layouts').addClass('loading');

            let section = $(this).parent().parent().parent().parent().data('order');
            let id = $(this).parent().parent().parent().parent().data('uid');
            let type = $(this).data('type');

            $.ajax({
                url: ajaxurl,
                data: {
                    action: 'addwraplayout',
                    'mfn-builder-nonce': wpnonce,
                    type: type,
                    section: section,
                    releaser: 'releaser-'+releaser
                },
                type: 'POST',
                success: function(response){

                    $content.find('#Content .sections_group .mfn-builder-content .mcb-section-'+id+' .section_wrapper').append(response.html);
                    $('#mfn-vb-form').append(response.form);
                    
                    if($content.find('.mcb-section-'+id+' .mfn-section-new').length){ $content.find('.mcb-section-'+id+' .mfn-section-new').remove(); }
                    if($content.find('.mcb-section-'+id).hasClass('empty')){ $content.find('.mcb-section-'+id).removeClass('empty'); }

                    backToWidgets();
                    reSortSections();
                    $content.find('.wrap-layouts').removeClass('loading');
                    pending = false;

                    blink();
                    enableBeforeUnload();
                    addHistory();
                    
                }
            });

        }

    })
}

// add Wrap

function addNewWrap(id, is_divider) {

    pending = true;
    if(!$content.find('.mfn-wrap-add').hasClass('loading')){

        $content.find('.mfn-wrap-add').addClass('loading');

        let section = $content.find('.mcb-section-'+id).data('order');
        let count = $content.find('.mcb-section-'+id+' .section_wrapper .mcb-wrap').length;
        
        if($content.find('#Content .sections_group .mfn-builder-content .mcb-section-'+id+' .section_wrapper').length == 0){
            $content.find('#Content .sections_group .mfn-builder-content .mcb-section-'+id).append('<div class="section_wrapper mcb-section-inner"></div>');
        }

        $.ajax({
            url: ajaxurl,
            data: {
                action: 'addnewwrap',
                'mfn-builder-nonce': wpnonce,
                count: count,
                section: section,
                is_divider: is_divider,
                releaser: 'releaser-'+releaser
            },
            type: 'POST',
            success: function(response){
                if($content.find('.mcb-section-'+id+' .mfn-section-new').length){ $content.find('.mcb-section-'+id+' .mfn-section-new').remove(); }
                $content.find('#Content .sections_group .mfn-builder-content .mcb-section-'+id+' .section_wrapper').append(response.html);
                $('#mfn-vb-form').append(response.form);
                $content.find('.mfn-wrap-add').removeClass('loading');

                backToWidgets();
                reSortSections();

                pending = false;

                blink();

                addHistory();
                enableBeforeUnload();
                

            }
        });

    }
}

// add new widget
function addNewWidget(item){
    pending = true;
    $.ajax({
        url: ajaxurl,
        data: {
            action: 'addnewwidget',
            'mfn-builder-nonce': wpnonce,
            count: new_widget_wcount,
            section: new_widget_section,
            wrap: new_widget_wrap,
            size: new_widget_wrap_size,
            item: item,
            pageid: pageid,
            releaser: 'releaser-'+releaser
        },
        type: 'POST',
        success: function(response){

            if($content.find('.mfn-builder-content .mcb-item-'+new_widget_container).length){

                if(new_widget_position == 'before'){
                    $content.find('.mfn-builder-content .mcb-item-'+new_widget_container).before(response.html);
                }else{
                    $content.find('.mfn-builder-content .mcb-item-'+new_widget_container).after(response.html);
                }
                
            }else{
              
                $content.find('.mfn-builder-content .mcb-wrap-'+new_widget_container+' .mcb-wrap-inner').append(response.html);

                if($content.find('.mfn-builder-content .mcb-wrap-'+new_widget_container+' .mcb-wrap-inner').length && $content.find('.mfn-builder-content .mcb-wrap-'+new_widget_container+' .mcb-wrap-inner').hasClass('empty')){
                    $content.find('.mfn-builder-content .mcb-wrap-'+new_widget_container+' .mcb-wrap-inner').removeClass('empty');
                    $content.find('.mfn-builder-content .mcb-wrap-'+new_widget_container+' .mcb-wrap-inner .mfn-wrap-new').remove();
                }

            }
            

            if(response.script){
                let ajax_script = response.script;
                eval(ajax_script);
            }
            
            $('#mfn-vb-form').append(response.form);

            if(item == 'progress_bars'){ $content.find('.mfn-builder-content .mcb-wrap-inner .mcb-item-'+response.id+' .bars_list').addClass('hover'); }
            reSortSections();

            pending = false;

            blink();

            runSorting();

            checkEmptyWraps();

            enableBeforeUnload();
            //addHistory();
            
        }
    });

}

function addNewSection(){

    $content.find('.mfn-builder-content').on('click', '.mfn-section-add', function(e) {
        e.preventDefault();

        pending = true;

        if(!$content.find('.mfn-section-add').hasClass('loading')){

            $content.find('.mfn-section-add').addClass('loading');

            let uid = $(this).parent().data('uid');
            let count = $content.find('.mcb-section').length;
            let placement = 'next';
            if($(this).hasClass('prev')){placement = 'prev';}

            $.ajax({
                url: ajaxurl,
                data: {
                    action: 'addnewsection',
                    'mfn-builder-nonce': wpnonce,
                    count: count,
                    releaser: 'releaser-'+releaser,
                },
                type: 'POST',
                success: function(response){

                    if($content.find('.mfn-builder-content .mfn-section-start').length){
                        $content.find('body').removeClass('mfn-ui-empty-page');
                        $content.find('.mfn-builder-content .mfn-section-start').remove();
                    }

                    if (typeof(uid) !== 'undefined') {
                        if(placement == 'prev'){
                            $content.find('#Content .sections_group .mcb-section-'+uid).before(response.html);
                        }else{
                            $content.find('#Content .sections_group .mcb-section-'+uid).after(response.html);
                        }
                    }else{
                        $content.find('.mfn-builder-content').prepend(response.html);
                    }

                    $('#mfn-vb-form').append(response.form);
                    
                    $content.find('.mfn-section-add').removeClass('loading');
                    reSortSections();
                    addWrapLayout();
                    runPrebuilt();

                    prebuiltType = response.id;

                    pending = false;

                    blink();
                    enableBeforeUnload();
                    addHistory();
                    

                }
            });


        }
    });
}

// shortcode remove icon

$('.modal-add-shortcode .browse-icon .mfn-button-delete').on('click', function(e) {
    e.preventDefault();
    $('.modal-add-shortcode.show .browse-icon .mfn-form-control').val(sample_icon);
    $('.modal-add-shortcode.show .form-addon-prepend .mfn-button-upload .label i').attr('class', sample_icon);
});

// choose icon
$('.mfn-modal.modal-select-icon .mfn-items-list li a').on('click', function(e) {
    e.preventDefault();

    let icon = $(this).find('i').attr('class');
    $(this).parent().addClass('active');

    if( $('.modal-add-shortcode').hasClass('show') ){
        // for shortcode

        $('.modal-add-shortcode.show .browse-icon .mfn-form-control').val(icon);
        $('.modal-add-shortcode.show .form-addon-prepend .mfn-button-upload .label i').attr('class', icon);
        $('.modal-select-icon.show').removeClass('show');

    }else{
        // for sidebar
    
        
        $('.mfn-form-row.icon.mfn-fr-show .preview-iconinput').val(icon);
        $('.mfn-form-row.icon.mfn-fr-show .form-addon-prepend .mfn-button-upload .label i').attr('class', icon);
        $('.mfn-form-row.icon.mfn-fr-show .browse-icon').removeClass('empty');
        $('.mfn-modal').removeClass('show');

        let it = $('.mfn-form-row.icon.mfn-fr-show').data('element');

        if($content.find('.'+it).hasClass('column_counter')){
            // counter
            if($content.find('.'+it+' .icon_wrapper i').length){
                $content.find('.'+it+' .icon_wrapper i').attr('class', icon);
            }else{
                $content.find('.'+it+' .icon_wrapper').html('<i class="'+icon+'"></i>');
            }
        }else if($content.find('.'+it).hasClass('column_flat_box')){
            // flat box
            if($content.find('.'+it+' .icon i').length){
                $content.find('.'+it+' .icon i').attr('class', icon);
            }else{
                $content.find('.'+it+' .icon').html('<i class="'+icon+'"></i>');
            }
        }else if($content.find('.'+it).hasClass('column_icon_box')){
            // icon box
            if($content.find('.'+it+' .icon_wrapper .icon i').length){
                $content.find('.'+it+' .icon_wrapper .icon i').attr('class', icon);
            }else{
                if($content.find('.'+it+' .icon_box .image_wrapper').length){ $content.find('.'+it+' .icon_box .image_wrapper').remove(); }
                $content.find('.'+it+' .icon_box').prepend('<div class="icon_wrapper"><div class="icon"><i class="'+icon+'"></i></div></div>');
            }
        }else if($content.find('.'+it).hasClass('column_list')){
            // list
            if($content.find('.'+it+' .list_left i').length){
                $content.find('.'+it+' .list_left i').attr('class', icon);
            }else{
                $content.find('.'+it+' .list_left').removeClass('list_image').addClass('list_icon').html('<i class="'+icon+'"></i>');
            }
        }else if($content.find('.'+it).hasClass('column_fancy_heading')){
            // fancy heading
            if($content.find('.'+it+' .icon_top i').length){
                $content.find('.'+it+' .icon_top i').attr('class', icon);
            }else{
                $content.find('.'+it+' .icon_top').html('<i class="'+icon+'"></i>');
            }
        }else if($content.find('.'+it).hasClass('column_call_to_action')){
            // call to action
            if($content.find('.'+it+' .call_center i').length){
                $content.find('.'+it+' .call_center i').attr('class', icon);
            }else{
                $content.find('.'+it+' .call_center').html('<i class="'+icon+'"></i>');
            }
        }else if($content.find('.'+it).hasClass('column_button')){
            // button
            if($content.find('.'+it+' .button .button_icon i').length){
                $content.find('.'+it+' .button .button_icon i').attr('class', icon);
            }else{
                $content.find('.'+it+' .button').prepend('<span class="button_icon"><i class="'+icon+'"></i></span>');
                $content.find('.'+it+' .button').addClass('has-icon');
            }
        }else if($content.find('.'+it).hasClass('column_chart')){
            // chart
            if($content.find('.'+it+' .chart .icon i').length){
                $content.find('.'+it+' .chart .icon i').attr('class', icon);
            }else{
                if( !$content.find('.'+it+' .chart > .image').length ){
                    $content.find('.'+it+' .chart > .image').remove();
                    $content.find('.'+it+' .chart > .num').remove();
                    $content.find('.'+it+' .chart').prepend('<div class="icon"><i class="'+icon+'"></i></div>');
                }else{
                    $content.find('.'+it+' .chart').append('<span class="mfn_tmp_info">The picture has higher priority. Delete it to see icon.</span>');
                    setTimeout(function() {
                        $content.find('.mfn_tmp_info').remove();
                    }, 3000);
                }
                
            }
        }
        enableBeforeUnload();
        addHistory();
    }
});




// delete icon
$($editpanel).on('click', '.browse-icon .mfn-button-delete', function(e) {
    e.preventDefault();
    let it = $(this).closest('.mfn-form-row').data('element');
    let group = $(this).closest('.mfn-form-row').data('group');

    $('.mfn-form-row.icon.mfn-fr-show .preview-iconinput').val('');
    $('.mfn-form-row.icon.mfn-fr-show .form-addon-prepend .mfn-button-upload .label i').attr('class', sample_icon);
    $('.mfn-form-row.icon.mfn-fr-show .browse-icon').addClass('empty');

    if($content.find('.'+it).hasClass('column_counter')){
        // counter
        if($('.mfn-ui .mfn-form .mfn-fr-show .mfn-form-control.preview-imageinput').val().length){
            $content.find('.'+it+' .icon_wrapper').html( $('.mfn-ui .mfn-form .mfn-fr-show .mfn-form-control.preview-imageinput').val() );
        }else{
            $content.find('.'+it+' .icon_wrapper').html('');
        }
    }else if($content.find('.'+it).hasClass('column_flat_box')){
        // flat box
        if($content.find('.'+it+' .icon i').length){
            $content.find('.'+it+' .icon i').attr('class', sample_icon);
        }
    }else if($content.find('.'+it).hasClass('column_icon_box')){
        // icon box
        if( $('.mfn-ui .mfn-form .mfn-fr-show .mfn-form-control.preview-imageinput').val().length ){
            $content.find('.'+it+' .icon_wrapper').remove();
            $content.find('.'+it+' .icon_box').prepend(' <div class="image_wrapper"><img src=" '+ $('.mfn-ui .mfn-form .mfn-fr-show .mfn-form-control.preview-imageinput').val() +' " class="scale-with-grid" alt=""></div> ');
        }
    }else if($content.find('.'+it).hasClass('column_list')){
        // list
        if($content.find('.'+it+' .list_left i').length){
            $content.find('.'+it+' .list_left i').attr('class', sample_icon);
        }
    }else if($content.find('.'+it).hasClass('column_fancy_heading')){
        // fancy heading
        if($content.find('.'+it+' .icon_top i').length){
            $content.find('.'+it+' .icon_top i').attr('class', sample_icon);
        }
    }else if($content.find('.'+it).hasClass('column_call_to_action')){
        // call to action
        if($content.find('.'+it+' .call_center i').length){
            $content.find('.'+it+' .call_center i').attr('class', '');
        }
    }else if($content.find('.'+it).hasClass('column_button')){
        // button
        if($content.find('.'+it+' .button .button_icon i').length){
            $content.find('.'+it+' .button .button_icon').remove();
            $content.find('.'+it+' .button').removeClass('has-icon');
        }
    }else if($content.find('.'+it).hasClass('column_chart')){
        // chart
        if($content.find('.'+it+' .chart .icon').length){
            $content.find('.'+it+' .chart .icon').remove();
            
            if( $('.mfn-form .mfn-fr-show .preview-imageinput').val().length ){
                $content.find('.'+it+' .chart .num').remove();
                $content.find('.'+it+' .chart .icon').remove();
                $content.find('.'+it+' .chart').prepend('<div class="image"><img class="scale-with-grid" src="'+$('.mfn-form .mfn-fr-show .preview-imageinput').val()+'" alt="" /></div>');
            }else if( $('.mfn-form .mfn-fr-show .preview-labelinput').val().length ){
                $content.find('.'+it+' .chart .num').remove();
                $content.find('.'+it+' .chart .image').remove();
                $content.find('.'+it+' .chart').prepend('<div class="num">'+$("."+group+'.mfn-fr-show .preview-labelinput').val()+'</div>');
            }

        }
    }
    enableBeforeUnload();
    addHistory();

});



// show choose icon
$($editpanel).on('click', '.mfn-form-row .browse-icon .mfn-button-upload', function(e) {
    e.preventDefault();
    $('.mfn-modal.modal-select-icon .mfn-items-list li').removeClass('active');
    $('.mfn-modal.modal-select-icon').addClass('show');
});






























































































// inputs changes


function runEdit(releaser){


// visual

if($('.visual.content.'+releaser).length){

    $('.visual.content.'+releaser).each(function() {

        if($(this).find('iframe').length){
            let tmp_uid = getUid();
            $(this).find('.form-group.visual-editor').html('<div class="form-control"><div class="wp-core-ui wp-editor-wrap tmce-active"><div class="wp-editor-tools hide-if-no-js"><div class="wp-media-buttons"><button type="button" class="button insert-media add_media" data-editor="ve-'+tmp_uid+'"><span class="wp-media-buttons-icon"></span> Add Media</button></div><div class="wp-editor-tabs"><button type="button" class="wp-switch-editor switch-tmce" data-wp-editor-id="ve-'+tmp_uid+'">Visual</button><button type="button" class="wp-switch-editor switch-html" data-wp-editor-id="ve-'+tmp_uid+'">Text</button></div></div><div class="wp-editor-container"><textarea class="editor wp-editor-area preview-contentinput" name="'+$(this).find('.preview-contentinput').attr('name')+'" data-visual="mce" id="ve-'+tmp_uid+'" rows="8">'+$(this).find('.preview-contentinput').val()+'</textarea></div></div></div>');
        }

        var $editor = $(this).find('textarea[data-visual="mce"]');

        var visuid = $editor.attr('data-id');
        $editor.attr('id', visuid);

        var vis_settings = {
            tinymce: {
                toolbar1: "formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,dfw,wp_adv,mfnsc",
                toolbar2: "strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
                menubar: false,
                statusbar: false,
            }
        };

        wp.editor.initialize(visuid, vis_settings);

        tinymce.get( visuid ).on('blur', function(e) {

            let it = $('.sidebar-wrapper .mfn-form-row.mfn-fr-show').data('element');
            let val = this.getContent();

            $content.find('.'+it+' .item-header').nextAll().remove();
            $content.find('.'+it).append(val);

            $editor.val(val);
            enableBeforeUnload();
            addHistory();
        });


    });
}

// widgets

$('.'+releaser+' .preview-numberinput').on('change', function() {
    // number
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_counter')){
        // counter
        if($content.find('.'+it+' .desc_wrapper .number').length){
            $content.find('.'+it+' .desc_wrapper .number').text(val);
        }else{
            if($content.find('.'+it+' .desc_wrapper .number-wrapper').length){
                $content.find('.'+it+' .desc_wrapper .number-wrapper').append('<span class="number" data-to="'+val+'">'+val+'</span>');
            }else{
                $content.find('.'+it+' .desc_wrapper').prepend('<div class="number-wrapper"><span class="number" data-to="'+val+'">'+val+'</span></div>');
            }
        }
    }else if($content.find('.'+it).hasClass('column_how_it_works')){
        // how it works
        if($content.find('.'+it+' .image .number').length){
            $content.find('.'+it+' .image .number').text(val);
        }else{
            $content.find('.'+it+' .image').html('<span class="number">'+val+'</span>');
        }
    }else if($content.find('.'+it).hasClass('column_quick_fact')){
        // quick fact
        if($content.find('.'+it+' .number-wrapper .number').length){
            $content.find('.'+it+' .number-wrapper .number').attr('data-to', val).text(val);
        }else{
            $content.find('.'+it+' .quick_fact').prepend('<div class="number-wrapper"><span class="number" data-to="'+val+'">'+val+'</span></div>');
        }
    }
    enableBeforeUnload();
    addHistory();
});



$('.'+releaser+' .preview-prefixinput').keyup(function() {
    // prefix
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_counter')){
        // counter
        if($content.find('.'+it+' .desc_wrapper .label.prefix').length){
            $content.find('.'+it+' .desc_wrapper .label.prefix').text(val);
        }else{
            if($content.find('.'+it+' .desc_wrapper .number-wrapper').length){
                $content.find('.'+it+' .desc_wrapper .number-wrapper').prepend('<span class="label prefix">'+val+'</span>');
            }else{
                $content.find('.'+it+' .desc_wrapper').prepend('<div class="number-wrapper"><span class="label prefix">'+val+'</span></div>');
            }
        }
    }else if($content.find('.'+it).hasClass('column_quick_fact')){
        // quick fact prefix
        if($content.find('.'+it+' .number-wrapper .prefix').length){
            $content.find('.'+it+' .number-wrapper .prefix').text(val);
        }else{
            if($content.find('.'+it+' .number-wrapper').length){
                $content.find('.'+it+' .number-wrapper').prepend('<span class="label prefix">'+val+'</span>');
            }else{
                $content.find('.'+it+' .desc_wrapper').prepend('<div class="number-wrapper"><span class="label prefix">'+val+'</span></div>');
            }
        }
    }

}).change(addHistory, enableBeforeUnload);


$('.'+releaser+' .preview-labelinput').keyup(function() {
    // postfix
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_counter')){
        // counter
        if($content.find('.'+it+' .desc_wrapper .label.postfix').length){
            $content.find('.'+it+' .desc_wrapper .label.postfix').text(val);
        }else{
            if($content.find('.'+it+' .desc_wrapper .number-wrapper').length){
                $content.find('.'+it+' .desc_wrapper .number-wrapper').append('<span class="label postfix">'+val+'</span>');
            }else{
                $content.find('.'+it+' .desc_wrapper').prepend('<div class="number-wrapper"><span class="label postfix">'+val+'</span></div>');
            }
        }
    }else if($content.find('.'+it).hasClass('column_quick_fact')){
        // quick fact postfix
        if($content.find('.'+it+' .number-wrapper .label.postfix').length){
            $content.find('.'+it+' .number-wrapper .label.postfix').text(val);
        }else{
            if($content.find('.'+it+' .number-wrapper').length){
                $content.find('.'+it+' .number-wrapper').append('<span class="label postfix">'+val+'</span>');
            }else{
                $content.find('.'+it+' .desc_wrapper').prepend('<div class="number-wrapper"><span class="label postfix">'+val+'</span></div>');
            }
        }
    }else if($content.find('.'+it).hasClass('column_chart')){
        // chart

        if(val.length){
            if($content.find('.'+it+' .num').length){
                $content.find('.'+it+' .num').text(val);
            }else{

                if( !$content.find('.'+it+' .chart > .image').length && !$content.find('.'+it+' .chart > .icon').length ){
                    $content.find('.'+it+' .chart').prepend('<div class="num">'+val+'</div>');
                }else{
                    if(!$content.find('.'+it+' .chart .mfn_tmp_info').length){
                        $content.find('.'+it+' .chart').append('<span class="mfn_tmp_info">Picture and icon have higher priority. Delete them to see label.</span>');
                        setTimeout(function() {
                            $content.find('.mfn_tmp_info').remove();
                        }, 3000);
                    }
                }
            }
        }else{
            if( $('.mfn-form .mfn-fr-show .preview-imageinput').val().length ){
                if($content.find('.'+it+' .chart .image img').length){
                    $content.find('.'+it+' .chart .image img').attr('src', $('.mfn-form .mfn-fr-show .preview-imageinput').val());
                }else{
                    $content.find('.'+it+' .chart .num').remove();
                    $content.find('.'+it+' .chart .icon').remove();
                    $content.find('.'+it+' .chart').prepend('<div class="image"><img class="scale-with-grid" src="'+$('.mfn-form .mfn-fr-show .preview-imageinput').val()+'" alt="" /></div>');
                }
            }else if( $('.mfn-form .mfn-fr-show .preview-iconinput').val().length ){
                if($content.find('.'+it+' .chart .icon i').length){
                    $content.find('.'+it+' .chart .icon i').attr('class', $('.mfn-form .mfn-fr-show .preview-iconinput').val());
                }else{
                    $content.find('.'+it+' .chart > .image').remove();
                    $content.find('.'+it+' .chart > .num').remove();
                    $content.find('.'+it+' .chart').prepend('<div class="icon"><i class="'+$('.mfn-form .mfn-fr-show .preview-iconinput').val()+'"></i></div>');
                }
            }
            
        }
    }

}).change(addHistory, enableBeforeUnload);




$('.'+releaser+' .preview-headinginput').keyup(function() {
    // heading
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_quick_fact')){
        // quick facts
        if($content.find('.'+it+' .quick_fact .heading_tag').length){
            $content.find('.'+it+' .quick_fact .heading_tag').text(val);
        }else{
            $content.find('.'+it+' .quick_fact').prepend('<h4 class="title heading_tag">'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_our_team')){
        // our team
        if($content.find('.'+it+' .team > .title').length){
            $content.find('.'+it+' .team > .title').text(val);
        }else{
            $content.find('.'+it+' .team').prepend('<h4 class="title">'+val+'</h4>');
        }
    }

}).change(addHistory, enableBeforeUnload);

$('.'+releaser+' .preview-captioninput').keyup(function() {
    // caption
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_image')){
        // image
        if($content.find('.'+it+' .wp-caption-text').length){
            $content.find('.'+it+' .wp-caption-text').text(val);
        }else{
            $content.find('.'+it+' .image_frame').append('<p class="wp-caption-text">'+val+'</p>');
        }
    }
}).change(addHistory, enableBeforeUnload);

$('.'+releaser+' .preview-priceinput').keyup(function() {
    // price
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if($content.find('.'+it).hasClass('column_pricing_item')){
        // image
        if($content.find('.'+it+' .price span').length){
            $content.find('.'+it+' .price span').text(val);
        }else{
            $content.find('.'+it+' .price').append('<span>'+val+'</span>');
        }
    }
}).change(addHistory, enableBeforeUnload);

$('.'+releaser+' .preview-percentinput').on('change', function() {
    // chart
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    $content.find('.'+it+' .chart').attr('data-percent', val);
    mfnChart();
    enableBeforeUnload();
    addHistory();
});

$('.'+releaser+' .preview-line_widthinput').on('change', function() {
    // chart
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    $content.find('.'+it+' .chart').attr('data-line-width', val);
    mfnChart();
    enableBeforeUnload();
    addHistory();
});


$('.'+releaser+' .preview-titleinput').keyup(function() {
    // title
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_article_box')){
        // article box
        if($content.find('.'+it+' .desc_wrapper h4').length){
            $content.find('.'+it+' .desc_wrapper h4').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper i').before('<h4>'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_feature_box')){
        // feature box
        if($content.find('.'+it+' .desc_wrapper h4').length){
            $content.find('.'+it+' .desc_wrapper h4').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').prepend('<h4>'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_chart')){
        // chart
        if($content.find('.'+it+' .chart_box big').length){
            $content.find('.'+it+' .chart_box big').text(val);
        }else{
            $content.find('.'+it+' .chart_box').append('<p><big>'+val+'</big></p>');
        }
    }else if($content.find('.'+it).hasClass('column_pricing_item')){
        // pricing item
        if($content.find('.'+it+' .plan-header > h2').length){
            $content.find('.'+it+' .plan-header > h2').text(val);
        }else{
            $content.find('.'+it+' .plan-header .image').after('<h2>'+val+'</h2>');
        }
    }else if($content.find('.'+it).hasClass('column_our_team')){
        // our team
        if($content.find('.'+it+' .desc_wrapper h4').length){
            $content.find('.'+it+' .desc_wrapper h4').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').prepend('<h4>'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_our_team_list')){
        // our team list
        if($content.find('.'+it+' .desc_wrapper h4').length){
            $content.find('.'+it+' .desc_wrapper h4').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').prepend('<h4>'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_call_to_action')){
        // call to action
        if($content.find('.'+it+' .call_left h3').length){
            $content.find('.'+it+' .call_left h3').text(val);
        }else{
            $content.find('.'+it+' .call_left').prepend('<h3>'+val+'</h3>');
        }
    }else if($content.find('.'+it).hasClass('column_trailer_box')){
        // trailer box
        if($content.find('.'+it+' .desc h2').length){
            $content.find('.'+it+' .desc h2').text(val);
        }else{
            $content.find('.'+it+' .desc').append('<h2>'+val+'</h2><div class="line"></div>');
        }
    }else if($content.find('.'+it).hasClass('column_fancy_heading')){
        // fancy heading
        if($content.find('.'+it+' .fancy_heading .title').length){
            $content.find('.'+it+' .fancy_heading .title').text(val);
        }else{
            $content.find('.'+it+' .fancy_heading').prepend('<h2 class="title">'+val+'</h2>');
        }
    }else if($content.find('.'+it).hasClass('column_sliding_box')){
        // sliding box
        if($content.find('.'+it+' .desc_wrapper h4').length){
            $content.find('.'+it+' .desc_wrapper h4').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').prepend('<h4>'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_story_box')){
        // story box
        if($content.find('.'+it+' .desc_wrapper h3').length){
            $content.find('.'+it+' .desc_wrapper h3').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').prepend('<h3 class="themecolor">'+val+'</h3>');
        }
    }else if($content.find('.'+it).hasClass('column_shop_slider')){
        // shop slider
        if($content.find('.'+it+' .title').length){
            $content.find('.'+it+' .title').text(val);
        }else{
            $content.find('.'+it+' .blog_slider_header').prepend('<h4 class="title">'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_quick_fact')){
        // quick facts
        if($content.find('.'+it+' .quick_fact .title_tag').length){
            $content.find('.'+it+' .quick_fact .title_tag').text(val);
        }else{
            $content.find('.'+it+' .quick_fact .number-wrapper').after('<h3 class="title title_tag">'+val+'</h3>');
        }
    }else if($content.find('.'+it).hasClass('column_promo_box')){
        // promo box
        if($content.find('.'+it+' .desc_wrapper h2').length){
            $content.find('.'+it+' .desc_wrapper h2').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').prepend('<h2>'+val+'</h2>');
        }
    }else if($content.find('.'+it).hasClass('column_list')){
        // list
        if($content.find('.'+it+' .list_right h4').length){
            $content.find('.'+it+' .list_right h4').text(val);
        }else{
            $content.find('.'+it+' .list_right').prepend('<h4>'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_photo_box')){
        // photo box
        if($content.find('.'+it+' .photo_box h4').length){
            $content.find('.'+it+' .photo_box h4').text(val);
        }else{
            $content.find('.'+it+' .photo_box').prepend('<h4>'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_opening_hours')){
        // opening hours
        if($content.find('.'+it+' .opening_hours h3').length){
            $content.find('.'+it+' .opening_hours h3').text(val);
        }else{
            $content.find('.'+it+' .opening_hours').prepend('<h3>'+val+'</h3>');
        }
    }else if($content.find('.'+it).hasClass('column_info_box')){
        // info box
        if($content.find('.'+it+' .infobox h3').length){
            $content.find('.'+it+' .infobox h3').text(val);
        }else{
            $content.find('.'+it+' .infobox').prepend('<h3>'+val+'</h3>');
        }
    }else if($content.find('.'+it).hasClass('column_how_it_works')){
        // how it works
        if($content.find('.'+it+' .how_it_works h4').length){
            $content.find('.'+it+' .how_it_works h4').text(val);
        }else{
            $content.find('.'+it+' .how_it_works .image').after('<h4>'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_icon_box')){
        // icon box
        if($content.find('.'+it+' .desc_wrapper .title').length){
            $content.find('.'+it+' .desc_wrapper .title').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').prepend('<h4 class="title">'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_flat_box')){
        // flat box
        if($content.find('.'+it+' .desc_wrapper h4').length){
            $content.find('.'+it+' .desc_wrapper h4').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').prepend('<h4>'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_helper')){
        // helper
        if($content.find('.'+it+' .helper_header .title').length){
            $content.find('.'+it+' .helper_header .title').text(val);
        }else{
            $content.find('.'+it+' .helper_header').prepend('<h4 class="title">'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_blog_slider') || $content.find('.'+it).hasClass('column_clients_slider')){
        // blog slider // clients slider
        $content.find('.'+it+' .blog_slider_header').html('<h4 class="title">'+val+'</h4>');
    }else if($content.find('.'+it).hasClass('column_blog_news')){
        // blog news
        if($content.find('.'+it+' .Latest_news h3.title').length){
            $content.find('.'+it+' .Latest_news h3.title').text(val);
        }else{
            $content.find('.'+it+' .Latest_news').prepend('<h3 class="title">'+val+'</h3>');
        }
    }else if($content.find('.'+it).hasClass('column_blog_teaser')){
        // blog news
        if($content.find('.'+it+' .blog-teaser h3.title').length){
            $content.find('.'+it+' .blog-teaser h3.title').text(val);
        }else{
            $content.find('.'+it+' .blog-teaser').prepend('<h3 class="title">'+val+'</h3>');
        }
    }else if($content.find('.'+it).hasClass('column_counter')){
        // counter
        if($content.find('.'+it+' .desc_wrapper p.title').length){
            $content.find('.'+it+' .desc_wrapper p.title').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').append('<p class="title">'+val+'</p>');
        }
    }else if($content.find('.'+it).hasClass('column_contact_box')){
        // contact box
        if($content.find('.'+it+' .get_in_touch > h3').length){
            $content.find('.'+it+' .get_in_touch > h3').text(val);
        }else{
            $content.find('.'+it+' .get_in_touch').prepend('<h3>'+val+'</h3>');
        }
    }else if($content.find('.'+it).hasClass('column_tabs')){
        // tabs
        if($content.find('.'+it+' h4.title').length){
            $content.find('.'+it+' h4.title').text(val);
        }else{
            $content.find('.'+it+'').prepend('<h4 class="title">'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_progress_bars')){
        // progresss bars
        if($content.find('.'+it+' .progress_bars h4.title').length){
            $content.find('.'+it+' .progress_bars h4.title').text(val);
        }else{
            $content.find('.'+it+' .progress_bars').prepend('<h4 class="title">'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_accordion')){
        // accordion
        if($content.find('.'+it+' .accordion h4.title').length){
            $content.find('.'+it+' .accordion h4.title').text(val);
        }else{
            $content.find('.'+it+' .accordion').prepend('<h4 class="title">'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_faq')){
        // faq
        if($content.find('.'+it+' .faq h4.title').length){
            $content.find('.'+it+' .faq h4.title').text(val);
        }else{
            $content.find('.'+it+' .faq').prepend('<h4 class="title">'+val+'</h4>');
        }
    }else if($content.find('.'+it).hasClass('column_button')){
        // button
        $content.find('.'+it+' .button .button_label').text(val);
    }
    
}).change(addHistory, enableBeforeUnload);

// call to action button
$('.'+releaser+' .preview-button_titleinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let tmp_group = $(this).closest('.mfn-form-row').data('group');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_call_to_action')){
        // call to action button
        if(val){
            $content.find('.'+it+' .call_center').html('<a href="#" class="button has-icon "><span class="button_icon"><i class="'+$('.'+tmp_group+' .preview-iconinput').val()+'"></i></span><span class="button_label">'+val+'</span></a>');
        }else{
            $content.find('.'+it+' .call_center').html('<span class="icon_wrapper"><i class="'+$('.'+tmp_group+' .preview-iconinput').val()+'"></i></span>');
        }
    }
}).change(addHistory, enableBeforeUnload);


// helper title 1
$('.helper.title1.'+releaser+' .preview-title1input').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .links .link-1').length){
        $content.find('.'+it+' .links .link-1').html(val);
    }else{
        $content.find('.'+it+' .links').prepend('<a class="link link-1 toggle" href="#" data-rel="1">'+val+'</a>');
    }
}).change(addHistory, enableBeforeUnload);

// helper title 2
$('.helper.title2.'+releaser+' .preview-title2input').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .links .link-2').length){
        $content.find('.'+it+' .links .link-2').html(val);
    }else{
        $content.find('.'+it+' .links').append('<a class="link link-2 toggle" href="#" data-rel="2">'+val+'</a>');
    }
}).change(addHistory, enableBeforeUnload);

// promo box button
$('.promo_box.btn_text.'+releaser+' .preview-btn_textinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        if($content.find('.'+it+' .desc_wrapper .button_label').length){
            $content.find('.'+it+' .desc_wrapper .button_label').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').append('<a href="#" class="button button_theme has-icon"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">'+val+'</span></a>');
        }
    }else{
        $content.find('.'+it+' .desc_wrapper .button').remove();
    }
}).change(addHistory, enableBeforeUnload);


// code
$('.code.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' pre').length){
        $content.find('.'+it+' pre').text(val);
    }else{
        $content.find('.'+it).append('<pre>'+val+'</pre>');
    }
}).change(addHistory, enableBeforeUnload);

// opening hours content
$('.opening_hours.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .opening_hours_wrapper .ohw-desc').length){
        $content.find('.'+it+' .opening_hours_wrapper .ohw-desc').text(val);
    }else{
        $content.find('.'+it+' .opening_hours_wrapper').prepend('<span class="ohw-desc">'+val+'</span>');
    }
}).change(addHistory, enableBeforeUnload);

// info box content
$('.info_box.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .infobox_wrapper .ib-desc').length){
        $content.find('.'+it+' .infobox_wrapper .ib-desc').text(val);
    }else{
        $content.find('.'+it+' .infobox_wrapper').append('<span class="ib-desc">'+val+'</span>');
    }
}).change(addHistory, enableBeforeUnload);

// content feature list
$('.feature_list.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .feature_list > .fl-content').length){
        $content.find('.'+it+' .feature_list > .fl-content').html(val);
    }else{
        $content.find('.'+it+' .feature_list').append('<ul class="fl-content">'+val+'</ul>');
    }
}).change(addHistory, enableBeforeUnload);

// list
$('.list.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .list_right .desc').length){
        $content.find('.'+it+' .list_right .desc').html(val);
    }else{
        $content.find('.'+it+' .list_right').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// our team
$('.our_team.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .desc_wrapper .desc').length){
        $content.find('.'+it+' .desc_wrapper .desc').html(val);
    }else{
        $content.find('.'+it+' .desc_wrapper').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// our team list
$('.our_team_list.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .desc_wrapper .desc').length){
        $content.find('.'+it+' .desc_wrapper .desc').html(val);
    }else{
        $content.find('.'+it+' .desc_wrapper').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// our team
$('.our_team.blockquote.'+releaser+' .preview-blockquoteinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .desc_wrapper blockquote').length){
        $content.find('.'+it+' .desc_wrapper blockquote').html(val);
    }else{
        $content.find('.'+it+' .desc_wrapper').append('<blockquote>'+val+'</blockquote>');
    }
}).change(addHistory, enableBeforeUnload);
// our team list
$('.our_team_list.blockquote.'+releaser+' .preview-blockquoteinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .column .bq_wrapper blockquote').length){
        $content.find('.'+it+' .column .bq_wrapper blockquote').html(val);
    }else{
        $content.find('.'+it+' .column .bq_wrapper').prepend('<blockquote>'+val+'</blockquote>');
    }
}).change(addHistory, enableBeforeUnload);

// call to action
$('.call_to_action.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .call_right .desc').length){
        $content.find('.'+it+' .call_right .desc').html(val);
    }else{
        $content.find('.'+it+' .call_right').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// fancy heading
$('.fancy_heading.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .inside').length){
        $content.find('.'+it+' .inside').html(val);
    }else{
        $content.find('.'+it+' .fancy_heading').append('<div class="inside">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// promo box
$('.promo_box.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .desc_wrapper .desc').length){
        $content.find('.'+it+' .desc_wrapper .desc').html(val);
    }else{
        $content.find('.'+it+' .desc_wrapper').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// zoom box
$('.zoom_box.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .desc_txt').length){
        $content.find('.'+it+' .desc_txt').html(val);
    }else{
        $content.find('.'+it+' .desc_wrap').append('<div class="desc_txt">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// quick fact
$('.quick_fact.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .quick_fact .desc').length){
        $content.find('.'+it+' .quick_fact .desc').html(val);
    }else{
        $content.find('.'+it+' .quick_fact').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// photo box
$('.photo_box.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .photo_box .desc').length){
        $content.find('.'+it+' .photo_box .desc').html(val);
    }else{
        $content.find('.'+it+' .photo_box').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// story box
$('.story_box.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .story_box .desc').length){
        $content.find('.'+it+' .story_box .desc').html(val);
    }else{
        $content.find('.'+it+' .story_box').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// hover color content
$('.hover_color.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .hover_color_wrapper').length){
        $content.find('.'+it+' .hover_color_wrapper').html(val);
    }
}).change(addHistory, enableBeforeUnload);

// icon box content
$('.icon_box.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .desc').length){
        $content.find('.'+it+' .desc').html(val);
    }else{
        $content.find('.'+it+' .desc_wrapper').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// how it works content
$('.how_it_works.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' .desc').length){
        $content.find('.'+it+' .desc').html(val);
    }
}).change(addHistory, enableBeforeUnload);

// contact box address
$('.contact_box.address.'+releaser+' .preview-addressinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        if($content.find('.'+it+' .get_in_touch_wrapper ul li.address .address_wrapper').length){
            $content.find('.'+it+' .get_in_touch_wrapper ul li.address .address_wrapper').html(val);
        }else{
            $content.find('.'+it+' .get_in_touch_wrapper ul').append('<li data-sort="1" class="address"><span class="icon"><i class="icon-location"></i></span><span class="address_wrapper">'+val+'</span></li>');
        }
    }else{
        $content.find('.'+it+' .get_in_touch_wrapper ul li.address').remove();
    }
    
}).change(addHistory, enableBeforeUnload);

// contact box phone
$('.contact_box.telephone.'+releaser+' .preview-telephoneinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        if($content.find('.'+it+' .get_in_touch_wrapper ul li.phone.phone-1 p a').length){
            $content.find('.'+it+' .get_in_touch_wrapper ul li.phone.phone-1 p a').html(val);
        }else{
            $content.find('.'+it+' .get_in_touch_wrapper ul').append('<li data-sort="2" class="phone phone-1"><span class="icon"><i class="icon-phone"></i></span><p><a href="tel:'+val+'">'+val+'</a></p></li>');
        }
    }else{
        $content.find('.'+it+' .get_in_touch_wrapper ul li.phone.phone-1').remove();
    }
    
}).change(addHistory, enableBeforeUnload);

// contact box phone 2
$('.contact_box.telephone_2.'+releaser+' .preview-telephone_2input').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        if($content.find('.'+it+' .get_in_touch_wrapper ul li.phone.phone-2 p a').length){
            $content.find('.'+it+' .get_in_touch_wrapper ul li.phone.phone-2 p a').html(val);
        }else{
            $content.find('.'+it+' .get_in_touch_wrapper ul').append('<li data-sort="3" class="phone phone-2"><span class="icon"><i class="icon-phone"></i></span><p><a href="tel:'+val+'">'+val+'</a></p></li>');
        }
    }else{
        $content.find('.'+it+' .get_in_touch_wrapper ul li.phone.phone-2').remove();
    }
    
}).change(addHistory, enableBeforeUnload);

// contact box fax
$('.contact_box.fax.'+releaser+' .preview-faxinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        if($content.find('.'+it+' .get_in_touch_wrapper ul li.phone.fax p a').length){
            $content.find('.'+it+' .get_in_touch_wrapper ul li.phone.fax p a').html(val);
        }else{
            $content.find('.'+it+' .get_in_touch_wrapper ul').append('<li data-sort="4" class="phone fax"><span class="icon"><i class="icon-print"></i></span><p><a href="fax:'+val+'">'+val+'</a></p></li>');
        }
    }else{
        $content.find('.'+it+' .get_in_touch_wrapper ul li.phone.fax').remove();
    }
    
}).change(addHistory, enableBeforeUnload);

// contact box email
$('.contact_box.email.'+releaser+' .preview-emailinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        if($content.find('.'+it+' .get_in_touch_wrapper ul li.mail p a').length){
            $content.find('.'+it+' .get_in_touch_wrapper ul li.mail p a').html(val);
        }else{
            $content.find('.'+it+' .get_in_touch_wrapper ul').append('<li data-sort="5" class="mail"><span class="icon"><i class="icon-mail"></i></span><p><a href="mailto:'+val+'">'+val+'</a></p></li>');
        }
    }else{
        $content.find('.'+it+' .get_in_touch_wrapper ul li.mail').remove();
    }
    
}).change(addHistory, enableBeforeUnload);

// contact box www
$('.contact_box.www.'+releaser+' .preview-wwwinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        if($content.find('.'+it+' .get_in_touch_wrapper ul li.www p a').length){
            $content.find('.'+it+' .get_in_touch_wrapper ul li.www p a').html(val);
        }else{
            $content.find('.'+it+' .get_in_touch_wrapper ul').append('<li data-sort="6" class="www"><span class="icon"><i class="icon-link"></i></span><p><a target="_blank" href="https://'+val+'">'+val+'</a></p></li>');
        }
    }else{
        $content.find('.'+it+' .get_in_touch_wrapper ul li.www').remove();
    }
    
}).change(addHistory, enableBeforeUnload);

// blockquote content
$('.blockquote.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    $content.find('.'+it+' blockquote').html(val);
}).change(addHistory, enableBeforeUnload);

// our team links email fb twitter linkedin vcard
$('.our_team.email.'+releaser+' .preview-emailinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .desc_wrapper .links').length){
            if($content.find('.'+it+' .desc_wrapper .links a.mail').length){
                $content.find('.'+it+' .desc_wrapper .links a.mail').attr('href', val);
            }else{
                $content.find('.'+it+' .desc_wrapper .links').prepend('<a href="mailto:'+val+'" class="icon_bar icon_bar_small mail"><span class="t"><i class="icon-mail"></i></span><span class="b"><i class="icon-mail"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .desc_wrapper').append('<div class="links"><a href="mailto:'+val+'" class="icon_bar icon_bar_small mail"><span class="t"><i class="icon-mail"></i></span><span class="b"><i class="icon-mail"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .desc_wrapper .links a.mail').remove();
    }
}).change(addHistory, enableBeforeUnload);
$('.our_team.facebook.'+releaser+' .preview-facebookinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .desc_wrapper .links').length){
            if($content.find('.'+it+' .desc_wrapper .links a.facebook').length){
                $content.find('.'+it+' .desc_wrapper .links a.facebook').attr('href', val);
            }else{
                $content.find('.'+it+' .desc_wrapper .links').append('<a target="_blank" href="'+val+'" class="icon_bar icon_bar_small facebook"><span class="t"><i class="icon-facebook"></i></span><span class="b"><i class="icon-facebook"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .desc_wrapper').append('<div class="links"><a target="_blank" href="'+val+'" class="icon_bar icon_bar_small facebook"><span class="t"><i class="icon-facebook"></i></span><span class="b"><i class="icon-facebook"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .desc_wrapper .links a.facebook').remove();
    }
}).change(addHistory, enableBeforeUnload);
$('.our_team.twitter.'+releaser+' .preview-twitterinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .desc_wrapper .links').length){
            if($content.find('.'+it+' .desc_wrapper .links a.twitter').length){
                $content.find('.'+it+' .desc_wrapper .links a.twitter').attr('href', val);
            }else{
                $content.find('.'+it+' .desc_wrapper .links').append('<a target="_blank" href="'+val+'" class="icon_bar icon_bar_small twitter"><span class="t"><i class="icon-twitter"></i></span><span class="b"><i class="icon-twitter"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .desc_wrapper').append('<div class="links"><a target="_blank" href="'+val+'" class="icon_bar icon_bar_small twitter"><span class="t"><i class="icon-twitter"></i></span><span class="b"><i class="icon-twitter"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .desc_wrapper .links a.twitter').remove();
    }
}).change(addHistory, enableBeforeUnload);
$('.our_team.linkedin.'+releaser+' .preview-linkedininput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .desc_wrapper .links').length){
            if($content.find('.'+it+' .desc_wrapper .links a.linkedin').length){
                $content.find('.'+it+' .desc_wrapper .links a.linkedin').attr('href', val);
            }else{
                $content.find('.'+it+' .desc_wrapper .links').append('<a target="_blank" href="'+val+'" class="icon_bar icon_bar_small linkedin"><span class="t"><i class="icon-linkedin"></i></span><span class="b"><i class="icon-linkedin"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .desc_wrapper').append('<div class="links"><a target="_blank" href="'+val+'" class="icon_bar icon_bar_small linkedin"><span class="t"><i class="icon-linkedin"></i></span><span class="b"><i class="icon-linkedin"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .desc_wrapper .links a.linkedin').remove();
    }
}).change(addHistory, enableBeforeUnload);
$('.our_team.vcard.'+releaser+' .preview-vcardinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .desc_wrapper .links').length){
            if($content.find('.'+it+' .desc_wrapper .links a.vcard').length){
                $content.find('.'+it+' .desc_wrapper .links a.vcard').attr('href', val);
            }else{
                $content.find('.'+it+' .desc_wrapper .links').append('<a href="'+val+'" class="icon_bar icon_bar_small vcard"><span class="t"><i class="icon-vcard"></i></span><span class="b"><i class="icon-vcard"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .desc_wrapper').append('<div class="links"><a href="'+val+'" class="icon_bar icon_bar_small vcard"><span class="t"><i class="icon-vcard"></i></span><span class="b"><i class="icon-vcard"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .desc_wrapper .links a.vcard').remove();
    }
}).change(addHistory, enableBeforeUnload);



// our team list links email fb twitter linkedin vcard
$('.our_team_list.email.'+releaser+' .preview-emailinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .bq_wrapper .links').length){
            if($content.find('.'+it+' .bq_wrapper .links a.mail').length){
                $content.find('.'+it+' .bq_wrapper .links a.mail').attr('href', val);
            }else{
                $content.find('.'+it+' .bq_wrapper .links').prepend('<a href="mailto:'+val+'" class="icon_bar icon_bar_small mail"><span class="t"><i class="icon-mail"></i></span><span class="b"><i class="icon-mail"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .bq_wrapper').append('<div class="links"><a href="mailto:'+val+'" class="icon_bar icon_bar_small mail"><span class="t"><i class="icon-mail"></i></span><span class="b"><i class="icon-mail"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .bq_wrapper .links a.mail').remove();
    }
}).change(addHistory, enableBeforeUnload);
$('.our_team_list.facebook.'+releaser+' .preview-facebookinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .bq_wrapper .links').length){
            if($content.find('.'+it+' .bq_wrapper .links a.facebook').length){
                $content.find('.'+it+' .bq_wrapper .links a.facebook').attr('href', val);
            }else{
                $content.find('.'+it+' .bq_wrapper .links').append('<a target="_blank" href="'+val+'" class="icon_bar icon_bar_small facebook"><span class="t"><i class="icon-facebook"></i></span><span class="b"><i class="icon-facebook"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .bq_wrapper').append('<div class="links"><a target="_blank" href="'+val+'" class="icon_bar icon_bar_small facebook"><span class="t"><i class="icon-facebook"></i></span><span class="b"><i class="icon-facebook"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .bq_wrapper .links a.facebook').remove();
    }
}).change(addHistory, enableBeforeUnload);
$('.our_team_list.twitter.'+releaser+' .preview-twitterinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .bq_wrapper .links').length){
            if($content.find('.'+it+' .bq_wrapper .links a.twitter').length){
                $content.find('.'+it+' .bq_wrapper .links a.twitter').attr('href', val);
            }else{
                $content.find('.'+it+' .bq_wrapper .links').append('<a target="_blank" href="'+val+'" class="icon_bar icon_bar_small twitter"><span class="t"><i class="icon-twitter"></i></span><span class="b"><i class="icon-twitter"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .bq_wrapper').append('<div class="links"><a target="_blank" href="'+val+'" class="icon_bar icon_bar_small twitter"><span class="t"><i class="icon-twitter"></i></span><span class="b"><i class="icon-twitter"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .bq_wrapper .links a.twitter').remove();
    }
}).change(addHistory, enableBeforeUnload);
$('.our_team_list.linkedin.'+releaser+' .preview-linkedininput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .bq_wrapper .links').length){
            if($content.find('.'+it+' .bq_wrapper .links a.linkedin').length){
                $content.find('.'+it+' .bq_wrapper .links a.linkedin').attr('href', val);
            }else{
                $content.find('.'+it+' .bq_wrapper .links').append('<a target="_blank" href="'+val+'" class="icon_bar icon_bar_small linkedin"><span class="t"><i class="icon-linkedin"></i></span><span class="b"><i class="icon-linkedin"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .bq_wrapper').append('<div class="links"><a target="_blank" href="'+val+'" class="icon_bar icon_bar_small linkedin"><span class="t"><i class="icon-linkedin"></i></span><span class="b"><i class="icon-linkedin"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .bq_wrapper .links a.linkedin').remove();
    }
}).change(addHistory, enableBeforeUnload);
$('.our_team_list.vcard.'+releaser+' .preview-vcardinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        if($content.find('.'+it+' .bq_wrapper .links').length){
            if($content.find('.'+it+' .bq_wrapper .links a.vcard').length){
                $content.find('.'+it+' .bq_wrapper .links a.vcard').attr('href', val);
            }else{
                $content.find('.'+it+' .bq_wrapper .links').append('<a href="'+val+'" class="icon_bar icon_bar_small vcard"><span class="t"><i class="icon-vcard"></i></span><span class="b"><i class="icon-vcard"></i></span></a>');
            }
        }else{
            $content.find('.'+it+' .bq_wrapper').append('<div class="links"><a href="'+val+'" class="icon_bar icon_bar_small vcard"><span class="t"><i class="icon-vcard"></i></span><span class="b"><i class="icon-vcard"></i></span></a></div>');
        }
    }else{
        $content.find('.'+it+' .bq_wrapper .links a.vcard').remove();
    }
}).change(addHistory, enableBeforeUnload);

// feature box content
$('.feature_box.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if( $content.find('.'+it+' .desc').length ){
        $content.find('.'+it+' .desc').html(val);
    }else{
        $content.find('.'+it+' .desc_wrapper').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// flat box content
$('.flat_box.content.'+releaser+' .preview-contentinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if( $content.find('.'+it+' .desc').length ){
        $content.find('.'+it+' .desc').html(val);
    }else{
        $content.find('.'+it+' .desc_wrapper').append('<div class="desc">'+val+'</div>');
    }
}).change(addHistory, enableBeforeUnload);

// blockquote author
$('.blockquote.author.'+releaser+' .preview-authorinput').on('keyup', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if($content.find('.'+it+' .author a').length){
        $content.find('.'+it+' .author a').html(val);
    }else{
        $content.find('.'+it+' .author span').html(val);
    }
}).change(addHistory, enableBeforeUnload);

$('.'+releaser+' .preview-sloganinput').keyup(function() {
    // slogan
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_article_box')){
        // article box
        if($content.find('.'+it+' .desc_wrapper p').length){
            $content.find('.'+it+' .desc_wrapper > p').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper').prepend('<p>'+val+'</p>');
        }
    }else if($content.find('.'+it).hasClass('column_trailer_box')){
        // trailer box
        if($content.find('.'+it+' .subtitle').length){
            $content.find('.'+it+' .subtitle').text(val);
        }else{
            $content.find('.'+it+' .desc').prepend('<div class="subtitle">'+val+'</div>');
        }
    }else if($content.find('.'+it).hasClass('column_fancy_heading')){
        // fancy heading
        if($content.find('.'+it+' .slogan').length){
            $content.find('.'+it+' .slogan').text(val);
        }else{
            $content.find('.'+it+' .fh-top').html('<div class="slogan">'+val+'</div>');
        }
    }
}).change(addHistory, enableBeforeUnload);


$('.'+releaser+' .preview-phoneinput').keyup(function() {
    // phone
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_our_team')){
        // our team
        if($content.find('.'+it+' .desc_wrapper p.phone a').length){
            $content.find('.'+it+' .desc_wrapper p.phone a').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper .hr_color').before('<p class="phone"><i class="icon-phone"></i> <a href="#">'+val+'</a></p>');
        }
    }else if($content.find('.'+it).hasClass('column_our_team_list')){
        // our team
        if($content.find('.'+it+' .desc_wrapper p.phone a').length){
            $content.find('.'+it+' .desc_wrapper p.phone a').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper .hr_color').before('<p class="phone"><i class="icon-phone"></i> <a href="#">'+val+'</a></p>');
        }
    }
}).change(addHistory, enableBeforeUnload);

$('.'+releaser+' .preview-subtitleinput').keyup(function() {
    // subtitle
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_our_team')){
        // our team
        if($content.find('.'+it+' .desc_wrapper p.subtitle').length){
            $content.find('.'+it+' .desc_wrapper p.subtitle').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper .hr_color').before('<p class="subtitle">'+val+'</p>');
        }
    }else if($content.find('.'+it).hasClass('column_our_team_list')){
        // our team
        if($content.find('.'+it+' .desc_wrapper p.subtitle').length){
            $content.find('.'+it+' .desc_wrapper p.subtitle').text(val);
        }else{
            $content.find('.'+it+' .desc_wrapper .hr_color').before('<p class="subtitle">'+val+'</p>');
        }
    }
}).change(addHistory, enableBeforeUnload);

$('.'+releaser+' .preview-linkinput').on('change', function() {
    // link
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    
    if($content.find('.'+it).hasClass('column_article_box')){
        // article box
        if(val != ''){
            if($content.find('.'+it+' .article_box a').length){
                $content.find('.'+it+' .article_box a').attr('href', val);
            }else{
                let ab_html = $content.find('.'+it+' .article_box').html();
                $content.find('.'+it+' .article_box').html('<a href="'+val+'">'+ab_html+'</a>');
            }
        }else{
            if($content.find('.'+it+' .article_box a').length){
                let ab_html = $content.find('.'+it+' .article_box a').html();
                $content.find('.'+it+' .article_box').html(ab_html);
            }
        }
    }else if($content.find('.'+it).hasClass('column_button')){
        // button link
        $content.find('.'+it+' .button').attr('href', val);
    }
    enableBeforeUnload();
    addHistory();
});


$('.'+releaser+' .preview-targetinput').on('change', function() {
    // link target
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_button')){
        // button target
        if(val == '0'){
            $content.find('.'+it+' .button').removeAttr('target').removeAttr('rel').removeAttr('data-type');
        }else if(val == '1'){
            $content.find('.'+it+' .button').removeAttr('rel').removeAttr('data-type').attr('target', '_blank');
        }else if(val == 'lightbox'){
            $content.find('.'+it+' .button').removeAttr('target').attr('rel', 'lightbox').attr('data-type', 'image');
        }
        
    }
    enableBeforeUnload();
    addHistory();
});

$('.'+releaser+' .preview-margininput').on('change', function() {
    // margin
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_image')){
        // image margin top
        changeInlineStyles(it+' .image_frame', 'margin-top', val+"px");
    }
});

$('.column.style.'+releaser+' .preview-styleinput')
.on('blur', function() {
    // inline styles column
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    let styles = val.split(';');

    $.each(styles, function( i, v ) {
      if(v.trim()){
        
        let st_expl = v.split(':');

        if(st_expl[0] && st_expl[1]){
            changeInlineStyles(it+' .column_attr', st_expl[0], st_expl[1]);
        }
      }
    });

}).on('focus', function() {
    // inline styles column
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    let styles = val.split(';');

    $.each(styles, function( i, v ) {
      if(v.trim()){
        
        let st_expl = v.split(':');

        if(st_expl[0] && st_expl[1]){
            changeInlineStyles(it+' .column_attr', st_expl[0], 'remove');
        }
      }
    });

});

$('.image.margin_bottom.'+releaser+' .preview-margin_bottominput').on('change', function() {
    // margin
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_image')){
        // image margin bottom
        changeInlineStyles(it+' .image_frame', 'margin-bottom', val+"px");
    }
});

$('.'+releaser+' .preview-stretchinput').on('change', function() {
    // stretch image
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_image')){
        // image stretch
        $content.find('.'+it+' .image_frame').removeClass('stretch-ultrawide stretch');
        if(val == 'ultrawide'){
            $content.find('.'+it+' .image_frame').addClass('stretch-ultrawide');
        }else if(val == "1"){
            $content.find('.'+it+' .image_frame').addClass('stretch');
        }
    }
    enableBeforeUnload();
    addHistory();
});


$('.'+releaser+' .preview-downloadinput').on('change', function() {
    // button download
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        $content.find('.'+it+' .button').attr('download', val);
    }else{
        $content.find('.'+it+' .button').removeAttr('download');
    }
    enableBeforeUnload();
    addHistory();
});

$('.'+releaser+' .preview-relinput').on('change', function() {
    // button rel
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        $content.find('.'+it+' .button').attr('rel', val);
    }else{
        $content.find('.'+it+' .button').removeAttr('rel');
    }
    enableBeforeUnload();
    addHistory();
});

$('.'+releaser+' .preview-onclickinput').on('change', function() {
    // button onclick
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if(val.length){
        $content.find('.'+it+' .button').attr('onclick', val);
    }else{
        $content.find('.'+it+' .button').removeAttr('onclick');
    }
    enableBeforeUnload();
    addHistory();
});

// segmented options

$('.'+releaser+' .segmented-options li a').on("click", function(e) {
    e.preventDefault();

    let $editbox = $(this).closest('.mfn-form-row');

    $('li', $editbox).removeClass('active');
    $('input', $editbox).prop('checked', false);
    $(this).siblings('input').prop('checked', true);
    $(this).closest('li').addClass('active');


    let it = $editbox.data('element');
    let group = $editbox.data('group');
    let val = $(this).siblings('input').val();

    if($editbox.hasClass('feature_list') || $editbox.hasClass('faq') || $editbox.hasClass('tabs') || $editbox.hasClass('accordion') || $editbox.hasClass('map') || $editbox.hasClass('pricing_item')){
        re_render_tabs(group);
        return;
    }

    if($editbox.hasClass('image_gallery') || $editbox.hasClass('divider') || $editbox.hasClass('slider') || $editbox.hasClass('testimonials_list') || $editbox.hasClass('testimonials') || $editbox.hasClass('shop_slider') || $editbox.hasClass('shop') || $editbox.hasClass('clients_slider') || $editbox.hasClass('clients') || $editbox.hasClass('blog_teaser') || $editbox.hasClass('blog_news') || $editbox.hasClass('portfolio_slider') || $editbox.hasClass('blog') || $editbox.hasClass('offer_thumb') || $editbox.hasClass('portfolio_photo') || $editbox.hasClass('portfolio_grid') || $editbox.hasClass('portfolio') || $editbox.hasClass('blog_slider')){
        re_render(group);
        return;
    }

    // text column align
    if($editbox.hasClass('column align')){
        $content.find('.'+it+' > div').removeClass('align_center align_left align_right align_justify');
        if(val){
            $content.find('.'+it+' > div').addClass('align_'+val);
        }
    }

    // quick fact align
    if($editbox.hasClass('quick_fact align')){
        $content.find('.'+it+' .quick_fact').removeClass('align_center align_left align_right').addClass('align_'+val);
    }

    // photo box greyscale
    if($editbox.hasClass('photo_box greyscale')){
        if(val == 0){
            $content.find('.'+it+' .photo_box').removeClass('greyscale');
        }else{
            $content.find('.'+it+' .photo_box').addClass('greyscale');
        }
    }

    // our team style
    if($editbox.hasClass('our_team') && $editbox.hasClass('style')){
        $content.find('.'+it+' .team').removeClass('team_circle team_vertical team_horizontal').addClass('team_'+val);
    }

    // offer thumb align
    if($editbox.hasClass('offer_thumb align')){
        $content.find('.'+it+' .desc_wrapper').removeClass('align_center align_left align_right align_justify').addClass('align_'+val);
    }

    // promo box image position
    if($editbox.hasClass('promo_box position')){
        $content.find('.'+it+' .promo_box_wrapper').removeClass('promo_box_right promo_box_left').addClass('promo_box_'+val);
    }

    // button icon position
    if($editbox.hasClass('widget-button icon_position')){
        $content.find('.'+it+' .button').removeClass('button_right button_left').addClass('button_'+val);
    }

    // counter type
    if($editbox.hasClass('counter') && $editbox.hasClass('type')){
        $content.find('.'+it+' .counter').removeClass('counter_horizontal counter_vertical').addClass('counter_'+val);
    }

    // promo box border
    if($editbox.hasClass('promo_box border')){
        if(val == 0){
            $content.find('.'+it+' .promo_box').removeClass('has_border').addClass('no_border');
        }else{
            $content.find('.'+it+' .promo_box').addClass('has_border').removeClass('no_border');
        }
    }

    // image border
    if($editbox.hasClass('image border')){
        if(val == 0){
            $content.find('.'+it+' .image_frame').removeClass('has_border').addClass('no_border');
        }else{
            $content.find('.'+it+' .image_frame').addClass('has_border').removeClass('no_border');
        }
    }

    // image align
    if($editbox.hasClass('image align')){
            $content.find('.'+it+' .image_frame').removeClass('alignleft alignright aligncenter');
        if(val){
            $content.find('.'+it+' .image_frame').addClass('align'+val);
        }
    }

    // trailer box orientation
    if($editbox.hasClass('trailer_box orientation')){
        $content.find('.'+it+' .trailer_box').removeClass('horizontal');
        if(val){
            $content.find('.'+it+' .trailer_box').addClass(val);
        }
    }

    // story box style
    if($editbox.hasClass('story_box') && $editbox.hasClass('style')){
        $content.find('.'+it+' .story_box').removeClass('vertical');
        if(val){
            $content.find('.'+it+' .story_box').addClass('vertical');
        }
    }

    // photo box align
    if($editbox.hasClass('photo_box align')){
        $content.find('.'+it+' .photo_box').removeClass('pb_center pb_left pb_right pb_justify').addClass('pb_'+val);
    }

    // list style
    if($editbox.hasClass('list') && $editbox.hasClass('style')){
        $content.find('.'+it+' .list_item').removeClass('lists_1 lists_2 lists_3 lists_4').addClass('lists_'+val);
    }

    // icon box icon position
    if($editbox.hasClass('icon_box icon_position')){
        $content.find('.'+it+' .icon_box').removeClass('icon_position_left');
        if(val == 'left'){
            $content.find('.'+it+' .icon_box').addClass('icon_position_left');
        }
    }

    // blog teaser margin
    if($editbox.hasClass('blog_teaser margin')){
        $content.find('.'+it+' .blog-teaser').removeClass('margin-no');
        if(val == 0){
            $content.find('.'+it+' .blog-teaser').addClass('margin-no');
        }
    }

    // button align
    if($editbox.hasClass('widget-button align')){
        if($content.find('.'+it+' .button_align').length){
            $content.find('.'+it+' .button_align').removeClass('align_center align_right').addClass('align_'+val);
        }else{
            $content.find('.'+it+' .button').wrap('<div class="button_align align_'+val+'" />');
        }
    }

    // how it works border
    if($editbox.hasClass('how_it_works border')){
        if(val == 1){
            $content.find('.'+it+' .how_it_works').addClass('has_border').removeClass('no_border');
        }else{
            $content.find('.'+it+' .how_it_works').removeClass('has_border').addClass('no_border');
        }
    }

    // hover color align
    if($editbox.hasClass('hover_color align')){
        $content.find('.'+it+' .hover_color').removeClass('align_center align_left align_right align_justify');
        $content.find('.'+it+' .hover_color').addClass('align_'+val);
    }
    

    // button full width fullwidth
    if($editbox.hasClass('widget-button full_width')){
        $content.find('.'+it+' .button').removeClass('button_full_width');
        if(val == 1){
            $content.find('.'+it+' .button').addClass('button_full_width');
        }
    }

    // button size
    if($editbox.hasClass('widget-button') && $editbox.hasClass('size')){
        $content.find('.'+it+' .button').removeClass('button_size_1 button_size_2 button_size_3 button_size_4');
        $content.find('.'+it+' .button').addClass('button_size_'+val);
    }

    // blog more
    if($editbox.hasClass('blog more')){
        $content.find('.'+it+' .posts_group').removeClass('hide-more');
        if(val == 0){
            $content.find('.'+it+' .posts_group').addClass('hide-more');
        }
    }

    // blog more
    if($editbox.hasClass('blog margin')){
        $content.find('.'+it+' .posts_group').removeClass('margin');
        if(val == 1){
            $content.find('.'+it+' .posts_group').addClass('margin');
        }
    }

    // mobile column text align
    if($editbox.hasClass('column align-mobile')){
        $content.find('.'+it+' > div').removeClass('mobile_align_center mobile_align_left mobile_align_right mobile_align_justify');
        if(val){
            $content.find('.'+it+' > div').addClass('mobile_align_'+val);
        }
    }

    // fancy heading style
    if($editbox.hasClass('fancy_heading') && $editbox.hasClass('style')){

        $content.find('.'+it+' .fancy_heading').removeClass('fancy_heading_icon fancy_heading_line fancy_heading_arrows').addClass('fancy_heading_'+val);

        $content.find('.'+it+' h1 i').remove();
        $content.find('.'+it+' h2 i').remove();

        if(val == 'icon'){
            $content.find('.'+it+' .fh-top').html('<span class="icon_top"><i class="'+$('.'+$editbox.data('group')+' .preview-iconinput').val()+'"></i></span>');
        }else if(val == 'line'){
            $content.find('.'+it+' .fh-top').html('<span class="slogan">'+$('.'+$editbox.data('group')+' .preview-sloganinput').val()+'</span>');
        }else if(val == 'arrows'){
            $content.find('.'+it+' .fh-top').html('');
            $content.find('.'+it+' h1').prepend('<i class="icon-right-dir"></i>');
            $content.find('.'+it+' h1').append('<i class="icon-left-dir"></i>');
            $content.find('.'+it+' h2').prepend('<i class="icon-right-dir"></i>');
            $content.find('.'+it+' h2').append('<i class="icon-left-dir"></i>');
        }
    }

    // helper title tag
    if($editbox.hasClass('helper') && $editbox.hasClass('title_tag')){
        let helper_header = $content.find('.'+it+' .helper_header .title').text();
        $content.find('.'+it+' .helper_header .title').replaceWith('<'+val+' class="title">'+helper_header+'</'+val+'>');
    }

    // fancy heading title tag
    if($editbox.hasClass('fancy_heading') && $editbox.hasClass('h1')){
        let helper_header = $content.find('.'+it+' .title').text();
        if(val == 0){
            $content.find('.'+it+' .title').replaceWith('<h2 class="title">'+helper_header+'</h2>');
        }else{
            $content.find('.'+it+' .title').replaceWith('<h1 class="title">'+helper_header+'</h1>');
        }
    }

    // helper title tag
    if($editbox.hasClass('icon_box') && $editbox.hasClass('title_tag')){
        let helper_header = $content.find('.'+it+' .desc_wrapper .title').text();
        $content.find('.'+it+' .desc_wrapper .title').replaceWith('<'+val+' class="title">'+helper_header+'</'+val+'>');
    }

    // quick facts heading tag
    if($editbox.hasClass('quick_fact') && $editbox.hasClass('heading_tag')){
        let helper_header = $content.find('.'+it+' .quick_fact .heading_tag').text();
        $content.find('.'+it+' .quick_fact .heading_tag').replaceWith('<'+val+' class="title heading_tag">'+helper_header+'</'+val+'>');
    }

    // quick facts title tag
    if($editbox.hasClass('quick_fact') && $editbox.hasClass('title_tag')){
        let helper_header = $content.find('.'+it+' .quick_fact .title_tag').text();
        $content.find('.'+it+' .quick_fact .title_tag').replaceWith('<'+val+' class="title title_tag">'+helper_header+'</'+val+'>');
    }

    enableBeforeUnload();
    addHistory();

});

// color picker

$('.'+releaser+' .form-group.color-picker .form-control .mfn-form-control').on('change', function() {

    let $colorbox = $(this).closest('.mfn-form-row');
    let it = $colorbox.data('element');
    let edit_group = $colorbox.data('group');

    let val = $(this).val();

    colorChange($colorbox, edit_group, it, val);
});

$('.'+releaser+' .form-group.color-picker').each(function() {


    let $colorbox = $(this).closest('.mfn-form-row');
    
    if($colorbox.find('.wp-picker-holder').length){
        $(this).html('<div class="color-picker-group"><div class="form-addon-prepend"><a href="#" class="color-picker-open"><span class="label"style="background-color:'+$($colorbox).find('.mfn-form-control').val()+';border-color:'+$($colorbox).find('.mfn-form-control').val()+'"><i class="icon-bucket"></i></span></a></div><div class="form-control has-icon has-icon-right"><input class="mfn-form-control mfn-form-input" type="text" value="'+$($colorbox).find('.mfn-form-control').val()+'" name="'+$($colorbox).find('.mfn-form-control').attr('name')+'" autocomplete="off" /><a class="mfn-option-btn mfn-option-text color-picker-clear" href="#"><span class="text">Clear</span></a></div><input class="has-colorpicker" data-alpha="true" type="text" value="'+$($colorbox).find('.mfn-form-control').val()+'" autocomplete="off" /></div>');
    }


    let it = $colorbox.data('element');
    let edit_group = $colorbox.data('group');
    let $color_input = $(this).find('.has-colorpicker');

    $color_input.wpColorPicker({
        mode : 'hsl',
        width : 283,
        change : function(event, ui) {

            colorChange($colorbox, edit_group, it, ui.color.toString());

            $('.form-control .mfn-form-input', $colorbox).val(ui.color.toString());
            $('.form-addon-prepend .label', $colorbox).css({'background-color': ui.color.toString(), 'border-color': ui.color.toString()});
            $('.form-addon-prepend .label', $colorbox).removeClass('light dark').addClass(getContrastYIQ(ui.color.toString()));

 
            colorchange = true;

        },
        clear : function() {
            
            colorChange($colorbox, edit_group, it, 'transparent');

            $('.form-control .mfn-form-input', $colorbox).val('');
            $('.form-addon-prepend .label', $colorbox).removeAttr('style').removeClass('dark').addClass('light');
        }
    });

    $( '.color-picker-clear', $colorbox ).on('click', function(e){
        e.preventDefault();
        //$( 'input.has-colorpicker', $colorbox).wpColorPicker( 'color', '#fff' );
        $( '.mfn-form-input', $colorbox).val('');
        $('.form-addon-prepend .label', $colorbox).removeAttr('style').removeClass('dark').addClass('light');
        
        colorChange($colorbox, edit_group, it, 'transparent');

    });

});


// bg position

$('.'+releaser+' .preview-bg_positioninput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val().split(';');
    val[0].length ? changeInlineStyles(it, 'background-repeat', val[0]) : null;
    val[1].length ? changeInlineStyles(it, 'background-position', val[1]) : null;
    val[2].length ? changeInlineStyles(it, 'background-attachment', val[2]) : null;
    val[3].length ? changeInlineStyles(it, 'background-size', val[3]) : null;
});

// divider height

$('.divider.'+releaser+' .preview-heightinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it+' hr').length){
        it = it+' hr';
    }else if($content.find('.'+it+' .hr_dots').length){
        it = it+' .hr_dots';
    }
    changeInlineStyles(it, 'margin', '0 auto '+val+'px auto');
});

// move up

$('.'+releaser+' .preview-move_upinput').change(function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    changeInlineStyles(it, 'margin-top', '-'+val+'px');
});

// padding

$('.'+releaser+' .preview-paddinginput').on('change', function() {
    let $editbox = $(this).closest('.mfn-form-row');
    let it = $editbox.data('element');
    let val = $(this).val();
    if($editbox.hasClass('hover_color padding')){
        let tmp_it = it+' .hover_color_wrapper';
        changeInlineStyles(tmp_it, 'padding', val);
    }else{
        changeInlineStyles(it, 'padding', val);
    }
    runSorting();
});

// border width

$('.'+releaser+' .preview-border_widthinput').on('change', function() {
    let $editbox = $(this).closest('.mfn-form-row');
    let it = $editbox.data('element');
    let val = $(this).val();

    if($editbox.hasClass('hover_color border_width')){
        let tmp_it = it+' .hover_color_bg';
        changeInlineStyles(tmp_it, 'border-width', val);
    }else{
        changeInlineStyles(it, 'border-width', val);
    }

});
// padding horizontal

$('.'+releaser+' .preview-padding_horizontalinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    changeInlineStyles(it, 'padding-left', val);
    changeInlineStyles(it, 'padding-right', val);
});

// background-size
$('.'+releaser+' .preview-bg_sizeinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    changeInlineStyles(it, 'background-size', val);
});

// padding-top
$('.'+releaser+'.mfn-type-section .preview-padding_topinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    changeInlineStyles(it, 'padding-top', val+"px");
    runSorting();
});

// padding-bottom

$('.'+releaser+'.mfn-type-section .preview-padding_bottominput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    changeInlineStyles(it, 'padding-bottom', val+"px");
    runSorting();
});

// align text select

$('.'+releaser+' .preview-aligninput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();

    if($content.find('.'+it).hasClass('column_offer')){
        // offer
        $content.find('.'+it+' .desc_wrapper').removeClass('align_center align_left align_right align_justify').addClass('align_'+val);
    }
    enableBeforeUnload();
    addHistory();
});

// animation

$('.'+releaser+' .preview-animateinput').on('change', function(){
    let it = $(this).closest('.mfn-form-row').data('element');
    let $edited_box = $content.find('.'+it);
    let val = $(this).val();
    
    if($edited_box.find('.animate').length){
        $edited_box.find('.animate').removeAttr('class').addClass('animate '+val);
    }else{
        $content.find('.'+it+' > :last-child').wrap('<div class="animate '+val+'"></div>');
    }

});

// vertical align

$('.'+releaser+' .preview-vertical_aligninput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    $content.find('.'+it).removeClass('valign-top valign-middle valign-bottom');
    let val = $(this).val();
    if(val != ''){ $content.find('.'+it).addClass('valign-'+val); }
    enableBeforeUnload();
    addHistory();
});

// wrap margin bottom

$('.'+releaser+' .preview-column_margininput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    $content.find('.'+it).removeClass('column-margin-10px column-margin-20px column-margin-30px column-margin-40px column-margin-50px');
    let val = $(this).val();
    if(val != ''){ $content.find('.'+it).addClass('column-margin-'+val); }

    runSorting();
    enableBeforeUnload();
    addHistory();
});

// column margin bottom

$('.'+releaser+' .preview-margin_bottominput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    $content.find('.'+it).removeClass('column-margin-10px column-margin-20px column-margin-30px column-margin-40px column-margin-50px');
    let val = $(this).val();
    if(val != ''){ $content.find('.'+it).addClass('column-margin-'+val); }

    runSorting();
    enableBeforeUnload();
    addHistory();
});

// style how it works

$('.how_it_works.style.'+releaser+' .preview-styleinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    $content.find('.'+it+' .how_it_works').removeClass('fill');
    let val = $(this).val();
    if(val != ''){ $content.find('.'+it+' .how_it_works').addClass('fill'); }
    enableBeforeUnload();
    addHistory();
});

// mobile visibility

$('.'+releaser+' .preview-visibilityinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    $content.find('.'+it).removeClass('hide-desktop hide-tablet hide-mobile');
    let val = $(this).val();
    if(val != ''){ $content.find('.'+it).addClass(val); }
    enableBeforeUnload();
    addHistory();
});

// navi input

$('.'+releaser+' .preview-navigationinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val != ''){
        $content.find('.'+it).append('<div class="section-nav prev"><i class="icon-up-open-big"></i></div><div class="section-nav next"><i class="icon-down-open-big"></i></div>');
        $content.find('.'+it).addClass('has-navi');
    }else{
        $content.find('.'+it+' .section-nav').remove();
        $content.find('.'+it).removeClass('has-navi');
    }
    enableBeforeUnload();
    addHistory();
});

// decoration svgs

$('.'+releaser+' .preview-dividerinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if($content.find('.'+it+' .section-divider').length){
        $content.find('.'+it+' .section-divider').removeClass('circle up square triangle triple-triangle down').addClass(val);
    }else if(val != ''){
        $content.find('.'+it).append('<div class="section-divider '+val+'"></div>');
    }
    enableBeforeUnload();
    addHistory();
});

// custom ID

$('.'+releaser+'.mfn-type-section .preview-section_idinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        $content.find('.'+it).attr('id', val);
    }else{
        $content.find('.'+it).removeAttr('id');
    }
    enableBeforeUnload();
    addHistory();
});

// widget custom ID

$('.'+releaser+'.mfn-type-section .preview-uidinput').on('change', function() {
    let it = $(this).closest('.mfn-form-row').data('element');
    let val = $(this).val();
    if(val.length){
        $content.find('.'+it).attr('id', val);
    }else{
        $content.find('.'+it).removeAttr('id');
    }
    enableBeforeUnload();
    addHistory();
});

// pseudo checkbox

$('.mfn-ui .mfn-form .mfn-type-section.style.'+releaser+' li').on('click', function() {

    let $editbox = $(this).closest('.mfn-form-row');

    let windowH = $(window).height() || 0;


    let it = $editbox.data('element');

    let val = $(this).children('input').val();

    if($(this).hasClass('active')){
        $(this).find('input').prop('checked', false);
        $(this).removeClass('active');
        $content.find('.'+it).removeClass(val);

        if(val == 'full-screen'){
            $content.find('.'+it).css({'min-height': '50px'});
            $content.find('.'+it+' .section_wrapper').css({'padding-top': 0, 'padding-bottom': 0});
        }

    }else{
        $(this).addClass('active');
        $(this).find('input').prop('checked', true);
        $content.find('.'+it).addClass(val);

        if(val == 'full-screen'){
            $content.find('.'+it).css({ 'min-height': windowH });
            let padding = (windowH - $content.find('.'+it+' .section_wrapper').height()) / 2;
            $content.find('.'+it+' .section_wrapper').css({'padding-top': padding + 10, 'padding-bottom': padding - 10});
        }
    }

    

    var value = '';

    $('li input:checked', $editbox).each(function() {
        if($(this).val() == 'full-screen'){  }
            value = value + ' ' + $(this).val();
        
    });

    $('.value', $editbox).val(value);

    enableBeforeUnload();
    addHistory();
});

// tabs 

$('.mfn-ui .mfn-form .tabs.'+releaser).each(function() {
    // add

    let group = $(this).closest('.mfn-form-row').data('group');
    $(this).on('click', '.mfn-button-add', function(e) {
        e.preventDefault();
        var $form = $(this).closest('.form-group'),
        $clone = $('li.default', $form).clone(true);
        $('.tabs-wrapper', $form).append( $clone );
        $clone.find('input, textarea').each(function(){
            $(this).attr('name', $(this).data('default') ).removeAttr('data-default');
        });
        $clone.siblings().removeClass('show');
        $clone.removeClass('default').addClass('show')
        .hide().fadeIn(200);
        reorder_tabs()
    });

    $(this).find('ul.tabs-wrapper li input, ul.tabs-wrapper li textarea').on('blur', function() {
        re_render_tabs(group);
    });
    // delete
    $(this).on('click', '.mfn-tab-delete', function(e) {
      e.preventDefault();
      $(this).closest('.tab').fadeOut( 200, function() {
        $(this).remove();
        reorder_tabs()
        setTimeout(re_render_tabs(group), 1000);
      });
    });

    // clone

    $(this).on('click', '.mfn-tab-clone', function(e) {
      e.preventDefault();
      var $tab = $(this).closest('.tab'),
        $clone = $tab.clone(true);
      $tab.removeClass('show').after( $clone );
      $clone.hide().fadeIn(200);
      reorder_tabs()
      setTimeout(re_render_tabs(group), 1000);
    });

    // toggle

    $(this).on('click', '.mfn-tab-toggle', function(e) {
      e.preventDefault();
      var $tab = $(this).closest('.tab');
      $('input', $tab).trigger('change');
      $tab.toggleClass('show')
        .siblings().removeClass('show');
    });

    // move title to header

    $(this).on('change', '.js-title', function(e) {
        e.preventDefault();
        var $tab = $(this).closest('.tab');
        var val = $(this).val();
        $('.tab-header .title', $tab).text(val);
    });

    // sort

    $(this).find('.tabs-wrapper').sortable({
    axis: 'y',
    cursor: 'ns-resize',
    handle: '.tab-header',
    opacity: 0.9,
    update: function(e, ui) {
        reorder_tabs();
        setTimeout(re_render_tabs(group), 1000);
    }
    });
});


// re render map

$('.map.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render_tabs(re_group);
});

// re render pricing item

$('.pricing_item.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render_tabs(re_group);
});

// re render map basic

$('.map_basic.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render image

$('.image.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});
// re render map basic

$('.video.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');

    re_render(re_group);
});

// re render blog slider

$('.blog_slider.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render portfolio

$('.portfolio.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render fancy divider

$('.fancy_divider.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render portfolio grid

$('.portfolio_grid.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render portfolio photo

$('.portfolio_photo.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render offer thumb

$('.offer_thumb.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render offer

$('.offer.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render blog

$('.blog.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render portfolio slider

$('.portfolio_slider.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render blog news

$('.blog_news.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render blog teaser

$('.blog_teaser.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

$('.video.mp4.'+releaser+' .preview-mp4input').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});


// re render clients

$('.clients.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render clients slider

$('.clients_slider.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render clients slider

$('.countdown.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});



// re render gallery

$('.image_gallery.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render shop

$('.shop.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render shop slider

$('.shop_slider.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render testimonials

$('.testimonials.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render testimonials list

$('.testimonials_list.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render slider

$('.slider.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});

// re render divider

$('.divider.re_render.'+releaser+' .mfn-form-control').on('change', function(){
    let re_group = $(this).closest('.mfn-form-row').data('group');
    re_render(re_group);
});



 // end run edit

}


















































// global functions 

// import element 

function importFromClipboard(u, w){

    let count = $content.find('.mcb-section').length;

    if( !$content.find('.vb-item[data-uid="' +u+ '"] .mfn-section-import').hasClass('pending') ){
        $content.find('.vb-item[data-uid="' +u+ '"] .mfn-section-import').addClass('pending');
        $.ajax({
            url: ajaxurl,
            data: {
                action: 'importfromclipboard',
                'mfn-builder-nonce': wpnonce,
                import: mfnbuilder.clipboard,
                id: pageid,
                release: 'releaser-'+releaser,
                count: count
            },
            type: 'POST',
            success: function(response){
                
                if( w == 'after' ){
                    $content.find('.vb-item[data-uid="' +u+ '"]').after(response.html);
                }else{
                    $content.find('.vb-item[data-uid="' +u+ '"]').before(response.html);
                }

                $content.find('.vb-item[data-uid="' +u+ '"] .mfn-section-import').removeClass('pending');

                $('#mfn-vb-form').append(response.form);

                reSortSections();
                enableBeforeUnload();
                addHistory();
                blink();
                
            }
        });

    }
}

// export element

function elementToClipboard(u){
    var tmp_form = document.createElement("FORM");

    if( !$content.find('.vb-item[data-uid="' +u+ '"] .mfn-section-export').hasClass('pending') ){
    
        $('.mfn-ui .mfn-form .mfn-vb-formrow.mfn-vb-'+u).each(function() {
            $(this).clone().appendTo(tmp_form);
        });

        $content.find('.vb-item[data-uid="' +u+ '"] .mfn-section-export').addClass('pending');

        $content.find('.vb-item[data-uid="' +u+ '"] .vb-item').each(function() {
            var child_uid = $(this).attr('data-uid');

            $('.mfn-ui .mfn-form .mfn-vb-formrow.mfn-vb-'+child_uid).each(function() {
                $(this).clone().appendTo(tmp_form);
            });
        });

        let formData = new FormData(tmp_form);
        formData.append('action', 'mfntoclipboard');
        formData.append('mfn-builder-nonce', wpnonce);

        $.ajax({
            url: ajaxurl,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(response){

                var btnText = $content.find('.vb-item[data-uid="' +u+ '"] .mfn-section-export').text();

                $content.find('.vb-item[data-uid="' +u+ '"] .mfn-section-export').html('<span class="mfn-icon mfn-icon-check-blue"></span> Exported');

                setTimeout(function(){
                  $content.find('.vb-item[data-uid="' +u+ '"] .mfn-section-export').html('<span class="mfn-icon mfn-icon-export"></span> Export section');


                  $content.find('.vb-item[data-uid="' +u+ '"] .mfn-section-export').removeClass('pending');

                }, 1000);

                $content.find('.section-header .mfn-disabled').removeClass('mfn-disabled');

                localStorage.setItem( 'mfn-builder', JSON.stringify({
                  clipboard: response
                }) );

                mfnbuilder.clipboard = response;

                delete tmp_form;
                
            }
        });

    }
}

// export/import - import submit

$('.mfn-import-button').on('click', function(e) {
    e.preventDefault();


    if(!$('.mfn-import-button').hasClass('loading')){

        if($('.mfn-import-field').val().length){

            $('.mfn-import-button').addClass('loading disabled');

            $.ajax({
                url: ajaxurl,
                data: {
                    action: 'importdata',
                    'mfn-builder-nonce': wpnonce,
                    type: $('.panel-export-import-import .mfn-import-type').val(),
                    import: $('.mfn-import-field').val(),
                    pageid: $('.mfn-import-button').data('id')
                },
                type: 'POST',
                success: function(response){
                    $('.mfn-import-button').removeClass('loading disabled');
                    enableBeforeUnload();
                    addHistory();
                    location.reload();
                }
            });

        }else{
            alert('Import input cannot be empty');
        }

    }else{
        alert('Loading. Please wait');
    }
    
});

// export/import - import single page

$('.mfn-import-single-page-button').on('click', function(e) {
    e.preventDefault();

    var import_place = $('.panel-export-import-single-page .mfn-import-type').val();

    if(!$('.mfn-import-single-page-button').hasClass('loading')){

        if($('#mfn-items-import-page').val().length){

            $('.mfn-import-single-page-button').addClass('loading disabled');

            $.ajax({
                url: ajaxurl,
                data: {
                    action: 'importsinglepage',
                    'mfn-builder-nonce': wpnonce,
                    import: $('#mfn-items-import-page').val(),
                    pageid: $('.mfn-import-single-page-button').data('id'),
                    release: 'releaser-'+releaser,
                    count: 0
                },
                type: 'POST',
                success: function(response){
                    $('.mfn-import-single-page-button').removeClass('loading disabled');

                    if(import_place == 'before'){
                        $content.find('.mfn-builder-content').prepend(response.html);
                    }else if(import_place == 'after'){
                        $content.find('.mfn-builder-content').append(response.html);
                    }else{
                        $('#mfn-vb-form > div').remove();
                        $content.find('.mfn-builder-content').html(response.html);
                    }

                    $('#mfn-items-import-page').val('');

                    $('#mfn-vb-form').append(response.form);

                    reSortSections();
                    enableBeforeUnload();
                    addHistory();
                    blink();

                    //location.reload();
                }
            });

        }else{
            alert('Import input cannot be empty');
        }

    }else{
        alert('Loading. Please wait');
    }
    
});

$('.mfn-import-template-button').on('click', function(e) {
    e.preventDefault();

    if(!$('.mfn-import-template-button').hasClass('loading')){

        if($('.mfn-items-import-template li.active').length){

            $('.mfn-import-template-button').addClass('loading disabled');

            $.ajax({
                url: ajaxurl,
                data: {
                    action: 'importtemplate',
                    'mfn-builder-nonce': wpnonce,
                    type: $('.mfn-import-template-type').val(),
                    import: $('.mfn-items-import-template li.active').data('id'),
                    pageid: $('.mfn-import-template-button').data('id')
                },
                type: 'POST',
                success: function(response){
                    $('.mfn-import-template-button').removeClass('loading disabled');

                    enableBeforeUnload();
                    addHistory();

                    location.reload();
                }
            });

        }else{
            alert('Choose template first');
        }

    }else{
        alert('Loading. Please wait');
    }
    
});

// preview

$('.mfn-preview-generate').on('click', function(e) {
    e.preventDefault();

    var $el = $(this), 
    tooltip = $el.data('tooltip'),
    previewURL = $el.attr('data-href');

    if(!$el.hasClass('pending')){

        $el.attr('data-tooltip', 'Generating preview...');
        $el.addClass('pending');

        let mfnVbForm = document.getElementById('mfn-vb-form');
        let formData = new FormData(mfnVbForm);
        formData.append('action', 'generatepreview');
        formData.append('gtype', 'mfn-builder-preview');

        $.ajax({
            url: ajaxurl,
            'mfn-builder-nonce': wpnonce,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(response){

                $el.attr('data-tooltip', tooltip);

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

                $el.removeClass('pending');
                
            }
        });

    }

    

});

// take post editing

$('.take-post-editing').on('click', function(e) {
    e.preventDefault();
    $el = $(this);

    if(!$el.hasClass('loading')){

        $el.addClass('loading disabled');

        $.ajax({
            url: ajaxurl,
            data: {
                action: 'takepostediting',
                'mfn-builder-nonce': wpnonce,
                pageid: $('.mfn-import-template-button').data('id')
            },
            type: 'POST',
            success: function(response){
                $('.mfn-modal-locker').remove();
            }
        });

    }
});

// prebuilts

$('.mfn-insert-prebuilt').on('click', function(e) {
    e.preventDefault();

    $el = $(this);

    if(!$el.hasClass('loading')){

        let id = $el.closest('li').data('id');
        let count = $content.find('.mcb-section').length;

        $el.addClass('loading disabled');

        $.ajax({
            url: ajaxurl,
            data: {
                'mfn-builder-nonce': wpnonce,
                action: 'insertprebuilt',
                id: id,
                release: 'releaser-'+releaser,
                count: count
            },
            type: 'POST',
            success: function(response){

                $el.removeClass('loading').find('.text').text('Done');

                if( !$content.find('.mcb-section-'+prebuiltType).length || prebuiltType == 'end' ){
                    $content.find('.mfn-builder-content').append(response.html);
                }else{
                    $content.find('.mcb-section-'+prebuiltType).after(response.html);
                }

                if( $content.find('.mfn-builder-content .mfn-builder-content .mcb-section').length ){
                    $content.find('.mfn-builder-content .mfn-builder-content .mcb-section').unwrap();
                }
                

                $('#mfn-vb-form').append(response.form);


                if(prebuiltType != 'end'){

                    let newPreBuiltType = $content.find('.mcb-section-'+prebuiltType).next('.mcb-section').attr('data-uid');
                    
                    if($content.find('.mcb-section-'+prebuiltType).hasClass('empty')){
                        $content.find('.mcb-section-'+prebuiltType).remove();
                        $('.mfn-form .mfn-vb-'+prebuiltType).remove();
                    }
                    
                    prebuiltType = newPreBuiltType;

                }else{
                    prebuiltType = 'end';
                }


                setTimeout(function(){
                    $el.removeClass('disabled').find('.text').text('Insert');
                },1000);

                reSortSections();
                enableBeforeUnload();
                addHistory();
                blink();

                

            }
        });


    }else{
        alert('Loading. Please wait');
    }
    
});

// set revision
function setRevision(type) {

    $list = $('.panel ul.revisions-list[data-type="'+type+'"]');

    let mfnVbForm = document.getElementById('mfn-vb-form');
    let formData = new FormData(mfnVbForm);
    formData.append('action', 'setrevision');
    formData.append('revtype', type);

    $.ajax({
        url: ajaxurl,
        'mfn-builder-nonce': wpnonce,
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(response){
            displayRevisions(response, $list);

            if(type == 'autosave'){
                $('.btn-save-changes').removeClass('loading disabled');
            }else if(type == 'revision'){
                $('.mfn-save-revision').removeClass('loading disabled').find('.btn-wrapper').text('Saved');
                setTimeout(function() { $('.mfn-save-revision .btn-wrapper').text('Save revision'); }, 2000);
            }else if(type == 'mfn-builder-preview'){
                return true;
            }
        }
    });
}


// autosave

setInterval(autosave, 300000);

function autosave(){
    if(!$('.btn-save-changes').hasClass('disabled')){
        $('.btn-save-changes').addClass('loading disabled');
        setRevision('autosave');
    }
}

// manual save revision
$('.mfn-save-revision').on('click', function(e) {
    if(!$('.mfn-save-revision').hasClass('disabled')){
        $('.mfn-save-revision').addClass('loading disabled');
        setRevision('revision');
    }
});

// restore
$('.revision-restore').on('click', function(e) {
    e.preventDefault();
    restoreRev($(this));
});

function restoreRev($btn){
    if(!$btn.hasClass('disabled')){

        $btn.addClass('loading disabled');

        $list = $('.panel ul[data-type="backup"]');

        $el = $btn.closest('li');

        var time = $el.attr('data-time'),
          type = $el.closest('ul').attr('data-type'),
          btnText = $el.text(),
          revision;

        $.ajax({
            url: ajaxurl,
            data: {
                action: 'restorerevision',
                'mfn-builder-nonce': wpnonce,
                time: time,
                type: type,
                pageid: pageid
            },
            type: 'POST',
            success: function(response){
                $('#mfn-vb-form').empty();
                $content.find('.mfn-builder-content').empty();

                $('#mfn-vb-form').append(response.form+'<input type="hidden" name="pageid" value="'+pageid+'"><input type="hidden" name="mfn-builder-nonce" value="'+wpnonce+'">');

                $content.find('.mfn-builder-content').append(response.html);
                displayRevisions(response.revisions, $list);

                $btn.removeClass('loading disabled');

                reSortSections();
                enableBeforeUnload();
                addHistory();
                blink();
            }
        });

    }
}

function displayRevisions(rev, $list) {
    $list.empty();
    $.each(JSON.parse(rev), function(i, item) {
        $list.append('<li data-time="'+ i +'"><span class="revision-icon mfn-icon-clock"></span><div class="revision"><h6>'+ item +'</h6><a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a></div></li>');
    });

    $('.revision-restore').on('click', function(e) {
        e.preventDefault();
        restoreRev($(this));
    });
}


// paste element

function pasteElement($p){

    let d_sec_new = getUid();

    $.each( mfncopy.form, function( k, v ) {
        $('#mfn-vb-form').append( v.html );
        if($.isArray( v.val )){
            $('.tabs.update_val li.tab').each(function(i) {
                $(this).find('.mfn-form-control').each(function(j) {
                    $(this).val( v.val[i][j] );
                });
            });
        }else{
            $('#mfn-vb-form .update_val .mfn-form-control').val( v.val );
        }

        $('#mfn-vb-form .update_val .pill-initialized').removeClass('pill-initialized');
        
        $('#mfn-vb-form .update_val').removeClass('update_val');
    });
    
    if($p.hasClass('mcb-section') && mfncopy.type == 'wrap'){
        // wrap to section
        $p.find('.section_wrapper').append(mfncopy.html);
    }else if($p.hasClass('mcb-section') && mfncopy.type == 'column'){
        // column to section
        if($p.find('.mcb-wrap-inner').length){
            $p.find('.mcb-wrap-inner').last().append(mfncopy.html);
        }else{
            alert('Append wrap first.');
        }
    }else if($p.hasClass('mcb-wrap') && mfncopy.type == 'column'){
        // column to wrap
        $p.find('.mcb-wrap-inner').append(mfncopy.html);
    }else{
        $p.after(mfncopy.html);
    }

    $copied = $content.find('.copied_html');
    copied_uid = $copied.attr('data-uid');

    if($copied.hasClass('mcb-item-'+copied_uid)){
        // column
        $copied.removeClass('mcb-item-'+copied_uid).addClass('mcb-item-'+d_sec_new);
        updateFormRow(copied_uid, d_sec_new);

    }else if($copied.hasClass('mcb-wrap-'+copied_uid)){
        // wrap
        $copied.removeClass('mcb-wrap-'+copied_uid).addClass('mcb-wrap-'+d_sec_new);
        updateFormRow(copied_uid, d_sec_new);

        $copied.find('.vb-item').each(function() {

            let old_uid = $(this).attr('data-uid');
            let new_uid = getUid();

            $(this).removeClass('mcb-item-'+old_uid).addClass('mcb-item-'+new_uid).attr('data-uid', new_uid);
            updateFormRow(old_uid, new_uid);
        });
    }else if($copied.hasClass('mcb-section-'+copied_uid)){
        // section
        $copied.removeClass('mcb-section-'+copied_uid).addClass('mcb-section-'+d_sec_new);
        updateFormRow(copied_uid, d_sec_new);

        $copied.find('.vb-item').each(function() {

            let old_uid = $(this).attr('data-uid');
            let new_uid = getUid();

            updateFormRow(old_uid, new_uid);

            if($(this).hasClass('mcb-column')){
                $(this).removeClass('mcb-item-'+old_uid).addClass('mcb-item-'+new_uid).attr('data-uid', new_uid);
            }else{
                $(this).removeClass('mcb-wrap-'+old_uid).addClass('mcb-wrap-'+new_uid).attr('data-uid', new_uid);
            }
            
        });

    }

    $copied.attr('data-uid', d_sec_new);

    $copied.removeClass('copied_html');
    $('#mfn-vb-form .copied_form').removeClass('copied_form');

    blink();

    setTimeout(function() {
        reSortSections();

        checkEmptySections();
        checkEmptyWraps();

        runMedia('cloned_form_el'+releaser);
        runEdit('cloned_form_el'+releaser);

        mfnChart();

        enableBeforeUnload();

        $content.find('.vb-item[data-uid="'+d_sec_new+'"] .mfn-header .mfn-element-edit').trigger('click');

        // addHistory(); 

        releaser++;
    }, 50);
}

// update form row

function updateFormRow(uid, new_uid){

    $el = $('#mfn-vb-form .mfn-vb-'+uid+'.copied_form');

    if($el.length){
        
        $el.find('.uidinput').val(new_uid);

        $el.each(function() {

            if($(this).hasClass('mfn-type-item')){
                // column
                $(this).removeClass('mfn-vb-'+uid).addClass('cloned_form_el'+releaser+' mfn-vb-'+new_uid).attr('data-group', 'mfn-vb-'+new_uid).attr('data-element', 'mcb-item-'+new_uid);
            }else if($(this).hasClass('mfn-type-wrap')){
                $(this).removeClass('mfn-vb-'+uid).addClass('cloned_form_el'+releaser+' mfn-vb-'+new_uid).attr('data-group', 'mfn-vb-'+new_uid).attr('data-element', 'mcb-wrap-'+new_uid);
            }else{
                $(this).removeClass('mfn-vb-'+uid).addClass('cloned_form_el'+releaser+' mfn-vb-'+new_uid).attr('data-group', 'mfn-vb-'+new_uid).attr('data-element', 'mcb-section-'+new_uid);
            }

        })
    }
    
}

// copy to clipboard

function copyToClipboard(el){
    let $clipboard_copy = $content.find('.vb-item[data-uid="'+el+'"]');

    if($clipboard_copy.hasClass('mcb-section')){
        mfncopy.type = 'section';
    }else if($clipboard_copy.hasClass('mcb-wrap')){
        mfncopy.type = 'wrap';
    }else if($clipboard_copy.hasClass('mcb-column')){
        mfncopy.type = 'column';
    }

    mfncopy.html = $clipboard_copy.addClass('copied_html blink').wrap('<div />').parent().html();
    $clipboard_copy.removeClass('copied_html blink').unwrap();

    let form_copy_helper = [];

    $('.mfn-ui .mfn-form .mfn-vb-'+el).each(function() {

        if($(this).hasClass('tabs')){
            var tabs_helper = [];
            $(this).find('li.tab').each(function(i) {
                var tab_fields = [];
                $(this).find('.mfn-form-control').each(function(i) {
                    tab_fields.push($(this).val());
                });
                tabs_helper.push(tab_fields);
            });
            
            form_copy_helper.push({
                html: $(this).clone().addClass('copied_form update_val').wrap('<div />').parent().html(),
                val: tabs_helper
            });
        }else if($(this).hasClass('column content') || $(this).hasClass('blockquote content')){
            form_copy_helper.push({
                html: $(this).clone().addClass('copied_form update_val').wrap('<div />').parent().html(),
                val: $(this).find('.form-control .editor-content .mfn-form-control').val()
            });
        }else{

            form_copy_helper.push({
                html: $(this).clone().addClass('copied_form update_val').wrap('<div />').parent().html(),
                val: $(this).find('.mfn-form-control').val()
            });

        }
    });

    $clipboard_copy.find('.vb-item').each(function() {
        $('.mfn-ui .mfn-form .mfn-vb-'+$(this).attr('data-uid')).each(function() {
            if($(this).hasClass('tabs')){
                var tabs_helper = [];
                $(this).find('li.tab').each(function(i) {
                    var tab_fields = [];
                    $(this).find('.mfn-form-control').each(function(i) {
                        tab_fields.push($(this).val());
                    });
                    tabs_helper.push(tab_fields);
                });
                
                form_copy_helper.push({
                    html: $(this).clone().addClass('copied_form update_val').wrap('<div />').parent().html(),
                    val: tabs_helper
                });

                
            }else if($(this).hasClass('column content') || $(this).hasClass('blockquote content')){
                form_copy_helper.push({
                html: $(this).clone().addClass('copied_form update_val').wrap('<div />').parent().html(),
                val: $(this).find('.form-control .editor-content .mfn-form-control').val()
            });
            }else{
                form_copy_helper.push({
                    html: $(this).clone().addClass('copied_form update_val').wrap('<div />').parent().html(),
                    val: $(this).find('.mfn-form-control').val()
                });
            }
        });
    });

    mfncopy.form = form_copy_helper;
    localStorage.setItem('mfncopy', JSON.stringify(mfncopy));
}

// change styles function

function changeInlineStyles(u, s, v){
    let styles = [];
    if($content.find('.'+u).length){
        
        if(v == 'remove_style'){
            $content.find('.'+u).removeAttr('style');
        }else{
            let attrstyle = $content.find('.'+u).attr('style');

            if(typeof attrstyle !== typeof undefined && attrstyle !== false){
                styles = attrstyle.split(';');
            }

            let sid = styles.findIndex( st => st.includes(s));

            if(styles[sid]){
                if(v == 'remove'){
                    styles.splice(sid,1);
                }else{
                    styles[sid] = s+': '+v;
                }
                
            }else{
                styles.push(s+': '+v);
            }
            //styles[sid] ? styles[sid] = s+': '+v : styles.push(s+': '+v);
            
            let newstyles = styles.join(';');
            $content.find('.'+u).attr('style', newstyles);
        }

        if(s != 'color' && s != 'background-color'){
            enableBeforeUnload();
            addHistory();
        }
        
    }
}

// change color

function colorChange($colorbox, edit_group, it, val) {
    let style_type = 'background-color';

    if($colorbox.hasClass('widget-button color')){
        // button background
        it = it+' .button';
    }else if($colorbox.hasClass('widget-button font_color')){
        // button font color
        it = it+' .button span';
        style_type = 'color';
    }else if($colorbox.hasClass('column column_bg')){
        // column bg
        it = it+' .column_attr';
    }else if($colorbox.hasClass('column content')){
        // column txt
        it = it+' .column_attr';
    }else if($colorbox.hasClass('counter color')){
        // counter icon color
        it = it+' .icon_wrapper i';
        style_type = 'color';
    }else if($colorbox.hasClass('feature_box background')){
        // feature box background
        it = it+' .feature_box_wrapper';
    }else if($colorbox.hasClass('flat_box background')){
        // flat box background
        it = it+' .themebg';
    }else if($colorbox.hasClass('hover_color background')){
        // hover color background
        it = it+' .hover_color_bg';
    }else if($colorbox.hasClass('hover_color background_hover')){
        // hover color background
        it = it+' .hover_color';
    }else if($colorbox.hasClass('hover_color border')){
        // hover color border
        style_type = 'border-color';
        it = it+' .hover_color_bg';
    }else if($colorbox.hasClass('hover_color border_hover')){
        // hover color border
        style_type = 'border-color';
        it = it+' .hover_color';
    }else if($colorbox.hasClass('zoom_box bg_color')){
        // zoom box background
        it = it+' .desc';
    }

    if($colorbox.hasClass('divider color')){
       changeDividerColor(it, edit_group, val); 
    }else if($colorbox.hasClass('fancy_divider color_top')){
       changeFancyDividerColorTop(it, edit_group, val); 
    }else if($colorbox.hasClass('fancy_divider color_bottom')){
       changeFancyDividerColorBottom(it, edit_group, val); 
    }else if($colorbox.hasClass('widget-chart')){
        if(val == 'transparent'){
            changeColorChart(it, themecolor); 

            $('.mfn-form .widget-chart.color.mfn-fr-show .form-addon-prepend .label').css({'background-color': themecolor, 'border-color': themecolor});
            $('.mfn-form .widget-chart.color.mfn-fr-show .form-addon-prepend .label').removeClass('light dark').addClass(getContrastYIQ(themecolor));

        }else{
            changeColorChart(it, val);
        }

        mfnChart();

    }else if(!$colorbox.hasClass('content')){
        if(val == 'transparent'){
            changeInlineStyles(it, style_type, 'remove_style');
        }else{
            changeInlineStyles(it, style_type, val);
        }
    }

    //enableBeforeUnload();

}

// change divider color

function changeDividerColor(u, g, v){
    let can = $('.'+g+' .preview-themecolorinput').val();
    let style = $('.'+g+'.style input:checked').val();
    let line = $('.'+g+'.line input:checked').val();

    if(can == 0){
        if(style == 'dots'){
            changeInlineStyles(u+' .hr_dots span', 'background-color', v);
        }else if(style == 'zigzag'){
            changeInlineStyles(u+' .hr_zigzag i', 'color', v);
        }else{
            if(line == 'narrow'){
                changeInlineStyles(u+' .hr_narrow', 'background-color', v);
            }else if(line == 'wide'){
                changeInlineStyles(u+' .hr_wide hr', 'background-color', v);
            }else if(line == 'default'){
                changeInlineStyles(u+' hr', 'background-color', v);
            }else if(line == ''){
                changeInlineStyles(u+' .no_line', 'background-color', v);
            }
        }
    }else{
        return;
    }
} 

// change fancy divider color

function changeFancyDividerColorTop(u, g, v){
    let style = $('.'+g+'.style .preview-styleinput').val();

    if(style == 'circle up' || style == 'curve up' || style == 'triangle up'){
        changeInlineStyles(u+' svg', 'background', v);
    }else{
        changeInlineStyles(u+' svg path', 'fill', v);
        changeInlineStyles(u+' svg path', 'stroke', v);
    }
}
function changeFancyDividerColorBottom(u, g, v){
    let style = $('.'+g+'.style .preview-styleinput').val();

    if(style == 'circle down' || style == 'curve down' || style == 'triangle down'){
        changeInlineStyles(u+' svg', 'background', v);
    }else{
        changeInlineStyles(u+' svg path', 'fill', v);
        changeInlineStyles(u+' svg path', 'stroke', v);
    }
}

// video bg 

function setVideoBg(u, t, v){
    if(v != ''){
        if($content.find('.'+u+' .section_video video').length){
            if($content.find('.'+u+' .section_video video source[type="video/'+t+'"]').length){
                $content.find('.'+u+' .section_video video source[type="video/'+t+'"]').attr('src', v);
            }else{
                $content.find('.'+u+' .section_video video').append('<source type="video/'+t+'" src="'+v+'">');
            }
        }else{
            $content.find('.'+u).append('<div class="section_video"><div class="mask"></div><video poster autoplay="true" loop="true" muted="muted"><source type="video/'+t+'" src="'+v+'"></video></div>').addClass('has-video');
        }
    }else{
        if($content.find('.'+u+' .section_video video source[type="video/'+t+'"]').length){
            $content.find('.'+u+' .section_video video source[type="video/'+t+'"]').remove();
        }
        if(!$content.find('.'+u+' .section_video video source').length){
            $content.find('.'+u+' .section_video').remove();
            $content.find('.'+u).removeClass('has-video');
        }
    }
    enableBeforeUnload();
    addHistory();
}

// chart color

function changeColorChart(u, v){
    if(v != 'transparent'){
        $content.find('.'+u+' .chart').attr('data-bar-color', v);
    }else{
        $content.find('.'+u+' .chart').attr('data-bar-color', '#000');
    }
}

// image for widget

function imageForWidget(u, v, p){

    p ? p = p : '';

    if($content.find('.'+u).hasClass('column_article_box')){
        // article box
        $content.find('.'+u+' .article_box .photo_wrapper').html('<img class="scale-with-grid" src="'+v+'" alt="">');
    }else if($content.find('.'+u).hasClass('column_before_after')){
        // before after
        if(p == 'before'){
            $content.find('.'+u+' .twentytwenty-before').attr('src', v);
        }else if(p == 'after'){
            $content.find('.'+u+' .twentytwenty-after').attr('src', v);
        }
        $content.find('.before_after.twentytwenty-container').twentytwenty();
    }else if($content.find('.'+u).hasClass('column_counter')){
        // counter
        if( v ){
            $content.find('.'+u+' .icon_wrapper').html('<img class="scale-with-grid" src="'+v+'" alt="">');
        }else if( $('.mfn-form-row.mfn-fr-show .preview-iconinput').val() ){
            $content.find('.'+u+' .icon_wrapper').html('<i class="' +$('.mfn-form-row.mfn-fr-show .preview-iconinput').val()+ '"></i>');
        }
    }else if($content.find('.'+u).hasClass('column_feature_box')){
        // feature box
        $content.find('.'+u+' .photo_wrapper').html('<img class="scale-with-grid" src="'+v+'" alt="">');
    }else if($content.find('.'+u).hasClass('column_flat_box') && p == 'boximg'){
        // flat box
        $content.find('.'+u+' .photo_wrapper img').attr('src', v);
    }else if($content.find('.'+u).hasClass('column_flat_box') && p == 'iconimg'){
        // flat box icon
        if(v != ''){
            $content.find('.'+u+' .icon').html('<img class="scale-with-grid" src="'+v+'"  alt="">');
        }else{
            $content.find('.'+u+' .icon').html('');
        }
    }else if($content.find('.'+u).hasClass('column_hover_box') && p == 'mainimg'){
        // hover box
        $content.find('.'+u+' img.visible_photo').attr('src', v);
    }else if($content.find('.'+u).hasClass('column_hover_box') && p == 'hoverimg'){
        // hover box
        $content.find('.'+u+' img.hidden_photo').attr('src', v);
    }else if($content.find('.'+u).hasClass('column_how_it_works')){
        // how it works
        if(v){
            $content.find('.'+u+' .how_it_works').removeClass('no-img');
        }else{
            $content.find('.'+u+' .how_it_works').addClass('no-img');
        }
        
        if($content.find('.'+u+' .how_it_works .image img').length){
            $content.find('.'+u+' .how_it_works .image img').attr('src', v).removeAttr('width').removeAttr('height');;
        }else{
            $content.find('.'+u+' .how_it_works .image').append('<img src="'+v+'" class="scale-with-grid" alt="">');
        }
    }else if($content.find('.'+u).hasClass('column_icon_box')){
        // icon box
        if(v != ''){
            if($content.find('.'+u+' .icon_box .image_wrapper img').length){
                $content.find('.'+u+' .icon_box .image_wrapper img').attr('src', v);
            }else{
                if($content.find('.'+u+' .icon_box .icon_wrapper').length) { $content.find('.'+u+' .icon_box .icon_wrapper').remove(); }
                $content.find('.'+u+' .icon_box').prepend('<div class="image_wrapper"><img src="'+v+'" class="scale-with-grid" alt=""></div>');
            }
        }else if( $('.mfn-ui .mfn-form .mfn-fr-show .mfn-form-control.preview-iconinput').val().length ){
            $content.find('.'+u+' .icon_box .image_wrapper').remove();
            $content.find('.'+u+' .icon_box').prepend('<div class="icon_wrapper"><div class="icon"><i class="'+$('.mfn-ui .mfn-form .mfn-fr-show .mfn-form-control.preview-iconinput').val()+'"></i></div></div>');
        }else{
            if($content.find('.'+u+' .icon_box .icon_wrapper').length) { $content.find('.'+u+' .icon_box .icon_wrapper').remove(); }
            if($content.find('.'+u+' .icon_box .image_wrapper').length) { $content.find('.'+u+' .icon_box .image_wrapper').remove(); }
        }
    }else if($content.find('.'+u).hasClass('column_image')){
        // image
        $content.find('.'+u+' .image_wrapper img').attr('src', v).removeAttr('width').removeAttr('height');
    }else if($content.find('.'+u).hasClass('column_list')){
        // list
        $content.find('.'+u+' .list_left').removeClass('list_icon list_image').addClass('list_image').html('<img src="'+v+'" class="scale-with-grid" alt="">');
    }else if($content.find('.'+u).hasClass('column_photo_box')){
        // photo box
        $content.find('.'+u+' .image_wrapper img').attr('src', v).removeAttr('width').removeAttr('height');;
    }else if($content.find('.'+u).hasClass('column_promo_box')){
        // promo box
        $content.find('.'+u+' .photo_wrapper img').attr('src', v).removeAttr('width').removeAttr('height');;
    }else if($content.find('.'+u).hasClass('column_sliding_box')){
        // sliding box
        $content.find('.'+u+' .photo_wrapper img').attr('src', v).removeAttr('width').removeAttr('height');;
    }else if($content.find('.'+u).hasClass('column_story_box')){
        // sliding box
        $content.find('.'+u+' .photo_wrapper img').attr('src', v).removeAttr('width').removeAttr('height');;
    }else if($content.find('.'+u).hasClass('column_trailer_box')){
        // trailer box
        $content.find('.'+u+' .trailer_box img').attr('src', v).removeAttr('width').removeAttr('height');;
    }else if($content.find('.'+u).hasClass('column_zoom_box') && p == 'main'){
        // zoom box main
        $content.find('.'+u+' .photo img').attr('src', v).removeAttr('width').removeAttr('height');;
    }else if($content.find('.'+u).hasClass('column_zoom_box') && p == 'desc'){
        // zoom box desc
        if(v){
            if($content.find('.'+u+' .desc_wrap .desc_img img').length){
                $content.find('.'+u+' .desc_wrap .desc_img img').attr('src', v);
            }else{
                $content.find('.'+u+' .desc_wrap').prepend('<div class="desc_img"><img class="scale-with-grid" src="'+v+'" alt=""></div>');
            }
        }else{
            if($content.find('.'+u+' .desc_wrap .desc_img img').length){
                $content.find('.'+u+' .desc_wrap .desc_img').remove();
            }
        }
    }else if($content.find('.'+u).hasClass('mcb-section') && p == 'decortop'){
        // section decor top
        if(v != ''){
            if($content.find('.'+u+' .section-decoration.top').length){
                $content.find('.'+u+' .section-decoration.top').css({ 'background-image': v});
            }else{
                $content.find('.'+u).prepend('<div class="section-decoration top" style="background-image:url('+v+');"></div>');
            }
        }else{
            $content.find('.'+u+' .section-decoration.top').remove();
        }
    }else if($content.find('.'+u).hasClass('mcb-section') && p == 'decorbottom'){
        // section decor bottom
        if(v != ''){
            if($content.find('.'+u+' .section-decoration.bottom').length){
                $content.find('.'+u+' .section-decoration.bottom').css({ 'background-image': v});
            }else{
                $content.find('.'+u).append('<div class="section-decoration bottom" style="background-image:url('+v+');"></div>');
            }
        }else{
            $content.find('.'+u+' .section-decoration.bottom').remove();
        }
    }else if($content.find('.'+u).hasClass('column_our_team')){
        // our team
        $content.find('.'+u+' .image_wrapper img').attr('src', v);
    }else if($content.find('.'+u).hasClass('column_our_team_list')){
        // our team list
        $content.find('.'+u+' .image_wrapper img').attr('src', v);
    }else if($content.find('.'+u).hasClass('column_pricing_item')){
        // pricing item
        $content.find('.'+u+' .image img').attr('src', v);
    }else if($content.find('.'+u).hasClass('column_chart')){
        // chart
        if(v){
            if($content.find('.'+u+' .chart .image img').length){
                $content.find('.'+u+' .chart .image img').attr('src', v);
            }else{
                $content.find('.'+u+' .chart .num').remove();
                $content.find('.'+u+' .chart .icon').remove();
                $content.find('.'+u+' .chart').prepend('<div class="image"><img class="scale-with-grid" src="'+v+'" alt="" /></div>');
            }
        }else if($('.mfn-form-row.mfn-fr-show .preview-iconinput').val().length){
            $content.find('.'+u+' .chart .image').remove();
            $content.find('.'+u+' .chart .label').remove();
            $content.find('.'+u+' .chart').prepend('<div class="icon"><i class="'+$('.mfn-form .mfn-fr-show .preview-iconinput').val()+'"></i></div>');
        }else if($('.mfn-form-row.mfn-fr-show .preview-labelinput').val().length){
            $content.find('.'+u+' .chart .image').remove();
            $content.find('.'+u+' .chart .icon').remove();
            $content.find('.'+u+' .chart').prepend('<div class="num">'+$('.mfn-form-row.mfn-fr-show .preview-labelinput').val()+'</div>');
        }
        
    }

    // before after
    if($content.find('.vb-item[data-uid='+u+'] .before_after.twentytwenty-container').length){

        $content.find('.vb-item[data-uid='+u+'] .before_after.twentytwenty-container .twentytwenty-overlay').remove();
        $content.find('.vb-item[data-uid='+u+'] .before_after.twentytwenty-container .twentytwenty-after-label').remove();
        $content.find('.vb-item[data-uid='+u+'] .before_after.twentytwenty-container .twentytwenty-handle').remove();
        $content.find('.vb-item[data-uid='+u+'] .before_after.twentytwenty-container').unwrap(); 

        $content.find('.vb-item[data-uid='+u+'] .before_after.twentytwenty-container').twentytwenty(); 

    }
    enableBeforeUnload();
    addHistory();
}

// MEDIA

function runMedia(releaser){

$('.'+releaser+' .browse-image').each(function() {

  var frame,
      metaBox = $(this),
      $modulebox = metaBox.closest('.mfn-form-row'),
      eluid = metaBox.closest('.mfn-form-row').data('element'),
      groupid = metaBox.closest('.mfn-form-row').data('group'),
      addImgLink = metaBox.find('.mfn-button-upload'),
      delImgAll = metaBox.find( '.mfn-button-delete-all'),
      imgContainer = metaBox.find( '.selected-image'),
      multipleImgs = false,
      multipleImgsInput = metaBox.find( '.upload-input' ),
      galleryContainer = metaBox.find( '.gallery-container' ),
      imgIdInput = metaBox.find( '.mfn-form-input' );

  
    if(metaBox.hasClass('multi')){
        multipleImgs = 'add';
    }

  addImgLink.on( 'click', function( event ){
    event.preventDefault();

    if ( frame ) { frame.open(); return; }

    frame = wp.media({
      multiple: multipleImgs
    });


    if(multipleImgs && multipleImgs == 'add' && metaBox.find( '.upload-input' ).length){

        frame.on('open', function() {
        
        var library = frame.state().get('selection'),
            images = metaBox.find( '.upload-input' ).val();

        if (!images) {
            return true;
        }

        imageIDs = images.split(',');

        imageIDs.forEach(function(id) {
            var attachment = wp.media.attachment(id);
            attachment.fetch();
            library.add(attachment ? [attachment] : []);
        });

      });


        frame.on( 'select', function() {

        galleryContainer.html('');

        var library = frame.state().get('selection'),
        imageURLs = [],
        imageIDs = [],
        imageURL, outputHTML, joinedIDs;

        

        library.map(function(image) {

            image = image.toJSON();
            imageURLs.push(image.url);
            imageIDs.push(image.id);

            if (image.sizes.thumbnail) {
            imageURL = image.sizes.thumbnail.url;
            } else {
            imageURL = image.url;
            }

            outputHTML = '<li class="selected-image">' +
            '<img data-pic-id="' + image.id + '" src="' + imageURL + '" />' +
            '<a class="mfn-option-btn mfn-button-delete" data-tooltip="Delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>' +
            '</li>';

            galleryContainer.append(outputHTML);

            
        });

        joinedIDs = imageIDs.join(',').replace(/^,*/, '');
        if (joinedIDs.length !== 0) {
            metaBox.removeClass('empty');
        }
        multipleImgsInput.val(joinedIDs);
        delSingleImgGallery();
        re_render(groupid);

        });
        frame.open();
    }else{

        frame.on( 'select', function() {

        metaBox.removeClass('empty');
        var attachment = frame.state().get('selection').first().toJSON();
        if(imgContainer) { imgContainer.html( '<img src="'+attachment.url+'" alt="">' ); }
        imgIdInput.val( attachment.url );

        if($modulebox.hasClass('column bg_image') && imgIdInput.hasClass('preview-bg_imageinput')){
            let tmp_eluid = eluid + ' .column_attr';
            changeInlineStyles(tmp_eluid, 'background-image', 'url('+attachment.url+')');
        }else if(imgIdInput.hasClass('preview-bg_imageinput')){
            changeInlineStyles(eluid, 'background-image', 'url('+attachment.url+')');
        }else if(imgIdInput.hasClass('preview-bg_video_mp4input')){
            setVideoBg(eluid, 'mp4', attachment.url);
        }else if(imgIdInput.hasClass('preview-bg_video_ogvinput')){
            setVideoBg(eluid, 'ogg', attachment.url);
        }else if($modulebox.hasClass('article_box') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if(imgIdInput.hasClass('preview-image_beforeinput')){
            imageForWidget(eluid, attachment.url, 'before');
        }else if(imgIdInput.hasClass('preview-image_afterinput')){
            imageForWidget(eluid, attachment.url, 'after');
        }else if($modulebox.hasClass('contact_box image') && imgIdInput.hasClass('preview-imageinput')){
            let tmp_eluid = eluid + ' .get_in_touch';
            changeInlineStyles(tmp_eluid, 'background-image', 'url('+attachment.url+')');
        }else if($modulebox.hasClass('counter image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('feature_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('flat_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url, 'boximg');
        }else if($modulebox.hasClass('flat_box icon_image') && imgIdInput.hasClass('preview-icon_imageinput')){
            imageForWidget(eluid, attachment.url, 'iconimg');
        }else if($modulebox.hasClass('hover_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url, 'mainimg');
        }else if($modulebox.hasClass('hover_box image_hover') && imgIdInput.hasClass('preview-image_hoverinput')){
            imageForWidget(eluid, attachment.url, 'hoverimg');
        }else if($modulebox.hasClass('how_it_works image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('icon_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('image src') && imgIdInput.hasClass('preview-srcinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('info_box image') && imgIdInput.hasClass('preview-imageinput')){
            let tmp_eluid = eluid + ' .infobox';
            changeInlineStyles(tmp_eluid, 'background-image', 'url('+attachment.url+')');
        }else if($modulebox.hasClass('list image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('opening_hours image') && imgIdInput.hasClass('preview-imageinput')){
            let tmp_eluid = eluid + ' .opening_hours';
            changeInlineStyles(tmp_eluid, 'background-image', 'url('+attachment.url+')');
        }else if($modulebox.hasClass('photo_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('promo_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('sliding_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('story_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('trailer_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('zoom_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url, 'main');
        }else if($modulebox.hasClass('zoom_box content_image') && imgIdInput.hasClass('preview-content_imageinput')){
            imageForWidget(eluid, attachment.url, 'desc');
        }else if($modulebox.hasClass('decor_top') && imgIdInput.hasClass('preview-decor_topinput')){
            imageForWidget(eluid, attachment.url, 'decortop');
        }else if($modulebox.hasClass('decor_bottom') && imgIdInput.hasClass('preview-decor_bottominput')){
            imageForWidget(eluid, attachment.url, 'decorbottom');
        }else if($modulebox.hasClass('video placeholder') && imgIdInput.hasClass('preview-placeholderinput')){
            re_render(groupid);
        }else if($modulebox.hasClass('video mp4') && imgIdInput.hasClass('preview-mp4input')){
            re_render(groupid);
        }else if($modulebox.hasClass('map icon') && imgIdInput.hasClass('preview-iconinput')){
            re_render(groupid);
        }else if($modulebox.hasClass('video ogv') && imgIdInput.hasClass('preview-ogvinput')){
            re_render(groupid);
        }else if($modulebox.hasClass('our_team image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('our_team_list image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('pricing_item image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }else if($modulebox.hasClass('widget-chart image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, attachment.url);
        }

        });

        frame.open();

    }

    
  });
  
  
  // DELETE IMAGE LINK

  if(multipleImgs == 'add'){
    delSingleImgGallery();
  }else{
      metaBox.find( '.mfn-button-delete').on( 'click', function( e ){
        e.preventDefault();
        imgContainer.html( '' );
        metaBox.addClass('empty');
        imgIdInput.val( '' );


        if(imgIdInput.hasClass('preview-bg_imageinput')){
            changeInlineStyles(eluid, 'background-image', '');
        }else if(imgIdInput.hasClass('preview-bg_video_mp4input')){
            setVideoBg(eluid, 'mp4', '');
        }else if(imgIdInput.hasClass('preview-bg_video_ogvinput')){
            setVideoBg(eluid, 'ogg', '');
        }else if($modulebox.hasClass('article_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if(imgIdInput.hasClass('preview-image_beforeinput')){
            imageForWidget(eluid, sample_img, 'before');
        }else if(imgIdInput.hasClass('preview-image_afterinput')){
            imageForWidget(eluid, sample_img, 'after');
        }else if($modulebox.hasClass('contact_box image') && imgIdInput.hasClass('preview-imageinput')){
            let tmp_eluid = eluid + ' .get_in_touch';
            changeInlineStyles(tmp_eluid, 'background-image', 'remove_style');
        }else if($modulebox.hasClass('counter image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, '');
        }else if($modulebox.hasClass('feature_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('flat_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img, 'boximg');
        }else if($modulebox.hasClass('flat_box icon_image') && imgIdInput.hasClass('preview-icon_imageinput')){
            imageForWidget(eluid, '', 'iconimg');
        }else if($modulebox.hasClass('hover_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img, 'mainimg');
        }else if($modulebox.hasClass('hover_box image_hover') && imgIdInput.hasClass('preview-image_hoverinput')){
            imageForWidget(eluid, sample_img, 'hoverimg');
        }else if($modulebox.hasClass('how_it_works image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, '');
        }else if($modulebox.hasClass('icon_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, '');
        }else if($modulebox.hasClass('image src') && imgIdInput.hasClass('preview-srcinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('info_box image') && imgIdInput.hasClass('preview-imageinput')){
            let tmp_eluid = eluid + ' .infobox';
            changeInlineStyles(tmp_eluid, 'background-image', '');
        }else if($modulebox.hasClass('list image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, '');
        }else if($modulebox.hasClass('opening_hours image') && imgIdInput.hasClass('preview-imageinput')){
            let tmp_eluid = eluid + ' .opening_hours';
            changeInlineStyles(tmp_eluid, 'background-image', 'remove_style');
        }else if($modulebox.hasClass('photo_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('promo_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('sliding_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('story_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('trailer_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('zoom_box image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img, 'main');
        }else if($modulebox.hasClass('zoom_box content_image') && imgIdInput.hasClass('preview-content_imageinput')){
            imageForWidget(eluid, '', 'desc');
        }else if($modulebox.hasClass('decor_top') && imgIdInput.hasClass('preview-decor_topinput')){
            imageForWidget(eluid, '', 'decortop');
        }else if($modulebox.hasClass('decor_bottom') && imgIdInput.hasClass('preview-decor_bottominput')){
            imageForWidget(eluid, '', 'decorbottom');
        }else if($modulebox.hasClass('video placeholder') && imgIdInput.hasClass('preview-placeholderinput')){
            re_render(groupid);
        }else if($modulebox.hasClass('video mp4') && imgIdInput.hasClass('preview-mp4input')){
            re_render(groupid);
        }else if($modulebox.hasClass('map icon') && imgIdInput.hasClass('preview-iconinput')){
            re_render(groupid);
        }else if($modulebox.hasClass('video ogv') && imgIdInput.hasClass('preview-ogvinput')){
            re_render(groupid);
        }else if($modulebox.hasClass('our_team image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('our_team_list image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('pricing_item image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, sample_img);
        }else if($modulebox.hasClass('widget-chart image') && imgIdInput.hasClass('preview-imageinput')){
            imageForWidget(eluid, '');
        }
        

      });
  }

  function delSingleImgGallery(){
    metaBox.find( '.mfn-button-delete').on( 'click', function( e ){
        e.preventDefault();
        $(this).closest('.selected-image').remove();

        var imageIDs = [],
        id;

      metaBox.find('.gallery-container img').each(function() {
        id = $(this).attr('data-pic-id');
        imageIDs.push(id);
      });

      var joinedIDs = imageIDs.join( ',' );

      if (joinedIDs === '') {
          metaBox.addClass('empty');
        }

      multipleImgsInput.val(joinedIDs);

      re_render(groupid);
    });
  }

  // Delete all 

  delImgAll.on('click', function(e) {
    e.preventDefault();
    galleryContainer.html('');
    metaBox.find( '.upload-input' ).val('');
    metaBox.addClass('empty');
    $content.find('.'+eluid+' .gallery').remove();
    $content.find('.'+eluid+' style').remove();
    imgIdInput.val( '' );
    re_render(groupid);
  });

});

}

function reSortSections(){
    pending = true;

    $content.find('.mfn-builder-content .mcb-section').each(function(i) {

        let uid = $(this).data('uid');

        let patt_wrap = /wraps]\[([0-9]|[0-9][0-9])\]/g;
        let patt_sect = /sections\[([0-9]|[0-9][0-9])\]/g;
        let patt_item = /items]\[([0-9]|[0-9][0-9])\]/g;
        

        if($(this).find('.mcb-wrap').length > 0){

        $(this).find('.mcb-wrap').each(function(j) {

            let w_uid = $(this).data('uid');
            

            if($(this).find('.mcb-column').length > 0){
            let widgets = $(this).find('.mcb-column');
            widgets.each(function(k) {
                let wi_uid = $(this).data('uid');

                $(this).attr('data-order', k);

                $('.sidebar-wrapper .mfn-vb-'+wi_uid).each(function() {

                    $(this).find('.mfn-form-control, input, select, textarea').each(function() {

                    let attr_name = $(this).attr('name');

                    if( typeof attr_name !== typeof undefined && attr_name !== false ){

                        let new_attr_name_i = attr_name.replace(patt_item, 'items]['+k+']');
                        new_attr_name_i = new_attr_name_i.replace(patt_wrap, 'wraps]['+j+']');
                        new_attr_name_i = new_attr_name_i.replace(patt_sect, 'sections['+i+']');

                        $(this).attr('name', new_attr_name_i);
                        
                    }else if( typeof $(this).attr('data-default') !== 'undefined' ){
                        attr_name = $(this).attr('data-default');

                        let new_attr_name_i = attr_name.replace(patt_item, 'items]['+k+']');
                        new_attr_name_i = new_attr_name_i.replace(patt_wrap, 'wraps]['+j+']');
                        new_attr_name_i = new_attr_name_i.replace(patt_sect, 'sections['+i+']');

                        $(this).attr('data-default', new_attr_name_i);
                    }

                    });

                });
            });
            }

            $(this).attr('data-order', j);

            $('.sidebar-wrapper .mfn-vb-'+w_uid+' .mfn-form-control').each(function() {

                let attr_name = $(this).attr('name').replace(patt_sect, 'sections['+i+']');
                let new_attr_name_w = attr_name.replace(patt_wrap, 'wraps]['+j+']');

                $(this).attr('name', new_attr_name_w);

            });

        });
        }

        $('.sidebar-wrapper .mfn-vb-'+uid+' .mfn-form-control, .sidebar-wrapper .mfn-vb-'+uid+' .value').each(function() {
            let attr_name = $(this).attr('name');
            let new_attr_name = attr_name.replace(patt_sect, 'sections['+i+']');
            $(this).attr('name', new_attr_name);
        });

        $(this).attr('data-order', i);

    });

    pending = false;
}

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




function runSorting(){

// iframe drag positioning fix

$.ui.ddmanager.frameOffsets={},$.ui.ddmanager.prepareOffsets=function(e,t){var o,n,f,i,r=$.ui.ddmanager.droppables[e.options.scope]||[],s=t?t.type:null,a=(e.currentItem||e.element).find(":data(ui-droppable)").addBack();e:for(o=0;o<r.length;o++)if(!(r[o].options.disabled||e&&!r[o].accept.call(r[o].element[0],e.currentItem||e.element))){for(n=0;n<a.length;n++)if(a[n]===r[o].element[0]){r[o].proportions().height=0;continue e}r[o].visible="none"!==r[o].element.css("display"),r[o].visible&&("mousedown"===s&&r[o]._activate.call(r[o],t),r[o].offset=r[o].element.offset(),proportions={width:r[o].element[0].offsetWidth,height:r[o].element[0].offsetHeight},"function"==typeof r[o].proportions?r[o].proportions(proportions):r[o].proportions=proportions,(f=r[o].document[0])!==document&&((i=$.ui.ddmanager.frameOffsets[f])||(i=$.ui.ddmanager.frameOffsets[f]=$((f.defaultView||f.parentWindow).frameElement).offset()),r[o].offset.left+=i.left,r[o].offset.top-= ( i.top - scroll_top ) )) } };


if($content){

$content.find('body').imagesLoaded(function() {

    // adding 
    $('.mfn-visualbuilder .sidebar-panel-content ul.items-list li').draggable({
        helper: function(e) {
            return $('<div>').attr('data-type', $(e.target).closest('li').data('type')).addClass('mfn-vb-dragger mfn-vb-drag-item').text( $(e.target).closest('li').data('title') );
        },
        //helper: 'clone',
        cursorAt: {
            top: 20,
            left: 20
        },
        iframeFix: true,
        //revert: 'invalid',
        refreshPositions: true,
        cursor: 'move',
        start: function(event, elem) {
            dragging_new = 1;
            $content.find('.mcb-column').addClass('ui-droppable-active-show');
        },
        stop: function(event, elem) {

            if(dragging_new == 1){

                if($content.find('.mfn-vb-drag-item').length){ $content.find('.mfn-vb-drag-item').remove(); }
                $content.find('.mcb-column').removeClass('ui-droppable-active-show');
               
                if($content.find('.mfn-vb-sort-placeholder-widget').length) { $content.find('.mfn-vb-sort-placeholder-widget').remove(); }
                $content.find('body').removeClass('hover');

                setTimeout(resetIframeHeight, 100);
            }

            dragging_new = 0;
        },
        drag: function(event, elem){
            if(dragging_new == 1){
                //elem.position.top -= $('html, body').scrollTop() - scroll_top;
                elem.position.top -= $(window).scrollTop() - scroll_top;

                // $(document).on('keyup', function(e) {
                //   if (e.keyCode == 27) {

                //     scroll_top = $("html, body").scrollTop();
                //     dragging_new = 0;
                //     if($content.find('.mfn-vb-sort-placeholder-widget').length){ $content.find('.mfn-vb-sort-placeholder-widget').remove(); }
                //     if($('.mfn-vb-drag-item').length){ $('.mfn-vb-drag-item').remove(); }
                //     $content.find('.mcb-column').removeClass('ui-droppable-active-show');

                //     $content.find('body').removeClass('hover');

                //     return false;
                //   }
                // });
            }


        }
    });


    $content.find('.mfn-drag-helper').droppable({
        greedy: true,
        iframeFix: true,
        tolerance: 'touch',
        accept: "*",
        drop: function(event, ui) {
            if(dragging_new == 1){

                $content.find('.mfn-vb-dragover').removeClass('mfn-vb-dragover');
              
                $content.find('.mcb-column').removeClass('ui-droppable-active-show');

                if($(this).find('.mfn-vb-sort-placeholder-widget').length){ $(this).find('.mfn-vb-sort-placeholder-widget').remove(); }

                var dropped = ui.draggable;
                var dropped_item = dropped.attr('data-type');

                if(dropped.data('type')){ addNewWidget(dropped_item); }

                if($content.find('.mfn-vb-drag-item').length){ $content.find('.mfn-vb-drag-item').remove(); }
                if($content.find('.mfn-vb-sort-placeholder-widget').length) { $content.find('.mfn-vb-sort-placeholder-widget').remove(); }

                dragging_new = 0;

                $content.find('body').removeClass('hover');

                setTimeout(resetIframeHeight, 100);

            }

        }, 
        over: function(event, elem) {
            if(dragging_new == 1){ 
                $content.find('.mfn-vb-dragover').removeClass('mfn-vb-dragover');
                $content.find('.mfn-vb-sort-placeholder-widget').remove();
  
                $(this).addClass("mfn-vb-dragover");

                new_widget_container = $(this).closest('.vb-item').attr('data-uid');

                if($(this).hasClass('mfn-dh-before')){
                    new_widget_position = 'before';
                    $(this).closest('.vb-item').before('<div class="mfn-vb-sort-placeholder-widget one column"></div>');
                }else{
                    new_widget_position = 'after';
                    if(!$(this).parent().hasClass('empty')){
                        $(this).closest('.vb-item').after('<div class="mfn-vb-sort-placeholder-widget one column"></div>');
                    }else{
                        $(this).parent().append('<div class="mfn-vb-sort-placeholder-widget one column"></div>');
                    }
                }

                new_widget_wrap = $(this).closest('.mcb-wrap').attr('data-order');
                new_widget_wrap_size = $(this).closest('.mcb-wrap').attr('data-size');
                new_widget_section = $(this).closest('.mcb-section').attr('data-order');
                new_widget_wcount = $(this).closest('.mcb-wrap').find('.mcb-column').length;

            }

            
        }, 
        out: function(event, elem) {
            if(dragging_new == 1){ 
                dropped_id = null;
                $(this).removeClass("mfn-vb-dragover");
            }
        }
    });


    // widget
    $content.find('.mcb-wrap-inner').sortable({
        connectWith: ".mcb-wrap-inner",
        placeholder: 'mfn-vb-sort-placeholder-widget',
        handle: ".mfn-column-drag",
        forcePlaceholderSize: false,
        iframeFix: true,
        iframeScroll: true,
        items: '.mcb-column',
        appendTo: $content.find('body'),
        helper: function(e, ui) {
            return $('<div>').addClass('mfn-vb-dragger mfn-vb-drag-item').text( 'Item sort' );
        },
        cursorAt: {
            top: 20,
            left: 20
        },
        update: function(e, ui) {
            checkEmptyWraps();
            enableBeforeUnload();
            reSortSections();

        },
        over: function(e, ui) {
            if(dragging_new == 1){
                ui.placeholder.addClass( 'one column' );
            }else{
                let size = ui.item.attr('data-size');
                let sizeClass = sizes.filter(s => s.key === size)[0];

                if(sizeClass) { ui.placeholder.addClass( sizeClass.value+' column' ); }
            }
        },
        start: function(event, elem) {
            scroll_top = $content.find("html, body").scrollTop();
            $content.find('.mcb-column').addClass('ui-droppable-active-show')
        },
        stop: function(event, elem) {
            $content.find('.mcb-column').removeClass('ui-droppable-active-show')
            addHistory();
        }
    });
   

    // wraps
    $content.find('.section_wrapper').sortable({
        connectWith: ".section_wrapper",
        placeholder: 'mfn-vb-sort-placeholder-wrap',
        handle: ".mfn-wrap-drag",
        //revert: true,
        forcePlaceholderSize: true,
        items: '.mcb-wrap',
        appendTo: $content.find('body'),
        helper: function(e, ui) {
            return $('<div>').addClass('mfn-vb-dragger mfn-vb-drag-wrap').text( 'Wrap sort' );
        },
        opacity: 0.9,
        cursorAt: {
            top: 20,
            left: 20
        },
        update: function(e, ui) {
            checkEmptySections();
            enableBeforeUnload();
            reSortSections();
            addHistory();
        },
        start: function(event, elem) {
            scroll_top = $content.find("html, body").scrollTop();
            //$content.find('.mcb-wrap-inner').addClass('ui-droppable-active-show')
        },
        stop: function(event, elem) {
            //$content.find('.mcb-wrap-inner').removeClass('ui-droppable-active-show')
        }
    });

    // sections
    $content.find('.mfn-builder-content').sortable({
        connectWith: ".mfn-builder-content",
        placeholder: 'mfn-vb-sort-placeholder-section',
        handle: ".mfn-section-drag",
        forcePlaceholderSize: true,
        //revert: true,
        iframeFix: true,
        iframeScroll: true,
        scrollSensitivity: 30,
        scroll: true,
        items: '.mcb-section',
        containment: "parent",
        appendTo: $content.find('body'),
        helper: function(e, ui) {
            return $('<div>').addClass('mfn-vb-dragger mfn-vb-drag-section').text( 'Section sort' );
        },
        cursorAt: {
            top: 20,
            left: 20
        },
        update: function(e, ui) {
            enableBeforeUnload();
            reSortSections();
            addHistory();
        },
        start: function(event, elem) {
            scroll_top = $content.find("html, body").scrollTop();
            $content.find('.mcb-section').addClass('ui-droppable-active-show')
        },
        stop: function(event, elem) {
            $content.find('.mcb-section').removeClass('ui-droppable-active-show')
        }
    });

});
}
}


function blink(){
    setTimeout(function(){
        $content.find('.blink').removeClass('blink');
    }, 800);
}

































// re renders

function re_render(g){

    var it = $('.'+g).data('element');

    pending = true;

    let widget_attr = {};
    let widget_type = $('.sidebar-wrapper .'+g+'.mfn-type-item.type .typeinput').val();

    $('.'+g+'.mfn-fr-show .mfn-form-control').each(function() {
        let f_name = $(this).closest('.mfn-form-row').data('name');
        widget_attr[f_name] = $(this).val();
    });

    $('.'+g+'.mfn-fr-show .segmented-options li input:checked').each(function() {
        let f_name = $(this).closest('.mfn-form-row').data('name');
        widget_attr[f_name] = $(this).val();
    });

    if(widget_type == 'image_gallery'){
        widget_attr['ids'] = $('.sidebar-wrapper .'+g+' .upload-input').val();
    }

    $.ajax({
        url: ajaxurl,
        data: {
            action: 'rerenderwidget',
            'mfn-builder-nonce': wpnonce,
            type: widget_type,
            attri: widget_attr,
        },
        type: 'POST',
        success: function(response){
            $content.find('.'+it+' > :last-child').remove();
            $content.find('.'+it+' .title').remove();

            if(Array.isArray(response)){
                $content.find('.'+it).append(response[0]);
                eval(response[1]);
            }else{
                $content.find('.'+it).append(response);
            }

            enableBeforeUnload();

            pending = false;
            addHistory();
        }
    });
}

// tabs

// reorder
function reorder_tabs(){
    $('.mfn-fr-show ul.tabs-wrapper li.tab:not(.default)').each(function(i) {
        $(this).find('input, textarea').each(function() {
            let patt_tabs = /tabs]\[([0-9]|[0-9][0-9])\]/g;
            let new_attr_name = $(this).attr('name').replace(patt_tabs, 'tabs]['+i+']');
            $(this).attr( 'name', new_attr_name );
        })

    });
}

function re_render_tabs(g){
    pending = true;
    var it = $('.'+g).data('element');

    var widget_type = $('.'+g).find('.typeinput').val();
    var widget_attr = {};
    widget_attr['tabs'] = [];

    if(widget_type != 'feature_list'){
        widget_attr['title'] = $('.'+g).find('.preview-titleinput').val();
    }

    if(widget_type == 'feature_list'){
        widget_attr['columns'] = $('.'+g+'.feature_list.columns input:checked').val();
        widget_attr['content'] = $('.'+g+'.feature_list .preview-contentinput').val();
    }

    if(widget_type == 'tabs'){
        widget_attr['type'] = $('.'+g+'.tabs.type input:checked').val();
        widget_attr['uid'] = $('.'+g+'.tabs.uid .preview-uidinput').val();
    }

    if(widget_type == 'info_box'){
        widget_attr['image'] = $('.'+g+'.info_box .preview-imageinput').val();
        widget_attr['title'] = $('.'+g+'.info_box .preview-titleinput').val();
        widget_attr['animate'] = $('.'+g+'.info_box .preview-animateinput').val();
        widget_attr['content'] = $('.'+g+'.info_box .preview-contentinput').val();
    }

    if(widget_type == 'opening_hours'){
        widget_attr['content'] = $('.'+g+'.opening_hours .preview-contentinput').val();
        widget_attr['image'] = $('.'+g+'.opening_hours .preview-imageinput').val();
    }

    if(widget_type == 'accordion'){
        widget_attr['open1st'] = $('.'+g+'.accordion.open1st input:checked').val();
        widget_attr['openAll'] = $('.'+g+'.accordion.openAll input:checked').val();
        widget_attr['style'] = $('.'+g+'.accordion.style input:checked').val();
    }

    if(widget_type == 'faq'){
        widget_attr['open1st'] = $('.'+g+'.faq.open1st input:checked').val();
        widget_attr['openAll'] = $('.'+g+'.faq.openAll input:checked').val();
    }

    if(widget_type == 'progress_bars'){
        widget_attr['content'] = $('.'+g+'.progress_bars .preview-contentinput').val();
    }

    if(widget_type == 'pricing_item' || widget_type == 'map'){
        $('.'+g+'.'+widget_type+'.mfn-fr-show .mfn-form-control').each(function() {
            let f_name = $(this).closest('.mfn-form-row').data('name');
            if(f_name != 'tabs'){ widget_attr[f_name] = $(this).val(); }
        });

        $('.'+g+'.'+widget_type+'.mfn-fr-show .segmented-options li input:checked').each(function() {
            let f_name = $(this).closest('.mfn-form-row').data('name');
            if(f_name != 'tabs'){ widget_attr[f_name] = $(this).val(); }
        });
    }

    if($('.'+g).find('.tabs-wrapper li.tab:not(.default)').length){
        $('.'+g).find('.tabs-wrapper li.tab:not(.default)').each(function(a) {

            if(widget_type == 'progress_bars'){
                var arr = {
                    'title': $(this).find('.mfn-tab-title').val(), 
                    'value': $(this).find('.mfn-tab-value').val(), 
                    'size': $(this).find('.mfn-tab-size').val(), 
                    'color': $(this).find('.mfn-tab-color').val()
                };
            }else if(widget_type == 'tabs' || widget_type == 'accordion' || widget_type == 'faq'){
                var arr = {
                    'title': $(this).find('.mfn-tab-title').val(), 
                    'content': $(this).find('.mfn-form-textarea').val()
                };
            }else if(widget_type == 'feature_list'){
                var arr = {
                    'title': $(this).find('.mfn-tab-title').val(), 
                    'icon': $(this).find('.mfn-tab-icon').val(),
                    'link': $(this).find('.mfn-tab-link').val(),
                    'target': $(this).find('.mfn-tab-target').val(),
                    'animate': $(this).find('.mfn-tab-animate').val(),
                };
            }else if(widget_type == 'info_box'){
                var arr = {
                    'content': $(this).find('.mfn-tab-content').val(),
                };
            }else if(widget_type == 'opening_hours'){
                var arr = {
                    'days': $(this).find('.mfn-tab-days').val(),
                    'hours': $(this).find('.mfn-tab-hours').val(),
                };
            }else if(widget_type == 'timeline'){
                var arr = {
                    'title': $(this).find('.mfn-tab-title').val(),
                    'date': $(this).find('.mfn-tab-date').val(),
                    'content': $(this).find('.mfn-form-textarea').val(),
                };
            }else if(widget_type == 'pricing_item'){
                var arr = {
                    'title': $(this).find('.mfn-tab-title').val(),
                };
            }else if(widget_type == 'pricing_item'){
                var arr = {
                    'lat': $(this).find('.mfn-tab-lat').val(),
                    'lng': $(this).find('.mfn-tab-lng').val(),
                    'icon': $(this).find('.mfn-tab-icon').val(),
                };
            }

            widget_attr['tabs'].push(arr);

        });
    }
    
    $.ajax({
        url: ajaxurl,
        data: {
            action: 'rerenderwidget',
            'mfn-builder-nonce': wpnonce,
            type: widget_type,
            attri: widget_attr,
        },
        type: 'POST',
        success: function(response){
            $content.find('.'+it+' > :last-child').remove();
            $content.find('.'+it+' .title').remove();
            if(Array.isArray(response)){
                $content.find('.'+it).append(response[0]);
                let ajax_script = response[1];
                eval(ajax_script);
            }else{
                $content.find('.'+it).append(response);
            }
            if(widget_type == 'progress_bars'){
                $content.find('.'+it+' .bars_list').addClass('hover');
            }

            pending = false;
            enableBeforeUnload();
            addHistory();
        }
    });
    
}










// settings



var introduction = {
  overlay: $('.mfn-intro-overlay'),
  cookie: {
    // introduction.cookie.get()
    get: function(){
      return Cookies.get('mfn-builder-introo');
    },
    // introduction.cookie.set()
    set: function(){
      Cookies.set( 'mfn-builder-introo', 1, { path: '' } );
    },
    // introduction.cookie.remove()
    remove: function(){
      Cookies.remove( 'mfn-builder-introo', { path: '' } );
    }
  },
  // introduction.open()
  open: function(){
    var slidesAmount = $('.mfn-intro-container ul li').size() - 1;
    if( introduction.cookie.get() ){
      return false;
    }
    introduction.overlay.show();
    $('.mfn-intro-container ul').slick({
      cssEase: 'ease-out',
      dots: false,
      fade: true,
      infinite: false
    });
    $('.mfn-intro-container ul').on('afterChange', function(event, slick, currentSlide, nextSlide){
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
    introduction.overlay.fadeOut(200);
  }
};
introduction.open();

$('.introduction-reopen').on('click', function(e) {
    e.preventDefault();
    introduction.cookie.remove();
    introduction.open();
});






$('.mfn-option-dropdown a').on('click', function(e) {e.preventDefault();});

// export / import

$('.mfn-export-import-opt').on('click', function(e) {
    e.preventDefault();
    $('.mfn-export-import-opt').removeClass('active');
    $(this).addClass('active');
    $(".panel").hide();
    $('.export-import-current').text($(this).text());
    let filtr = $(this).data('filter');
    $('.'+filtr).show();
});

$('.mfn-export-button').on('click', function(e) {
    e.preventDefault();

    if(!$(this).hasClass('mfn-icon-check-blue')){
        $('.mfn-export-field').select();
        document.execCommand("copy");
        $(this).find('span').text('Copied').addClass('mfn-icon-check-blue');
        localStorage.setItem( 'mfn-builder', JSON.stringify({
          clipboard: $('.mfn-export-field').val()
        }) );
    }

});

$('.mfn-items-import-template li').on('click', function() {
    $('.mfn-items-import-template li').removeClass('active');
    $(this).addClass('active');
});

$('.mfn-export-cancel').on('click', function(e) {
    e.preventDefault();
    backToWidgets();
});

function handlePaste (e) {
    var clipboardData, pastedData;

    // Stop data actually being pasted into div
    e.stopPropagation();
    e.preventDefault();

    // Get pasted data via clipboard API
    clipboardData = e.clipboardData || window.clipboardData;
    pastedData = clipboardData.getData('Text');

    if( !pastedData && JSON.parse(localStorage.getItem('mfn-builder')).clipboard ){
        pastedData = JSON.parse(localStorage.getItem('mfn-builder')).clipboard;
    }

    $('#import-data-textarea').val(pastedData);
}

document.getElementById('import-data-textarea').addEventListener('paste', handlePaste);

// pre built sections

$('.pre-built-opt').on('click', function(e) {
    e.preventDefault();
    $('.pre-built-opt').removeClass('active');
    $(this).addClass('active');
    $('.pre-built-current').text($(this).text());
    let filtr = $(this).data('filter');

    $('.mfn-visualbuilder .sidebar-panel-content ul.prebuilt-sections-list li').hide();
    $('.mfn-visualbuilder .sidebar-panel-content ul.prebuilt-sections-list li.'+filtr).show();
    
});

// preview

$('.mfn-preview-opt').on('click', function() {
    let preview_type = $(this).data('preview');
    if(!$('body').hasClass('mfn-preview-mode')){ $('body').addClass('mfn-preview-mode'); }
    $('.mfn-preview-toolbar .mfn-preview-opt').removeClass('btn-active');
    $('.mfn-preview-toolbar .mfn-preview-opt[data-preview="'+preview_type+'"]').addClass('btn-active');
    $('.mfn-visualbuilder .preview-wrapper').removeClass('preview-mobile preview-tablet preview-desktop').addClass('preview-'+preview_type);
});

$('.mfn-preview-mode-close').on('click', function(e) {
    e.preventDefault();
    $('body').removeClass('mfn-preview-mode');
    $('.mfn-visualbuilder .preview-wrapper').removeClass('preview-mobile preview-tablet preview-desktop');
});

// end preview

// revisions

$('.mfn-revisions-opt').on('click', function(e) {
    e.preventDefault();
    $('.mfn-revisions-opt').removeClass('active');
    $(this).addClass('active');
    $(".panel").hide();
    $('.revisions-current').text($(this).text());
    let filtr = $(this).data('filter');
    $('.'+filtr).show();
});


$('.sidebar-panel #mfn-widgets-list .mfn-search').on('focus', function() {
    $('.mfn-visualbuilder .sidebar-panel-content ul.items-list li').show();
    $('.mfn-filter-items').removeClass('active');
    $('.mfn-filter-items[data-filter="all"]').addClass('active');
    $('.filter-items-current').text($('.mfn-filter-items[data-filter="all"]').text());
});

var options = {
  valueNames: [ 'title' ]
};

var userList = new List('mfn-widgets-list', options);

var optionsicons = {
  valueNames: [ 'titleicon' ]
};

var iconsList = new List('modal-select-icon', optionsicons);

// filter items 

$('.mfn-filter-items').on('click', function(e) {
    e.preventDefault();
    $('.mfn-filter-items').removeClass('active');
    $(this).addClass('active');
    $('.filter-items-current').text($(this).text());
    let filtr = $(this).data('filter');

    $('.sidebar-panel #mfn-widgets-list .mfn-search').val('');
    userList.search();

    if(filtr == 'all'){
        $('.mfn-visualbuilder .sidebar-panel-content ul.items-list li').show();
    }else{
        $('.mfn-visualbuilder .sidebar-panel-content ul.items-list li').hide();
        $('.mfn-visualbuilder .sidebar-panel-content ul.items-list li.'+filtr).show();
    }

});

// back to widgets

$("li.menu-items a ").on('click', function(e) {
    e.preventDefault();
    backToWidgets();
});
$('.back-to-widgets').on('click', function(e) {
    e.preventDefault();
    backToWidgets();
});

// close modal icon

$('.btn-modal-close').on('click', function(e) {
    e.preventDefault();
    $('.mfn-modal.show').removeClass('show');
});

// modal icon

$('.mfn-ui .modal-select-icon .modalbox-search .mfn-form-select').on('change', function() {
    let choosed = $(this).val();
    $('.mfn-ui .modal-select-icon .modalbox-content ul.mfn-items-list li').hide();
    $('.mfn-ui .modal-select-icon .modalbox-content ul.mfn-items-list li.'+choosed).show();
    $('.mfn-ui .modal-select-icon .modalbox-search .mfn-search').val('');

    iconsList.search();
});

// add section + hover effect

$(".btn-section-add.prev").hover(function() {
    $(this).closest(".mcb-section").addClass("add-row-before");
}, function() {
    $(this).closest(".mcb-section").removeClass("add-row-before");
});

$(".btn-section-add.next").hover(function() {
    $(this).closest(".mcb-section").addClass("add-row-after");
}, function() {
    $(this).closest(".mcb-section").removeClass("add-row-after");
});

// show prebuilts

$(".sidebar-menu ul li.menu-sections a ").on('click', function(e) {
    e.preventDefault();
    showPrebuilts();
    resetSaveButton();
});

// show revisions

$(".sidebar-menu ul li.menu-revisions a ").on('click', function(e) {
    e.preventDefault();
    $(".panel").hide();
    $(".header").hide();
    $(".panel-revisions").show();
    $(".header-revisions").show();
    $('.mfn-revisions-opt').removeClass('active');

    $('.mfn-revisions-opt').first().addClass('active');
    $('.revisions-current').text($('.mfn-revisions-opt').first().text());
    resetSaveButton();
});

// show import export
$(".sidebar-menu ul li.menu-export a ").on('click', function(e) {
    e.preventDefault();
    $('.mfn-export-import-opt').removeClass('active');
    $(".panel").hide();
    $(".header").hide();
    $('.export-import-current').text($('.mfn-export-import-opt').first().text());
    $('.mfn-export-import-opt').first().addClass('active');
    $(".panel-export-import").show();
    $(".header-export-import").show();
    resetSaveButton();
});

// show single page import
$(".sidebar-menu ul li.menu-page a ").on('click', function(e) {
    e.preventDefault();
    $('.mfn-export-import-opt').removeClass('active');
    $(".panel").hide();
    $(".header").hide();
    $('.export-import-current').text($('.mfn-export-import-opt').last().text());
    $('.mfn-export-import-opt').last().addClass('active');
    $(".panel-export-import-single-page").show();
    $(".header-export-import").show();
    resetSaveButton();
});

// show settings
$('.mfn-settings-tab').on('click', function(e) {
    e.preventDefault();
    $(".panel").hide();
    $(".header").hide();
    $(".panel-settings").show();
    $(".header-settings").show();
    resetSaveButton();
});

// show view options
$('.mfn-view-options-tab').on('click', function(e) {
    e.preventDefault();
    $('.btn-save-action').hide();
    $('.btn-save-form-primary').attr('data-action', 'update').removeClass('mfn-btn-green').addClass('mfn-btn-blue');
    $('.btn-save-form-primary span').text('Save options');
    $(".panel").hide();
    $(".header").hide();
    $(".panel-view-options").show();
    $(".header-view-options").show();
});

function resetSaveButton(){
    $('.btn-save-action').show();
    $('.btn-save-form-primary').attr('data-action', formaction).removeClass('mfn-btn-blue').addClass('mfn-btn-green');
    $('.btn-save-form-primary span').text(savebutton);
}


$( document ).ajaxComplete(function() {


    // vb tools
    runMedia('releaser-'+releaser);
    runEdit('releaser-'+releaser);
    runSorting();


    // blog slider
    if($content && $content.find('.blog_slider_ul').length){
        mfnSliderBlog();
    }
    // clients slider
    if($content && $content.find('.clients_slider_ul').length){
        mfnSliderClients();
    }

    // gallery
    if($content && $content.find('.sections_group .gallery').not('.msnry-initialized').length){
        mfnGalleryInit();
    }

    // countdown
    if($content && $content.find('.downcount').length){
        mfnCountDown();
    }

    // chart
    if($content && $content.find('.chart').length){
        mfnChart();
    }

    // equal height

    if($content && $content.find('.section.equal-height .mcb-wrap-inner').length ){
        mfnEqualHeight();
    }

    // counter

    if($content && $content.find('.animate-math .number').length){
        mfnAnimateMath();
    }

    // slider

    if($content && $content.find('.content_slider_ul').length){
        sliderSlider();
    }

    // accordion
    if($content && $content.find('.mfn-acc').length){
        accordionifaqs();
    }

    // feature list 

    if($content && $content.find('.feature_list').length){
        mfnFeatureList();
    }

    // hover box

    if($content && $content.find('.tooltip, .hover_box').length){
        mfnHoverBox();
    }
    // slider offer full

    if($content && $content.find('.offer_ul').length){
        mfnSliderOffer();
    }

    if($content && $content.find('.blog_wrapper .isotope:not( .masonry ), .portfolio_wrapper .isotope:not( .masonry-flat, .masonry-hover, .masonry-minimal').length){
        portfolioIsotope();
    }

    if($content && $content.find('.isotope.masonry, .isotope.masonry-hover, .isotope.masonry-minimal').length){
        blogPortfolioMasonry();
    }

    // slider testimonials

    if($content && $content.find('.testimonials_slider_ul').length){
        sliderTestimonials();
    }

    // slider offer thumb

    if($content && $content.find('.offer_thumb_ul').length){
        mfnSliderOfferThumb();
    }

    if($content && $content.find('.shop_slider_ul').length){
        mfnSliderShop();
    }

    // Equal Height | Wraps
    if($content && $content.find('.section.equal-height-wrap .section_wrapper').length){
        mfnEqualHeightWrap()
    }

    // portfolio slider

    if($content && $content.find('.portfolio_slider_ul').length){
        sliderPortfolio();
    }

    // before after

    if($content && $content.find('.before_after.twentytwenty-container').length){

        $content.find('.before_after.twentytwenty-container .twentytwenty-overlay').remove();
        $content.find('.before_after.twentytwenty-container .twentytwenty-after-label').remove();
        $content.find('.before_after.twentytwenty-container .twentytwenty-handle').remove();

        $content.find('.before_after.twentytwenty-container').imagesLoaded(function() {
            $content.find('.before_after.twentytwenty-container').twentytwenty();
            $content.find('.before_after.twentytwenty-container').not('ba-initialized').addClass('ba-initialized');
        });
    }
    // tabs
    if($content && $content.find('.jq-tabs:not(.ui-tabs)').length){
        $content.find('.jq-tabs:not(.ui-tabs) ul li a').each(function() { $(this).attr("href", location.href.toString().replace('#', '')+$(this).attr("href")); }); // prevents tab reload iframe from jquery 1.9, 1.8 is ok
        $content.find('.jq-tabs:not(.ui-tabs)').tabs();
    }

    // edit view for new widget
    if($content && $content.find('.mfn-builder-content .mfn-new-item .mfn-element-edit').length){

        if( !$content.find('.mfn-builder-content .mfn-new-item').hasClass('column_placeholder') ){
            $content.find('.mfn-builder-content .mfn-new-item .mfn-element-edit').trigger('click');
        }
        $content.find('.mfn-builder-content .mfn-new-item').removeClass('mfn-new-item');

    }


    releaser++;
});





// reinit js

// accordion & faq


function accordionifaqs(){
    $content.find('.mfn-acc').each(function() {
      var el = $(this);

      if (el.hasClass('openAll')) {

        // show all
        el.find('.question')
          .addClass("active")
          .children(".answer")
          .show();

      } else {

        // show one
        var activeTab = el.attr('data-active-tab');
        if (el.hasClass('open1st')) activeTab = 1;

        if (activeTab) {
          el.find('.question').eq(activeTab - 1)
            .addClass("active")
            .children(".answer")
            .show();
        }

      }
    });
}

// chart

function mfnChart(){
    $content.find('.chart_box').each(function() {
        var chart_html = $(this).html();

        var $box = $(this).closest('.mcb-column');

        $('.mfn-vb-formrow.mfn-vb-'+$box.attr('data-uid')+' .color-picker-group .mfn-form-control').val( $(this).find('.chart').attr('data-bar-color') );

        $(this).html(chart_html);

        var $el = $(this).children('.chart');

        var line_width = $el.data('line-width');
        var line_percent = $el.data('percent');
        

        $el.easyPieChart({
          animate: 1000,
          lineCap: 'circle',
          lineWidth: line_width,
          size: 140,
          scaleColor: false
        });
        

        if($(this).find('canvas').length > 1){ $(this).find('canvas').first().remove(); }

        $(this).addClass('chart-initialized');

    });
}

// counter, Quick Fact

function mfnAnimateMath(){
    $content.find('.animate-math .number').waypoint({

      offset: '100%',
      triggerOnce: true,
      handler: function() {

        var el = $(this.element).length ? $(this.element) : $(this);
        var duration = Math.floor((Math.random() * 1000) + 1000);
        var to = el.attr('data-to');

        $({
          property: 0
        }).animate({
          property: to
        }, {
          duration: duration,
          easing: 'linear',
          step: function() {
            el.text(Math.floor(this.property));
          },
          complete: function() {
            el.text(this.property);
          }
        });

        if (typeof this.destroy !== 'undefined' && $.isFunction(this.destroy)) {
          this.destroy();
        }
      }

    });
}

// hover box

function mfnHoverBox(){
    $content.find('.tooltip, .hover_box')
      .on('touchstart', function() {
        $(this).toggleClass('hover');
      })
      .on('touchend', function() {
        $(this).removeClass('hover');
      });
}

// feature list

function mfnFeatureList(){
    $content.find('.feature_list').each(function() {
      var col = $(this).attr('data-col') ? $(this).attr('data-col') : 4;
      $(this).find('li:nth-child(' + col + 'n):not(:last-child)').after('<hr />');
    });
}

// countdown
function mfnCountDown(){
    $content.find('.downcount').each(function() {
      var el = $(this);
      el.downCount({
        date: el.attr('data-date'),
        offset: el.attr('data-offset')
      });
    });
}

// Slider | Testimonials

function sliderTestimonials() {

var pager = function(el, i) {
  var img = $(el.$slides[i]).find('.single-photo-img').html();
  return '<a>' + img + '</a>';
};

$content.find('.testimonials_slider_ul').each(function() {

  var slider = $(this);

  slider.not('.slick-initialized').slick({
    cssEase: 'ease-out',
    dots: true,
    infinite: true,
    touchThreshold: 10,
    speed: 300,

    prevArrow: '<a class="button the-icon slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>',
    nextArrow: '<a class="button the-icon slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>',

    adaptiveHeight: true,
    appendDots: slider.siblings('.slider_pager'),
    customPaging: pager,

    rtl: rtl ? true : false,
    autoplay: mfn.slider.testimonials ? true : false,
    autoplaySpeed: mfn.slider.testimonials ? mfn.slider.testimonials : 5000,

    slidesToShow: 1,
    slidesToScroll: 1
  });

});
}

// Slider | Shop

function mfnSliderShop() {

var pager = function(el, i) {
  return '<a>' + i + '</a>';
};

$content.find('.shop_slider_ul').each(function() {

  var slider = $(this);
  var slidesToShow = 4;

  var count = slider.closest('.shop_slider').data('order');
  if (slidesToShow > count) {
    slidesToShow = count;
    if (slidesToShow < 1) {
      slidesToShow = 1;
    }
  }

  slider.not('.slick-initialized').slick({
    cssEase: 'ease-out',
    dots: true,
    infinite: true,
    touchThreshold: 10,
    speed: 300,

    prevArrow: '<a class="button the-icon slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>',
    nextArrow: '<a class="button the-icon slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>',
    appendArrows: slider.siblings('.blog_slider_header').children('.slider_navigation'),

    appendDots: slider.siblings('.slider_pager'),
    customPaging: pager,

    rtl: rtl ? true : false,
    autoplay: mfn.slider.shop ? true : false,
    autoplaySpeed: mfn.slider.shop ? mfn.slider.shop : 5000,

    slidesToShow: slickAutoResponsive(slider, slidesToShow),
    slidesToScroll: slickAutoResponsive(slider, slidesToShow)
  });

  // ON | debouncedresize

  $(window).on('debouncedresize', function() {
    slider.slick('slickSetOption', 'slidesToShow', slickAutoResponsive(slider, slidesToShow), false);
    slider.slick('slickSetOption', 'slidesToScroll', slickAutoResponsive(slider, slidesToShow), true);
  });

});
}

// Slider | Offer Thumb

function mfnSliderOfferThumb() {

var pager = function(el, i) {
    var img = $content.find( el.$slides[i] ).find('.thumbnail').html();
    return '<a>' + img + '</a>';
};

$content.find('.offer_thumb_ul').each(function() {

  var slider = $(this);

  slider.not('.slick-initialized').slick({
    cssEase: 'ease-out',
    arrows: false,
    dots: true,
    infinite: true,
    touchThreshold: 10,
    speed: 300,

    adaptiveHeight: true,
    appendDots: slider.siblings('.slider_pagination'),
    customPaging: pager,

    rtl: rtl ? true : false,
    autoplay: mfn.slider.offer ? true : false,
    autoplaySpeed: mfn.slider.offer ? mfn.slider.offer : 5000,

    slidesToShow: 1,
    slidesToScroll: 1
  });

});
}

// Slider | Portfolio

function sliderPortfolio() {

$content.find('.portfolio_slider_ul').each(function() {

  var slider = $(this);
  var size = 380;
  var scroll = 5;

  if (slider.closest('.portfolio_slider').data('size')) {
    size = slider.closest('.portfolio_slider').data('size');
  }

  if (slider.closest('.portfolio_slider').data('size')) {
    scroll = slider.closest('.portfolio_slider').data('scroll');
  }

  slider.not('.slick-initialized').slick({
    cssEase: 'ease-out',
    dots: false,
    infinite: true,
    touchThreshold: 10,
    speed: 300,

    prevArrow: '<a class="slider_nav slider_prev themebg" href="#"><i class="icon-left-open-big"></i></a>',
    nextArrow: '<a class="slider_nav slider_next themebg" href="#"><i class="icon-right-open-big"></i></a>',

    rtl: rtl ? true : false,
    autoplay: mfn.slider.portfolio ? true : false,
    autoplaySpeed: mfn.slider.portfolio ? mfn.slider.portfolio : 5000,

    slidesToShow: slickAutoResponsive(slider, 5, size),
    slidesToScroll: slickAutoResponsive(slider, scroll, size)
  });

  // ON | debouncedresize
  $(window).on('debouncedresize', function() {
    slider.slick('slickSetOption', 'slidesToShow', slickAutoResponsive(slider, 5, size), false);
    slider.slick('slickSetOption', 'slidesToScroll', slickAutoResponsive(slider, scroll, size), true);
  });

});
}

// Slider | Offer

function mfnSliderOffer() {
$content.find('.offer_ul').each(function() {

  var slider = $(this);

  slider.not('.slick-initialized').slick({
    cssEase: 'ease-out',
    dots: false,
    infinite: true,
    touchThreshold: 10,
    speed: 300,

    prevArrow: '<a class="slider_prev" href="#"><span class="button_icon"><i class="icon-up-open-big"></i></span></a>',
    nextArrow: '<a class="slider_next" href="#"><span class="button_icon"><i class="icon-down-open-big"></i></span></a>',

    adaptiveHeight: true,
    //customPaging  : pager,

    rtl: rtl ? true : false,
    autoplay: mfn.slider.offer ? true : false,
    autoplaySpeed: mfn.slider.offer ? mfn.slider.offer : 5000,

    slidesToShow: 1,
    slidesToScroll: 1
  });

  // Pagination | Show (css)

  slider.siblings('.slider_pagination').addClass('show');

  // Pager | Set slide number after change

  slider.on('afterChange', function(event, slick, currentSlide, nextSlide) {
    slider.siblings('.slider_pagination').find('.current').text(currentSlide + 1);
  });

});
}

// Equal Height | Wraps

function mfnEqualHeightWrap() {
    $content.find('.section.equal-height-wrap .section_wrapper').each(function() {
      var maxH = 0;
      $( '> .wrap', $(this) ).each( function() {
        $(this).css('height', 'auto');
        if ( $(this).innerHeight() > maxH ) {
          maxH = $(this).innerHeight();
        }
      });
      $('> .wrap', $(this)).css('height', maxH + 'px');
    });
  }

// Slider | Slider

function sliderSlider() {

var pager = function(el, i) {
  return '<a>' + i + '</a>';
};

$content.find('.content_slider_ul').each(function() {

  var slider = $(this);
  var count = 1;
  var centerMode = false;

  if (slider.closest('.content_slider').hasClass('carousel')) {
    count = slickAutoResponsive(slider);

    $(window).on('debouncedresize', function() {
      slider.slick('slickSetOption', 'slidesToShow', slickAutoResponsive(slider), false);
      slider.slick('slickSetOption', 'slidesToScroll', slickAutoResponsive(slider), true);
    });
  }

  if (slider.closest('.content_slider').hasClass('center')) {
    centerMode = true;
  }

  slider.not('.slick-initialized').slick({
    cssEase: 'cubic-bezier(.4,0,.2,1)',
    dots: true,
    infinite: true,
    touchThreshold: 10,
    speed: 300,

    centerMode: centerMode,
    centerPadding: '20%',

    prevArrow: '<a class="button the-icon slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>',
    nextArrow: '<a class="button the-icon slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>',

    adaptiveHeight: true,
    appendDots: slider.siblings('.slider_pager'),
    customPaging: pager,

    rtl: rtl ? true : false,
    autoplay: mfn.slider.slider ? true : false,
    autoplaySpeed: mfn.slider.slider ? mfn.slider.slider : 5000,

    slidesToShow: count,
    slidesToScroll: count
  });

  // Lightbox | disable on dragstart

  var clickEvent = false;

  slider.on('dragstart', '.slick-slide a[rel="lightbox"]', function(event) {
    if (lightboxAttr) {
      var events = $._data(this,'events');
      if( events && Object.prototype.hasOwnProperty.call(events, 'click') ){
        clickEvent = events.click[0];
        $(this).addClass('off-click').off('click');
      }
    }
  });

  // Lightbox | enable after change

  slider.on('afterChange', function(event, slick, currentSlide, nextSlide) {
    if (lightboxAttr) {
      $content.find('a.off-click[rel="lightbox"]', slider).removeClass('off-click').on('click', clickEvent);
    }
  });

});
}

 // Portfolio - Isotope

function portfolioIsotope() {

    $content.find('.blog_wrapper .isotope:not( .masonry ), .portfolio_wrapper .isotope:not( .masonry-flat, .masonry-hover, .masonry-minimal').each(function() {

    var $el = $(this);

    $el.imagesLoaded( function() {
        $el.isotope({
          itemSelector: '.isotope-item',
          layoutMode: 'fitRows',
          isOriginLeft: rtl ? false : true
        });

            $('.preview-wrapper').css({'margin-left': $('.sidebar-wrapper').width()-1});
            setTimeout(function () { $('.preview-wrapper').css({'margin-left': $('.sidebar-wrapper').width() }); },500);
        });  


    });

}


// Blog & Portfolio - Masonry

function blogPortfolioMasonry() {

    $content.find('.isotope.masonry, .isotope.masonry-hover, .isotope.masonry-minimal').each(function() {

    var $el = $(this);

    $el.imagesLoaded( function() {

    $el.isotope({
      itemSelector: '.isotope-item',
      layoutMode: 'masonry',
      isOriginLeft: rtl ? false : true
    });

            $('.preview-wrapper').css({'margin-left': $('.sidebar-wrapper').width()-1});
            setTimeout(function () { $('.preview-wrapper').css({'margin-left': $('.sidebar-wrapper').width() }); },500);
        });  


    });

}



// gallery

function mfnGalleryInit(){

    $content.find('.column_image_gallery').each(function() {

    var $el = $(this);

    var $grid = $el.find('.gallery');

    if(!$grid.hasClass('msnry-initialized')){

    var id = $grid.attr('id');

      $('> br', $grid).remove();

      $('.gallery-icon > a', $grid)
        .wrap('<div class="image_frame scale-with-grid"><div class="image_wrapper"></div></div>')
        .prepend('<div class="mask"></div>')
        .children('img')
        .css('height', 'auto')
        .css('width', '100%');

      // lightbox | link to media file

      if ($grid.hasClass('file')) {
        $('.gallery-icon a', $grid)
          .attr('rel', 'prettyphoto[' + id + ']')
          .attr('data-elementor-lightbox-slideshow', id); // FIX: elementor lightbox gallery
      }

      // isotope for masonry layout

      if ($grid.hasClass('masonry')) {

        /*
        var $grid_iso = $grid.isotope({
          itemSelector: '.gallery-item',
          layoutMode: 'masonry',
          isOriginLeft: rtl ? false : true
        });
        */

        
        $grid.imagesLoaded( function() {
            $grid.isotope({
              itemSelector: '.gallery-item',
              layoutMode: 'masonry',
              isOriginLeft: rtl ? false : true
            });
            $('.preview-wrapper').css({'margin-left': $('.sidebar-wrapper').width()-1});
            setTimeout(function () { $('.preview-wrapper').css({'margin-left': $('.sidebar-wrapper').width() }); },500);
        });  

        
        
        $grid.addClass('msnry-initialized');
      }

      
    }

});
}


var scrollTicker, lightboxAttr, sidebar,
    rtl = $('body').hasClass('rtl'),
    simple = $('body').hasClass('style-simple'),
    topBarTop = '61px',
    headerH = 0,
    mobileInitW = (mfn.mobileInit) ? mfn.mobileInit : 1240;

    // Slick Slider | Auto responsive

  function slickAutoResponsive(slider, max, size) {

    if (!max){
      max = 5;
    }
    if (!size){
      size = 380;
    }

    var width = slider.width(),
      count = Math.ceil(width / size);

    if (count < 1) count = 1;
    if (count > max) count = max;

    return count;
  }





// Slider | Blog

  function mfnSliderBlog() {

    var pager = function(el, i) {
      return '<a>' + i + '</a>';
    };

    $content.find('.blog_slider_ul').each(function() {

      var slider = $(this);
      var slidesToShow = 4;

      var count = slider.closest('.blog_slider').data('order');
      if (slidesToShow > count) {
        slidesToShow = count;
        if (slidesToShow < 1) {
          slidesToShow = 1;
        }
      }

      slider.not('.slick-initialized').slick({
        cssEase: 'ease-out',
        dots: true,
        infinite: true,
        touchThreshold: 10,
        speed: 300,

        prevArrow: '<a class="button the-icon slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>',
        nextArrow: '<a class="button the-icon slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>',
        appendArrows: slider.siblings('.blog_slider_header').children('.slider_navigation'),

        appendDots: slider.siblings('.slider_pager'),
        customPaging: pager,

        rtl: rtl ? true : false,
        autoplay: mfn.slider.blog ? true : false,
        autoplaySpeed: mfn.slider.blog ? mfn.slider.blog : 5000,

        slidesToShow: slickAutoResponsive(slider, slidesToShow),
        slidesToScroll: slickAutoResponsive(slider, slidesToShow)
      });


    });
  }

  // Equal Height | Items

  function mfnEqualHeight() {
    $content.find('.section.equal-height .mcb-wrap-inner').each(function() {
      var maxH = 0;

      $('> .column', $(this)).each(function() {
        $(this).css('height', 'auto');
        if ($(this).height() > maxH) {
          maxH = $(this).height();
        }
      });
      $('> .column', $(this)).css('height', maxH + 'px');
    });
  }

  // Slider | Clients

function mfnSliderClients() {
$content.find('.clients_slider_ul').each(function() {

  var slider = $(this);

  slider.not('.slick-initialized').slick({
    cssEase: 'ease-out',
    dots: false,
    infinite: true,
    touchThreshold: 10,
    speed: 300,

    prevArrow: '<a class="button the-icon slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>',
    nextArrow: '<a class="button the-icon slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>',
    appendArrows: slider.siblings('.blog_slider_header').children('.slider_navigation'),

    rtl: rtl ? true : false,
    autoplay: mfn.slider.clients ? true : false,
    autoplaySpeed: mfn.slider.clients ? mfn.slider.clients : 5000,

    slidesToShow: slickAutoResponsive(slider, 4),
    slidesToScroll: slickAutoResponsive(slider, 4)
  });

  // ON | debouncedresize

  $(window).on('debouncedresize', function() {
    slider.slick('slickSetOption', 'slidesToShow', slickAutoResponsive(slider, 4), false);
    slider.slick('slickSetOption', 'slidesToScroll', slickAutoResponsive(slider, 4), true);
  });

});
}





return {
  init: init,
  addHistory: addHistory,
  wpnonce: wpnonce,
  ajaxurl: ajaxurl,
  enableBeforeUnload: enableBeforeUnload
};

})(jQuery);


(function($) {

    $(document).ready(function() {

        document.getElementById('mfn-preview-wrapper').innerHTML = '<iframe id="mfn-vb-ifr" src="'+mfnvbvars.permalink+'" allowfullscreen="1"></iframe>';
        $('iframe#mfn-vb-ifr').on('load', function() {
            $content = $("iframe#mfn-vb-ifr").contents();
            MfnVbApp.init();
        });

    });

}(jQuery)); 










 