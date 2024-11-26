<?php
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'theme-options',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ));
}
function enqueue_theme_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

?>
