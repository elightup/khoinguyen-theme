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
		<div class="footer-widgets__wrapper row ">
			<div class="footer-left col-4">
				<?php dynamic_sidebar('sidebar-footer-left') ?>
			</div>
			<div class="footer-center col-4">
				<?php dynamic_sidebar('sidebar-footer-center') ?>
			</div>
			<div class="footer-right col-4">
				<?php dynamic_sidebar('sidebar-footer-right') ?>
			</div>
		</div>
	</div>
	<div class="site-info">
		Copyright © <?= date('Y') ?> <?php bloginfo(); ?>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<script src="https://sp.zalo.me/plugins/sdk.js"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=199776704968988&autoLogAppEvents=1" nonce="yQNhQFXA"></script>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none">
	<symbol id="icon-basket" viewBox="0 0 24 24">
		<path d="M8.132,2.504L4.42,9H3C2.688,9,2.395,9.146,2.205,9.393c-0.189,0.248-0.252,0.57-0.17,0.87l2.799,10.263 C5.07,21.394,5.864,22,6.764,22h10.473c0.898,0,1.692-0.605,1.93-1.475l2.799-10.263c0.082-0.3,0.02-0.622-0.17-0.87 C21.605,9.146,21.312,9,21,9h-1.42l-3.712-6.496l-1.736,0.992L17.277,9H6.723l3.145-5.504L8.132,2.504z M14,13h2v5h-2V13z M8,13h2 v5H8V13z"></path>
	</symbol>
	<symbol id="icon-cart" viewBox="0 0 24 24">
		<circle cx="10.5" cy="19.5" r="1.5"></circle>
		<circle cx="17.5" cy="19.5" r="1.5"></circle>
		<path d="M21,7H7.334L6.18,4.23C5.868,3.482,5.143,3,4.333,3H2v2h2.334l4.743,11.385C9.232,16.757,9.597,17,10,17h8 c0.417,0,0.79-0.259,0.937-0.648l3-8c0.115-0.308,0.072-0.651-0.114-0.921C21.635,7.161,21.328,7,21,7z M17,13h-2v2h-2v-2h-2v-2h2 V9h2v2h2V13z"></path>
	</symbol>
	<symbol id="icon-user" viewBox="0 0 24 24">
		<path fill="none" d="M12,8c-1.178,0-2,0.822-2,2s0.822,2,2,2s2-0.822,2-2S13.178,8,12,8z"></path>
		<path fill="none" d="M12,4c-4.337,0-8,3.663-8,8c0,2.176,0.923,4.182,2.39,5.641c0.757-1.8,2.538-3.068,4.61-3.068h2 c2.072,0,3.854,1.269,4.61,3.068C19.077,16.182,20,14.176,20,12C20,7.663,16.337,4,12,4z M12,14c-2.28,0-4-1.72-4-4s1.72-4,4-4 s4,1.72,4,4S14.28,14,12,14z"></path>
		<path fill="none" d="M13,16.572h-2c-1.432,0-2.629,1.01-2.926,2.354C9.242,19.604,10.584,20,12,20s2.758-0.396,3.926-1.073 C15.629,17.582,14.432,16.572,13,16.572z"></path>
		<path d="M12,2C6.579,2,2,6.579,2,12c0,3.189,1.592,6.078,4,7.924V20h0.102C7.77,21.245,9.813,22,12,22s4.23-0.755,5.898-2H18 v-0.076c2.408-1.846,4-4.734,4-7.924C22,6.579,17.421,2,12,2z M8.074,18.927c0.297-1.345,1.494-2.354,2.926-2.354h2 c1.432,0,2.629,1.01,2.926,2.354C14.758,19.604,13.416,20,12,20S9.242,19.604,8.074,18.927z M17.61,17.641 c-0.757-1.8-2.538-3.068-4.61-3.068h-2c-2.072,0-3.854,1.269-4.61,3.068C4.923,16.182,4,14.176,4,12c0-4.337,3.663-8,8-8 s8,3.663,8,8C20,14.176,19.077,16.182,17.61,17.641z"></path>
		<path d="M12,6c-2.28,0-4,1.72-4,4s1.72,4,4,4s4-1.72,4-4S14.28,6,12,6z M12,12c-1.178,0-2-0.822-2-2s0.822-2,2-2s2,0.822,2,2 S13.178,12,12,12z"></path>
	</symbol>
	<symbol id="icon-logout" viewBox="0 0 24 24">
		<path d="M12,3c-4.963,0-9,4.037-9,9c0,0,0,0,0,0.001l5-4v3h7v2H8v3l-5-4C3.001,16.964,7.037,21,12,21s9-4.037,9-9S16.963,3,12,3z"></path>
	</symbol>
	<symbol id="icon-check" viewBox="0 0 24 24">
		<path d="M19,4h-2V2h-2v2H9V2H7v2H5C3.897,4,3,4.897,3,6v2v12c0,1.103,0.897,2,2,2h14c1.103,0,2-0.897,2-2V8V6 C21,4.897,20.103,4,19,4z M19.002,20H5V8h14L19.002,20z"></path>
		<path d="M11 17.414L16.707 11.707 15.293 10.293 11 14.586 8.707 12.293 7.293 13.707z"></path>
	</symbol>
	<symbol id="icon-price-tag" viewBox="0 0 24 24">
		<path d="M13.707,3.293C13.52,3.105,13.266,3,13,3H4C3.447,3,3,3.447,3,4v9c0,0.266,0.105,0.52,0.293,0.707l8,8 C11.488,21.902,11.744,22,12,22s0.512-0.098,0.707-0.293l9-9c0.391-0.391,0.391-1.023,0-1.414L13.707,3.293z M12,19.586l-7-7V5 h7.586l7,7L12,19.586z"></path>
		<circle cx="8.496" cy="8.495" r="1.505"></circle>
	</symbol>
	<symbol id="icon-search" viewBox="0 0 24 24">
		<path d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z"></path>
	</symbol>
	<symbol id="icon-menu" viewBox="0 0 24 24">
		<path d="M4 6H20V8H4zM4 11H20V13H4zM4 16H20V18H4z"></path>
	</symbol>
	<symbol id="icon-facebook" viewBox="0 0 24 24">
		<path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
	</symbol>
</svg>


<?php wp_footer(); ?>

</body>

</html>