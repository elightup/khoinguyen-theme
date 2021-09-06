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
				<?php if ( is_user_logged_in() ): ?>
					<div class="menu-account d-flex">
						<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars" class="svg-inline--fa fa-bars fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path></svg>
						<div class="menu-account__wrapper">
							<ul>
								<li>
									<svg><use xlink:href="#icon-user" /></svg>
									<a href="<?php echo esc_url( home_url() ); ?>/thong-tin-tai-khoan/">Thông tin tài khoản</a>
								</li>
								<li>
									<svg><use xlink:href="#icon-check" /></svg>
									<a href="<?php echo esc_url( home_url() ); ?>/don-hang-cua-toi/">Đơn hàng của tôi</a>
								</li>
								<li>
									<svg><use xlink:href="#icon-logout" /></svg>
									<a class="popup-modal" href="#popup-logout">Đăng xuất</a>
								</li>
							</ul>
						</div>
					</div>
					<div id="popup-logout" class="popup-logout mfp-hide white-popup-block">
						<h3>Xin xác nhận</h3>
						<p>Bạn có muốn chắc đăng xuất.</p>
						<a class="btn-secondary wp-block-button__link popup-modal-dismiss">Không</a>
						<a class="btn-primary wp-block-button__link" href="<?= wp_logout_url( '/' ); ?>">Có</a>
					</div>
				<?php endif ?>
			</div>
		</header><!-- #masthead -->
		<div class="content container" id="content">