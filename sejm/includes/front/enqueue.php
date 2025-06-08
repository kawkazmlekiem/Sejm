<?php

function u_enqueue() {
    wp_register_style( 
    'parliament-style',
     get_stylesheet_directory_uri() . '/styles/style.css'
     );

    wp_enqueue_style( 'parliament-style' );
}