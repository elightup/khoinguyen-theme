<?php
function khoinguyen_body_classes($classes) {
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'khoinguyen_body_classes');

// Giờ đến phần lọc.

// Em cần tìm hiểu về action pre_get_posts nhé.
add_action( 'pre_get_posts', 'kn_filter_product_archive' );

function kn_filter_product_archive( $query ) {
	// Chỉ lọc ở trang archive product.
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( 'product' ) ) {
		return;
	}

	$tax_query = [
		'relation' => 'AND',		
	];
	// Lọc theo ngành hàng.
	$nganh_hang = isset( $_GET['filter-nganh-hang'] ) ? wp_strip_all_tags( $_GET['filter-nganh-hang'] ) : '';
	if ( $nganh_hang ) {
		$tax_query[] = [
			'taxonomy' => 'nganh-hang',
			'field' => 'slug',
			'terms' => $nganh_hang
		];
	}
	// Lọc theo hãng
	$hang = isset( $_GET['filter-hang'] ) ? wp_strip_all_tags( $_GET['filter-hang'] ) : '';
	if ( $hang) {
		$tax_query[] = [
			'taxonomy' => 'hang',
			'field' => 'slug',
			'terms' => $hang,
		];
	}
	// Lọc theo kiểu lắp đặt
	$kieu_lap_dat = isset( $_GET['filter-kieu-lap-dat'] ) ? wp_strip_all_tags( $_GET['filter-kieu-lap-dat'] ) : '';
	if ( $kieu_lap_dat ) {
		$tax_query[] = [
			'taxonomy' => 'kieu_lap_dat',
			'field' => 'slug',
			'terms' => $kieu_lap_dat,
		];
	}
	// Lọc theo loại m
	$loai_may = isset( $_GET['filter-loai-may'] ) ? wp_strip_all_tags( $_GET['filter-loai-may'] ) : '';
	if ( $loai_may ) {
		$tax_query[] = [
			'taxonomy' => 'loai_may',
			'field' => 'slug',
			'terms' => $loai_may,
		];
	}	
	$loai_may = isset( $_GET['filter-loai-may'] ) ? wp_strip_all_tags( $_GET['filter-loai-may'] ) : '';
	$query->set( 'tax_query', $tax_query );

	// Lọc theo giá.
	$gia = isset( $_GET['filter-gia'] ) ? wp_strip_all_tags( $_GET['filter-gia'] ) : '';
	if ( $gia ) {
		$meta_query = [];

		if ( $gia == '5' ) {
			$meta_query[] = [
				'key' => 'price',
				'value' => 5000000,
				'compare' => '<',
				'type' => 'NUMERIC',
			];
		} elseif ( $gia == '5-7' ) {
			$meta_query[] = [
				'key' => 'price',
				'value' => 5000000,
				'compare' => '>=',
				'type' => 'NUMERIC',
			];
			$meta_query[] = [
				'key' => 'price',
				'value' => 7000000,
				'compare' => '<',
				'type' => 'NUMERIC',
			];
		} elseif ( $gia == '7-15' ) {
			$meta_query[] = [
				'key' => 'price',
				'value' => 7000000,
				'compare' => '>=',
				'type' => 'NUMERIC',
			];
			$meta_query[] = [
				'key' => 'price',
				'value' => 15000000,
				'compare' => '<',
				'type' => 'NUMERIC',
			];
		} elseif ( $gia == '15' ) {
			$meta_query[] = [
				'key' => 'price',
				'value' => 15000000,
				'compare' => '>=',
				'type' => 'NUMERIC',
			];
		}

		$query->set( 'meta_query', $meta_query );
	}
}
add_action( 'pre_get_posts', 'my_change_sort_order'); 
function my_change_sort_order($query){
    if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( 'product' ) ) {
		return;
	}
    $sap_xep = isset( $_GET['filter-sap-xep'] ) ? wp_strip_all_tags( $_GET['filter-sap-xep'] ) : '';
	if($sap_xep) {
		$meta_query = [];
		if($sap_xep == '1') {
			$query->set( 'order', 'DESC' );
			$query->set( 'orderby', 'date' ); 
		}elseif ($sap_xep == '2') {
			$query->set( 'order', 'ASC' );
			$query->set( 'orderby', 'date' ); 
		}
	
	}
}
    

