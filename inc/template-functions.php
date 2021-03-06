<?php
function khoinguyen_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1 ' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( is_user_logged_in() ) {
		$user       = wp_get_current_user();
		$roles_user = $user->roles[0];
		$classes[]  = $roles_user;
	}
	return $classes;
}
add_filter( 'body_class', 'khoinguyen_body_classes' );

add_action( 'wp_ajax_filter', 'filter_product' );
add_action( 'wp_ajax_nopriv_filter', 'filter_product' );
function filter_product() {

	$id    = isset( $_POST['id'] ) ? $_POST['id'] : false;
	$lable = isset( $_POST['lable'] ) ? $_POST['lable'] : false;
	$args  = array(
		'post_type' => 'product',
		'p'         => $id,
	);
	$query = new WP_Query( $args );
	ob_start();
	while ( $query->have_posts() ) :
		$query->the_post();
		$price          = rwmb_meta( 'price', get_the_ID() );
		$price_pre_sale = rwmb_meta( 'price_pre_sale', get_the_ID() );
		$code           = rwmb_meta( 'code', get_the_ID() );
		$kithuat        = rwmb_meta( 'thong_so_so_sanh', get_the_ID() );
		?>
	<div class="filter-product-content">
		<div class="filter-product-top <?php echo $lable ?>">
			<div class="box_image">
				<a class="post-thumbnail" href="<?php echo get_the_permalink(); ?>">
					<?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
				</a>
			</div>
			<div class="box_price">
				<?php if ( $price_pre_sale ) : ?>
				<span class="price-pre-sale"><?php echo kn_currency_format( $price_pre_sale ? $price_pre_sale : 0 ) ?></span>
				<?php endif; ?>
				<span class="price"><?php echo kn_currency_format( $price ? $price : 0 ) ?></span>
			</div>
			<div class="box_product-datmua">
				<?php
				$ID   = get_current_user_id();
				$cart = get_user_meta( $ID, 'cart', true );
				if ( empty( $cart ) || ! is_array( $cart ) ) {
					$cart = [];
				}
				$cart_product_id = [];
				foreach ( $cart as $key => $value ) {
					$cart_product_id[] = $key;
				}
				if ( in_array( get_the_ID(), $cart_product_id ) ) :
					?>
					<a href="<?= home_url(); ?>/gio-hang" class="btn btn-them">???? th??m v??o gi??? </a>
					<a href="<?= home_url(); ?>/gio-hang" class="btn btn-muangay" data-product="<?= get_the_ID(); ?>">Mua ngay
					</a>
				<?php else : ?>
				<a href="#" class="btn btn-them single-add-to-cart" data-product="<?= get_the_ID(); ?>">Th??m v??o gi???
					h??ng</a>
				<a href="#" class="btn btn-muangay single-buynow" data-product="<?= get_the_ID(); ?>">Mua ngay</a>
				<?php endif; ?>
			</div>
		</div>
		<div class="filter-product-bottom">
			<div class="box_items">
				<?php
				if ( ! $lable ) {
					echo '<p class="product-lable">
						M?? s???n ph???m
					</p>';
				}
				?>
				<div class="product-content">
					<?php echo $code ?>
				</div>
			</div>
			<div class="box_items">
				<?php
				if ( ! $lable ) {
					echo '<p class="product-lable">
						?????c ??i???m n???i b???t
					</p>';
				}
				?>
				<div class="product-content">
					<?php kn_get_mota() ?>
				</div>
			</div>
			<div class="box_items">
				<?php
				if ( ! $lable ) {
					echo '<p class="product-lable">
						Th??ng s??? k??? thu???t
					</p>';
				}
				?>
				<div class="product-content">
					<?php echo $kithuat ?>
				</div>
			</div>
		</div>
	</div>
		<?php
	endwhile;

	$html = ob_get_clean();
	wp_send_json( [
		'product' => $html,
	] );
}

