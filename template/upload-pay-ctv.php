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


if ( ! is_user_logged_in() ) {
	echo 'Bạn chưa đăng nhập';
}

$user_role = wp_get_current_user()->roles[0];
if ( ! $user_role === 'administrator' ) {
	echo 'Bạn không có quyền xem trang này';
}
?>

	<?php if ( is_user_logged_in() && $user_role === 'administrator' ) : ?>
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

	<?php endif; ?>
<?php
get_footer();
