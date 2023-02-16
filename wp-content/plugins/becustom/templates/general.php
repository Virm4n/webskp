<?php
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}
?>

<div id="mfn-custom" class="wrap about-wrap">

	<?php include_once( plugin_dir_path( __DIR__ ) . '/templates/parts/header.php' ); ?>

	<div class="dashboard-tab">

		<div class="col">

		<?php
			if( WHITE_LABEL ){
				echo '<h3>White label activated, all of the settings are disabled</h3> ';
			}
		?>

		<p>BeCustom is provided exclusively for Betheme customers only.</p>

		<p>This tool allows to re-brand Be into a totally custom product that you may be proud of while providing it for your customers.</p>

		<p>Replace any Betheme and Muffin Group logos to own, change any occurrence of 'Be' or even customise the WP login page in a very simple way.</p>

		<p>It is so simple that you will be surprised.</p>

		</div>

	</div>

</div>
