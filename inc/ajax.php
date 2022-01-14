<?php
add_action( 'wp_ajax_display_districts', 'display_districts' );
add_action( 'wp_ajax_nopriv_display_districts', 'display_districts' );
function display_districts() {
	$city = (int) filter_input( INPUT_POST, 'city', FILTER_SANITIZE_NUMBER_INT );

	if ( empty( $city ) ) {
		wp_send_json_error();
	}
	$districts = kn_get_districts_from_city( $city );
	$response  = [];
	foreach ( $districts as $key => $district ) {
		$response[] = [
			$key => $district,
		];
	}
	wp_send_json_success( $response );
}


add_action( 'wp_ajax_display_wards', 'display_wards' );
add_action( 'wp_ajax_nopriv_display_wards', 'display_wards' );
function display_wards() {
	$district = (int) filter_input( INPUT_POST, 'district', FILTER_SANITIZE_NUMBER_INT );

	if ( empty( $district ) ) {
		wp_send_json_error();
	}
	$wards    = kn_get_wards_from_district( $district );
	$response = [];
	foreach ( $wards as $key => $ward ) {
		$response[] = [
			$key => $ward,
		];
	}
	wp_send_json_success( $response );
}
