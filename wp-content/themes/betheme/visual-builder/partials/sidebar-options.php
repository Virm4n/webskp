<?php  
if( ! defined( 'ABSPATH' ) ){
    exit; // Exit if accessed directly
}



if($post_type == 'post'){
    $page_opt_class = new Mfn_Post_Type_Post();
}elseif($post_type == 'portfolio'){
    $page_opt_class = new Mfn_Post_Type_Portfolio();
}else{
    $page_opt_class = new Mfn_Post_Type_Page();
}

$options = $page_opt_class->set_fields();

echo '<div class="panel panel-view-options" style="display: none;"><div class="mfn-form mfn-form-options">';
    
    echo '<form id="mfn-options-form">';
    echo '<input type="hidden" name="pageid" value="'.get_the_ID().'">';
    echo '<input type="hidden" name="mfn-builder-nonce" value="'.wp_create_nonce( 'mfn-builder-nonce' ).'">';
    if(count($options) > 0){
        foreach ($options['fields'] as $o=>$opt) {
            if(isset($opt['id'])){
                echo $this->mfn_formElement($opt, get_post_meta($post->ID, $opt['id'], true), 'mfnopt', '', '', 'releaser-first', '');
            }else if(isset( $opt['title']) && !isset($opt['id']) ){
                echo '<h5 class="row-header-title">'. wp_kses($opt['title'], mfn_allowed_html('title')) .'</h5>';
            }
        }
    }
    echo '</form>';
        
        // echo '<pre>';
        // print_r( $options );
        // echo '</pre>';
              
echo '</div></div>';