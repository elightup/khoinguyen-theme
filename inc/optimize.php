<?php
/**
 * Remove Yoast Seo filter column in admin column.
 */
function kn_remove_yoast_seo_admin_filters() {
	global $wpseo_meta_columns;
	if ( $wpseo_meta_columns ) {
		remove_action( 'restrict_manage_posts', array( $wpseo_meta_columns, 'posts_filter_dropdown' ) );
		remove_action( 'restrict_manage_posts', array( $wpseo_meta_columns, 'posts_filter_dropdown_readability' ) );
	}
}
add_action( 'admin_init', 'kn_remove_yoast_seo_admin_filters', 20 );
