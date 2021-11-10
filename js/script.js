jQuery( function ( $ ) {
	var $body = $( 'body' );

	var $window = $( window );
	const slickSlider = () => {
		$( '.home__banner-wrapper' ).slick( {
			autoplay: true,
			autoplaySpeed: 5000,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			arrows: false,
			rows: 0,
			adaptiveHeight: true,
		} );
		$( '.product_list' ).slick( {
			slidesToShow: 5,
			slidesToScroll: 1,
			dots: false,
			arrows: true,
			rows: 0,
			responsive: [ {
					breakpoint: 768,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 400,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		} );
		$( '.product-categrory-content' ).slick( {
			slidesToShow: 4,
			slidesToScroll: 1,
			dots: false,
			arrows: true,
			rows: 0,
			responsive: [ {
					breakpoint: 768,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 400,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		} );


		$( '.box_image-product' ).slick( {
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.box_image-product-slider'
		} );
		$( '.box_image-product-slider' ).slick( {
			slidesToShow: 4,
			asNavFor: '.box_image-product',
			centerMode: true,
			focusOnSelect: true
		} );
	};

	const tabsProduct = () => {
		$( '.nav-pill  li' ).on( 'click', function () {
			$( '.nav-pill li' ).removeClass( 'active' );
			$( this ).addClass( 'active' );
			$tab = $( this ).data( 'id' );

			let tabs = $( '.content' );
			tabs.each( function () {
				console.log( $( this ).hasClass( $tab ) );
				if ( $( this ).hasClass( $tab ) ) {
					$( this ).addClass( 'show' )
				} else {
					$( this ).removeClass( 'show' );
				}
			} )

		} );
		$( '.category-menu' ).on( 'click', function () {
			$( '.filter-category' ).toggleClass( 'show' );
		} );
		$( '.header_bottom .category' ).mouseover( function () {
			$( '.filter-category' ).addClass( 'show' );
		} )
		$( '.header_bottom .category' ).mouseout( function () {
			$( '.filter-category' ).removeClass( 'show' );
		} )
	}

	const filterProductArchive = () => {
		const $form = $( '.filters' );
		$form.on( 'change', 'select', function () {
			$form.submit();
		} )
	}

	const filterproduct_khuyenmai = () => {
		$( '.filter-category_khuyenmai li' ).on( 'click', function () {
			$( '.filter-category_khuyenmai li' ).removeClass( 'active' );
			$( this ).addClass( 'active' );
			$data = $( this ).data( 'tab' );
			let datas = $( '.product-item' );
			datas.each( function () {
				if ( $( this ).hasClass( $data ) ) {
					$( this ).addClass( 'shows' )
				} else {
					$( this ).removeClass( 'shows' );
				}
			} )
		} )
	}

	let toggleAccount = () => {
		$( '.menu-account svg' ).on( 'click', function ( e ) {
			e.stopPropagation(); // do not trigger event on .site
			$( '.menu-account__wrapper' ).toggleClass( 'menu-account-open' );
		} );
	}

	let popupLogout = () => {
		$( '.popup-modal' ).magnificPopup( {
			type: 'inline',
			preloader: false,
			modal: true
		} );
		$( document ).on( 'click', '.popup-modal-dismiss', function ( e ) {
			e.preventDefault();
			$.magnificPopup.close();
		} );
	}

	function sosanh() {
		$( '#filter' ).on( 'click', function () {
			$( '.seclect-product-list' ).toggleClass( 'show' )
		} )
		$( '#inputFilter' ).on( 'keyup', function () {
			var val = $( this ).val().toLowerCase();
			$( '.product-lists #product' ).filter( function () {

				$( this ).toggle( $( this ).text().toLowerCase().indexOf( val ) > -1 );
			} )
		} );
		$( '.product-lists  .product_item' ).on( 'click', function () {
			let ID    = $( this ).data( 'id' );
			let link  = $( this ).data( 'link' );
			let title = $( this ).data( 'title' );
			$.ajax( {
				type: "POST",
				url: link,
				data: {
					action: "filter",
					id: ID,
				},
				success: function ( response ) {
					$( '.dislay-product' ).html( response.product );
					$( '.seclect-product-list' ).toggleClass( 'show' );
					$( '.lable' ).text( title );
					$( '.product-sosanh' ).css( 'height', '1500px' )
				}
			} );
		} )
		// filter 2

		$( '#filter2' ).on( 'click', function () {
			$( '.seclect-product-list2' ).toggleClass( 'show' )
		} )
		$( '#inputFilter2' ).on( 'keyup', function () {
			var val = $( this ).val().toLowerCase();
			$( '.product-list2 #product2' ).filter( function () {
				$( this ).toggle( $( this ).text().toLowerCase().indexOf( val ) > -1 );
			} )
		} )

		$( '.product-list2  .product_item' ).on( 'click', function () {
			let ID = $( this ).data( 'id' );
			let link = $( this ).data( 'link' );
			let title = $( this ).data( 'title' );
			$.ajax( {
				type: "POST",
				url: link,
				data: {
					action: "filter",
					id: ID,
					lable: 'right-filter'
				},
				success: function ( response ) {
					$( '.dislay-product2' ).html( response.product );
					$( '.seclect-product-list2' ).toggleClass( 'show' );
					$( '.lable2' ).text( title );
					$( '.product-sosanh' ).css( 'height', '1500px' )
				}
			} );
		} );
		// filter 3
		$( '#filter3' ).on( 'click', function () {
			$( '.seclect-product-list3' ).toggleClass( 'show' )
		} )
		$( '#inputFilter3' ).on( 'keyup', function () {
			var val = $( this ).val().toLowerCase();
			$( '.product-list3 #product3' ).filter( function () {
				$( this ).toggle( $( this ).text().toLowerCase().indexOf( val ) > -1 );
			} )
		} )

		$( '.product-list3  .product_item' ).on( 'click', function () {
			let ID = $( this ).data( 'id' );
			let link = $( this ).data( 'link' );
			let title = $( this ).data( 'title' );
			$.ajax( {
				type: "POST",
				url: link,
				data: {
					action: "filter",
					id: ID,
					lable: 'right-filter'
				},
				success: function ( response ) {
					$( '.dislay-product3' ).html( response.product );
					$( '.seclect-product-list3' ).toggleClass( 'show' );
					$( '.lable3' ).text( title );
					var height = $( '.filter-product-content' ).height();
					$( '.product-sosanh' ).css( 'height', height + 200 )
				}
			} );
		} );

		var height = $( '.filter-product-content' ).height();
		let name   = $( '.filter-product-content' ).data( 'name' );
		if ( name === 'undefined' ) {
			$( '.lable' ).text( 'Chọn sản phẩm để so sánh' );
		} else {
			$( '.lable' ).text( name );
		}
		$( '.product-sosanh' ).css( 'height', height + 200 )
	}

	let validateForm = () => {
		// Detect 'change' or 'keyup' ở title và check.
		const $form = $( '#voucher_info' ),
			$button = $form.find( '.rwmb-form-submit button' ),
			$title = $form.find( '#post_title' );

		// Disable button ngay khi load.
		$button.prop( 'disabled', true );
		$( 'input#post_title' ).focus();

		$title.on( 'input', function () {
			$( '.post-title-error' ).remove();
			$.post( Data.ajaxUrl, {
				action: 'kn_check_title_voucher',
				title: $title.val(),
			}, function ( response ) {
				if ( !response.success ) {
					// alert( response.data );
					$title.after( '<p class="post-title-error">' + response.data + '</p>' );
					$button.prop( 'disabled', true );
					return;
				}

				// Nếu title unique, bật lại button submit.
				$( '.post-title-error' ).remove();
				$button.prop( 'disabled', false );
			} );
		} );
	}

	let popupForm = () => {
		$( '.popup-form' ).magnificPopup( {
			type: 'inline',
			closeBtnInside: true,
			preloader: false,
		} );

		$( '.item-title' ).on( 'click', function () {

			$( '.item-title' ).removeClass( 'active' );
			$( '.item-content' ).removeClass( 'show' );
			$( this ).addClass( 'active' );
			$tab = $( this ).data( 'id' );

			$( '#' + $tab ).addClass( 'show' );
		} );
	}


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

	function clicktichdiem() {
		$( '.tichdiem' ).on( 'click', function () {
			$( '.popup_tichdiem' ).toggleClass( 'show' );
		} );
	}
	function scrolltop() {

		var offset = 220;
		var duration = 500;

		$( window ).scroll( function() {
			if ( $( this ).scrollTop() > offset ) {
				$( '#back-to-top' ).fadeIn( duration );
			} else {
				$( '#back-to-top' ).fadeOut( duration );
			}
		} );

		$( '#back-to-top' ).click( function( event ) {
			event.preventDefault();
			$( 'html, body' ).animate( { scrollTop: 0 }, duration );
			return false;
		} );
	}
	$( window ).on( 'load', setDistrict );

	let caculatorLoiNhuan = () => {
		$( 'input[name="by_price"]' ).on( 'input', function () {
			const $by_price = $(this).val(),
				$parent      = $(this).parent(),
				$price_web   = $parent.siblings( 'td[data-price-web]' ).data( 'price-web' ),
				$price_ship  = $parent.siblings( 'td[data-price-ship]' ).data( 'price-ship' ),
				$price_ctv   = $parent.siblings( 'td[data-price-ctv]' ).data( 'price-ctv' ),
				$sales_bonus = $parent.siblings( 'td[data-sales-bonus]' ).data( 'sales-bonus' ),
				$loi_nhuan   = $price_web - $by_price - $price_ctv - $price_ship + $sales_bonus;

			$parent.siblings( '.column-loi-nhuan' ).text( eFormatNumber( 0, 3, '.', ',', parseFloat( $loi_nhuan ) ) + '₫' );
		} );
		$( 'input[name="by_percent"]' ).on( 'input', function () {
			const $by_percent = $(this).val(),
				$parent           = $(this).parent(),
				$price_web        = $parent.siblings( 'td[data-price-web]' ).data( 'price-web' ),
				$price_ship       = $parent.siblings( 'td[data-price-ship]' ).data( 'price-ship' ),
				$price_ctv        = $parent.siblings( 'td[data-price-ctv]' ).data( 'price-ctv' ),
				$sales_bonus      = $parent.siblings( 'td[data-sales-bonus]' ).data( 'sales-bonus' ),
				$price_by_percent = $price_web * $by_percent / 100;
				$loi_nhuan   = $price_web - $price_by_percent - $price_ctv - $price_ship + $sales_bonus;

			$parent.siblings( '.column-loi-nhuan' ).text( eFormatNumber( 0, 3, '.', ',', parseFloat( $loi_nhuan ) ) + '₫' );
		} );
	}

	function eFormatNumber(n, x, s, c, number) {
		var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
			num = number.toFixed(Math.max(0, ~~n));
		return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
	}


	slickSlider();
	tabsProduct();
	filterProductArchive();
	filterproduct_khuyenmai();
	toggleAccount();
	popupLogout();
	scrolltop();
	sosanh();
	if ( $body.hasClass( 'page-id-191' ) ) {
		validateForm();
	}
	popupForm();
	selectDistrictByCity();
	selectWardByDistrict();
	clicktichdiem();
	caculatorLoiNhuan();
} );