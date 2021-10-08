<?php
add_action( 'wp_ajax_kn_check_title_voucher', 'kn_check_title_voucher' );
add_action( 'wp_ajax_nopriv_kn_check_title_voucher', 'kn_check_title_voucher' );
function kn_check_title_voucher() {
	global $wpdb;

	$post_title     = isset( $_POST['title'] ) ? $_POST['title'] : '';
	$user_id        = get_current_user_id();
	$prefix_voucher = get_user_meta( $user_id, 'prefix_voucher', true ) ? get_user_meta( $user_id, 'prefix_voucher', true ) : '';

	if ( empty( $post_title ) ) {
		$message = 'Bạn cần nhập tên mã';
		wp_send_json_error( $message );
	}
	
	$post_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_type = 'voucher' AND post_title = '" . $prefix_voucher . $post_title . "'" );
	if ( $post_id ) {
		$message = 'Mã voucher đã tồn tại';
		wp_send_json_error( $message );
	} else {
		wp_send_json_success();
	}
	
}


add_filter( 'rwmb_frontend_insert_post_data', 'kn_add_voucher_prefix', 10, 2 );
add_filter( 'rwmb_frontend_update_post_data', 'kn_add_voucher_prefix', 10, 2 );
function kn_add_voucher_prefix( $data, $config ) {
	if ( $config['id'] !== 'voucher_info' ) {
		return $data;
	}
	$user_id            = get_current_user_id();
	$prefix_voucher     = get_user_meta( $user_id, 'prefix_voucher', true ) ? get_user_meta( $user_id, 'prefix_voucher', true ) : '';
	$data['post_title'] = strtoupper( $prefix_voucher . $data['post_title'] );
	return $data;
}

add_action( 'rwmb_frontend_before_form', function() {
	add_filter( 'rwmb_post_title_field_meta', function( $meta, $field, $saved ) {
		$prefix = get_user_meta( get_current_user_id(), 'prefix_voucher', true );
		if ( strpos( $meta, $prefix ) === 0 ) {
			$meta = substr( $meta, strlen( $prefix ) );
		}

		return $meta;
	}, 20, 3 );
} );