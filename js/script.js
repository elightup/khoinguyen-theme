jQuery(function ($) {
	var $body = $('body');

	var $window = $(window);
	const slickSlider = () => {
		$('.home__banner-wrapper').slick({
			autoplay: true,
			autoplaySpeed: 5000,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			arrows: false,
			rows: 0,
			adaptiveHeight: true,
		});
		$('.product_list').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			dots: false,
			arrows: true,
			rows: 0,
			responsive: [
				{
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
		});
		$('.product-categrory-content').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			dots: false,
			arrows: true,
			rows: 0,
			responsive: [
				{
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
		});



		$('.box_image-product').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.box_image-product-slider'
		});
		$('.box_image-product-slider').slick({
			slidesToShow: 4,

			asNavFor: '.box_image-product',
			centerMode: true,

			focusOnSelect: true
		});
	};

	const tabsProduct = () => {
		$('.nav-pill  li').on('click', function () {

			$('.nav-pill li').removeClass('active');
			$(this).addClass('active');
			$tab = $(this).data('id');

			let tabs = $('.content');
			tabs.each(function () {
				console.log($(this).hasClass($tab));
				if ($(this).hasClass($tab)) {
					$(this).addClass('show')
				} else {
					$(this).removeClass('show');
				}
			})

		});
		$('.category-menu').on('click',function(){
			$('.filter-category').toggleClass('show');
		});
		$('.category').mouseover(function(){
			$('.filter-category').addClass('show');
		})
		$('.category').mouseout(function(){
			$('.filter-category').removeClass('show');
		})
	}

	const filterProductArchive = () => {
		const $form = $( '.filters' );
		$form.on( 'change', 'select', function () {
			$form.submit();
		})
	}

	const filterproduct_khuyenmai = () =>{
		$('.filter-category_khuyenmai li').on('click', function () {
			$('.filter-category_khuyenmai li').removeClass('active');
			$(this).addClass('active');
			$data = $(this).data('tab');
			let datas = $('.product-item');
			datas.each(function () {

				if ($(this).hasClass($data)) {
					$(this).addClass('shows')
				} else {
					$(this).removeClass('shows');
				}
			})
		})
	}

	let toggleAccount = () => {
		$('.menu-account svg').on('click', function (e) {
			e.stopPropagation(); // do not trigger event on .site
			$('.menu-account__wrapper').toggleClass('menu-account-open');
		});
	}

	let popupLogout = () => {
		$('.popup-modal').magnificPopup({
			type: 'inline',
			preloader: false,
			modal: true
		});
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
	}
	function sosanh() {
		$('#filter').on('click', function () {
			$('.seclect-product-list').toggleClass('show')
		})
		$('#inputFilter').on('keyup', function () {
			var val = $(this).val().toLowerCase();
			$('.product-list #product').filter(function () {

				$(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
			})
		});
		$('.product-list  .product_item').on('click', function () {
			let ID = $(this).data('id');
			let link = $(this).data('link');
			let title = $(this).data('title');
			$.ajax({
				type: "get",
				dataType: "html",
				url: link,
				data: {
					action: "filter",
					id: ID,
				},

				success: function (response) {
					$('.dislay-product').html(response);
					$('.seclect-product-list').toggleClass('show');
					$('.lable').text(title);
					var height = $('.filter-product-content').height();
					$('.product-sosanh').css('height', height + 200)
				}
			});
		})


		$('#filter2').on('click', function () {
			$('.seclect-product-list2').toggleClass('show')
		})
		$('#inputFilter2').on('keyup', function () {
			var val = $(this).val().toLowerCase();
			$('.product-list2 #product2').filter(function () {

				$(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
			})
		})

		$('.product-list2  .product_item').on('click', function () {
			let ID = $(this).data('id');
			let link = $(this).data('link');
			let title = $(this).data('title');
			$.ajax({
				type: "get",
				dataType: "html",
				url: link,
				data: {
					action: "filter",
					id: ID,
					lable: 'right-filter'
				},

				success: function (response) {
					$('.dislay-product2').html(response);
					$('.seclect-product-list2').toggleClass('show');
					$('.lable2').text(title);
					var height = $('.filter-product-content').height();
					$('.product-sosanh').css('height', height + 200)

				}
			});
		})

		var height = $('.filter-product-content').height();
		name = $('.filter-product-content').data('name');
		if (name === 'undefined') {
			$('.lable').text('Chọn sản phẩm để so sánh');
		} else {
			$('.lable').text(name);
		}
		$('.product-sosanh').css('height', height + 200)

	}

	let validateForm = () => {
		// Detect 'change' or 'keyup' ở title và check.
		const $form = $( '#voucher_info' ),
			$button = $form.find( '.rwmb-form-submit button' ),
			$title  = $form.find( '#post_title' );

		// Disable button ngay khi load.
		$button.prop( 'disabled', true );

		$title.on( 'input', function() {
			$( '.post-title-error' ).remove();
			$.post( Data.ajaxUrl, {
				action: 'kn_check_title_voucher',
				title: $title.val(),
			}, function( response ) {
				if ( ! response.success ) {
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
			$(this).addClass( 'active' );
			$tab = $(this).data( 'id' );

			$( '#' + $tab ).addClass( 'show' );

			// let tabs = $( '.content' );
			// tabs.each( function () {
			// 	if ( $(this).hasClass( $tab ) ) {
			// 		$(this).addClass( 'show' )
			// 	} else {
			// 		$(this).removeClass( 'show' );
			// 	}
			// } )

		} );
	}





	slickSlider();
	tabsProduct();
	filterProductArchive();
	filterproduct_khuyenmai();
	toggleAccount();
	popupLogout();
	sosanh();
	validateForm();
	popupForm();
});
