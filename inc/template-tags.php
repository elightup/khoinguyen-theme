<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package khoinguyen
 */

if (!function_exists('khoinguyen_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function khoinguyen_posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('Posted on %s', 'post date', 'khoinguyen'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('khoinguyen_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function khoinguyen_posted_by()
	{
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s', 'post author', 'khoinguyen'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('khoinguyen_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function khoinguyen_entry_footer()
	{
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'khoinguyen'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'khoinguyen') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'khoinguyen'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'khoinguyen') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'khoinguyen'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', 'khoinguyen'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if (!function_exists('khoinguyen_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function khoinguyen_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

	<?php
		endif; // End is_singular().
	}
endif;

if (!function_exists('wp_body_open')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;

function khoinguyen_get_categrory()
{

	$terms = get_terms(array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,

	));

	?>
	<div class="categroty">
		<div class="categroty-menu">
			<div class="categroty-menu-icon">
				<img src="<?php echo get_template_directory_uri(); ?>/images/menu.png" alt="">
			</div>
			<p class="categroty-menu-title">
				Danh mục sản phẩm
			</p>
		</div>
		<div class="filter-categroty">
			<ul>

				<?php
				foreach ($terms as $term) {
				?>
					<li data-tab="<?php echo $term->slug ?>">
						<a href="<?php echo get_term_link($term->slug, 'nganh-hang'); ?>"><?php echo $term->name; ?></a>

					</li>
				<?php
				}
				?>
			</ul>
		</div>
	<?php

}
function kn_entry_title()
{
	the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
}
function kn_filter_home()
{

	$terms = get_terms(array(
		'taxonomy'   => 'nganh-hang',
		'hide_empty' => false,

	));
	?>

		<div class="filter-categroty">
			<h4>Danh mục: </h4>
			<ul>
				<?php
				foreach ($terms as $term) {
				?>
					<li data-tab="<?php echo $term->slug ?>">
						<?php echo $term->name; ?>
					</li>
				<?php
				}
				?>
			</ul>
		</div>

	<?php
}
function kn_get_path()
{
	echo	'<div class="box_path">';
	yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
	echo	'</div>';
}
function kn_get_mota()
{
	$mota = rwmb_meta('mo_ta', get_queried_object_id());
	if (empty($mota)) {
		return;
	}
	?>
		<div class="content-mota">
			<?php echo $mota ?>
		</div>
	<?php
}
function kn_currency_format( $number ) {
	$number = $number * 1000;
	return number_format( $number, 0, ',', '.' ) . ' ₫';
}
function kn_get_posts_categrory()
{
	$terms = get_the_category(get_queried_object_id());


	$ids = array_map(function ($term) {
		return $term->term_id;
	}, $terms);
	$args  = array(
		'posts_per_page'   	=> 10,
		'post_type'      => 'product',
		'post__not_in'     	=> array(get_the_ID()),
		'category__in'		=> $ids,
	);
	$query = new WP_Query($args);
	if (!$query->have_posts()) {
		return;
	}
	while ($query->have_posts()) :
		$query->the_post();
		get_template_part('template-parts/content', 'product');
	endwhile;
	wp_reset_postdata();
}
function kn_filter_product()
{
	$args  = array(

		'post_type'      => 'product',

	);
	$query = new WP_Query($args);

	?>
	<div class="select-product">
		<Label></Label>
	</div>
	<input type="text" name="" id="">
	<?php
	if (!$query->have_posts()) {
		return;
	}
	while ($query->have_posts()) :
		$query->the_post();
		
	endwhile;
	wp_reset_postdata();
}
