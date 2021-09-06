<?php
$price = rwmb_meta('price', get_the_ID());
$priceCV = rwmb_meta('price_nhap', get_the_ID());
$code = rwmb_meta('code', get_the_ID());
$number = rwmb_meta('number', get_the_ID());

?>

<div class="box_single-top row">
    <div class="box_img col-4">
        <div class="box_image-product">
            <?php
            $images = rwmb_meta('anh_san_pham', get_the_ID());
            if (empty($images)) {
                the_post_thumbnail();
            }
            foreach ($images as $image) :
                $image_product = wp_get_attachment_image_url($image['image_product'], 'full');

            ?>
                <div class="box_image">
                    <img src="<?= $image_product ?>" loading="lazy">
                </div>

            <?php endforeach ?>

        </div>
        <div class="box_image-product-slider">
            <?php
            foreach ($images as $image) :
                $image_product = wp_get_attachment_image_url($image['image_product'], 'full');

            ?>
                <div class="box_image">
                    <img src="<?= $image_product ?>" loading="lazy">
                </div>
            <?php endforeach ?>

        </div>
    </div>
    <div class="box_product-content col-8">

        <div class="box_product-title">
            <div class="box_name">
                <?php kn_get_phantram($price ? $price : 0,$priceCV ? $priceCV : 0) ?>
                <?php the_title('<h2 class="product-title">', '</h2>') ?>
            </div>
            <div class="box_product-status">
                <p class="status">
                    <span class="status-item">
                        <i class="bi bi-check-circle"></i>
                        Tình trạng: <?php if ($number > 0) {
                                        echo 'còn hàng';
                                    } else {
                                        echo '<pan  style="color: red;">hết hàng </pan>';
                                    }
                                    ?>
                    </span>
                    <span class="status-item">
                        <i class="bi bi-check-circle"></i>
                        Mã sản phẩm: <?php echo $code ?>
                    </span>
                    <span class="status-item">
                        <i class="bi bi-check-circle"></i>
                        Vận chuyển: Liên hệ!
                    </span>
                </p>
            </div>
        </div>

        <div class="box_product-price">
            <div class="product-price">
                <span class="price"><?php echo kn_currency_format($price ? $price : 0) ?></span>
                <span class="price-sale"><?php echo kn_currency_format($priceCV ? $priceCV : 0) ?></span>
            </div>
            <div class="Product-compare">
                <a href="#">
                    <i class="bi bi-arrow-left-right"></i>
                    So sánh sản phẩm
                </a>
            </div>
        </div>

        <div class="box_product-discription">
            <?php kn_get_mota() ?>
        </div>

        <div class="box_product-share">
            <div class="product_share-item">
                <p>
                    Sẵn hàng tại:
                    <span>Hà Nội</span>
                </p>
            </div>
            <div class="product_share-item">
                <a href="#">
                    Hostline:
                    <span>0966 000 862</span>
                </a>
            </div>
            <div class="product_share-item">
                <p>Chia sẻ:</p>

                <div class="zalo-share-button icon " data-href="<?php the_permalink(); ?>" data-oaid="579745863508352884" data-layout="2" data-color="blue" data-customize="true">
                    <img src="<?= get_template_directory_uri(); ?>/images/logo-zalo.jpg" alt="" sizes="50px 50px" srcset="">
                </div>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="icon"> <img src="<?= get_template_directory_uri(); ?>/images/facebook.png" alt="" sizes="50px 50px" srcset=""></a>

            </div>
        </div>

        <div class="box_product-datmua">
            <a href="#" class="btn btn-them">Thêm vào giỏ hàng </a>
            <a href="#" class="btn btn-muangay">Mua ngay </a>

        </div>
    </div>
</div>
<div class="box_featured-product row">
    <div class="featured-item">
        <div class="box_featured-img">
            <img src="<?php echo get_template_directory_uri() ?>/images/sanpham.jpg" alt="">
        </div>
        <div class="box_featured-content">
            <p class="featured-top">Sản Phẩm Mới Nhất</p>
            <p class="featured-bottom">Luôn cung cấp sản phẩm mới nhất</p>
        </div>
    </div>

    <div class="featured-item">
        <div class="box_featured-img">
            <img src="<?php echo get_template_directory_uri() ?>/images/sanpham_2.jpg" alt="">
        </div>
        <div class="box_featured-content">
            <p class="featured-top">Mức Giá Phù Hợp</p>
            <p class="featured-bottom">Tiết kiệm chi phí cho mọi người</p>
        </div>
    </div>

    <div class="featured-item">
        <div class="box_featured-img">
            <img src="<?php echo get_template_directory_uri() ?>/images/sanpham_3.jpg" alt="">
        </div>
        <div class="box_featured-content">
            <p class="featured-top">Sản Phẩm Chính Hãng</p>
            <p class="featured-bottom">Được nhập trực tiếp từ hãng</p>
        </div>
    </div>

    <div class="featured-item">
        <div class="box_featured-img">
            <img src="<?php echo get_template_directory_uri() ?>/images/sanpham_4.jpg" alt="">
        </div>
        <div class="box_featured-content">
            <p class="featured-top">An toàn & Uy Tín</p>
            <p class="featured-bottom">Với hơn 3.000 khách hàng</p>
        </div>
    </div>
    <div class="featured-item">
        <div class="box_featured-img">
            <img src="<?php echo get_template_directory_uri() ?>/images/sanpham_5.jpg" alt="">
        </div>
        <div class="box_featured-content">
            <p class="featured-top">Thanh Toán Bảo Mật</p>
            <p class="featured-bottom">Hỗ trợ nhiều hình thức thanh toán</p>
        </div>
    </div>
</div>