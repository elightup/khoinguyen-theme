<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package khoinguyen
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" media="print" onload="this.media='all'">
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'khoinguyen'); ?></a>

		<header id="masthead" class="site-header ">
			<div class="header-sidebar">
				<div class="sidebar-top container">
					<?php dynamic_sidebar('menu-top') ?>
				</div>

			</div>
			<div class="header_top ">
				<div class="container row">
					<div class="header_top-logo">
						<?php
						the_custom_logo();
						?>
					</div>
					<div class="header_top-search">
						<form action="/" method="get" class="header-search">
							<input type="hidden" name="post_type" value="product">
							<input type="text" name="s" id="quick-search" placeholder="Tìm kiếm nhanh...">
							<div class="btn-search">
								<img src="<?php echo get_template_directory_uri(); ?>/images/search.png" alt="">

							</div>
						</form>
					</div>
					<div class="header_top-contact">

						<p class="contact">
							<strong>
								<span>Tổng đài:</span>
							</strong>
							<strong>
								<span>0966 000 862</span>
							</strong>
						</p>
						<img src="<?php echo get_template_directory_uri(); ?>/images/support.png" alt="">
					</div>
				</div>
			</div>
			<div class="header_bottom ">

				<div class="header_bottom-categrory container">
					<?php khoinguyen_get_categrory(); ?>
				</div>
				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'khoinguyen'); ?></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
				<div class="header_bottom-cart">
					<?php if ( ! is_user_logged_in() ): ?>
						<a href="<?php echo esc_url( home_url() ); ?>/dang-nhap">Đăng nhập</a>
					<?php else :
						$current_user = wp_get_current_user();
					?>
						<span>Chào bạn, <?php echo $current_user->display_name; ?></span>
					<?php endif ?>

					<?php get_template_part( 'template-parts/mini-cart' ) ?>
				</div>
			</div>
		</header><!-- #masthead -->
		<div class="content container" id="content">