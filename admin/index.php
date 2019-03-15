<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		include_once '../include/admin/action.php';
		$user_data = array();
		$action = new Action();
		$user_data = $action->login($_POST);
		$user_data = json_decode($user_data);
		if(!empty($user_data) && sizeof($user_data) > 0){
			if($user_data->success == 1){
				header("Location: dashboard.php");
			} else {
				echo 'User not login';
			}
		}
		//print_r($user_data);
	}
?>

<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Login</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

		<!--end::Web font -->

		<!--begin:: Global Mandatory Vendors -->
		<link href="../vendors/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />


		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Styles -->
		<link href="../assets/demo/base/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/demo/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="../assets/demo/media/img/logo/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--desktop m-grid--ver-desktop m-grid--hor-tablet-and-mobile m-login m-login--6" id="m_login">
				<div class="m-grid__item   m-grid__item--order-tablet-and-mobile-2  m-grid m-grid--hor m-login__aside " style="background-image: url(../assets/app/media/img//bg/bg-4.jpg);">
					<div class="m-grid__item">
						<div class="m-login__logo">
							<a href="#">
								<img src="../assets/app/media/img/logos/logo-4.png">
							</a>
						</div>
					</div>
					<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver">
						<div class="m-grid__item m-grid__item--middle">
							<span class="m-login__title">Whatever CTA's wave purpose important exit element</span>
							<span class="m-login__subtitle">Lorem ipsum amet estudiat</span>
						</div>
					</div>
				</div>
				<div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">

					<!--begin::Head-->
					<!--<div class="m-login__head">
						<span>Don't have an account?</span>
						<a href="#" class="m-link m--font-danger">Sign Up</a>
					</div>-->

					<!--end::Head-->

					<!--begin::Body-->
					<div class="m-login__body">

						<!--begin::Signin-->
						<div class="m-login__signin">
							<div class="m-login__title">
								<h3>Login</h3>
							</div>

							<!--begin::Form-->
							<form class="m-login__form m-form" action="" method="post" id="login-form">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="email" placeholder="email" name="email" autocomplete="off" required="required">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password" required="required">
								</div>
								<div class="m-login__action">
									<a href="#" class="m-link">
										<span>Forgot Password ?</span>
									</a>
									<a href="#">
										<button type="submit" id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
									</a>
								</div>
							</form>
							<!--end::Form-->

							<!--begin::Action-->
							

							<!--end::Action-->

							<!--begin::Divider-->
							<!--<div class="m-login__form-divider">
								<div class="m-divider">
									<span></span>
									<span>OR</span>
									<span></span>
								</div>
							</div>-->

							<!--end::Divider-->

							<!--begin::Options-->
							<!--<div class="m-login__options">
								<a href="#" class="btn btn-primary m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-facebook-f"></i>
										<span>Facebook</span>
									</span>
								</a>
								<a href="#" class="btn btn-info m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-twitter"></i>
										<span>Twitter</span>
									</span>
								</a>
								<a href="#" class="btn btn-danger m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-google"></i>
										<span>Google</span>
									</span>
								</a>
							</div>-->

							<!--end::Options-->
						</div>

						<!--end::Signin-->
					</div>

					<!--end::Body-->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin:: Global Mandatory Vendors -->
		<script src="../vendors/jquery/dist/jquery.js" type="text/javascript"></script>
		<script src="../vendors/popper.js/dist/umd/popper.js" type="text/javascript"></script>
		<script src="../vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../vendors/js-cookie/src/js.cookie.js" type="text/javascript"></script>
		<script src="../vendors/moment/min/moment.min.js" type="text/javascript"></script>
		<script src="../vendors/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
		<script src="../vendors/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
		<script src="../vendors/wnumb/wNumb.js" type="text/javascript"></script>

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<script src="../vendors/jquery.repeater/src/lib.js" type="text/javascript"></script>
		<script src="../vendors/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
		<script src="../vendors/jquery.repeater/src/repeater.js" type="text/javascript"></script>
		<script src="../vendors/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
		<script src="../vendors/block-ui/jquery.blockUI.js" type="text/javascript"></script>
	
		<script src="../vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
		<script src="../vendors/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
		<script src="../vendors/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
		<script src="../vendors/js/framework/components/plugins/forms/bootstrap-switch.init.js" type="text/javascript"></script>
		
		<script src="../vendors/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
		<script src="../vendors/handlebars/dist/handlebars.js" type="text/javascript"></script>
		<script src="../vendors/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
		<script src="../vendors/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="../vendors/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
		<script src="../vendors/inputmask/dist/inputmask/inputmask.phone.extensions.js" type="text/javascript"></script>
		<script src="../vendors/nouislider/distribute/nouislider.js" type="text/javascript"></script>
		<script src="../vendors/autosize/dist/autosize.js" type="text/javascript"></script>
		<script src="../vendors/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
		<script src="../vendors/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
		<script src="../vendors/dropzone/dist/dropzone.js" type="text/javascript"></script>
		<script src="../vendors/summernote/dist/summernote.js" type="text/javascript"></script>
		<script src="../vendors/markdown/lib/markdown.js" type="text/javascript"></script>
		<script src="../vendors/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
		<script src="../vendors/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
		<script src="../vendors/js/framework/components/plugins/forms/jquery-validation.init.js" type="text/javascript"></script>
		<script src="../vendors/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
		<script src="../vendors/js/framework/components/plugins/base/bootstrap-notify.init.js" type="text/javascript"></script>
		<script src="../vendors/morris.js/morris.js" type="text/javascript"></script>
		
		
		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Bundle -->
		<script src="../assets/demo/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts -->
		<!--<script src="assets/snippets/custom/pages/user/login6.js" type="text/javascript"></script>-->

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>