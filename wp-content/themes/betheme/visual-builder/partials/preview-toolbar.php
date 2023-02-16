<?php 

echo '<div class="mfn-preview-toolbar mfn-header mfn-header-green header-large">';

    echo '<div class="options-group group-title">';
    echo '<div class="header-label">Responsive mode</div>';
    echo '</div>';

    echo '<div class="options-group group-options">';
    echo '<a class="mfn-option-btn mfn-option-grey btn-large mfn-preview-opt" data-preview="desktop" title="Desktop" href="#" data-tooltip="Desktop" href="#" data-position="bottom"><span class="mfn-icon mfn-icon-desktop"></span></a>';
    echo '<a class="mfn-option-btn mfn-option-grey btn-large mfn-preview-opt btn-active" data-preview="tablet" title="Tablet" href="#" data-tooltip="Tablet" href="#" data-position="bottom"><span class="mfn-icon mfn-icon-tablet"></span></a>';
    echo '<a class="mfn-option-btn mfn-option-grey btn-large mfn-preview-opt" data-preview="mobile" title="Mobile" href="#" data-tooltip="Mobile" href="#" data-position="bottom"><span class="mfn-icon mfn-icon-mobile"></span></a>';
    echo '</div>';

    echo '<div class="options-group group-close">';
    echo '<a class="mfn-option-btn mfn-option-grey btn-large mfn-preview-mode-close" title="Close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>';
    echo '</div>';

echo '</div>';

?>