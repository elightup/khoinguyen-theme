<?php
$terms = get_the_terms(get_the_ID(),'nganh-hang');
$terms_hang = get_the_terms(get_the_ID(), 'hang');
$terms_kieulapdat = get_the_terms(get_the_ID(), 'kieu-lap-dat');
$terms_loaimay = get_the_terms(get_the_ID(), 'loai-may');
$price = rwmb_meta('price', get_the_ID());
$priceCV = rwmb_meta('price_nhap', get_the_ID());
$Qtang = rwmb_meta('gift', get_the_ID());
$class     = '';
$class_hang     = '';
$class_kieulapdat     = '';
$class_loaimay      = '';
if ($terms) {
	foreach ($terms as $term) {
		$class .= $term->slug . ' ';
	};
}
if ($terms_hang) {
	foreach ($terms_hang as $term_hang) {
		$class_hang .= $term_hang->slug . ' ';
	};
}
if ($terms_kieulapdat) {
	foreach ($terms_kieulapdat as $term_kieulapdat) {
		$class_kieulapdat .= $term_kieulapdat->slug . ' ';
	};
}
if ($terms_loaimay) {
	foreach ($terms_loaimay as $term_loaimay) {
		$class_loaimay .= $term_loaimay->slug . ' ';
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
<article class="product-item shows <?php echo $class_hang; ?>">
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
<article class="product-item shows <?php echo $class_kieulapdat; ?>">
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
<article class="product-item shows <?php echo $class_loaimay; ?>">
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