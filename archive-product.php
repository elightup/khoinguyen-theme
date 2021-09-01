<?php

/**
 * Archive Product Template
 */

get_header();
?>

<section id="content" class="danhmuc-sp">

    <div id="main" class="container">

        <?php
        kn_get_path();
        kn_filter_home();
        ?>
        <div class="content_product-list">
            <div class="product-list">
                <?php
                ob_start();
                $args = [
                    'post_type'      => 'product',
                    'posts_per_page' => 20,
                ];

                $query = new WP_Query($args);
                while ($query->have_posts()) :
                    $query->the_post();
                    get_template_part('template-parts/content', 'product');
                endwhile;
                
                
                wp_reset_postdata();
               
                

                ?>
            </div>
            <?php  the_posts_pagination(
                    array(
                        'prev_text' => __('<i class="bi bi-chevron-double-left"></i>', 'khoinguyen'),
                        'next_text' => __('<i class="bi bi-chevron-double-right"></i>', 'khoinguyen'),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'khoinguyen') . ' </span>',
                    )); ?>
        </div>
    </div>

    </div>


    </div>
</section>

<?php
get_footer();
