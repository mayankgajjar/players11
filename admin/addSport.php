
<?php 
	
 	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 		include_once '../include/admin/action.php';
		$sport_data = array();
		$action = new Action();
		$s_data = $action->addSport($_POST);
		$s_data = json_decode($s_data);

		if($s_data->success == 1){
			//header("Location: sportList.php");
			header("location: sportList.php",  true,  301 );
		} else {
			$sport = array();
	 	}
	}

	include_once '../include/admin/head_layout.php'; 

?>

	<div class="m-content">
		<div class="row">
			<div class="col-md-12">
				<div class="m-portlet m-portlet--tab">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
									<i class="la la-gear"></i>
								</span>
								<h3 class="m-portlet__head-text">
									Add Sport
								</h3>
							</div>
						</div>
					</div>

					<!--begin::Form-->
					<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="">
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Sport Name</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="sport_name" name="sport_name">
								</div>
							</div>
							
						</div>
						<div class="m-portlet__foot m-portlet__foot--fit">
							<div class="m-form__actions">
								<div class="row">
									<div class="col-2">
									</div>
									<div class="col-10">
										<button type="Submit" class="btn btn-success">Submit</button>
										<a href="sportList.php" class="btn btn-secondary">Back</a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php include_once '../include/admin/footer_layout.php'; ?>
				