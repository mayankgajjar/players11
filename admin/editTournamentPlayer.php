
<?php 
	
	include_once '../include/admin/action.php';
	$player_data = array();
	$role_data = array();
	$team_data = array();

	$action = new Action();
	$player_data = $action->getPlayerbyId($_GET['id']);
	$player_data = json_decode($player_data);
	
	if($player_data->success == 1){
		$player = $player_data->data;
	} else {
		$player = array();
 	}

 	$role_data = $action->getPlayerType();
	$role_data = json_decode($role_data);
	
	if($role_data->success == 1){
		$role = $role_data->data;
	} else {
		$role = array();
 	}

 	$team_data = $action->getTeamList();
	$team_data = json_decode($team_data);
	
	if($team_data->success == 1){
		$team = $team_data->data;
	} else {
		$team = array();
 	}

 	$sport_data = $action->getSport();
	$sport_data = json_decode($sport_data);
	
	if($sport_data->success == 1){
		$sport = $sport_data->data;
	} else {
		$sport = array();
 	}


 	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

 		if(isset($_FILES)){
 			$files = $_FILES;
 		} else {
 			$files = '';
 		}

		$p_data = $action->updatePlayer($_POST, $files);
		$p_data = json_decode($p_data);

		if($p_data->success == 1){
			header("location: tournamentPlayerList.php",  true,  301 );
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
									Edit Player
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
									<select class="custom-select form-control m-input--solid" name="sport_id" id="sport_id">
										<option>Select Sport</option>
										<?php foreach ($sport as $key => $value) { ?>
											<option value="<?php echo $value->id; ?>" <?php if($player->sport_id == $value->id){ echo 'selected'; } ?>><?php echo $value->sport_name; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>

						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Player Name</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $player->name ?>" id="name" name="name" required>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Player Short Name</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $player->short_name ?>" id="short_name" name="short_name" required>
								</div>
							</div>
						</div>

						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">API Code</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $player->api_code ?>" id="api_code" name="api_code" required>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Credits</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $player->credits ?>" id="credits" name="credits" >
								</div>
							</div>
						</div>

						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Team</label>
								<div class="col-4">
									<select class="custom-select form-control m-input--solid" name="team_key" id="team_key">
										<option>Select Team</option>
										<?php foreach ($team as $key => $value) { ?>
											<option value="<?php echo $value->team_key; ?>" <?php if($player->team_key == $value->team_key){ echo 'selected'; } ?>><?php echo $value->name; ?></option>
										<?php } ?>
									</select>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Role</label>
								<div class="col-4">
									<select class="custom-select form-control m-input--solid" name="role" id="role">
										<option>Select Role</option>
										<?php foreach ($role as $key => $value) { ?>
											<option value="<?php echo $value->player_type; ?>" <?php if($value->player_type == $player->role){ echo 'selected'; } ?> required><?php echo $value->player_type; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>

						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Profile Picture</label>
								<div class="col-4">
									<div class="custom-file">
										<input type="file" name="profile_pic" class="custom-file-input" id="customFile">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Status</label>
								<div class="col-4">
									<select class="custom-select form-control m-input--solid" name="status" id="status">
										<option>Select Status</option>
										<option value="0" <?php if($player->status == '0'){ echo 'selected'; } ?>>Active</option>
										<option value="1" <?php if($player->status == '1'){ echo 'selected'; } ?>>Inactive</option>
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
										<a href="tournamentPlayerList.php" class="btn btn-secondary">Back</a>
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
				