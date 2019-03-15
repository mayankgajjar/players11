<?php 

	include_once '../include/admin/action.php';
	$match_data = array();
	$action = new Action();

	$match_data = $action->getMatchList();
	$match_data = json_decode($match_data);

	if($match_data->success == 1){
		unset($_GET);
		$match = $match_data->data;
	} else {
		$match = array();
 	}

 	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

 		$frmname = $_POST['frmname'];

 		if($frmname == 'league_form'){
 			$p_data = $action->assignMatchLeague($_POST);
 		} else {
 			$p_data = $action->assignCreditsToPlayer($_POST);
 		}
		
		$p_data = json_decode($p_data);

		if($p_data->success == 1){
			header("location: matchList.php",  true,  301 );
		}
	}

	include_once '../include/admin/head_layout.php';
?>

	<!-- BEGIN: Subheader -->

	<div class="m-content">
		<div class="row">
			<div class="col-md-12">

				<div class="m-portlet m-portlet--mobile">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Match List
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<!--<li class="m-portlet__nav-item">
									<a href="crudAction.php?action=getTeam" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air">
										<span>
											<i class="fas fa-plus"></i>
											<span>Fetch Team</span>
										</span>
									</a>
								</li>
								<li class="m-portlet__nav-item"></li>-->
							</ul>
						</div>
					</div>
					<div class="m-portlet__body">

						<!--begin: Datatable -->
						<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Tournament Name</th>
									<th>Match Title</th>
									<th>Start Date</th>
									<th>Match Status</th>
									<th>Is Point Count</th>
									<th>Leagues</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach ($match as $key => $value) { 
								?>
								<tr> 
									<td><?php echo $i; ?></td>
									<td><?php echo $value->tournament_name; ?></td>
									<td><?php echo $value->match_title; ?></td>
									<td><?php echo $value->start_date_gmt; ?></td>
									<td><?php 
										if($value->match_status == 'not_started'){
											echo 'Not Started';
										} elseif($value->match_status == 'completed') {
											echo 'Completed';
										} elseif($value->match_status == 'started'){
											echo 'Started';
										}
									?></td>
									<td><?php 
										if($value->is_point_count == '1'){
											echo 'Pending';
										} else {
											echo 'Completed';
										}
									?></td>
									<td>
										<?php if($value->is_league == 1) { ?>
											<button class="show-leagues btn btn-info btn-sm waves-effect waves-light m-b-5" data-custom-value=<?php echo $value->match_key; ?> > 
												<strong><?php echo $value->total_league; ?>&nbsp;<span> Leagues</span></strong>
											</button>
										<?php } else {  ?>
											<button class="show-leagues btn btn-success btn-sm waves-effect waves-light m-b-5" data-custom-value=<?php echo $value->match_key; ?>> 
												<strong><span>Assign</span></strong> 
											</button>
										<?php } ?>
									</td>
									<td>
										<?php if($value->is_squad == 1) { ?>
											<button class="show-player btn btn-success btn-sm waves-effect waves-light m-b-5" data-custom-value=<?php echo $value->match_key; ?>> <strong><span>Players</span></strong>
											</button>
										<?php } else { ?>
											<button class="show-player btn btn-info btn-sm waves-effect waves-light m-b-5" data-custom-value=<?php echo $value->match_key; ?>> <strong><span>Squad</span></strong></button>
										<?php } ?>
										<?php
											if($value->match_status == 'completed' && $value->is_point_count == 1){ ?>
												<a href="crudAction.php?action=getMatchPoints&match_key=<?php echo $value->match_key; ?>&tournament_key=<?php echo $value->tournament_key; ?>" 
													class="btn btn-info btn-sm waves-effect waves-light m-b-5" 
				                        			onclick="return confirm('Are you sure want to do this?')">
				                          			<strong>Get Points</strong>
				                        		</a>
										<?php } ?>
									</td>
								</tr>
								<?php $i++; } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-league">
		<form action="" method="POST" id="league-form" name="league-form">
			<input type="hidden" name="frmname" value="league_form"/>
			<input type="hidden" name="match_id" id="match_id" value="">
			<input type="hidden" name="smatch_key" id="smatch_key" value="">
			<div id="league-html"></div>
		</form>
	</div>

	<div class="modal fade" id="modal-player">
		<form action="" method="POST" id="player-form" name="player-form">
			<input type="hidden" name="frmname" value="player_form"/> 
			<input type="hidden" name="match_key" id="match_key" value="">
			<div id="player-html"></div>
		</form>
	</div>

<script type="text/javascript">
	$( document ).ready(function() {
		var table = $('#m_table_2').DataTable({
			"responsive": true,
			"pagingType": "full_numbers",
			"processing": true,
		});
	});


	$(document).on('click', '.show-leagues', function() {
		var match_key = $(this).data("custom-value")
		$.ajax({
            type: "POST",
            url: "crudAction.php?action=show_leagues",
            data: {match_key: match_key},
            success: function (data) {
            	if(data != ''){
            		$('#match_id').val(match_id);
            		$('#league-html').html(data);
            		$('#modal-league').modal('toggle');	
            	} else {
            		alert('All league assign. No more league found.');
            	}
            	
            },
        });
	});
	

	$(document).on('click', '.show-player', function() {
		var match_key = $(this).data("custom-value")
		$.ajax({
            type: "POST",
            url: "crudAction.php?action=show_player",
            data: {match_key: match_key},
            success: function (data) {
            	if(data != ''){
            		$('#match_key').val(match_key);
            		$('#player-html').html(data);
            		$('#modal-player').modal('toggle');	
            	} else {
            		alert('All league assign. No more league found.');
            	}
            	
            },
        });
	});

	$(document).on('click', '#action_checkbox', function () {
        if (this.checked) {
            $('.ch_checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $('.ch_checkbox').each(function () {
                this.checked = false;
            });
        }
    });
    
    $(document).on('click', '.ch_checkbox', function () {
        if ($('.ch_checkbox:checked').length == $('.ch_checkbox').length) {
            $('#action_checkbox').prop('checked', true);
        } else {
            $('#action_checkbox').prop('checked', false);
        }
    });

</script>


<?php include_once '../include/admin/footer_layout.php'; ?>
				