<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finix
 */

?>
<div class="col-12 col-md-12">
<div class="team-detail-info">
	<div class="row align-items-center">
		<div class="col-lg-5 col-md-6 img-align-start">
			<div class="user-image">
				<?php the_post_thumbnail(); ?>
				<?php
				$experience = get_post_meta( get_the_ID(), 'experience', true );
				?>
				<?php if ( ! empty( $experience ) ) { ?>
				<div class="user-experience"><span><?php echo esc_html( $experience ); ?></span><?php esc_html_e( 'Years of Experience', 'finix' ); ?></div>
				<?php } ?>
			</div>
		</div>
		<div class="col-lg-7 col-md-6">
			<div class="member-info">
				<div class="personal-info">
					<?php
					$position = get_post_meta( get_the_ID(), 'position', true );
					if ( ! empty( $position ) ) {
						?>
					<span class="user-position"><?php echo esc_html( $position ); ?></span>
					<?php } ?>
					<h2 class="user-name"><?php the_title(); ?></h2>
				</div>
				<?php
					$user_quote = get_post_meta( get_the_ID(), 'user_quote', true );
				if ( ! empty( $user_quote ) ) {
					?>
				<div class="user-quote">
					<?php echo esc_html( $user_quote ); ?>
				</div>
				<?php } ?>
				<div class="contact-details">
					<?php
					$address      = get_post_meta( get_the_ID(), 'address', true );
					$email        = get_post_meta( get_the_ID(), 'email', true );
					$phone_number = get_post_meta( get_the_ID(), 'phone_number', true );
					$fax_number   = get_post_meta( get_the_ID(), 'fax_number', true );
					$site_url     = get_post_meta( get_the_ID(), 'site_url', true );
					?>
					<ul>
						<?php if ( ! empty( $address ) ) { ?>
						<li>
							<i class="ti ti-map-alt"></i>
							<span><?php echo esc_html( $address ); ?></span>
						</li>
						<?php } ?>
						<?php if ( ! empty( $email ) ) { ?>
						<li>
							<i class="ti ti-email"></i>
							<span><?php echo esc_html( $email ); ?></span>
						</li>
						<?php } ?>
						<?php if ( ! empty( $phone_number ) ) { ?>
						<li>
							<i class="ti ti-headphone-alt"></i>
							<span><?php echo esc_html( $phone_number ); ?></span>
						</li>
						<?php } ?>
						<?php if ( ! empty( $fax_number ) ) { ?>
						<li>
							<i class="ti ti-printer"></i>
							<span><?php echo esc_html( $fax_number ); ?></span>
						</li>
						<?php } ?>
						<?php if ( ! empty( $site_url ) ) { ?>
						<li>
							<i class="ti ti-world"></i>
							<span><?php echo esc_html( $site_url ); ?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div class="contact-info">
					<?php
					$team_button     = get_post_meta( get_the_ID(), 'team_button', true );
					$team_button_url = get_post_meta( get_the_ID(), 'team_button_url', true );
					if ( ! empty( $team_button ) ) {
						?>
					<div class="contact-btn"><a href="<?php echo esc_url( $team_button_url ); ?>"><?php echo esc_html( $team_button ); ?></a></div>
					<?php } ?>
					<div class="social-info">
						<span class="social-icon"><i class="icon icon-share"></i></span>
						<ul>
							<?php
							$facebook = get_post_meta( get_the_ID(), 'facebook', true );
							if ( ! empty( $facebook ) ) {
								?>
							<li><a href="<?php echo esc_url( $facebook ); ?>"><i class="fab fa-facebook-f"></i></a></li>
							<?php } ?>
							<?php
							$twitter = get_post_meta( get_the_ID(), 'twitter', true );
							if ( ! empty( $twitter ) ) {
								?>
							<li><a href="<?php echo esc_url( $twitter ); ?>"><i class="fab fa-twitter"></i></a></li>
							<?php } ?>
							<?php
							$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
							if ( ! empty( $linkedin ) ) {
								?>
							<li><a href="<?php echo esc_url( $linkedin ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
							<?php } ?>
							<?php
							$instagram = get_post_meta( get_the_ID(), 'instagram', true );
							if ( ! empty( $instagram ) ) {
								?>
							<li><a href="<?php echo esc_url( $instagram ); ?>"><i class="fab fa-instagram"></i></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
	the_content();
	?>
</div>
