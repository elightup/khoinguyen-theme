<?php
$terms = get_the_terms(get_the_ID(), 'nganh-hang');

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

				<p class="price-sale">3.950.000</p>
				<p class="price">4.950.000</p>
			</div>
			<div class="product-khuyenmai">
				<p>Bộ quà tặng lên đến 2.000.000Đ</p>
			</div>
		</div>
	</article>
