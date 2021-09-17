<?php
add_action( 'wp_ajax_kn_check_title_voucher', 'kn_check_title_voucher' );
add_action( 'wp_ajax_nopriv_kn_check_title_voucher', 'kn_check_title_voucher' );
function kn_check_title_voucher() {
	global $wpdb;

	$post_title = isset( $_POST['title'] ) ? $_POST['title'] : '';
	if ( empty( $post_title ) ) {
		$message = 'Bạn cần nhập tên mã';
		wp_send_json_error( $message );
	}
	
	$post_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_type = 'voucher' AND post_title = '" . $post_title . "'" );
	if ( $post_id ) {
		$message = 'Mã voucher đã tồn tại';
		wp_send_json_error( $message );
	} else {
		wp_send_json_success();
	}
	
}
