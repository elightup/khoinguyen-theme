<?php
/**
 * Template Name: Upload lịch sử thanh toán
 *
 * @package khoinguyen
 */

get_header();
require get_template_directory() . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

?>

	<div class="primary">
		<main id="main" class="site-main container" role="main">
			<form action="" method="post" enctype="multipart/form-data">
				<input class="form-control" type="file" name="upload">
				<input type="submit" name="submit" value="Upload" class="btn btn-success">
			</form>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php

	if ( isset( $_POST['submit'] ) ) {
		if ( isset( $_FILES['upload'] ) ) {

			$file_name = $_FILES['upload']['name'];
			$file_tmp  = $_FILES['upload']['tmp_name'];
			$path      = WP_CONTENT_DIR . '/uploads/' . $file_name;
			move_uploaded_file( $file_tmp, $path );

			$template_path = $path;
			if ( file_exists( $template_path ) ) {
				$objPHPExcel = IOFactory::load( $template_path );
				$data        = $objPHPExcel->getActiveSheet()->toArray();
			}
			wp_insert_pay_ctv( $data, 'wp_pay_ctv' );

			echo 'Bạn đã upload thành công';
		} else {
			echo 'Chưa có file nào được chọn';
		}
	}
	?>
<?php
get_footer();
