

jQuery(function ($) {
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
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});
	};

	const tabsProduct = () => {
		$('.nav-pill  li').on('click', function (){

			$('.nav-pill li').removeClass('active');
			$(this).addClass('active');
			$tab= $(this).data('id');
			
			let tabs=$('.content');
			tabs.each(function(){
				console.log($(this).hasClass($tab));
				if($(this).hasClass($tab)){
					$(this).addClass('show')
				}else {
					$(this).removeClass('show');
				}
			})

		})
	}

	slickSlider();
	tabsProduct();
});
