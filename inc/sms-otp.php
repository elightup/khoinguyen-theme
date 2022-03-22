<?php
/**
 * Send otp message.
 */
function kn_send_otp( $random_otp, $phone ) {
	$body = json_encode( [
		'ApiKey'    => '6FAFC2B53487D4A40D1D6C7C3EDE5D',
		'Content'   => '1368Store : Ma OTP dang ky cua quy khach la ' . $random_otp . ', truy cap website https://1368store.vn/ de nhap thong tin. Vui long su dung ma OTP nay trong vong 15 phut.',
		'Phone'     => $phone,
		'SecretKey' => 'E990A5FF385519F7E23E26F031AE24',
		'Brandname' => '1368Store',
		'SmsType'   => '2',
	], JSON_UNESCAPED_UNICODE );

	$request  = wp_remote_get( 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_post_json', [
		'headers' => [
			'Content-Type' => 'application/json',
		],
		'method'  => 'POST',
		'body'    => $body,
		'timeout' => 15,
	] );
	$response = json_decode( $request['body'], true );
	return $response;
}

/**
 * Update random_otp after register user.
 */
function gtt_update_user( $object ) {
	$id_form = $object->config['id'];

	if ( $id_form === 'thong-tin-user,thong-tin-khac-ctv' || $id_form === 'thong-tin-user' ) {
		$random_otp = rand( 100000, 999999 );
		update_user_meta( $object->user_id, 'random_otp', $random_otp );
		update_user_meta( $object->user_id, 'random_otp_time', strtotime( current_time( 'mysql' ) ) );
		// Send random_otp to phone user
		$user_data  = get_userdata( $object->user_id );
		$user_phone = $user_data->user_login;
		kn_send_otp( $random_otp, $user_phone );
	}

}
add_action( 'rwmb_profile_after_save_user', 'gtt_update_user' );

/**
 * Redirect to otp page when register
 */
// function kn_redirect( $redirect, $config ) {
// $information_submit = substr( $redirect, strpos( $redirect, '=' ) + 1 );
// if ( 'register-form' === $config['form_id'] && 'error' !== $information_submit ) {
// $redirect = home_url() . '/nhap-ma-otp/';
// }
// return $redirect;
// }
// add_filter( 'rwmb_profile_redirect', 'kn_redirect', 10, 2 );

function kn_redirect( $config, $user_id ) {
	if ( ( 'thong-tin-user,thong-tin-khac-ctv' === $config['id'] || 'thong-tin-user' === $config['id'] ) && ! empty( $user_id ) ) {
		wp_safe_redirect( home_url() . '/nhap-ma-otp?user_id=' . $user_id );
		exit;
	}
}
add_action( 'rwmb_profile_after_process', 'kn_redirect', 10, 2 );


/**
 * Check mã xác thực before Login
 */
function kn_check_otp( $user ) {
	if ( ! $user instanceof WP_User ) {
		return;
	}
	$otp_code = get_user_meta( $user->ID, 'otp_code' );
	if ( empty( $otp_code ) ) {
		$text = 'Tài khoản của bạn chưa được xác thực! Bấm <a href="' . esc_url( home_url() ) . '/nhap-ma-otp?user_id=' . $user->ID . '"> vào đây </a> để nhập mã OTP';
		$user = new WP_Error( 'broke', $text );
	}
	return $user;
}
add_filter( 'wp_authenticate_user', 'kn_check_otp' );

/**
 * Check nhập mã OTP
 */
add_action( 'wp_ajax_kn_check_otp', 'kn_check_otp_message' );
add_action( 'wp_ajax_nopriv_kn_check_otp', 'kn_check_otp_message' );
function kn_check_otp_message() {
	$otp             = isset( $_POST['otp'] ) ? $_POST['otp'] : '';
	$user_id         = isset( $_POST['user_id'] ) ? $_POST['user_id'] : '';
	$random_otp_user = get_user_meta( $user_id, 'random_otp', true );

	$random_otp_time = (int) get_user_meta( $user_id, 'random_otp_time', true );
	$current_time    = strtotime( current_time( 'mysql' ) );

	if ( empty( $otp ) ) {
		$message = 'Bạn cần nhập OTP';
		wp_send_json_error( $message );
	}

	if ( $current_time > $random_otp_time + 900 ) {
		$message = 'Mã OTP đã hết hạn';
		wp_send_json_error( $message );
	}

	if ( $otp === $random_otp_user ) {
		update_user_meta( $user_id, 'otp_code', $random_otp_user );
		$message = 'Tài khoản của bạn đã xác thực thành công! <br>
		Website sẽ tự động chuyển hướng về trang chủ sau 5s <br>
		Tài khoản đăng ký cộng tác viên của bạn đang được xem xét chờ duyệt (Thời gian duyệt từ 1-2 ngày ).<br>
		Tài khoản được duyệt sẽ có thông báo qua mail đăng ký';

		// Login after register.
		$meta_user = get_user_meta( $user_id );
		$user      = new WP_User( $user_id );
		wp_set_current_user( $user_id, $meta_user['nickname'] );
		wp_set_auth_cookie( $user_id );
		do_action( 'wp_login', $meta_user['nickname'], $user );

		$return = [
			'message' => $message,
			'url'     => home_url(),
		];
		wp_send_json_success( $return );
	} else {
		$message = 'Mã OTP không đúng!';
		wp_send_json_error( $message );
	}
}


/**
 * Gửi lại mã OTP
 */
add_action( 'wp_ajax_kn_resend_otp', 'kn_resend_otp' );
add_action( 'wp_ajax_nopriv_kn_resend_otp', 'kn_resend_otp' );
function kn_resend_otp() {
	$random_otp = rand( 100000, 999999 );
	$user_id    = isset( $_POST['user_id'] ) ? $_POST['user_id'] : '';

	if ( empty( $user_id ) ) {
		$message = 'Tài khoản không hợp lệ';
		wp_send_json_error( $message );
	}

	update_user_meta( $user_id, 'random_otp', $random_otp );
	update_user_meta( $user_id, 'random_otp_time', strtotime( current_time( 'mysql' ) ) );
	// Send random_otp to phone user
	$user_data  = get_userdata( $user_id );
	$user_phone = $user_data->user_login;
	kn_send_otp( $random_otp, $user_phone );

	$message = 'Đã gửi lại mã OTP';
	wp_send_json_success( $message );
}
