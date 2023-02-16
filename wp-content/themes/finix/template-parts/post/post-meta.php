<?php
/**
 * Post Meta
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */


if( class_exists( 'ReduxFramework' ) ){
    $finix_opt = get_option('finix_redux'); ?>
    <div class="post-meta">
        <ul>

        <?php
        if ($finix_opt['post_metabox']['1']) {
        ?>
        <li>
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
            <i class="ti ti-user"></i>
            <?php echo get_the_author(); ?>
        </a>
        </li>
        <?php } ?>
        
        
        <?php 
        if ($finix_opt['post_metabox']['2']) {
        $date=date_create($post->post_date); ?>
        <li><a href="<?php the_permalink();?>"><i class="ti ti-calendar"></i><?php echo finix_time_link(); ?></a></li>
        <?php } ?>
        
        <?php
        if ($finix_opt['post_metabox']['3']) {
        ?>
        <li>
        <a href="<?php echo get_comments_link( $post->post_id ); ?>">
            <i class="ti ti-comment-alt"></i> 
            <span><?php echo finix_get_comments_number_text(); ?></span>
        </a>
        </li>
        <?php } ?>
                            
        </ul>
    </div>
<?php }
else{ ?>
    <div class="post-meta">
        <ul>

        <li>
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
            <i class="ti ti-user"></i>
            <?php echo get_the_author(); ?>
        </a>
        </li>        
        
        <?php 
        $date=date_create($post->post_date); ?>
        <li><a href="<?php the_permalink();?>"><i class="ti ti-calendar"></i><?php echo finix_time_link(); ?></a></li>
        
        <?php $comment_count = $post->comment_count; ?>
        <li>
        <a href="<?php echo get_comments_link( $post->post_id ); ?>">
            <i class="ti ti-comment-alt"></i> 
            <span><?php echo finix_get_comments_number_text(); ?></span>
        </a>
        </li>
                                    
        </ul>
    </div>
<?php } ?>