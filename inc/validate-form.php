<?php
add_action( 'wp_ajax_kn_check_title_voucher', 'kn_check_title_voucher' );
add_action( 'wp_ajax_nopriv_kn_check_title_voucher', 'kn_check_title_voucher' );
function kn_check_title_voucher() {
	global $wpdb;

	$post_title     = isset( $_POST['title'] ) ? $_POST['title'] : '';
	$user_id        = get_current_user_id();
	$prefix_voucher = get_user_meta( $user_id, 'prefix_voucher', true ) ? get_user_meta( $user_id, 'prefix_voucher', true ) : '';
	// $unicode        = ["à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ","ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ","ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ","ỳ","ý","ỵ","ỷ","ỹ","đ","À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ","È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ","Ì","Í","Ị","Ỉ","Ĩ","Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ","Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ","Ỳ","Ý","Ỵ","Ỷ","Ỹ","Đ"];

	if ( empty( $post_title ) ) {
		$message = 'Bạn cần nhập tên mã';
		wp_send_json_error( $message );
	}


	$pattern = "/[ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]/";

	# $pattern = "/[^A-Za-z0-9]/";

	if ( preg_match( $pattern, $post_title ) ) {
		$message = 'Bạn hãy nhập tên không dấu';
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
		$prefix = strtoupper( get_user_meta( get_current_user_id(), 'prefix_voucher', true ) );
		if ( strpos( $meta, $prefix ) === 0 ) {
			$meta = substr( $meta, strlen( $prefix ) );
		}

		return $meta;
	}, 20, 3 );
} );