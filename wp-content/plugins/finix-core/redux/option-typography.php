<?php
/**
 * Typography Options
 *
 * @package Finix Core
 * @subpackage Core
 * @since 1.1.0
 * @version 1.5.0
 */

Redux::setSection( 'finix_redux', array(
    'title' => esc_html__( 'Typography','finix' ),
    'id'    => 'default-style-section',
    'icon'  => 'el el-text-width',
    'desc'  => esc_html__('This section contains typography related options.','finix'),
    'fields'=> array(

        array(
            'id'       => 'body-typography',
            'type'     => 'typography',
            'title'    => __( 'Body Font', 'finix' ),
            'subtitle' => __( 'Specify the body font properties.', 'finix' ),
            'google'   => true,
            'letter-spacing'=> true, 
            'font-backup' => true,
            'text-align'    => false,  
            'color'         => false,
            //'output' => array('body'),
        ),

        array(
            'id'       => 'h1-typography',
            'type'     => 'typography',
            'title'    => __( 'H1 Font', 'finix' ),
            'subtitle' => __( 'Specify the body font properties.', 'finix' ),
            'google'   => true,
            'letter-spacing'=> true, 
            'font-backup' => true,
            'text-align'    => false,  
            'color'         => false,
            //'output' => array('h1'),
        ),

        array(
            'id'       => 'h2-typography',
            'type'     => 'typography',
            'title'    => __( 'H2 Font', 'finix' ),
            'subtitle' => __( 'Specify the body font properties.', 'finix' ),
            'google'   => true,
            'letter-spacing'=> true, 
            'font-backup' => true,
            'text-align'    => false,  
            'color'         => false,
            //'output' => array('h2'),
        ),

        array(
            'id'       => 'h3-typography',
            'type'     => 'typography',
            'title'    => __( 'H3 Font', 'finix' ),
            'subtitle' => __( 'Specify the body font properties.', 'finix' ),
            'google'   => true,
            'letter-spacing'=> true, 
            'font-backup' => true,
            'text-align'    => false,  
            'color'         => false,
            //'output' => array('h3'),
        ),

        array(
            'id'       => 'h4-typography',
            'type'     => 'typography',
            'title'    => __( 'H4 Font', 'finix' ),
            'subtitle' => __( 'Specify the body font properties.', 'finix' ),
            'google'   => true,
            'letter-spacing'=> true, 
            'font-backup' => true,
            'text-align'    => false,  
            'color'         => false,
            //'output' => array('h4'),
        ),

        array(
            'id'       => 'h5-typography',
            'type'     => 'typography',
            'title'    => __( 'H5 Font', 'finix' ),
            'subtitle' => __( 'Specify the body font properties.', 'finix' ),
            'google'   => true,
            'letter-spacing'=> true, 
            'font-backup' => true,
            'text-align'    => false,  
            'color'         => false,
            //'output' => array('h5'),
        ),

        array(
            'id'       => 'h6-typography',
            'type'     => 'typography',
            'title'    => __( 'H6 Font', 'finix' ),
            'subtitle' => __( 'Specify the body font properties.', 'finix' ),
            'google'   => true,
            'letter-spacing'=> true, 
            'font-backup' => true,
            'text-align'    => false,  
            'color'         => false,
            //'output' => array('h6'),
        ),


    )
));
?>