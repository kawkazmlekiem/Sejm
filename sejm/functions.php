<?php

/// Setup
 define('TEMPLATE_DIR', get_template_directory());

/// Includes
include(TEMPLATE_DIR . '/includes/front/enqueue.php');
include(TEMPLATE_DIR . '/includes/backend/register_mp_cpt.php');
include(TEMPLATE_DIR . '/includes/backend/import_mp.php');
include(TEMPLATE_DIR . '/includes/backend/import_mp_image.php');
include(TEMPLATE_DIR . '/includes/backend/import_voting_stats.php');

/// Hooks
add_action('wp_enqueue_scripts', 'u_enqueue');
add_action('init', 'register_mp_cpt');

if (!wp_next_scheduled('parliament_import_mp')) {
    wp_schedule_event(time(), 'daily', 'parliament_import_mp');
}
add_action('parliament_import_mp', 'import_mp');
do_action('parliament_import_mp');
?>