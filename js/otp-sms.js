jQuery( function ( $ ) {
	let check_otp = () => {
		$( '.form-otp input' ).on( 'keydown', function (e) {
			if ( e.keyCode == 13 ) {
				var user_id = OTP.user_id;

				$.post( OTP.ajaxUrl, {
					action: 'kn_check_otp',
					otp: $(this).val(),
					user_id: user_id,
				}, function ( response ) {
					if ( ! response.success ) {
						$( '.form-otp__message' ).html( response.data );
						return;
					}
					$( '.form-otp__message' ).html( response.data.message );
					setTimeout( () => {
						location.href = response.data.url;
					}, 5000);
				} );
			}
		} );
		$( '.form-otp a.btn' ).on( 'click', function (e) {
			e.preventDefault();
			var user_id = OTP.user_id;

			$.post( OTP.ajaxUrl, {
				action: 'kn_check_otp',
				otp: $(this).prev().val(),
				user_id: user_id,
			}, function ( response ) {
				if ( ! response.success ) {
					$( '.form-otp__message' ).html( response.data );
					return;
				}
				$( '.form-otp__message' ).html( response.data.message );
				setTimeout( () => {
					location.href = response.data.url;
				}, 5000);
			} );
		} );
	}

	let resend_otp = () => {
		$( '.form-otp-resend a' ).on( 'click', function (e) {
			e.preventDefault();
			var user_id = OTP.user_id;

			$.post( OTP.ajaxUrl, {
				action: 'kn_resend_otp',
				user_id: user_id,
			}, function ( response ) {
				if ( ! response.success ) {
					$( '.form-otp__message' ).html( response.data );
					return;
				}
				$( '.form-otp__message' ).html( response.data );
			} );
		} );
	}

	check_otp();
	resend_otp();
} );