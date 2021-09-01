

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
	const filterproduct=()=>{
		$('.filter-categroty li').on('click',function(){
			$('.filter-categroty li').removeClass('active');
			$(this).addClass('active');
			$data=$(this).data('tab');
			
			let datas=$('.product-item');
			datas.each(function(){
				
				if($(this).hasClass($data)){
					$(this).addClass('shows')
				}else {
					$(this).removeClass('shows');
				}
			})
		})

	}
	slickSlider();
	tabsProduct();
	filterproduct();
});
