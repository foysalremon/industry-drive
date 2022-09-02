<?php 
if(!function_exists('id_customize_register')){
    function id_customize_register($id_customize){
        $id_customize->add_panel( 'id_panel', array(
            'priority'       => 80,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => esc_html__('Theme Settings', 'industry-dive'),
            'description'    => esc_html__('Settings for Theme', 'industry-dive'),
        ) );

        $id_customize->add_setting( 'featured_post' , array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'tiles',
            'transport'   => 'refresh',
        ) );

        $id_customize->add_section( 'home_section' , array(
            'title'      => esc_html__( 'Home', 'industry-dive' ),
            'panel'     => 'id_panel'
        ) );

        $id_customize->add_control( 'featured_post', array(
            'type' => 'select',
            'section' => 'home_section',
            'label' => __( 'Show featured posts as', 'industry-dive' ),
            'choices' => array(
              'tiles' => __( 'Tiles', 'industry-dive' ),
              'slider' => __( 'Slider', 'industry-dive' )
            ),
        ) );
    }
    add_action('customize_register', 'id_customize_register');
}