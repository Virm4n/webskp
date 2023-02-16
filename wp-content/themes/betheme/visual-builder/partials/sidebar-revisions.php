<?php  
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

$revisions = Mfn_Builder_Helper::get_revisions( $post->ID );

echo '<div class="panel panel-revision panel-revisions" style="display: none;">';
    
    echo '<ul class="revisions-list" data-type="autosave">';
        if( ! empty( $revisions['autosave'] ) ){
        foreach( $revisions['autosave'] as $rev_key => $rev_val ){
            echo '<li data-time="'. esc_attr( $rev_key ) .'">';
            echo '<span class="revision-icon mfn-icon-clock"></span>';
            echo '<div class="revision">';
            echo '<h6>'. esc_attr( $rev_val ) .'</h6>';
            echo '<a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a>';
            echo '</div>';
            echo '</li>';
        }
        }
    echo '</ul><p class="info">Saved automatically<br>every 5 minutes</p>';
    
echo '</div>';

echo '<div class="panel panel-revision panel-revisions-update" style="display: none;">';
    
    echo '<ul class="revisions-list" data-type="update">';
        if( ! empty( $revisions['update'] ) ){
        foreach( $revisions['update'] as $rev_key => $rev_val ){
            echo '<li data-time="'. esc_attr( $rev_key ) .'">';
            echo '<span class="revision-icon mfn-icon-clock"></span>';
            echo '<div class="revision">';
            echo '<h6>'. esc_attr( $rev_val ) .'</h6>';
            echo '<a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a>';
            echo '</div>';
            echo '</li>';
        }
        }
    echo '</ul><p class="info">Saved after<br>every post update</p>';
    
echo '</div>';

echo '<div class="panel panel-revision panel-revisions-revision" style="display: none;">';
    
    echo '<ul class="revisions-list" data-type="revision">';
        if( ! empty( $revisions['revision'] ) ){
        foreach( $revisions['revision'] as $rev_key => $rev_val ){
            echo '<li data-time="'. esc_attr( $rev_key ) .'">';
            echo '<span class="revision-icon mfn-icon-clock"></span>';
            echo '<div class="revision">';
            echo '<h6>'. esc_attr( $rev_val ) .'</h6>';
            echo '<a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a>';
            echo '</div>';
            echo '</li>';
        }
        }
    echo '</ul><p class="info">Saved using<br>Save revision button</p>';
    
    echo '<a class="mfn-btn mfn-btn-blue btn-revision mfn-save-revision" href="#"><span class="btn-wrapper">Save revision</span></a>';
echo '</div>';

echo '<div class="panel panel-revision panel-revisions-backup" style="display: none;">';
    
    echo '<ul class="revisions-list" data-type="backup">';
        if( ! empty( $revisions['backup'] ) ){
        foreach( $revisions['backup'] as $rev_key => $rev_val ){
            echo '<li data-time="'. esc_attr( $rev_key ) .'">';
            echo '<span class="revision-icon mfn-icon-clock"></span>';
            echo '<div class="revision">';
            echo '<h6>'. esc_attr( $rev_val ) .'</h6>';
            echo '<a class="mfn-option-btn mfn-option-text mfn-option-blue mfn-btn-restore revision-restore" href="#"><span class="text">Restore</span></a>';
            echo '</div>';
            echo '</li>';
        }
        }
    echo '</ul><p class="info">Backup created<br>before restore of any revision</p>';

echo '</div>';