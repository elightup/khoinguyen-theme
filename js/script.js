jQuery(function($){


 slickSlider=()=>{
    $().slick({
        autoplay:true,
			autoplaySpeed:5000,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			arrows: false,
			rows: 0,
			adaptiveHeight: true
    })
};

slickSlider();
});