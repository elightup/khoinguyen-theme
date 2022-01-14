<?php
/**
 * Send otp message.
 */
function kn_send_otp( $random_otp, $phone ) {
	$body = json_encode( [
		'ApiKey'    => '6FAFC2B53487D4A40D1D6C7C3EDE5D',
		'Content'   => $random_otp . ' la ma xac minh dang ky Baotrixemay cua ban',
		'Phone'     => $phone,
		'SecretKey' => 'E990A5FF385519F7E23E26F031AE24',
		'Brandname' => 'Baotrixemay',
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
		$user = new WP_Error( 'broke', 'Tài khoản của bạn chưa được xác thực!' );
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

	if ( empty( $otp ) ) {
		$message = 'Bạn cần nhập OTP';
		wp_send_json_success( $message );
	}

	if ( $otp === $random_otp_user ) {
		update_user_meta( $user_id, 'otp_code', $random_otp_user );
		$message = 'Tài khoản của bạn đã xác thực thành công!';
		wp_send_json_success( $message );
	} else {
		$message = 'Mã OTP không đúng!';
		wp_send_json_success( $message );
	}
}
