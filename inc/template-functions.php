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
add_action('wp_ajax_filter', 'filter_product');
add_action('wp_ajax_nopriv_filter', 'filter_product');
function filter_product() {
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    $lable = isset($_GET['lable']) ? $_GET['lable'] : false;
    $args = array(
        'post_type' => 'product',
        'p' => $id,
    );
    $query = new WP_Query($args);
    while ($query->have_posts()) :
        $query->the_post();
        $price   = rwmb_meta('price');
        $priceCV = rwmb_meta('price_nhap');
        $code    = rwmb_meta('code');
        $kithuat = rwmb_meta('thong_so');
        ?>
        <div class="filter-product-content">
            <div class="filter-product-top <?php echo $lable ?>">
                <div class="box_image">
                    <?php khoinguyen_post_thumbnail(); ?>
                </div>
                <div class="box_price">
                    <span class="price"><?php echo kn_currency_format($price ? $price : 0); ?></span>
                    <span class="price-sale"><?php echo kn_currency_format($priceCV ? $priceCV : 0) ?></span>
                </div>
                <div class="box_product-datmua">
            <?php
           $ID = get_current_user_id();
            $cart = get_user_meta( $ID, 'cart', true );
            if ( empty( $cart ) || ! is_array( $cart ) ) {
                $cart = [];
            }
            $cart_product_id = [];
            foreach ( $cart as $key => $value ) {
                $cart_product_id[] = $key;
            }
            if ( in_array( get_the_ID(), $cart_product_id ) ) : ?>
                <a href="<?= home_url(); ?>/gio-hang" class="btn btn-them">Đã thêm vào giỏ </a>
                <a href="<?= home_url(); ?>/gio-hang" class="btn btn-muangay" data-product="<?= get_the_ID(); ?>">Mua ngay </a>
            <?php else: ?>
                <a href="#" class="btn btn-them single-add-to-cart" data-product="<?= get_the_ID(); ?>">Thêm vào giỏ hàng</a>
                <a href="#" class="btn btn-muangay single-buynow" data-product="<?= get_the_ID(); ?>">Mua ngay</a>
            <?php endif; ?>
        </div>
            </div>
            <div class="filter-product-bottom">
                <div class="box_items">
                    <?php if(!$lable){
                        echo'<p class="product-lable">
                        Mã sản phẩm
                    </p>';
                    } ?>
                    <div class="product-content">
                        <?php echo $code ?>
                    </div>
                </div>
                <div class="box_items">
                <?php if(!$lable){
                        echo'<p class="product-lable">
                        Thông số kỹ thuật
                    </p>';
                    } ?>
                    <div class="product-content">
                        <?php kn_get_mota() ?>
                    </div>
                </div>
                <div class="box_items">
                <?php if(!$lable){
                        echo'<p class="product-lable">
                        Đặc điểm nổi bật
                        </p>';
                    } ?>
                    <div class="product-content">
                        <?php echo $kithuat ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endwhile;
    wp_reset_postdata();
}
