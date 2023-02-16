<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option('finix_redux');
$opt= $finix_opt['blog_sidebar_opt'];
?>
<div class="blog-layout-grid">
	<div class="row">
	<?php
	while ( have_posts() ) :
	the_post();
	?>
	<?php
	if($opt == 1 || $opt == 2)
	{
	if ( ! is_active_sidebar('sidebar-1') ) { ?>
	<div class="col-lg-4 col-md-6 col-sm-6">
	<?php } else { ?>
		<div class="col-lg-6 col-md-6 col-sm-6">
	<?php }
	}
	else if($opt == 3)
	{
	?>
	<div class="col-lg-4 col-md-6 col-sm-6">
	<?php
	}
	?> 
	<?php
	get_template_part( 'template-parts/post/content', 'excerpt' );
	?>
	</div>
	<?php endwhile; ?>
	</div>
</div>