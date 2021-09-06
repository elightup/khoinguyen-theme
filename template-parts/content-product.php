<?php
$terms = get_the_terms(get_the_ID(), 'nganh-hang');
$price=rwmb_meta('price',get_the_ID());
$priceCV=rwmb_meta('price_nhap',get_the_ID());
$class      = '';

if ($terms) {
	foreach ($terms as $term) {
		$class .= $term->slug . ' ';
	};
}
?>

	<article class="product-item shows <?php echo $class;?>">
		<div class="product-thumb">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
		<div class="product-meta">
			<?php
			kn_entry_title();

			?>
			<div class="product-price">

				<p class="price-sale"><?php echo kn_currency_format( $priceCV?$priceCV:0) ?></p>
				<p class="price"><?php echo kn_currency_format( $price?$price:0) ?></p>
			</div>
			<div class="product-khuyenmai">
				<p>Bộ quà tặng lên đến 2.000.000Đ</p>
			</div>
		</div>
		<?php  kn_get_phantram($price?$price:0,$priceCV?$priceCV:0) ?>
	</article>
