<?php 

	$URL = "http://localhost/player11/";

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

		<link href="vendors/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />



		<!--end:: Global Mandatory Vendors -->



		<!--begin:: Global Optional Vendors -->

		<link href="vendors/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />

		<link href="vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

		<link href="vendors/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

		<link href="vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />

		<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

		<link href="vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />

		<link href="vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />

		<link href="vendors/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />

		<link href="vendors/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />

		<link href="vendors/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />

		<link href="vendors/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />

		<link href="vendors/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />

		<link href="vendors/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />

		<link href="vendors/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css" />

		<link href="vendors/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />

		<link href="vendors/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />

		<link href="vendors/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />

		<link href="vendors/animate.css/animate.css" rel="stylesheet" type="text/css" />

		<link href="vendors/toastr/build/toastr.css" rel="stylesheet" type="text/css" />

		<link href="vendors/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css" />

		<link href="vendors/morris.js/morris.css" rel="stylesheet" type="text/css" />

		<link href="vendors/chartist/dist/chartist.min.css" rel="stylesheet" type="text/css" />

		<link href="vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />

		<link href="vendors/socicon/css/socicon.css" rel="stylesheet" type="text/css" />

		<link href="vendors/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />

		<link href="vendors/vendors/flaticon/css/flaticon.css" rel="stylesheet" type="text/css" />

		<link href="vendors/vendors/metronic/css/styles.css" rel="stylesheet" type="text/css" />

		<link href="vendors/vendors/fontawesome5/css/all.min.css" rel="stylesheet" type="text/css"

		 />

		 



		<!--end:: Global Optional Vendors -->



		<!--begin::Global Theme Styles -->

		<link href="assets/demo/base/style.bundle.css" rel="stylesheet" type="text/css" />



		<!--RTL version:<link href="../../../assets/demo/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->



		<!--end::Global Theme Styles -->

		<link rel="shortcut icon" href="assets/demo/media/img/logo/favicon.ico" />

	</head>



	<!-- end::Head -->



