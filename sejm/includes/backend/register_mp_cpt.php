<?php
function register_mp_cpt() {
    register_post_type('mp', [
        'label' => 'MP',
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'mp'],
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
    ]);
}
?>