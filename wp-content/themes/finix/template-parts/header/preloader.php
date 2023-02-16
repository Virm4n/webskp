<?php 
/**
 * Displays header site branding
 *
 * @package Finix
 * @subpackage finix
 * @since finix 1.0
 * @version 1.7
 */

$finix_opt = get_option( 'finix_redux' ); 
if ( class_exists( 'ReduxFramework' ) ) {
    $opt= $finix_opt['display_loader'];
    if($opt == "yes")
    {
        $type= $finix_opt['loader_style'];
        if($type == 1)
        {
    ?>
        <div id="preloader">
            <div class="clear-loading loading-effect">
                <div class="loader">
                    <div class="loader-inner square-spin">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    <?php } 
        elseif($type == 2)
        {
    ?>
        <div id="preloader">
            <div class="clear-loading loading-effect">
                <?php
                $style= $finix_opt['loader_type'];
                if($style == 1)
                {
                ?>
                <div class="loader">
                    <div class="loader-inner line-scale-pulse-out">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <?php
                }
                if($style == 2)
                {
                ?>
                <div class="loader">
                    <div class="loader-inner ball-clip-rotate-multiple">
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <?php
                }
                if($style == 3)
                {
                ?>
                <div class="loader">
                    <div class="loader-inner pacman">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    </div>
                </div>
                <?php
                }
                if($style == 4)
                {
                ?>
                <div class="loader">
                    <div class="loader-inner square-spin">
                        <div></div>
                    </div>
                </div>
                <?php
                }
                if($style == 5)
                {
                ?>
                <div class="loader">
                    <div class="loader-inner ball-scale-multiple">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <?php
                }
                if($style == 6)
                {
                ?>
                <div class="loader">
                    <div class="loader-inner ball-grid-pulse">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    </div>
                </div>
                <?php
                }
                if($style == 7)
                {
                ?>
                <div class="loader">
                    <div class="loader-inner ball-spin-fade-loader">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <?php
                }
                if($style == 8)
                {
                ?>
                <div class="loader">
                    <div class="loader-inner ball-clip-rotate">
                        <div></div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
        }
        else{
            if(!empty($finix_opt['loader_image']['url'])){
            $url = $finix_opt['loader_image']['url'];
    ?>
                <div id="preloader">
                    <div class="clear-loading loading-effect">
                        <img src="<?php echo esc_url($url); ?>" alt="<?php esc_attr_e('loader','finix'); ?>" />
                    </div>
                </div>
            <?php
            }
        }
    }
}
else { ?>
<div id="preloader">
    <div class="clear-loading loading-effect">
        <div class="loader">
            <div class="loader-inner square-spin">
                <div></div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- End : Preloader -->