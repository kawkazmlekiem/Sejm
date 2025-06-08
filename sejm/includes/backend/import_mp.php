<?php
function import_mp() {
    $getData = file_get_contents('https://api.sejm.gov.pl/sejm/term10/MP');
    $data = json_decode($getData, true);

    foreach ($data as $person) {
        $full_name = $person['firstLastName'];

        $existing_query = new WP_Query([
            'post_type' => 'mp',
            'title' => $full_name,
            'posts_per_page' => 1,
            'fields' => 'ids',
        ]);

        if (!empty($existing_query->posts)) {
            $post_id = $existing_query->posts[0];
        } else {
            $post_id = wp_insert_post([
                'post_title' => $full_name,
                'post_type' => 'mp',
                'post_status' => 'publish',
            ]);

            if (is_wp_error($post_id)) {
                continue;
            }
        }

        if (!$post_id) continue;

        get_field('first_name', $post_id) !== $person['firstName'] ? 
		  update_field('first_name', $person['firstName'], $post_id) : '';
        get_field('last_name', $post_id) !== $person['lastName'] ? 
		  update_field('last_name', $person['lastName'], $post_id) : '';
		get_field('second_name', $post_id) !== $person['secondName'] ?   
        update_field('second_name', $person['secondName'], $post_id) : '';
		get_field('email', $post_id) !== $person['email'] ? 
        update_field('email', $person['email'], $post_id) : '';
		get_field('birth_date', $post_id) !== $person['birthDate'] ? 
        update_field('birth_date', $person['birthDate'], $post_id) : '';
		get_field('birth_location', $post_id) !== $person['birthLocation'] ? 
        update_field('birth_location', $person['birthLocation'], $post_id) : '';
		get_field('club', $post_id) !== $person['club'] ? 
        update_field('club', $person['club'], $post_id) : '';
		get_field('district_name', $post_id) !== $person['districtName'] ? 
        update_field('district_name', $person['districtName'], $post_id) : '';
		get_field('district_number', $post_id) !== $person['districtNum'] ?
        update_field('district_number', $person['districtNum'], $post_id) : '';
		get_field('voivodeship', $post_id) !== $person['voivodeship'] ?
        update_field('voivodeship', $person['voivodeship'], $post_id) : '';
		get_field('profession', $post_id) !== $person['profession'] ?
        update_field('profession', $person['profession'], $post_id) : '';
		get_field('number_of_votes', $post_id) !== $person['numberOfVotes'] ?
        update_field('number_of_votes', $person['numberOfVotes'], $post_id) : '';
		get_field('active', $post_id) !== $person['active'] ?
        update_field('active', $person['active'], $post_id) : '';
		get_field('education_level', $post_id) !== $person['educationLevel'] ?
        update_field('education_level', $person['educationLevel'], $post_id) : '';

		update_post_meta($post_id, 'mp_api_id', $person['id']);
	}
};
?>