
<?php 
	
	include_once '../include/admin/action.php';
	$action = new Action();
	$point_data = $action->getPointbyId($_GET['id']);
	$point_data = json_decode($point_data);
	
	if($point_data->success == 1){
		$point = $point_data->data;
	} else {
		$point = array();
 	}

 	$point_system = $action->getPointSystem();
	$point_system = json_decode($point_system);
	
	if($point_system->success == 1){
		$system = $point_system->data;
	} else {
		$system = array();
 	}

 	$role_array = $system->role;
 	

 	$scorecard_data = $action->getScorecardInfo($point->tournament_key,$point->match_key,$point->player_key);
 	$scorecard_data = json_decode($scorecard_data);
	
	if($scorecard_data->success == 1){
		$scorecard = $scorecard_data->data;
		$scorecard =  (array) $scorecard;
	} else {
		$scorecard = array();
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
								Player Point
							</h3>
						</div>
					</div>
				</div>

				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="">
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-1 col-form-label">Player Name</label>
							<div class="col-3">
								<input class="form-control m-input m-input--solid" type="text" value="<?php echo $point->player_name ?>" id="player_name" name="player_name" disabled>
							</div>
							<label for="example-text-input" class="col-1 col-form-label">Tournament Name</label>
							<div class="col-3">
								<input class="form-control m-input m-input--solid" type="text" value="<?php echo $point->tournament_name ?>" id="tournament_name" name="tournament_name" disabled>
							</div>
							<label for="example-text-input" class="col-1 col-form-label">Match Name</label>
							<div class="col-3">
								<input class="form-control m-input m-input--solid" type="text" value="<?php echo $point->match_title ?>" id="match_title" name="match_title" disabled>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-1 col-form-label">&nbsp;</label>
							<div class="col-10">
							  	<div class="table-responsive">          
								  	<table class="table">
									    <thead>
									      	<tr>
									        	<th><strong>#</strong></th>
									        	<th><strong>Title</strong></th>
									        	<th><strong>Point Unit</strong></th>
									        	<th><strong>Point</strong></th>
									        	<th><strong>Obtain Point</strong></th>
									      	</tr>
									    </thead>
									    <tbody>
									    	<?php 
									      	$i = 1; 
									      	foreach ($system as $key => $value) { 
									      		foreach ($scorecard as $key02 => $value02) {
									      			if($value->code == $key02){
									      				$skey = array($key02);
									      			}
									      		}
									      	?>

									      	<tr>
									      		<td><?php echo $i; ?></td>	
									      		<td><?php echo $value->title; ?></td>
									      		<td><?php if($value->point_unit == 0){
									      				echo 'Plus';
									      			} else {
									      				echo 'Minus';
									      			}
									      		?></td>
												<td><?php echo $value->total_point; ?></td>
												<td>
													<?php
													if (array_key_exists($value->code,$scorecard)){
														if($value->code == end($skey)){
															echo $value->total_point * $scorecard[$value->code];
														}
													} else {

														if($scorecard['minutes_played'] > 55){
															if($value->code == 'minutes_played_more_55'){
							                                    echo $value->total_point;
							                                } 
														} else {
															if ($value->code == 'minutes_played_less_55') {
							                                    echo $value->total_point;
							                                }
														}

						                                if($value->code == '10_passes' ){
						                                    $res_str = $scorecard['total_passes'] != '' && $scorecard['total_passes'] != 0 ? number_format($scorecard['total_passes'] / 10, 1) : '0.0';
						                                    if($res_str != ''){
							                                    $res_array = explode(".",$res_str);
							                                    $tpasses = $res_array['0'];
							                                    echo $tpasses * $value->total_point;
							                                }
						                                } elseif ($value->code == '2_goal_conceded_dif_gk'){
						                                    $res_str = $scorecard['total_goal_conceded_dif_gk'] != '' && $scorecard['total_goal_conceded_dif_gk'] != 0 ? number_format($scorecard['total_goal_conceded_dif_gk'] / 2, 1) : '0.0';
						                                    if($res_str != ''){
							                                    $res_array = explode(".",$res_str);
							                                    $tpasses = $res_array['0'];
							                                    echo $tpasses * $value->total_point;
							                                }
						                                } elseif ($value->code == '2_shots_target'){
						                                    //$res_str = $total_shots_target != 0 ? number_format($total_shots_target / 10, 1) : '0.0';
						                                	$res_str = $scorecard['total_shots_target'] != '' && $scorecard['total_shots_target'] != 0 ? number_format($scorecard['total_shots_target'] / 2, 1) : '0.0';
						                                	if($res_str != ''){
							                                    $res_array = explode(".",$res_str);
							                                    $tpasses = $res_array['0'];
							                                    echo $tpasses * $value->total_point;
							                                }
						                                } elseif ($value->code == '3_shots_save_gk'){
						                                    $res_str = $scorecard['total_shots_save_gk'] != '' && $scorecard['total_shots_save_gk'] != 0 ? number_format($scorecard['total_shots_save_gk'] / 3, 1) : '0.0';
															if($res_str != ''){
							                                    $res_array = explode(".",$res_str);
							                                    $tpasses = $res_array['0'];
							                                    echo $tpasses * $value->total_point;
							                                }						                                    
						                                } elseif ($value->code == '3_successful_tackles_made'){
						                                    $res_str = $scorecard['total_successful_tackles_made'] != '' && $scorecard['total_successful_tackles_made'] != 0 ? number_format($scorecard['total_successful_tackles_made'] / 3, 1) : '0.0';
						                                    if($res_str != ''){
							                                    $res_array = explode(".",$res_str);
							                                    $tpasses = $res_array['0'];
							                                    echo $tpasses * $value->total_point;
							                                }
						                                }

													}
													?>
												</td>
									      	</tr>
									      	<?php $i++; } ?>
									    </tbody>
									    <tfoot>
										    <tr>
										    	<th>&nbsp;</th>
										    	<th>&nbsp;</th>
										    	<th>&nbsp;</th>
										      	<th><strong>Total</strong></th>
										      	<td><strong><?php echo $point->total_point; ?></strong></td>
										    </tr>
										</tfoot>
								  	</table>
								</div>
							</div>
							<label for="example-text-input" class="col-1 col-form-label">&nbsp;</label>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include_once '../include/admin/footer_layout.php'; ?>
				