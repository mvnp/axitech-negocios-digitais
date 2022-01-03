<?php

if(!function_exists( 'startit_qode_register_sidebars' )) {
    /**
     * Function that registers theme's sidebars
     */
    function startit_qode_register_sidebars() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar','startit'),
            'id' => 'sidebar',
            'description' => esc_html__('Default Sidebar','startit'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));

    }

    add_action('widgets_init', 'startit_qode_register_sidebars');
}

if(!function_exists( 'startit_qode_add_support_custom_sidebar' )) {
    /**
     * Function that adds theme support for custom sidebars. It also creates QodeStartitSidebar object
     */
    function startit_qode_add_support_custom_sidebar() {
        add_theme_support('QodeStartitSidebar');
        if (get_theme_support('QodeStartitSidebar')) new QodeStartitSidebar();
    }

    add_action('after_setup_theme', 'startit_qode_add_support_custom_sidebar');
}
