<?php
/**
 * Template for displaying search forms in finix
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

?>
<?php $unique_id = esc_html( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" id="<?php echo esc_attr($unique_id); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'finix' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>
