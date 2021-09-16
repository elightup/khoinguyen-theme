<?php
$terms = wp_get_object_terms(get_the_ID(),'nganh-hang', array('orderby' => 'name', 'order' => 'DESC', 'fields' => 'all'));
$terms1 = get_the_terms(get_the_ID(), 'tag');
$price = rwmb_meta('price', get_the_ID());
$priceCV = rwmb_meta('price_nhap', get_the_ID());
$Qtang = rwmb_meta('gift', get_the_ID());
$class1      = '';
$class     = '';
$terms2 = get_the_terms(get_the_ID(), 'nganh-hang');
if (!empty($terms2) && is_array($terms2)) {
    $post_terms2 = array();
    foreach ($terms2 as $term2) {
        $post_terms2[] = $term2->term_id;
    }

    $categories = get_terms('nganh-hang', array(
        'orderby' => 'name',//required for woocommerce
        'order' => 'desc',//required for woocommerce
        'include' => $post_terms2,
    ));
}
if ($terms) {
	foreach ($terms as $term) {
		$class .= $term->slug . ' ';
	};
}
if ($terms1) {
	foreach ($terms1 as $term1) {
		$class1 .= $term1->slug . ' ';
	};
}

?>

<article class="product-item shows <?php echo $class; ?>">
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

			<p class="price-sale"><?php echo kn_currency_format($priceCV ? $priceCV : 0) ?></p>
			<p class="price"><?php echo kn_currency_format($price ? $price : 0) ?></p>
		</div>

		<?php
		if (empty($Qtang)) {
			echo '<div class="product-khuyenmai-none"></div>';
		} else {
			echo '<div class="product-khuyenmai">';
			echo '<p>' . $Qtang . '</p>';
			echo '</div>';
		}
		?>
	
	</div>
	<?php kn_get_phantram($price ? $price : 0, $priceCV ? $priceCV : 0) ?>
</article>
<article class="product-item shows <?php echo $class1; ?>">
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

			<p class="price-sale"><?php echo kn_currency_format($priceCV ? $priceCV : 0) ?></p>
			<p class="price"><?php echo kn_currency_format($price ? $price : 0) ?></p>
		</div>

		<?php
		if (empty($Qtang)) {
			echo '<div class="product-khuyenmai-none"></div>';
		} else {
			echo '<div class="product-khuyenmai">';
			echo '<p>' . $Qtang . '</p>';
			echo '</div>';
		}
		?>
	
	</div>
	<?php kn_get_phantram($price ? $price : 0, $priceCV ? $priceCV : 0) ?>
</article>