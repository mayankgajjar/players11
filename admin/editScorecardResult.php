
<?php 
	
	include_once '../include/admin/action.php';
	$sport_data = array();
	$action = new Action();
	$score_data = $action->getScorecardbyId($_GET['id']);
	$score_data = json_decode($score_data);
	
	if($score_data->success == 1){
		$score = $score_data->data;
	} else {
		$score = array();
 	}

 	$tournament_key = $score->tournament_key;
 	$match_key = $score->match_key;

 	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$s_data = $action->updateScorecard($_POST);
		$s_data = json_decode($s_data);

		if($s_data->success == 1){
			header("location: ScorecardResultList.php?tournament_key=".$tournament_key."&match_key=".$match_key."",  true,  301 );
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
									Edit Scorecard
								</h3>
							</div>
						</div>
					</div>

					<!--begin::Form-->
					<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Tournament</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->name; ?>" id="tournament_name" name="tournament_name" disabled>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Match Title</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->match_title; ?>" id="match_title" name="match_title" disabled>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Player Name</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->player_name; ?>" id="player_name" name="player_name" disabled>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Is Playing</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php if($score->in_playing_squad == 0){ echo 'Yes'; } else { echo 'No'; }  ?>" id="is_playing" name="is_playing" disabled>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">
								Red Card</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->red_card; ?>" id="red_card" name="red_card" disabled>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Yellow Card</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->yellow_card; ?>" id="yellow_card" name="yellow_card" disabled>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Y2C Card</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->y2c_card; ?>" id="y2c_card" name="y2c_card" disabled>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Clean Sheet</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php if($score->clean_sheet == 0){ echo 'Yes'; } else { echo 'No'; }  ?>" id="clean_sheet" name="clean_sheet" disabled>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Foul Committed</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->foul_committed; ?>" id="foul_committed" name="foul_committed" disabled>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Foul Drawn</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->foul_drawn;  ?>" id="foul_drawn" name="foul_drawn" disabled>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Goal Assist</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->goal_assist; ?>" id="goal_assist" name="goal_assist" disabled>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Goal Conceded</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->goal_conceded;  ?>" id="goal_conceded" name="goal_conceded" disabled>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Own Goal Conceded</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->goal_own_goal_conceded; ?>" id="goal_own_goal_conceded" name="goal_own_goal_conceded" disabled>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Goal Scored</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->goal_scored;  ?>" id="goal_scored" name="goal_scored" disabled>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Minutes Played</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->minutes_played; ?>" id="minutes_played" name="minutes_played" disabled>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Panalty Missed</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->panalty_missed;  ?>" id="panalty_missed" name="panalty_missed" disabled>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Panalty Saved</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->panalty_saved; ?>" id="panalty_saved" name="panalty_saved" disabled>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Panalty Scored</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" value="<?php echo $score->panalty_scored;  ?>" id="panalty_scored" name="panalty_scored" disabled>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Total Passes</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="total_passes" name="total_passes" value="<?php echo $score->total_passes; ?>">
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Total Shots Save GK</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="total_shots_save_gk" name="total_shots_save_gk" value="<?php echo $score->total_shots_save_gk;  ?>">
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Total Shots Target</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="total_shots_target" name="total_shots_target" value="<?php echo $score->total_shots_target;  ?>">
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Total Goal Conceded Dif/GK</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="total_goal_conceded_dif_gk" name="total_goal_conceded_dif_gk" value="<?php echo $score->total_goal_conceded_dif_gk;  ?>">
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Total Successful Tackles Made</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="total_successful_tackles_made" name="total_successful_tackles_made" value="<?php echo $score->total_successful_tackles_made;  ?>">
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
										<a href="ScorecardResultList.php?tournament_key=<?php echo $score->tournament_key; ?>&match_key=<?php echo $score->match_key; ?>" class="btn btn-secondary">Back</a>
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
				