<?php
    $kithuat = rwmb_meta( 'thong_so', get_the_ID() );
?>
<div class="box_single-bottom row">
    <div class="box_product-bottom col-lg-9">
        <!--tap menu -->
        <ul class="nav-pill">
            <li class="tab-button active" data-id="mota">Mô tả sản phẩm</li>
            <?php if( empty( $kithuat ) ){
                echo'<li class="tab-button" ></li>';
            }else{
               echo'<li class="tab-button" data-id="ktthuat">Thông số kỹ thuật</li>';
            } ?>

        </ul>

        <!--contennt-->
        <div class="product-content">
            <div class="content mota show">
                <?php the_content(); ?>

            </div>
            <div class="content ktthuat">
                <?php
                echo $kithuat;
                 ?>
            </div>
        </div>

        <!--conment-->
        <div class="product-comment">
            <div class="title">
                <h4>Đánh giá sản phẩm</h4>
            </div>
            <?php if ( comments_open() || get_comments_number() ) :
            $args = array(
                'id_form'           => 'commentform',
                'id_submit'         => 'submit',
                'title_reply'       => __( 'Leave a Reply','khoinguyen' ),
                'title_reply_to'    => __( 'Leave a Reply to %s' ,'khoinguyen'),
                'cancel_reply_link' => __( 'Cancel Reply','khoinguyen' ),
                'label_submit'      => __( 'Đánh giá','khoinguyen'),
                'comment_field'=>'<p class="comment-form-comment">
                <label for="comment">' . __( '', 'khoinguyen' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'
            );
                comment_form( $args, get_the_ID() );
            endif; ?>
        </div>
        <div class="product-categrory">
            <div class="title">
                <h4>Các sản phẩm tương tự</h4>
            </div>
            <div class="product-categrory-content">
                <?php kn_get_posts_categrory();
                ?>
            </div>
        </div>
    </div>
    <div class="box_sidebar col-lg-3">
        <div class="box_sidebar-product">
            <label class="title-sidebar">
                Top bán chạy
            </label>
        </div>
        <?php dynamic_sidebar('sidebar-right') ?>
    </div>
</div>