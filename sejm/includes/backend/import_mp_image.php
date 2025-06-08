<?php
function ensure_mp_image_loaded($post_id) {
    if (has_post_thumbnail($post_id)) {
        return;
    }

    $mp_id = get_post_meta($post_id, 'mp_api_id', true);

    if (!$mp_id) return;

    $image_url = 'https://api.sejm.gov.pl/sejm/term10/MP/'. $mp_id . '/photo';

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

	$response = wp_remote_get($image_url);
	$image_data = wp_remote_retrieve_body($response);
	
	$filename = 'mp_' . $mp_id . '.jpg';

    $upload = wp_upload_dir();
    $file_path = $upload['path'] . '/' . $filename;

    if (!is_writable($upload['path'])) {
        error_log('No write permissions for: ' . $upload['path']);
        return null;
    }

    file_put_contents($file_path, $image_data);

    $filetype = wp_check_filetype($filename, null);

    $attachment = [
        'post_mime_type' => $filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit'
    ];

    $attach_id = wp_insert_attachment($attachment, $file_path);
	set_post_thumbnail( $post_id, $attach_id);
}
?>