<?php
add_action( 'wp_ajax_display_districts', 'display_districts' );
add_action( 'wp_ajax_nopriv_display_districts', 'display_districts' );
function display_districts() {
	if ( empty( $_POST['city'] ) ) {
		wp_send_json_error();
	}
	$city_id   = $_POST['city'];
	$districts = kn_get_districts_from_city( $city_id );
	$response  = [];
	foreach( $districts as $key => $district ) {
		$response[] = [
			$key => $district
		];
	}
	wp_send_json_success( $response );
}


add_action( 'wp_ajax_display_wards', 'display_wards' );
add_action( 'wp_ajax_nopriv_display_wards', 'display_wards' );
function display_wards() {
	if ( empty( $_POST['district'] ) ) {
		wp_send_json_error();
	}
	$district_id = $_POST['district'];
	$wards       = kn_get_wards_from_district( $district_id );
	$response    = [];
	foreach( $wards as $key => $ward ) {
		$response[] = [
			$key => $ward
		];
	}
	wp_send_json_success( $response );
}