<!-- begin::Body -->

	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">



		<!-- begin:: Page -->

		<div class="m-grid m-grid--hor m-grid--root m-page">



			<!-- BEGIN: Header -->

			<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">

				<div class="m-container m-container--fluid m-container--full-height">

					<div class="m-stack m-stack--ver m-stack--desktop">



						<!-- BEGIN: Brand -->

						<div class="m-stack__item m-brand  m-brand--skin-dark ">

							<div class="m-stack m-stack--ver m-stack--general">

								<div class="m-stack__item m-stack__item--middle m-brand__logo">

									<a href="index.html" class="m-brand__logo-wrapper">

										<img alt="" src="assets/demo/media/img/logo/logo.png" />

									</a>

								</div>

								<div class="m-stack__item m-stack__item--middle m-brand__tools">



									<!-- BEGIN: Left Aside Minimize Toggle -->

									<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">

										<span></span>

									</a>



									<!-- END -->



									<!-- BEGIN: Responsive Aside Left Menu Toggler -->

									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">

										<span></span>

									</a>



									<!-- END -->



									<!-- BEGIN: Responsive Header Menu Toggler -->

									<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">

										<span></span>

									</a>



									<!-- END -->



									<!-- BEGIN: Topbar Toggler -->

									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">

										<i class="flaticon-more"></i>

									</a>



									<!-- BEGIN: Topbar Toggler -->

								</div>

							</div>

						</div>



						<!-- END: Brand -->

						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">



							<!-- BEGIN: Horizontal Menu -->

							<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>

							<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">

								<ul class="m-menu__nav ">

									<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i

											 class="m-menu__link-icon flaticon-add"></i><span class="m-menu__link-text">Actions</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>

										<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">

											<ul class="m-menu__subnav">

												<li class="m-menu__item " aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-file"></i><span class="m-menu__link-text">Create New Post</span></a></li>

												<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-diagram"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">

																<span class="m-menu__link-text">Generate Reports</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--success">2</span></span> </span></span></a></li>

												<li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i class="m-menu__link-icon flaticon-business"></i><span

														 class="m-menu__link-text">Manage Orders</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>

													<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>

														<ul class="m-menu__subnav">

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Latest Orders</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Pending Orders</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Processed Orders</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Delivery Reports</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Payments</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Customers</span></a></li>

														</ul>

													</div>

												</li>

												<li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="#" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-chat-1"></i><span class="m-menu__link-text">Customer

															Feedbacks</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>

													<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>

														<ul class="m-menu__subnav">

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Customer Feedbacks</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Supplier Feedbacks</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Reviewed Feedbacks</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Resolved Feedbacks</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Feedback Reports</span></a></li>

														</ul>

													</div>

												</li>

												<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Register Member</span></a></li>

											</ul>

										</div>

									</li>

									<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i

											 class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-text">Reports</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>

										<div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:1000px">

											<div class="m-menu__subnav">

												<ul class="m-menu__content">

													<li class="m-menu__item">

														<h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Finance Reports</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>

														<ul class="m-menu__inner">

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-map"></i><span class="m-menu__link-text">Annual Reports</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">HR Reports</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-clipboard"></i><span class="m-menu__link-text">IPO Reports</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Finance Margins</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Revenue Reports</span></a></li>

														</ul>

													</li>

													<li class="m-menu__item">

														<h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Project Reports</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>

														<ul class="m-menu__inner">

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Coca Cola

																		CRM</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Delta

																		Airlines Booking Site</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Malibu

																		Accounting</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Vineseed

																		Website Rewamp</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Zircon

																		Mobile App</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Mercury CMS</span></a></li>

														</ul>

													</li>

													<li class="m-menu__item">

														<h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">HR Reports</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>

														<ul class="m-menu__inner">

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Staff

																		Directory</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Client

																		Directory</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Salary

																		Reports</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Staff

																		Payslips</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Corporate

																		Expenses</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Project

																		Expenses</span></a></li>

														</ul>

													</li>

													<li class="m-menu__item">

														<h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Reporting Apps</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>

														<ul class="m-menu__inner">

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Report Adjusments</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Sources & Mediums</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Reporting Settings</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Conversions</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Report Flows</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Audit & Logs</span></a></li>

														</ul>

													</li>

												</ul>

											</div>

										</div>

									</li>

									<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i

											 class="m-menu__link-icon flaticon-paper-plane"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Apps</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--brand m-badge--wide">new</span></span>

												</span></span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>

										<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">

											<ul class="m-menu__subnav">

												<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-business"></i><span class="m-menu__link-text">eCommerce</span></a></li>

												<li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="crud/datatable_v1.html" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-computer"></i><span

														 class="m-menu__link-text">Audience</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>

													<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>

														<ul class="m-menu__subnav">

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Active Users</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-interface-1"></i><span class="m-menu__link-text">User Explorer</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-lifebuoy"></i><span class="m-menu__link-text">Users Flows</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Market Segments</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic"></i><span class="m-menu__link-text">User Reports</span></a></li>

														</ul>

													</div>

												</li>

												<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-map"></i><span class="m-menu__link-text">Marketing</span></a></li>

												<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">

																<span class="m-menu__link-text">Campaigns</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--success">3</span></span> </span></span></a></li>

												<li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i class="m-menu__link-icon flaticon-infinity"></i><span

														 class="m-menu__link-text">Cloud Manager</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>

													<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow "></span>

														<ul class="m-menu__subnav">

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-add"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">

																			<span class="m-menu__link-text">File Upload</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--danger">3</span></span> </span></span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-signs-1"></i><span class="m-menu__link-text">File Attributes</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-text">Folders</span></a></li>

															<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-cogwheel-2"></i><span class="m-menu__link-text">System Settings</span></a></li>

														</ul>

													</div>

												</li>

											</ul>

										</div>

									</li>

								</ul>

							</div>



							<!-- END: Horizontal Menu -->



							<!-- BEGIN: Topbar -->

							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">

								<div class="m-stack__item m-topbar__nav-wrapper">

									<ul class="m-topbar__nav m-nav m-nav--inline">

										<li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" m-dropdown-toggle="click" id="m_quicksearch"

										 m-quicksearch-mode="dropdown" m-dropdown-persistent="1">

											<a href="#" class="m-nav__link m-dropdown__toggle">

												<span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-search-1"></i></span></span>

											</a>

											<div class="m-dropdown__wrapper">

												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>

												<div class="m-dropdown__inner ">

													<div class="m-dropdown__header">

														<form class="m-list-search__form">

															<div class="m-list-search__form-wrapper">

																<span class="m-list-search__form-input-wrapper">

																	<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">

																</span>

																<span class="m-list-search__form-icon-close" id="m_quicksearch_close">

																	<i class="la la-remove"></i>

																</span>

															</div>

														</form>

													</div>

													<div class="m-dropdown__body">

														<div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">

															<div class="m-dropdown__content">

															</div>

														</div>

													</div>

												</div>

											</div>

										</li>

										<li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">

											<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">

												<span class="m-nav__link-icon">

													<span class="m-nav__link-icon-wrapper"><i class="flaticon-alarm"></i></span>

													<span class="m-nav__link-badge m-badge m-badge--danger">3</span>

												</span>

											</a>

											<div class="m-dropdown__wrapper">

												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>

												<div class="m-dropdown__inner">

													<div class="m-dropdown__header m--align-center">

														<span class="m-dropdown__header-title">9 New</span>

														<span class="m-dropdown__header-subtitle">User Notifications</span>

													</div>

													<div class="m-dropdown__body">

														<div class="m-dropdown__content">

															<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">

																<li class="nav-item m-tabs__item">

																	<a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">

																		Alerts

																	</a>

																</li>

																<li class="nav-item m-tabs__item">

																	<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">Events</a>

																</li>

																<li class="nav-item m-tabs__item">

																	<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">Logs</a>

																</li>

															</ul>

															<div class="tab-content">

																<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">

																	<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">

																		<div class="m-list-timeline m-list-timeline--skin-light">

																			<div class="m-list-timeline__items">

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>

																					<span class="m-list-timeline__text">12 new users registered</span>

																					<span class="m-list-timeline__time">Just now</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge"></span>

																					<span class="m-list-timeline__text">System shutdown <span class="m-badge m-badge--success m-badge--wide">pending</span></span>

																					<span class="m-list-timeline__time">14 mins</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge"></span>

																					<span class="m-list-timeline__text">New invoice received</span>

																					<span class="m-list-timeline__time">20 mins</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge"></span>

																					<span class="m-list-timeline__text">DB overloaded 80% <span class="m-badge m-badge--info m-badge--wide">settled</span></span>

																					<span class="m-list-timeline__time">1 hr</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge"></span>

																					<span class="m-list-timeline__text">System error - <a href="#" class="m-link">Check</a></span>

																					<span class="m-list-timeline__time">2 hrs</span>

																				</div>

																				<div class="m-list-timeline__item m-list-timeline__item--read">

																					<span class="m-list-timeline__badge"></span>

																					<span href="" class="m-list-timeline__text">New order received <span class="m-badge m-badge--danger m-badge--wide">urgent</span></span>

																					<span class="m-list-timeline__time">7 hrs</span>

																				</div>

																				<div class="m-list-timeline__item m-list-timeline__item--read">

																					<span class="m-list-timeline__badge"></span>

																					<span class="m-list-timeline__text">Production server down</span>

																					<span class="m-list-timeline__time">3 hrs</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge"></span>

																					<span class="m-list-timeline__text">Production server up</span>

																					<span class="m-list-timeline__time">5 hrs</span>

																				</div>

																			</div>

																		</div>

																	</div>

																</div>

																<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">

																	<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">

																		<div class="m-list-timeline m-list-timeline--skin-light">

																			<div class="m-list-timeline__items">

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>

																					<a href="" class="m-list-timeline__text">New order received</a>

																					<span class="m-list-timeline__time">Just now</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>

																					<a href="" class="m-list-timeline__text">New invoice received</a>

																					<span class="m-list-timeline__time">20 mins</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>

																					<a href="" class="m-list-timeline__text">Production server up</a>

																					<span class="m-list-timeline__time">5 hrs</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>

																					<a href="" class="m-list-timeline__text">New order received</a>

																					<span class="m-list-timeline__time">7 hrs</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>

																					<a href="" class="m-list-timeline__text">System shutdown</a>

																					<span class="m-list-timeline__time">11 mins</span>

																				</div>

																				<div class="m-list-timeline__item">

																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>

																					<a href="" class="m-list-timeline__text">Production server down</a>

																					<span class="m-list-timeline__time">3 hrs</span>

																				</div>

																			</div>

																		</div>

																	</div>

																</div>

																<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">

																	<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">

																		<div class="m-stack__item m-stack__item--center m-stack__item--middle">

																			<span class="">All caught up!<br>No new logs.</span>

																		</div>

																	</div>

																</div>

															</div>

														</div>

													</div>

												</div>

											</div>

										</li>

										<li class="m-nav__item m-topbar__quick-actions m-dropdown m-dropdown--skin-light m-dropdown--large m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">

											<a href="#" class="m-nav__link m-dropdown__toggle">

												<span class="m-nav__link-icon">

													<span class="m-nav__link-icon-wrapper"><i class="flaticon-share"></i></span>

													<span class="m-nav__link-badge m-badge m-badge--accent">5</span>

												</span>

											</a>

											<div class="m-dropdown__wrapper">

												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>

												<div class="m-dropdown__inner">

													<div class="m-dropdown__header m--align-center">

														<span class="m-dropdown__header-title">Quick Actions</span>

														<span class="m-dropdown__header-subtitle">Shortcuts</span>

													</div>

													<div class="m-dropdown__body m-dropdown__body--paddingless">

														<div class="m-dropdown__content">

															<div class="m-scrollable" data-scrollable="false" data-height="380" data-mobile-height="200">

																<div class="m-nav-grid m-nav-grid--skin-light">

																	<div class="m-nav-grid__row">

																		<a href="#" class="m-nav-grid__item">

																			<i class="m-nav-grid__icon flaticon-file"></i>

																			<span class="m-nav-grid__text">Generate Report</span>

																		</a>

																		<a href="#" class="m-nav-grid__item">

																			<i class="m-nav-grid__icon flaticon-time"></i>

																			<span class="m-nav-grid__text">Add New Event</span>

																		</a>

																	</div>

																	<div class="m-nav-grid__row">

																		<a href="#" class="m-nav-grid__item">

																			<i class="m-nav-grid__icon flaticon-folder"></i>

																			<span class="m-nav-grid__text">Create New Task</span>

																		</a>

																		<a href="#" class="m-nav-grid__item">

																			<i class="m-nav-grid__icon flaticon-clipboard"></i>

																			<span class="m-nav-grid__text">Completed Tasks</span>

																		</a>

																	</div>

																</div>

															</div>

														</div>

													</div>

												</div>

											</div>

										</li>

										<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">

											<a href="#" class="m-nav__link m-dropdown__toggle">

												<span class="m-topbar__userpic">

													<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt="" />

												</span>

												<span class="m-nav__link-icon m-topbar__usericon  m--hide">

													<span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>

												</span>

												<span class="m-topbar__username m--hide">Nick</span>

											</a>

											<div class="m-dropdown__wrapper">

												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>

												<div class="m-dropdown__inner">

													<div class="m-dropdown__header m--align-center">

														<div class="m-card-user m-card-user--skin-light">

															<div class="m-card-user__pic">

																<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="" />

															</div>

															<div class="m-card-user__details">

																<span class="m-card-user__name m--font-weight-500">Mark Andre</span>

																<a href="" class="m-card-user__email m--font-weight-300 m-link">mark.andre@gmail.com</a>

															</div>

														</div>

													</div>

													<div class="m-dropdown__body">

														<div class="m-dropdown__content">

															<ul class="m-nav m-nav--skin-light">

																<li class="m-nav__section m--hide">

																	<span class="m-nav__section-text">Section</span>

																</li>

																<li class="m-nav__separator m-nav__separator--fit">

																</li>

																<li class="m-nav__item">

																	<a href="snippets/pages/user/login-1.html" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>

																</li>

															</ul>

														</div>

													</div>

												</div>

											</div>

										</li>

										<li id="m_quick_sidebar_toggle" class="m-nav__item">

											<a href="#" class="m-nav__link m-dropdown__toggle">

												<span class="m-nav__link-icon"><i class="flaticon-grid-menu"></i></span>

											</a>

										</li>

									</ul>

								</div>

							</div>



							<!-- END: Topbar -->

						</div>

					</div>

				</div>

			</header>



			<!-- begin::Body -->

			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">



				<!-- BEGIN: Left Aside -->

				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>

				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">



					<!-- BEGIN: Aside Menu -->

					<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">

						<ul class="m-menu__nav ">

							<li class="m-menu__section m-menu__section--first">

								<h4 class="m-menu__section-text">Departments</h4>

								<i class="m-menu__section-icon flaticon-more-v2"></i>

							</li>

							<li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="index.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-text">Dashboard</span></a></li>

							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-layers"></i><span

									 class="m-menu__link-text">Resources</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>

								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>

									<ul class="m-menu__subnav">

										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__item-here"></span><span class="m-menu__link-text">Resources</span></span></li>

										<li class="m-menu__item " aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Timesheet</span></a></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Payroll</span></a></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Contacts</span></a></li>

									</ul>

								</div>

							</li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-suitcase"></i><span class="m-menu__link-text">Finance</span></a></li>

							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1"><a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-graphic-1"></i><span

									 class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Support</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--accent">3</span></span> </span></span><i class="m-menu__ver-arrow la la-angle-right"></i></a>

								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>

									<ul class="m-menu__subnav">

										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" m-menu-link-redirect="1"><span class="m-menu__link"><span class="m-menu__item-here"></span><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Support</span>

														<span class="m-menu__link-badge"><span class="m-badge m-badge--accent">3</span></span> </span></span></span></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Reports</span></a></li>

										<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span

												 class="m-menu__link-text">Cases</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>

											<div class="m-menu__submenu "><span class="m-menu__arrow"></span>

												<ul class="m-menu__subnav">

													<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Pending</span></a></li>

													<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Urgent</span></a></li>

													<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Done</span></a></li>

													<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Archive</span></a></li>

												</ul>

											</div>

										</li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Clients</span></a></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Audit</span></a></li>

									</ul>

								</div>

							</li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-light"></i><span class="m-menu__link-text">Administration</span></a></li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-share"></i><span class="m-menu__link-text">Management</span></a></li>

							<li class="m-menu__section ">

								<h4 class="m-menu__section-text">Reports</h4>

								<i class="m-menu__section-icon flaticon-more-v2"></i>

							</li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-graphic"></i><span class="m-menu__link-text">Accounting</span></a></li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-network"></i><span class="m-menu__link-text">Products</span></a></li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-network"></i><span class="m-menu__link-text">Sales</span></a></li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-alert"></i><span class="m-menu__link-title"> <span

										 class="m-menu__link-wrap"> <span class="m-menu__link-text">Bills</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--danger">12</span></span> </span></span></a></li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-technology"></i><span class="m-menu__link-text">IPO</span></a></li>

							<li class="m-menu__section ">

								<h4 class="m-menu__section-text">System</h4>

								<i class="m-menu__section-icon flaticon-more-v2"></i>

							</li>

							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-clipboard"></i><span

									 class="m-menu__link-text">Applications</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>

								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>

									<ul class="m-menu__subnav">

										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__item-here"></span><span class="m-menu__link-text">Applications</span></span></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Audit</span></a></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Notifications</span></a></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Messages</span></a></li>

									</ul>

								</div>

							</li>

							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-computer"></i><span

									 class="m-menu__link-text">Modules</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>

								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>

									<ul class="m-menu__subnav">

										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__item-here"></span><span class="m-menu__link-text">Modules</span></span></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Logs</span></a></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Errors</span></a></li>

										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Configuration</span></a></li>

									</ul>

								</div>

							</li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-cogwheel"></i><span class="m-menu__link-text">Files</span></a></li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-lifebuoy"></i><span class="m-menu__link-text">Security</span></a></li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-settings"></i><span class="m-menu__link-text">Options</span></a></li>

						</ul>

					</div>



					<!-- END: Aside Menu -->

				</div>



