<?php
if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}
?>

<div id="mfn-custom" class="wrap about-wrap">

	<?php include_once( plugin_dir_path( __DIR__ ) . '/templates/parts/header.php' ); ?>

	<div class="dashboard-tab">

		<div class="col">
			<?php if( mfn_is_registered() ): ?>

				<h3 class="primary"><?php esc_html_e( 'Theme is registered', 'mfn-opts' ); ?></h3>

				<form class="form-register form-deregister" method="post">

					<?php settings_fields( 'betheme_registration' ); ?>

					<p>
						<code><?php echo esc_html( mfn_get_purchase_code_hidden() ); ?></code>
					</p>

					<?php if( mfn_is_hosted() ): ?>

						<p class="confirm deregister" style="margin-bottom:40px">
							You are using Envato Hosted, this subscription code can not be deregistered.
						</p>

					<?php else: ?>

						<p class="confirm deregister">
							<a class="mfn-button mfn-button-primary mfn-button-fw"><?php esc_html_e( 'Deregister Theme', 'mfn-opts' ); ?></a>
						</p>

					<?php endif; ?>

					<?php if( WHITE_LABEL ): ?>

						<p class="question"><?php _e( 'This feature is disabled in White Label mode.', 'mfn-opts' );?></p>

					<?php else: ?>

						<p class="question">
							<?php $this->deregister(); ?>
							<input type="input" hidden name="action_name" value="deregister" />
							<span><?php esc_html_e( 'Are you sure you want to deregister the theme?', 'mfn-opts' ); ?></span>
							<a class="mfn-button cancel" target="_blank" href="#"><?php esc_html_e( 'Cancel', 'mfn-opts' ); ?></a>
							<input type="submit" class="mfn-button mfn-button-primary" name="deregister" value="<?php esc_attr_e( 'Deregister', 'mfn-opts' ); ?>" />
						</p>

					<?php endif; ?>

				</form>

				<p class="check-licenses"><a target="_blank" href="http://api.muffingroup.com/licenses/">Check your licenses</a></p>

			<?php endif; ?>			

			<h3 class="primary"> Import/Export settings </h3>
			<form class="form-import form-export" method="post">
				<textarea class="becustom-import-export" name="importexport"></textarea>
				
				<input type="input" hidden name="action_name" value="import" />
				<input type="input" hidden id="export-content" name="export-content" value="<?php echo $this->export_options() ?>" />
				<input type="input" hidden id="import-content" name="import-content" value="" />
				<?php $this->import_options(); ?>

				<br />
				<input type="submit" class="mfn-button mfn-button-primary" name="import" disabled value="<?php esc_attr_e( 'Import', 'mfn-opts' ); ?>" />
				<input type="submit" class="mfn-button mfn-button-primary" name="export" disabled value="<?php esc_attr_e( 'Export', 'mfn-opts' ); ?>" />

				
			</form>

		</div>
	</div>

</div>
