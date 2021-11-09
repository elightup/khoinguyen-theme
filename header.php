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
					<div class="header_bottom-cart">
						<?php if (!is_user_logged_in()) : ?>
							<a href="#form-login-register" class="popup-form">Đăng nhập</a>
							<?php get_template_part('template-parts/form-login-register'); ?>
						<?php else :
							$current_user = wp_get_current_user();
							$user_id   = $current_user->ID;
							$user_name = get_user_meta($user_id, 'user_name', true);
							$user_name = $user_name ? $user_name : $current_user->display_name;
							$wallet    = get_user_meta($user_id, 'wallet', true) ? get_user_meta($user_id, 'wallet', true) : 0;
						?>
							<span>Chào bạn, <?php echo $user_name; ?></span>
							<span class="tichdiem">Số dư: <?php echo number_format($wallet, 0, ',', '.') . ' ₫';; ?>
								<div class="popup_tichdiem show1">
									<ul>
										<p>Tài khoản tích điểm khi mua hàng, mỗi 1000đ giá trị đơn hàng sẽ được tính thành 1 điểm. Điểm được sử dụng đổi mã giảm giá, quà tặng, tiền mặt. Cảm ơn quý khách đã ủng hộ 1368Store.</p>
									</ul>
								</div>
							</span>
						<?php endif ?>

						<?php get_template_part('template-parts/mini-cart') ?>
					</div>
					<?php if (is_user_logged_in()) : ?>
						<div class="menu-account d-flex">
							<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars" class="svg-inline--fa fa-bars fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
							</svg>
							<div class="menu-account__wrapper">
								<ul>
									<li>
										<svg>
											<use xlink:href="#icon-user" />
										</svg>
										<a href="<?php echo esc_url(home_url()); ?>/thong-tin-tai-khoan/">Thông tin tài khoản</a>
									</li>
									<li>
										<svg>
											<use xlink:href="#icon-check" />
										</svg>
										<a href="<?php echo esc_url(home_url()); ?>/don-hang-cua-toi/">Đơn hàng của tôi</a>
									</li>
									<?php
									$role = wp_get_current_user()->roles[0];
									if ($role == 'ctv') : ?>
										<li>
											<svg>
												<use xlink:href="#icon-check" />
											</svg>
											<a href="<?php echo esc_url(home_url()); ?>/san-pham-duoc-ap-dung-voucher-cua-ban/">Lợi nhuận</a>
										</li>
										<li>
											<svg>
												<use xlink:href="#icon-check" />
											</svg>
											<a href="<?php echo esc_url(home_url()); ?>/lich-su-thanh-toan/">Lịch sử thanh toán</a>
										</li>
										<li>
											<svg>
												<use xlink:href="#icon-check" />
											</svg>
											<a href="<?php echo esc_url(home_url()); ?>/gia-nhap-san-pham-cua-ctv/">Giá nhập sản phẩm của CTV</a>
										</li>
										<li>
											<svg>
												<use xlink:href="#icon-check" />
											</svg>
											<a href="<?php echo esc_url(home_url()); ?>/tao-ma-giam-gia/">Tạo mã giảm giá</a>
										</li>
										<li>
											<svg>
												<use xlink:href="#icon-check" />
											</svg>
											<a href="<?php echo esc_url(home_url()); ?>/danh-sach-ma-giam-gia-cua-ban/">Mã giảm giá của bạn</a>
										</li>
									<?php endif ?>
									<li>
										<svg>
											<use xlink:href="#icon-logout" />
										</svg>
										<a class="popup-modal" href="#popup-logout">Đăng xuất</a>
									</li>
								</ul>
							</div>
						</div>
						<div id="popup-logout" class="popup-logout mfp-hide white-popup-block">
							<h3>Xin xác nhận</h3>
							<p>Bạn có muốn chắc đăng xuất.</p>
							<a class="btn-secondary wp-block-button__link popup-modal-dismiss">Không</a>
							<a class="btn-primary wp-block-button__link" href="<?= wp_logout_url(home_url()); ?>">Có</a>
						</div>
					<?php endif ?>
				</div>
			</div>

			<div class="header_top ">
				<div class="container row">
					<div class="header_top-logo">
						<?php if (is_front_page()) : ?>
							<h1 class="site-title">
								<a href="<?php echo esc_url(home_url()); ?>" rel="home"><?php bloginfo('name'); ?></a>
							</h1>
						<?php else : ?>
							<h3 class="site-title">
								<a href="<?php echo esc_url(home_url()); ?>" rel="home"><?php bloginfo('name'); ?></a>
							</h3>
						<?php endif; ?>
						<?php the_custom_logo(); ?>
					</div>
					<div class="header_top-contact">
						<p class="contact">
							<strong>
								<span>Hotline:</span>
							</strong>
							<strong>
								<img src="<?php echo get_template_directory_uri(); ?>/images/phone.png" alt="">&nbsp;
								<span class="phone">
									<a href="tel:0836491368">083.649.1368</a>
									-
									<a href="tel:0837421368">083.742.1368</a>
								</span>
							</strong>
						</p>
					</div>
					<div class="header_top-search">
						<form action="<?php echo esc_url(home_url()); ?>/" method="get" class="header-search">
							<input type="hidden" name="post_type" value="product">
							<input type="text" name="s" id="quick-search" placeholder="Tìm kiếm sản phẩm">
							<div class="btn-search">
								<span><img src="<?php echo get_template_directory_uri(); ?>/images/search.png" alt=""></span>
							</div>
						</form>
					</div>

				</div>
			</div>
			<div class="header_bottom">
				<div class="container d-flex">
					<div class="header_bottom-categrory">
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
				</div>
			</div>
		</header><!-- #masthead -->
		<div class="content container" id="content">