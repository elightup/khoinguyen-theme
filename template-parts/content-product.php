<?php
$terms            = get_the_terms( get_the_ID(),'nganh-hang' );
$terms_hang       = get_the_terms( get_the_ID(), 'hang' );
$terms_kieulapdat = get_the_terms( get_the_ID(), 'kieu-lap-dat' );
$terms_loaimay    = get_the_terms( get_the_ID(), 'loai-may' );
$price            = rwmb_meta( 'price', get_the_ID() );
$price_pre_sale   = rwmb_meta( 'price_pre_sale', get_the_ID() );
$gift             = rwmb_meta( 'gift', get_the_ID() );
$class            = '';
$class_hang       = '';
$class_kieulapdat = '';
$class_loaimay    = '';
if ( $terms ) {
	foreach ( $terms as $term ) {
		$class .= $term->slug . ' ';
	};
}
if ( $terms_hang ) {
	foreach ( $terms_hang as $term_hang ) {
		$class_hang .= $term_hang->slug . ' ';
	};
}
if ( $terms_kieulapdat ) {
	foreach ( $terms_kieulapdat as $term_kieulapdat ) {
		$class_kieulapdat .= $term_kieulapdat->slug . ' ';
	};
}
if ( $terms_loaimay ) {
	foreach ( $terms_loaimay as $term_loaimay ) {
		$class_loaimay .= $term_loaimay->slug . ' ';
	};
}
?>

<article class="product-item shows <?php echo $class,$class_hang,$class_kieulapdat,$class_loaimay; ?>">
	<div class="product-thumb">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
		<?php
		if ( $price_pre_sale ) {
			kn_get_phantram( $price ? $price : 0, $price_pre_sale ? $price_pre_sale : 0 );
		}
		?>
	</div>
	<div class="product-meta">
		<?php
		kn_entry_title();

		?>
		<div class="product-price">
			<?php if( $price_pre_sale ) : ?>
                <p class="price-pre-sale"><?php echo kn_currency_format( $price_pre_sale ? $price_pre_sale : 0 ) ?></p>
            <?php endif; ?>
            <p class="price"><?php echo kn_currency_format( $price ? $price : 0 ) ?></p>
		</div>

		<?php
		if ( empty( $gift ) ) {
			echo '<div class="product-khuyenmai-none"></div>';
		} else {
			echo '<div class="product-khuyenmai">';
			echo '<p>' . $gift . '</p>';
			echo '</div>';
		}
		?>
	</div>
</article>
