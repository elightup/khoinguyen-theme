<?php
function khoinguyen_setup() {
	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'khoinguyen' ),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'khoinguyen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function khoinguyen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'khoinguyen_content_width', 640 );
}
add_action( 'after_setup_theme', 'khoinguyen_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function khoinguyen_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'khoinguyen' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'khoinguyen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'menu top', 'khoinguyen' ),
			'id'            => 'menu-top',
			'description'   => esc_html__( 'Add widgets here.', 'khoinguyen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'menu home', 'khoinguyen' ),
			'id'            => 'sidebar-home',
			'description'   => esc_html__( 'Add widgets here.', 'khoinguyen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'sidebar Sản phẩm', 'khoinguyen' ),
			'id'            => 'sidebar-product',
			'description'   => esc_html__( 'Add widgets here.', 'khoinguyen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'sidebar right', 'khoinguyen' ),
			'id'            => 'sidebar-right',
			'description'   => esc_html__( 'Add widgets here.', 'khoinguyen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'sidebar footer-left', 'khoinguyen' ),
			'id'            => 'sidebar-footer-left',
			'description'   => esc_html__( 'Add widgets here.', 'khoinguyen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'sidebar footer-right', 'khoinguyen' ),
			'id'            => 'sidebar-footer-right',
			'description'   => esc_html__( 'Add widgets here.', 'khoinguyen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('sidebar footer-center', 'khoinguyen'),
			'id'            => 'sidebar-footer-center',
			'description'   => esc_html__('Add widgets here.', 'khoinguyen'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'khoinguyen_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function khoinguyen_scripts() {
	wp_enqueue_style( 'slick', get_template_directory_uri().'/css/slick.css' );
	wp_enqueue_style( 'magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', [], '1.1.0' );
	wp_enqueue_style( 'khoinguyen-style', get_stylesheet_uri(), array(), '1.0' );
	wp_style_add_data( 'khoinguyen-style', 'rtl', 'replace' );

	wp_enqueue_script( 'khoinguyen-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );
	wp_enqueue_script( 'khoinguyen-slick', get_template_directory_uri() . '/js/slick.js', array(), '1.0', true );
	wp_enqueue_script('khoinguyen-magnific', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '1.0', true);

	wp_enqueue_script( 'khoinguyen-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'khoinguyen-script', 'Data', [
		'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
		'province'      => get_user_meta( get_current_user_id(), 'user_province' ),
		'district'      => get_user_meta( get_current_user_id(), 'user_district' ),
		'ward'          => get_user_meta( get_current_user_id(), 'user_ward' ),
		'all_districts' => json_decode( file_get_contents( get_stylesheet_directory() . '/js/districts.json'), true ),
		'all_wards'     => json_decode( file_get_contents( get_stylesheet_directory() . '/js/wards.json'), true ),
	] );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'khoinguyen_scripts' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/shortcode.php';
require get_template_directory() . '/inc/validate-form.php';
require get_template_directory() . '/inc/ajax.php';


/*
 * Test send email with mailtrap
 */
function mailtrap( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host = 'smtp.mailtrap.io';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port = 2525;
	$phpmailer->Username = 'a00c6c3588510d';
	$phpmailer->Password = '8a3167c5fc0ee9';
}

add_action( 'phpmailer_init', 'mailtrap' );