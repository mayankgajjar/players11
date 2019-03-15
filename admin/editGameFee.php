<?php 
	
	include_once '../include/admin/action.php';
	$sport_data = array();
	$action = new Action();

	$sport_data = $action->getSport();
	$sport_data = json_decode($sport_data);
	if($sport_data->success == 1){
		$sport = $sport_data->data;
	} 

 	$type_data = array();
 	$type_data = $action->getGameFeebyId($_GET['id']);
 	$type_data = json_decode($type_data);
 	if($type_data->success == 1){
		$fees = $type_data->data;
	}

 	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$t_data = $action->updateGameFee($_POST);
		$t_data = json_decode($t_data);

		if($t_data->success == 1){
			header("location: gameFeeList.php",  true,  301 );
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
									Edit Game Fee
								</h3>
							</div>
						</div>
					</div>

					<!--begin::Form-->
					<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="">
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Sport</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square m-input--solid" id="exampleSelect1" name="sport_id">
										<option value=""> -- Select Sport -- </option>
										<?php foreach ($sport as $key => $value) { ?>
											<option value="<?php echo $value->id; ?>" <?php if($value->id == $fees->sport_id) { echo 'selected'; }?>><?php echo $value->sport_name; ?></option>
										<?php } ?>
									</select>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Min Amount</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="number" id="min_value" name="min_value" required="required" value="<?php echo $fees->min_value; ?>">
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Max Amount</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="number" id="max_value" name="max_value" required="required" value="<?php echo $fees->max_value; ?>">
								</div>
								<label for="example-text-input" class="col-2 col-form-label">GST Tax (%)</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="gst_tax" name="gst_tax" required="required" value="<?php echo $fees->gst_tax; ?>">
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">PG Commission (%)</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="pg_comm" name="pg_comm" required="required" value="<?php echo $fees->pg_comm; ?>">
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Commission (%)</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="comm" name="comm" required="required" value="<?php echo $fees->comm; ?>">
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Total Commission (%)</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="total_comm" name="total_comm"  readonly="readonly" value="<?php echo $fees->comm + $fees->pg_comm + $fees->gst_tax; ?>">
								</div>
							</div>
						</div>
						<div class="m-portlet__foot m-portlet__foot--fit">
							<div class="m-form__actions">
								<div class="row">
									<div class="col-2"></div>
									<div class="col-10">
										<button type="Submit" class="btn btn-success">Submit</button>
										<a href="gameFeeList.php" class="btn btn-secondary">Back</a>
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

	$(document).on("change", "#gst_tax, #pg_comm, #comm", function () {
	     get_total();
	});

	function get_total(){
		var gst_tax = $('#gst_tax').val();
		var pg_comm = $('#pg_comm').val();
		var comm = $('#comm').val();
		var total = parseFloat(gst_tax) + parseFloat(pg_comm) + parseFloat(comm);
		$('#total_comm').val(total);
	}

</script>

<?php include_once '../include/admin/footer_layout.php'; ?>
				