add_action( 'pre_get_posts', 'kn_filter_product_archive' );
function kn_filter_product_archive( $query ) {
	// Ch??? l???c ??? trang archive product v?? term ng??nh h??ng.
	if ( is_admin() || ! $query->is_main_query() || ( ! $query->is_post_type_archive( 'product' ) && ! $query->is_tax( 'nganh-hang' ) ) ) {
		return;
	}
	$query->set( 'posts_per_page', 20 );

	$tax_query = [
		'relation' => 'AND',
	];
	// L???c theo ng??nh h??ng.
	$nganh_hang = isset( $_GET['filter-nganh-hang'] ) ? wp_strip_all_tags( $_GET['filter-nganh-hang'] ) : '';
	if ( $nganh_hang ) {
		$tax_query[] = [
			'taxonomy' => 'nganh-hang',
			'field'    => 'slug',
			'terms'    => $nganh_hang,
		];
	}
	// L???c theo h??ng
	$hang = isset( $_GET['filter-hang'] ) ? wp_strip_all_tags( $_GET['filter-hang'] ) : '';
	if ( $hang ) {
		$tax_query[] = [
			'taxonomy' => 'hang',
			'field'    => 'slug',
			'terms'    => $hang,
		];
	}
	$query->set( 'tax_query', $tax_query );

	// Custom Filter.
	$total_filter = kn_filter();
	$meta_query   = [
		'relation' => 'AND',
	];
	foreach ( $total_filter as $key => $value ) {
		$filter = isset( $_GET[ 'filter-' . $key ] ) ? wp_strip_all_tags( $_GET[ 'filter-' . $key ] ) : '';
		if ( $filter ) {
			$meta_query[] = [
				[
					'key'     => $key,
					'value'   => $filter,
					'type'    => 'CHAR',
					'compare' => '=',
				],
			];
		}
	}
	$query->set( 'meta_query', $meta_query );

	// sap xep
	$sap_xep = isset( $_GET['filter-sap-xep'] ) ? wp_strip_all_tags( $_GET['filter-sap-xep'] ) : '';
	if ( $sap_xep ) {
		if ( $sap_xep == '1' ) {
			$query->set( 'order', 'DESC' );
			$query->set( 'orderby', 'date' );
		} elseif ( $sap_xep == '2' ) {
			$query->set( 'orderby', 'date' );
			$query->set( 'order', 'ASC' );
		} elseif ( $sap_xep == '3' ) {
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'ASC' );
			$query->set( 'meta_key', 'price' );
		} elseif ( $sap_xep == '4' ) {
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'DESC' );
			$query->set( 'meta_key', 'price' );
		}
	}

	// L???c theo gi??.
	$gia = isset( $_GET['filter-gia'] ) ? wp_strip_all_tags( $_GET['filter-gia'] ) : '';
	if ( $gia ) {
		$meta_query = [];
		if ( $gia == '1' ) {
			$meta_query[] = [
				'key'     => 'price',
				'value'   => 1000000,
				'compare' => '<',
				'type'    => 'NUMERIC',
			];
		} elseif ( $gia == '1-3' ) {
			$meta_query[] = [
				'key'     => 'price',
				'value'   => 1000000,
				'compare' => '>=',
				'type'    => 'NUMERIC',
			];
			$meta_query[] = [
				'key'     => 'price',
				'value'   => 3000000,
				'compare' => '<',
				'type'    => 'NUMERIC',
			];
		} elseif ( $gia == '3-5' ) {
			$meta_query[] = [
				'key'     => 'price',
				'value'   => 3000000,
				'compare' => '>=',
				'type'    => 'NUMERIC',
			];
			$meta_query[] = [
				'key'     => 'price',
				'value'   => 5000000,
				'compare' => '<',
				'type'    => 'NUMERIC',
			];
		} elseif ( $gia == '5-10' ) {
			$meta_query[] = [
				'key'     => 'price',
				'value'   => 5000000,
				'compare' => '>=',
				'type'    => 'NUMERIC',
			];
			$meta_query[] = [
				'key'     => 'price',
				'value'   => 10000000,
				'compare' => '<',
				'type'    => 'NUMERIC',
			];
		} elseif ( $gia == '10' ) {
			$meta_query[] = [
				'key'     => 'price',
				'value'   => 10000000,
				'compare' => '>=',
				'type'    => 'NUMERIC',
			];
		}
		$query->set( 'meta_query', $meta_query );
	}
}


/**
 * Login after register.
 */
function kn_login( $object ) {
	$district  = $_POST['user_district'] ? $_POST['user_district'] : '';
	$ward      = $_POST['user_ward'] ? $_POST['user_ward'] : '';
	$meta_user = get_user_meta( $object->user_id );
	$user      = new WP_User( $object->user_id );

	// Update.
	update_user_meta( $object->user_id, 'user_district', $district );
	update_user_meta( $object->user_id, 'user_ward', $ward );
	update_user_meta( $object->user_id, 'user_id', $object->user_id );

	// Login after register.
	// wp_set_current_user( $object->user_id, $meta_user['nickname'] );
	// wp_set_auth_cookie( $object->user_id );
	// do_action( 'wp_login', $meta_user['nickname'], $user );
}
add_action( 'rwmb_profile_after_save_user', 'kn_login' );

/**
 * Update cites, ward ??? admin.
 */
function kb_update_cities( $user_id, $old_user_data ) {
	$district  = $_POST['user_district'] ? $_POST['user_district'] : '';
	$ward      = $_POST['user_ward'] ? $_POST['user_ward'] : '';
	$user_meta = get_user_meta( $user_id );
	$user_data = get_userdata( $user_id );

	// Update.
	update_user_meta( $user_id, 'user_district', $district );
	update_user_meta( $user_id, 'user_ward', $ward );
}
add_action( 'profile_update', 'kb_update_cities', 99, 2 );


function wp_insert_pay_ctv( $row_arrays = array(), $wp_table_name ) {
	global $wpdb;
	$wp_table_name = esc_sql( $wp_table_name );
	// Setup arrays for Actual Values, and Placeholders.
	$values        = array();
	$place_holders = array();
	$query         = '';
	$query_columns = '';

	$query .= "INSERT INTO {$wp_table_name} (";

	// var_dump( $row_arrays );
	foreach ( $row_arrays as $count => $row_array ) {

		foreach ( $row_array as $key => $value ) {

			if ( $count == 0 ) {
				if ( $query_columns ) {
					$query_columns .= ',' . $key . '';
				} else {
					$query_columns .= '' . $key . '';
				}
			}

			$values[] = $value;

			if ( isset( $place_holders[ $count ] ) ) {
				$place_holders[ $count ] .= ", '%s'";
			} else {
				$place_holders[ $count ] .= "( '%s'";
			}
		}
		// mind closing the GAP.
		$place_holders[ $count ] .= ')';
	}

	$query .= ' pay_date, id_ctv, amount, month_profit, note ) VALUES ';

	$query .= implode( ', ', $place_holders );

	if ( $wpdb->query( $wpdb->prepare( $query, $values ) ) ) {
		return true;
	} else {
		return false;
	}

}
