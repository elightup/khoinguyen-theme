<div class="box_single-bottom row">
    <div class="box_product-bottom col-9">
        <!--tap menu -->
        <ul class="nav-pill">
            <li class="tab-button active" data-id="mota">Mô tả sản phẩm</li>
            <li class="tab-button" data-id="ktthuat">Thông số kỹ thuật</li>
        </ul>

        <!--contennt-->
        <div class="product-content">
            <div class="content mota show">
                <?php the_content(); ?>

            </div>
            <div class="content ktthuat">đâsdasd</div>
        </div>

        <!--conment-->
        <div class="product-comment">
            <div class="title">
                <h4>Đánh giá sản phẩm</h4>
            </div>
            <?php if (comments_open() || get_comments_number()) :
                comments_template();
            endif; ?>
        </div>
        <div class="product-categrory">
            <div class="title">
                <h4>Đánh giá sản phẩm</h4>
            </div>
            <div class="product-categrory-content">
                <?php kn_get_posts_categrory();
                ?>
            </div>
        </div>
    </div>
    <div class="box_sidebar col-3">
        <div class="box_sidebar-product">
            <label class="title-sidebar">
                Top bán chạy
            </label>
        </div>
        <?php dynamic_sidebar('sidebar-rigth') ?>
    </div>
</div>