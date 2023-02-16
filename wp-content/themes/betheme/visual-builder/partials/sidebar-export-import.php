<?php  
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

echo '<div class="panel panel-ie panel-export-import" style="display: none;">

    <div class="mfn-form">
        <div class="form-content form-content-full-width">
            <div class="form-group">
                <div class="form-control">
                    <textarea class="mfn-form-control mfn-export-field mfn-form-textarea">'.$mfn_items.'</textarea>
                </div>
            </div>
        </div>
    </div>

    <p>Copy to clipboard: Ctrl+C (Cmd+C for Mac)</p>

    <a class="mfn-btn mfn-btn mfn-export-cancel" href="#"><span class="btn-wrapper">Cancel</span></a>
    <a class="mfn-btn mfn-btn-blue mfn-export-button" href="#"><span class="btn-wrapper">Copy to clipboard</span></a>

</div>';



echo '<div class="panel panel-ie panel-export-import-import" style="display: none;">

    <div class="mfn-form">
        <div class="form-content form-content-full-width">
            <div class="form-group">
                <div class="form-control">
                    <textarea id="import-data-textarea" class="mfn-form-control mfn-import-field mfn-form-textarea" placeholder="Paste import data here"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="mfn-form import-options">
    <select class="mfn-form-control mfn-form-select mfn-import-type">
        <option value="before">Insert BEFORE current builder content</option>
        <option value="after">Insert AFTER current builder content</option>
        <option value="replace">REPLACE current builder content</option>
    </select>

    <a data-id="'.get_the_ID().'" class="mfn-btn mfn-btn-blue mfn-import-button" href="#"><span class="btn-wrapper">Import</span></a>
    </div>
   

</div>';

echo '<div class="panel panel-ie panel-export-import-single-page" style="display: none;">

    <div class="mfn-form">
        <div class="form-content form-content-full-width">
            <div class="form-group">
                <div class="form-control" style="">
                    <img class="icon" alt="" src="https://lukas.muffingroup.com/dev/wp-content/themes/betheme/muffin-options/svg/others/import-page-big.svg">

                        <h3>Single page import</h3>
                        <p>Paste a <code>link</code> from one of <a target="_blank" href="https://muffingroup.com/betheme/websites/">pre-built websites</a></p>

                        <input id="mfn-items-import-page" class="mfn-form-control mfn-form-input" placeholder="https://themes.muffingroup.com/betheme/about/">

                        <p class="hint">Only builder content will be imported. Theme options, sliders and images will not be imported.</p>

                    </div>
            </div>
        </div>
    </div>

    <div class="mfn-form import-options">
    <select class="mfn-form-control mfn-form-select mfn-import-type">
        <option value="before">Insert BEFORE current builder content</option>
        <option value="after">Insert AFTER current builder content</option>
        <option value="replace">REPLACE current builder content</option>
    </select>

    <a data-id="'.get_the_ID().'" class="mfn-btn mfn-btn-blue mfn-import-single-page-button" href="#"><span class="btn-wrapper">Import</span></a>
    </div>
   

</div>';


echo '<div class="panel panel-ie panel-export-import-templates" style="display: none;">

    <h4>Select a template from the list:</h4>';

$args = array(
    'post_type' => 'template',
    'posts_per_page'=> -1,
);

$templates = get_posts( $args );

if ( is_array( $templates ) && count($templates) > 0 ) {
    $classes = '';

    echo '<ul class="mfn-items-list mfn-items-import-template">';
    foreach ( $templates as $t=>$template ) {
        $t == 0 ? $classes = 'active' : $classes = '';
        echo '<li class="'.$classes.'" data-id="'. esc_attr($template->ID) .'"><a href="#"><h5>'. esc_html($template->post_title) .'</h5><p>'. esc_html($template->post_modified) .'</p></a></li>';
    }
    echo '</ul>';
}


echo '<div class="mfn-form templates-options">
    <select id="mfn-import-template-type" class="mfn-form-control mfn-form-select mfn-import-template-type">
        <option value="before">Insert BEFORE current builder content</option>
        <option value="after">Insert AFTER current builder content</option>
        <option value="replace">REPLACE current builder content</option>
    </select>

    <a data-id="'.get_the_ID().'" class="mfn-btn mfn-btn-blue mfn-import-template-button" href="#"><span class="btn-wrapper">Import</span></a>
    </div>
   

</div>';

