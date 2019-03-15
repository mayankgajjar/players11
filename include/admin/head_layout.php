<?php
	session_start();

	if(empty($_SESSION['login_user']) || $_SESSION['login_user'] == ''){
		header("Location: index.php");
	}
?>

<!DOCTYPE html>



<html lang="en">



	<!-- begin::Head -->

	<head>

		<?php 

			include_once '../include/admin/css.php';

		 ?>

	</head>



	<!-- end::Head -->



	<!-- begin::Body -->

	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">



		<!-- begin:: Page -->

		<div class="m-grid m-grid--hor m-grid--root m-page">



			<!-- BEGIN: Header -->

				<?php  include_once '../include/admin/headerbar.php';?>

			<!-- END: Header -->



			<!-- begin::Body -->

			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">



				<?php include_once '../include/admin/sidebar.php'; ?>



				<!-- END: Left Aside -->

				<div class="m-grid__item m-grid__item--fluid m-wrapper">