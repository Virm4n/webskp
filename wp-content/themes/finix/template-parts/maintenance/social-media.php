<?php
/**
 * Displays maintenance social-media
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.7
 */

$finix_opt = get_option('finix_redux');
$opt= $finix_opt['maint_social_media'];
if($opt == "on") {
?>
    <div class="social-info">
        <ul>
            <?php finix_social_links() ?>
        </ul>
    </div>
<?php } ?>
