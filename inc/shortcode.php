<?php
function shortcode_get_categrory()
{
    ob_start();
	$terms = get_terms(array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,

	));

	?>
	
		
		<div class="filter-categroty">
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
add_shortcode('menu_nganh','shortcode_get_categrory');