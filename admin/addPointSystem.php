<?php 
	
	include_once '../include/admin/action.php';
	$sport_data = array();
	$action = new Action();

	$sport_data = $action->getSport();
	$sport_data = json_decode($sport_data);

	if($sport_data->success == 1){
		$sport = $sport_data->data;
	} else {
		$sport = array();
 	}

 	$point_type_data = $action->getPointType();
 	$point_type_data = json_decode($point_type_data);

	if($point_type_data->success == 1){
		$point_type = $point_type_data->data;
	} else {
		$point_type = array();
 	}

 	$player_type_data = $action->getPlayerType();
 	$player_type_data = json_decode($player_type_data);

	if($player_type_data->success == 1){
		$player_type = $player_type_data->data;
	} else {
		$player_type = array();
 	}



 	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$t_data = $action->addPointSystem($_POST);
		$t_data = json_decode($t_data);

		if($t_data->success == 1){
			header("location: pointSystemList.php",  true,  301 );
		} else {
			$t_data = array();
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
									Add Player System
								</h3>
							</div>
						</div>
					</div>

					<!--begin::Form-->
					<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="">
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Sport</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square m-input--solid" id="exampleSelect1" name="sport_id" required="required">
										<option value=""> -- Select Sport -- </option>
										<?php foreach ($sport as $key => $value) { ?>
											<option value="<?php echo $value->id; ?>"><?php echo $value->sport_name; ?></option>
										<?php } ?>
									</select>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Point Type</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square m-input--solid" id="point_type_id" name="point_type_id" required="required">
										<option value=""> -- Select Point Type -- </option>
										<?php foreach ($point_type as $key => $value) { ?>
											<option value="<?php echo $value->id; ?>"><?php echo $value->point_type; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Title</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="title" name="title" required="required">
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Point Unit</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square m-input--solid" id="point_unit" name="point_unit" required="required">
										<option value=""> -- Select Point Unit -- </option>
										<option value="0"> Plus </option>
										<option value="1"> Minus </option>
									</select>
								</div>
							</div>
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Player Types</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square m-input--solid" id="role" name="role[]" multiple="multiple">
										<?php foreach ($player_type as $key => $value) { ?>
											<option value="<?php echo $value->id; ?>"><?php echo $value->player_type; ?></option>
										<?php } ?>
									</select>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Point</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="total_point" name="total_point" required="required">
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Code</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="code" name="code">
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Status</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square m-input--solid" id="status" name="status" required="required">
										<option value="0"> Active </option>
										<option value="1"> Inactive </option>
									</select>
								</div>
							</div>
						</div>
						<div class="m-portlet__foot m-portlet__foot--fit">
							<div class="m-form__actions">
								<div class="row">
									<div class="col-2"></div>
									<div class="col-10">
										<button type="Submit" class="btn btn-success">Submit</button>
										<a href="pointSystemList.php" class="btn btn-secondary">Back</a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('#role').select2();
		});
	</script>

<?php include_once '../include/admin/footer_layout.php'; ?>
				