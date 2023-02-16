<?php
/**
 * Finix Pagination
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
*/

function finix_pagination($numpages = '', $pagerange = '', $paged='') {

	if (empty($pagerange)) {
		$pagerange = 2;
	}

	global $paged;
	if (empty($paged)) {
		$paged = 1;
	}

	if ($numpages == '') {
	global $wp_query;
	$numpages = $wp_query->max_num_pages;
		if(!$numpages) {
			$numpages = 1;
		}
	}

	$pagination_args = array(
	'base'            => get_pagenum_link(1) . '%_%',
	'format'          => 'page/%#%',
	'total'           => $numpages,
	'current'         => $paged,
	'show_all'        => False,
	'end_size'        => 1,
	'mid_size'        => $pagerange,
	'prev_next'       => True,
	'prev_text'       => esc_html__('« Prev', 'finix'),
	'next_text'       => esc_html__('Next »', 'finix'),
	'type'            => 'array',
	'add_args'        => false,
	'add_fragment'    => ''
	);

	$paginate_links = paginate_links($pagination_args);

	if (is_array($paginate_links)) {
	echo "<div class='cpagination'>";
	echo '<ul class="pagination">';
	foreach ( $paginate_links as $page ) {
	echo "<li>$page</li>";
	}
	echo '</ul>';
	echo "</div>";
	}
}
?>