<?php 
$banners=rwmb_meta('group_banner');

if (empty($banners)) {
	return;
}
?>
<section class="home__banner row">
    <div class="home-sidebar">
        <?php dynamic_sidebar('menu') ?>
    </div>
</section>