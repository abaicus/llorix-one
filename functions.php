<?php

add_action( 'wp_enqueue_scripts', 'llorix_one_enqueue_styles' );
function llorix_one_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

?>