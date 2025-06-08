<?php
function votings_stats($post_id) {
	$mp_id = get_post_meta($post_id, 'mp_api_id', true);
	$api_stats = file_get_contents('https://api.sejm.gov.pl/sejm/term10/MP/' . $mp_id . '/votings/stats');

	if(!$api_stats)
		return;

	$api_stats_array = 	json_decode($api_stats, true);
	update_post_meta($post_id, 'mp_api_voting_stats', $api_stats_array);
}
?>