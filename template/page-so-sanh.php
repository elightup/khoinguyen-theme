<?php

/**
 * Template Name: so sanh
 *
 * @package khoinguyen
 */
if ('posts' === get_option('show_on_front')) {
    get_template_part('index'); 
    return;
}
get_header();


?>
<main id="primary" class="site-main ">
    <div class="main-title">
        <?php  the_title('<h2>','</h2>') ?>
    </div>
    <?php kn_get_path(); ?>
    <div class="row">
        <div class="col-md-6  product-left product-sosanh ">
            <?php  kn_get_select_product(); ?>
            <div class="dislay-product">
                <?php 
                echo $_GET['id'];
            
                 if($_GET['id']){
                   
                    load_sosanh($_GET['id']);
                }
                ?>
            </div>
        </div>
        <div class="col-md-6  product-right product-sosanh">
        <?php  kn_get_select_product2(); ?>
        <div class="dislay-product2"></div>
        </div>
    </div>
</main>
<?php

get_footer();
