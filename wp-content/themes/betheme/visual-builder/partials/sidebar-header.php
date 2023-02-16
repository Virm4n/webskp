<?php  
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

echo '    <div class="sidebar-panel-header">

		    				<div class="header header-edit-item" id="header-edit-item" style="display: none;">
	                            <div class="title-group">
	                                <span class="sidebar-panel-icon mfn-icon-column"></span>
	                                <div class="sidebar-panel-desc">
	                                    <h5 class="sidebar-panel-title">Column</h5>
	                                </div>
	                            </div>
	                            <div class="options-group">
	                                <a class="mfn-option-btn mfn-option-blank btn-large back-to-widgets" title="Close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
	                            </div>
	                        </div>


	                        <div class="header header-settings" id="header-settings" style="display: none;">
	                            <div class="title-group">
	                                <span class="sidebar-panel-icon mfn-icon-settings"></span>
	                                <div class="sidebar-panel-desc">
	                                    <h5 class="sidebar-panel-title">Settings</h5>
	                                </div>
	                            </div>
	                            <div class="options-group">
	                                <a class="mfn-option-btn mfn-option-blank btn-large back-to-widgets" title="Close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
	                            </div>
	                        </div>
	                        <div class="header header-view-options" id="header-view-options" style="display: none;">
	                            <div class="title-group">
	                                <span class="sidebar-panel-icon mfn-icon-options"></span>
	                                <div class="sidebar-panel-desc">
	                                    <h5 class="sidebar-panel-title">Page options</h5>
	                                </div>
	                            </div>
	                            <div class="options-group">
	                                <a class="mfn-option-btn mfn-option-blank btn-large back-to-widgets" title="Close" href="#"><span class="mfn-icon mfn-icon-close"></span></a>
	                            </div>
	                        </div>

	                        <div class="header header-items" id="header-items">
	                            <div class="title-group">
	                            <span class="sidebar-panel-icon mfn-icon-add-big"></span>
	                            <div class="sidebar-panel-desc">
	                                <h5 class="sidebar-panel-title">Add Item</h5>
	                            </div>
	                            </div>
	                            <div class="options-group">
	                                <div class="mfn-option-dropdown">
	                                    <a title="More" href="#" class="mfn-option-btn btn-large mfn-option-text btn-icon-right mfn-option-blank"><span class="text filter-items-current">All</span><span class="mfn-icon mfn-icon-arrow-down"></span></a>
	                                    <div class="dropdown-wrapper">
	                                        <h6>Filter by:</h6>                    
	                                    <a class="mfn-dropdown-item mfn-filter-items active" data-filter="all" href="#"> All</a>
	                                    <div class="mfn-dropdown-divider"></div>
	                                    <a class="mfn-dropdown-item mfn-filter-items" data-filter="category-typography" href="#"> Typography</a>
	                                    <a class="mfn-dropdown-item mfn-filter-items" data-filter="category-boxes" href="#"> Boxes</a>
	                                    <a class="mfn-dropdown-item mfn-filter-items" data-filter="category-blocks" href="#"> Blocks</a>
	                                    <a class="mfn-dropdown-item mfn-filter-items" data-filter="category-elements" href="#"> Elements</a>
	                                    <a class="mfn-dropdown-item mfn-filter-items" data-filter="category-loops" href="#"> Loops</a>
	                                    <a class="mfn-dropdown-item mfn-filter-items" data-filter="category-other" href="#"> Other</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="header header-prebuilt-sections" id="header-prebuilt-sections" style="display: none;">
	                            <div class="title-group">
	                            <span class="sidebar-panel-icon mfn-icon-predefined-sections"></span>
	                            <div class="sidebar-panel-desc">
	                                <h5 class="sidebar-panel-title"> Sections library</h5>
	                            </div>
	                            </div>
	                            <div class="options-group">
	                                <div class="mfn-option-dropdown">
	                                    <a title="More" href="#" class="mfn-option-btn btn-large mfn-option-text btn-icon-right mfn-option-blank"><span class="text pre-built-current">Basic</span><span class="mfn-icon mfn-icon-arrow-down"></span></a>
	                                    <div class="dropdown-wrapper">
	                                        <h6>Filter by:</h6>';

	                                        $categories = Mfn_Pre_Built_Sections::get_categories();

	                                        foreach( $categories as $category_key => $category ){
	                                        	echo '<a class="mfn-dropdown-item pre-built-opt" data-filter="category-'. esc_attr( $category_key ) .'" href="#"> '. esc_html( $category ) .'</a>';
											}
	                                    
	                                    echo '</div>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="header header-revisions" id="header-revisions" style="display: none;">
	                            <div class="title-group">
	                                <span class="sidebar-panel-icon mfn-icon-revisions"></span>
	                                <div class="sidebar-panel-desc">
	                                    <h5 class="sidebar-panel-title">Revisions</h5>
	                                </div>
	                            </div>
	                            <div class="options-group">
	                                <div class="mfn-option-dropdown">
	                                    <a title="More" href="#" class="mfn-option-btn btn-large mfn-option-text btn-icon-right mfn-option-blank"><span class="text revisions-current">Autosave</span><span class="mfn-icon mfn-icon-arrow-down"></span></a>
	                                    <div class="dropdown-wrapper">
	                                        <a class="mfn-dropdown-item mfn-revisions-opt active" data-filter="panel-revisions" href="#"> Autosave</a>
	                                        <a class="mfn-dropdown-item mfn-revisions-opt" data-filter="panel-revisions-update" href="#"> Update</a>
	                                        <a class="mfn-dropdown-item mfn-revisions-opt" data-filter="panel-revisions-revision" href="#"> Revision</a>
	                                        <a class="mfn-dropdown-item mfn-revisions-opt" data-filter="panel-revisions-backup" href="#"> Backup</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="header header-export-import" id="header-export-import" style="display: none;">
	                            <div class="title-group">
	                            <span class="sidebar-panel-icon mfn-icon-export-import"></span>
	                            <div class="sidebar-panel-desc">
	                                <h5 class="sidebar-panel-title">Export / Import</h5>
	                            </div>
	                            </div>
	                            <div class="options-group">
	                                <div class="mfn-option-dropdown">
	                                    <a title="More" href="#" class="mfn-option-btn btn-large mfn-option-text btn-icon-right mfn-option-blank"><span class="text export-import-current">Export</span><span class="mfn-icon mfn-icon-arrow-down"></span></a>
	                                    <div class="dropdown-wrapper">
	                                        <a class="mfn-dropdown-item mfn-export-import-opt active" data-filter="panel-export-import" href="#"> Export</a>
	                                        <a class="mfn-dropdown-item mfn-export-import-opt" data-filter="panel-export-import-import" href="#"> Import</a>
	                                        <a class="mfn-dropdown-item mfn-export-import-opt" data-filter="panel-export-import-templates" href="#"> Templates</a>
	                                        <a class="mfn-dropdown-item mfn-export-import-opt" data-filter="panel-export-import-single-page" href="#"> Single page</a>

	                                    </div>
	                                </div>
	                            </div>
	                        </div>

	                    </div>';

?>