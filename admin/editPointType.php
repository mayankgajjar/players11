<?php 
	
	include_once '../include/admin/action.php';
	$action = new Action();

	$sport_data = $action->getSport();
	$sport_data = json_decode($sport_data);

	if($sport_data->success == 1){
		$sport = $sport_data->data;
	} else {
		$sport = array();
 	}

 	$point_data = $action->getPointTypeById($_GET['id']);
 	$point_data = json_decode($point_data);

 	if($point_data->success == 1){
		$point = $point_data->data;
	}

 	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$t_data = $action->updatePointType($_POST);
		$t_data = json_decode($t_data);

		if($t_data->success == 1){
			header("location: pointTypeList.php",  true,  301 );
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
									Edit Player Type
								</h3>
							</div>
						</div>
					</div>

					<!--begin::Form-->
					<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Sport</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square m-input--solid" id="exampleSelect1" name="sport_id">
										<option value=""> -- Select Sport -- </option>
										<?php foreach ($sport as $key => $value) { ?>
											<option value="<?php echo $value->id; ?>" <?php if($value->id == $point->sport_id) { echo 'selected'; }?>><?php echo $value->sport_name; ?></option>
										<?php } ?>
									</select>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Point Type</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="pont_type" name="pont_type" value="<?php echo $point->pont_type; ?>" required="required">
								</div>
							</div>
							
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Status</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square m-input--solid" id="status" name="status">
										<option value="0" <?php if( $point->status == 0 ){ echo 'selected'; } ?>> Active </option>
										<option value="1" <?php if( $point->status == 1 ){ echo 'selected'; } ?>> Inactive </option>
									</select>
								</div>
							</div>
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Icon</label>
								<div class="col-4">
									<div class="custom-file">
										<input type="file" name="icon" class="custom-file-input" id="icon">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
								</div>
								<div class="col-2">
									
								</div>
							</div>
						</div>
						
						<div class="m-portlet__foot m-portlet__foot--fit">
							<div class="m-form__actions">
								<div class="row">
									<div class="col-2"></div>
									<div class="col-10">
										<button type="Submit" class="btn btn-success">Submit</button>
										<a href="pointTypeList.php" class="btn btn-secondary">Back</a>
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
				