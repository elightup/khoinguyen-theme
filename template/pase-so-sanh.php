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
        <div class="col-6 ">
            <?php  kn_get_select_product(); ?>
        </div>
        <div class="col-6 ">
        </div>
    </div>
</main>
<?php

get_footer();
