<?php
function shortcode_get_categrory()
{
	ob_start();
	$terms = get_terms(array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,

	));

?>


	<div class="filter-category">
		<ul>

			<?php
			foreach ($terms as $term) {
			?>
				<li data-tab="<?php echo $term->slug ?>">
					<a href="<?php echo $term->slug ?>"><?php echo $term->name; ?></a>
				</li>
			<?php
			}
			?>
		</ul>
	</div>
<?php
	return ob_get_clean();
}
add_shortcode('menu_nganh', 'shortcode_get_categrory');

function shortcode_get_banchay()
{
	ob_start();

	$args = [
		'post_type'      => 'product',
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'tag',
				'field' => 'slug',
				'terms' => array('noi-bat'),
				'include_children' => true,
				'operator' => 'IN'
			)

		),
	];

	$query = new WP_Query($args);
?>
	<div class="box_product_sidebar">
		<?php
		while ($query->have_posts()) :
			$query->the_post();
			$price = rwmb_meta('price', get_the_ID());
			$priceCV = rwmb_meta('price_nhap', get_the_ID());
		?>

			<div class="product_sidebar">
				<div class="product_sidebar-content">
					<div class="product-img">
						<a class="post-img" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>
					<div class="product_sidebar-meta">
						<?php
						kn_entry_title();

						?>
					</div>
				</div>
				<div class="product_sidebar-price">
					<p class="price"><?php echo kn_currency_format($price ? $price : 0) ?></p>
					<p class="price-sale"><?php echo kn_currency_format($priceCV ? $priceCV : 0) ?></p>

				</div>
			</div>
		<?php
		endwhile;
		wp_reset_postdata();
		return ob_get_clean();
		?>
	</div>
<?php
}
add_shortcode('get_banchay', 'shortcode_get_banchay');
