<?php
$price          = rwmb_meta( 'price', get_the_ID() );
$price_pre_sale = rwmb_meta( 'price_pre_sale', get_the_ID() );
$code           = rwmb_meta( 'code', get_the_ID() );
$number         = rwmb_meta( 'number', get_the_ID() );

?>

<div class="box_single-top row">
	<div class="box_img col-md-4">
		<div class="box_image-product">
			<?php
			$images = rwmb_meta( 'anh_san_pham', get_the_ID() );
			if ( empty( $images ) ) {
				the_post_thumbnail();
			}
			foreach ( $images as $image ) :
				$image_product = wp_get_attachment_image_url( $image['image_product'], 'full' );

			?>
				<div class="box_image">
					<img src="<?= $image_product ?>" loading="lazy">
				</div>

			<?php endforeach ?>

		</div>
		<div class="box_image-product-slider">
			<?php
			foreach ( $images as $image ) :
				$image_product = wp_get_attachment_image_url( $image['image_product'], 'full' );

			?>
				<div class="box_image">
					<img src="<?= $image_product ?>" loading="lazy">
				</div>
			<?php endforeach ?>

		</div>
	</div>
	<div class="box_product-content col-md-8 ">

		<div class="box_product-title">
			<div class="box_name">
				<?php
				if( $price_pre_sale ) {
					kn_get_phantram( $price_pre_sale ? $price_pre_sale : 0, $price ? $price : 0 );
				}
				?>
				<?php the_title( '<h1 class="product-title">', '</h1>' ) ?>
			</div>
			<div class="box_product-status">
				<p class="status row">
					<span class="status-item col-lg-4">
						<i class="bi bi-check-circle"></i>
						Tình trạng: <?php if ( $number > 0 ) {
										echo 'Còn hàng';
									} else {
										echo '<pan  style="color: red;">Hết hàng </pan>';
									}
									?>
					</span>
					<span class="status-item col-lg-4">
						<i class="bi bi-check-circle"></i>
						Mã sản phẩm: <?php echo $code ?>
					</span>
					<span class="status-item col-lg-4">
						<i class="bi bi-check-circle"></i>
						Vận chuyển: Miễn phí
					</span>
				</p>
			</div>
		</div>

		<div class="box_product-price">
			<div class="product-price">
				<?php if( $price_pre_sale ) : ?>
					<span class="price-pre-sale"><?php echo kn_currency_format( $price_pre_sale ? $price_pre_sale : 0 ) ?></span>
				<?php endif; ?>
				<span class="price"><?php echo kn_currency_format( $price ? $price : 0 ) ?></span>
			</div>
			<div class="Product-compare">
				<a href="<?= home_url(); ?>/so-sanh?id=<?php echo get_the_ID(); ?>">
					<i class="bi bi-arrow-left-right"></i>
					So sánh sản phẩm
				</a>
			</div>
		</div>

		<div class="box_product-discription">
			<?php kn_get_mota() ?>
		</div>

		<?php if ( rwmb_meta( 'gift' ) ): ?>
			<div class="box_product-khuyenmai">
				<h3>Khuyến mãi</h3>
				<span><?= rwmb_meta( 'gift' ); ?></span>
			</div>
		<?php endif ?>

		<div class="box_product-share">
			<div class="product_share-item">
				<p>
					Sẵn hàng tại:
					<span>Hà Nội</span>
				</p>
			</div>
			<div class="">
                Hotline:
				<a href="tel:0836491368">	
                    <span>083.649.1368</span>
				</a>
                -
                <a href="tel:0837421368">   
                    <span>083.742.1368</span>
                </a>
			</div>
			<div class="product_share-item">
				<p>Chia sẻ:</p>

				<div class="zalo-share-button icon " data-href="<?php the_permalink(); ?>" data-oaid="579745863508352884" data-layout="2" data-color="blue" data-customize="true">
					<img src="<?= get_template_directory_uri(); ?>/images/logo-zalo.jpg" alt="" sizes="50px 50px" srcset="">
				</div>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="icon"> <img src="<?= get_template_directory_uri(); ?>/images/facebook.png" alt="" sizes="50px 50px" srcset=""></a>

			</div>
		</div>

		<div class="box_product-datmua">
			<?php
			$id = get_current_user_id();
			$product_id = get_the_ID();

			$cart = get_user_meta( $id, 'cart', true );
			if ( empty( $cart ) || ! is_array( $cart ) ) {
				$cart = [];
			}
			$cart_product_id = [];

			foreach ( $cart as $key => $value ) {
				$cart_product_id[] = $key;
			}
			if ( in_array( get_the_ID(), $cart_product_id ) ) : ?>
				<a href="<?= home_url(); ?>/gio-hang" class="btn btn-them added">Đã thêm vào giỏ </a>
				<a href="<?= home_url(); ?>/gio-hang" class="btn btn-muangay" data-product="<?= $product_id; ?>">Mua ngay </a>

			<?php else: ?>
				<a href="#" class="btn btn-them single-add-to-cart" data-info="<?= esc_attr( wp_json_encode( kn_get_product_info( $product_id ) ) ); ?>" data-product="<?= $product_id; ?>">Thêm vào giỏ hàng</a>
				<a href="#" class="btn btn-muangay single-buynow" data-info="<?= esc_attr( wp_json_encode( kn_get_product_info( $product_id ) ) ); ?>" data-product="<?= $product_id; ?>">Mua ngay</a>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="box_featured-product row">
	<div class="featured-item  col-md-6">
		<div class="box_featured-img">
			<img src="<?php echo get_template_directory_uri() ?>/images/sanpham.jpg" alt="">
		</div>
		<div class="box_featured-content">
			<p class="featured-top">Sản Phẩm Mới Nhất</p>
			<p class="featured-bottom">Luôn cung cấp sản phẩm mới nhất</p>
		</div>
	</div>

	<div class="featured-item  col-md-6">
		<div class="box_featured-img">
			<img src="<?php echo get_template_directory_uri() ?>/images/sanpham_2.jpg" alt="">
		</div>
		<div class="box_featured-content ">
			<p class="featured-top">Mức Giá Phù Hợp</p>
			<p class="featured-bottom">Tiết kiệm chi phí cho mọi người</p>
		</div>
	</div>

	<div class="featured-item col-md-6">
		<div class="box_featured-img">
			<img src="<?php echo get_template_directory_uri() ?>/images/sanpham_3.jpg" alt="">
		</div>
		<div class="box_featured-content">
			<p class="featured-top">Sản Phẩm Chính Hãng</p>
			<p class="featured-bottom">Được nhập trực tiếp từ hãng</p>
		</div>
	</div>

	<div class="featured-item  col-md-6">
		<div class="box_featured-img">
			<img src="<?php echo get_template_directory_uri() ?>/images/sanpham_4.jpg" alt="">
		</div>
		<div class="box_featured-content">
			<p class="featured-top">An toàn & Uy Tín</p>
			<p class="featured-bottom">Với hơn 3.000 khách hàng</p>
		</div>
	</div>
	<div class="featured-item  col-md-6">
		<div class="box_featured-img">
			<img src="<?php echo get_template_directory_uri() ?>/images/sanpham_5.jpg" alt="">
		</div>
		<div class="box_featured-content">
			<p class="featured-top">Thanh Toán Bảo Mật</p>
			<p class="featured-bottom">Hỗ trợ nhiều hình thức thanh toán</p>
		</div>
	</div>
</div>