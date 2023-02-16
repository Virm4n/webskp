<?php  
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

echo '<div class="panel panel-items" id="mfn-widgets-list">
        <div class="panel-search mfn-form">
            <input class="mfn-form-control mfn-form-input search mfn-search" type="text" placeholder="Search">
        </div>
        <ul class="items-list list clearfix">';

		foreach($widgets as $w=>$widget){
			echo '<li class="mfn-item-'.$w.' category-'.$widget['cat'].'" data-title="'.$widget['title'].'" data-type="'.$w.'"><a href="#"><div class="mfn-icon card-icon"></div><span class="title">'.$widget['title'].'</span></a></li>';
		}

echo '</ul>
</div>';
?>