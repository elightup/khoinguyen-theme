<section class="home_banchay">
    <div class="box_title">
        <h2 class="title">Top bán chạy</h2>
    </div>
    <div class="product_list ">
        <?php
        ob_start();
        $args=[
            'post_type'      => 'product',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'nganh-hang',
                    'field' => 'slug',
                    'terms' => array('noi-bat'),
                    'include_children' => true,
                    'operator' => 'IN'
                )

            ),
        ];

        $query = new WP_Query($args);
        while ($query->have_posts()) :
            $query->the_post();
            get_template_part('template-parts/content', 'product');
        endwhile;
        wp_reset_postdata();

      
        ?>
    </div>
</section>