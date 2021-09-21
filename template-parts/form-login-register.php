<div id="form-login-register" class="form-login-register mfp-hide white-popup-block">
	<div class="form-title">
		<div class="item-title active" data-id="1">Đăng nhập</div>
		<div class="item-title" data-id="2">Tạo tài khoản</div>
	</div>
	<div class="form-content">
		<div id="1" class="item-content show">
			<?php echo do_shortcode( '[mb_user_profile_login label_username="Tên đăng nhập" label_password="Mật khẩu" label_submit="Đăng nhập" label_remember="Nhớ mật khẩu" confirmation="Bạn đã đăng nhập thành công" ajax="true"]' ); ?>
		</div>
		<div id="2" class="item-content">
			<?php echo do_shortcode( '[mb_user_profile_register id="thong-tin-user" password_strength="false" label_username="Số điện thoại(dùng để đăng nhập)" label_password="Mật khẩu" label_password2="Xác nhận mật khẩu"  label_submit="Tạo tài khoản" confirmation="Tài khoản của bạn đã được tạo thành công. Vui lòng <a href="/dang-nhap/">đăng nhập</a>" show_if_user_can="create_users" role="subscriber"]' ); ?>
		</div>
	</div>
</div>