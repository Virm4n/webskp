<?php
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

if( wp_get_referer() && strpos( wp_get_referer(), 'login' ) === false && strpos( wp_get_referer(), 'action=mfn-live-builder' ) === false ){
    $referrer = wp_get_referer();
}else{
    $referrer = admin_url( 'edit.php?post_type=page' );
}
echo '<div class="sidebar-menu">
    <div class="sidebar-menu-inner">
        <div class="mfnb-logo">Muffin Builder - Powered by Muffin Group</div>
        <nav id="main-menu">
            <ul>
            <li class="menu-items"><a data-tooltip="Items" data-position="right" href="#">Items</a></li>
						<li class="menu-page"><a data-tooltip="Single page import" data-position="right" href="#">Single page import</a></li>
            <li class="menu-sections"><a data-tooltip="Pre-built sections" data-position="right" href="#">Pre-built sections</a></li>
            <li class="menu-revisions"><a data-tooltip="Revisions" data-position="right" href="#">Revisions</a></li>
            <li class="menu-export"><a data-tooltip="Export / Import" data-position="right" href="#">Export / Import</a></li>
            </ul>
        </nav>
        <nav id="settings-menu">
            <ul>

            <li class="menu-wordpress"><a data-position="right" href="'.$referrer.'" data-tooltip="Back to WordPress">Back to WordPress</a></li>
            <li class="menu-options"><a data-position="right" id="page-options-tab" class="mfn-view-options-tab" href="#" data-tooltip="Page options">Options</a></li>
            <li class="menu-viewpage"><a data-position="right" href="'.get_the_permalink( $post->ID ).'" target="_blank" data-tooltip="View page">View page</a></li>
            <li class="menu-preview"><a data-tooltip="Preview" class="mfn-preview-generate" data-position="right" target="_blank" href="#" data-href="'.get_permalink($post->ID).'?mfn-preview=true">Preview</a></li>
            <li class="menu-settings"><a data-tooltip="Settings" class="mfn-settings-tab" data-position="right" href="#">Settings</a></li>

            </ul>
        </nav>
    </div>
</div>';
