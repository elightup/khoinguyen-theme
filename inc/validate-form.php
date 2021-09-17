<?php
add_action( 'wp_ajax_check_title_voucher', 'check_title_voucher' );
function check_title_voucher() {
	global $wpdb;

	if ( isset($_POST['post_title'] ) ) {
		$post_title = $_POST['post_title'];
		$post_id    = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_type = 'voucher' AND post_title = '" . $post_title . "'" );
		if ( $post_id ) {
			echo json_encode( 'Mã voucher đã tồn tại' );
		} else {
			echo json_encode( ' ' );
		}
	}

	exit();
}
