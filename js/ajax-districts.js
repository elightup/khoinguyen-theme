jQuery( function( $ ) {
	let selectDistrictByCity = () => {
		let defaultDistrict = '<option value="">Chọn Quận / Huyện</option>';
		$( document ).on( 'change', '.cities select', function () {
			var city = $( this ).val();
			var $district = $( this ).parents( '.cities' ).next().find( 'select' );
			var data = {
				action: 'display_districts',
				city: city
			};

			$.post( Data.ajaxUrl, data ).done( function ( response ) {
				var options = get_options_from_response( response, defaultDistrict );
				$district.html( options ).val( null );
			} );
		} );
	}

	let selectWardByDistrict = () => {
		let defaultWard = '<option value="">Chọn Xã / Phường</option>';
		$( document ).on( 'change', '.districts select', function () {
			var district = $( this ).val();
			var $ward = $( this ).parents( '.districts' ).next().find( 'select' );
			var data = {
				action: 'display_wards',
				district: district
			};

			$.post( Data.ajaxUrl, data ).done( function ( response ) {
				var options = get_options_from_response( response, defaultWard );
				$ward.html( options ).val( null );
			} );
		} );
	}


	function get_options_from_response( response, defaultOptions ) {
		if ( response.success ) {
			var data = response.data;
			data.forEach( function ( district ) {
				var entry = Object.entries( district )[ 0 ];
				defaultOptions += '<option value="' + entry[ 0 ] + '">' + entry[ 1 ] + '</option>';
			} );
		}
		return defaultOptions;
	}

	function setDistrict() {
		let option_districts = '',
			option_wards = '';
		$.each( Data.all_districts[ Data.province ], function ( index, districts ) {
			option_districts += '<option value="' + index + '">' + districts + '</option>';
		} );
		$.each( Data.all_wards[ Data.district ], function ( index, districts ) {
			option_wards += '<option value="' + index + '">' + districts + '</option>';
		} );

		let districts = '<option selected value="' + Data.district + '">' + Data.all_districts[ Data.province ][ Data.district ] + '</option>' + option_districts,
			ward = '<option selected value="' + Data.ward + '">' + Data.all_wards[ Data.district ][ Data.ward ] + '</option>' + option_wards;
		$( '.districts select' ).html( districts );
		$( '.wards select' ).html( ward );
	}
	$( window ).on( 'load', setDistrict );

	selectDistrictByCity();
	selectWardByDistrict();
} );