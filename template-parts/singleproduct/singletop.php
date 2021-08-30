<div class="box_single-top row">
    <div class="box_img col-4">
        <div class="single-image">
            <?php the_post_thumbnail(); ?>
        </div>
    </div>
    <div class="box_product-content col-8">
        
        <div class="box_product-title">

            <?php the_title('<h2 class="product-title">', '</h2>') ?>
            <div class="box_product-status">
                <p class="status">
                    <span class="status-item">
                        <i class="bi bi-check-circle"></i>
                        Tình trạng: Còn hàng
                    </span>
                    <span class="status-item">
                        <i class="bi bi-check-circle"></i>
                        Mã sản phẩm: KG108AKV
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
                <span class="price">5.325.000</span>
                <samp class="price-sale">3.790.000</samp>
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
                    <i class="bi bi-gift"></i>
                    Xem thêm gói ưu đãi
                </a>
            </div>
            <div class="product_share-item">
            <p>Chia sẻ:</p>
            <a href="#" class="icon" > <img src="<?= get_template_directory_uri(); ?>/images/logo-zalo.jpg" alt="" sizes="50px 50px" srcset=""></a>
            <a href="#" class="icon"> <img src="<?= get_template_directory_uri(); ?>/images/facebook.png" alt="" sizes="50px 50px" srcset=""></a>
            
            </div>
        </div>

        <div class="box_product-datmua">
            <a href="#" class="btn btn-them">Thêm vào giỏ hàng </a>
            <a href="#" class="btn btn-muangay">Mua ngay </a>
            <a href="#" class="btn btn-lienhe">
            <i class="bi bi-telephone"></i>
                 <p>
                     Đặt mua:<br>0966 000 862
                 </p>
            </a>
        </div>
    </div>
</div>
<div class="box_sidebar-product row">
    <?php dynamic_sidebar('sidebar-product') ?>
</div>