<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package khoinguyen
 */

?>
</div>
<footer id="colophon" class="site-footer">
	<div class="footer-widgets container">
		<div class="logo">
			<?php
			the_custom_logo();
			?>
		</div>
		<div class="footer-widgets__wrapper row ">

			<div class="footer-left col-6">

				<?php dynamic_sidebar('sidebar-footer-left') ?>
			</div>
			<div class="footer-rigth col-6">
				<?php dynamic_sidebar('sidebar-footer-rigth') ?>
			</div>
		</div>
	</div>
	<div class="site-info">
		Copyright © <?= date('Y') ?> giathuoctot.vn. Developed by <a href="https://titanweb.vn/" target="_blank" rel="noopener">TitanWeb</a>.
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>