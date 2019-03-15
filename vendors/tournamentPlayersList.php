<?php 

	include_once 'include/action.php';
	$player_data = array();
	$action = new Action();

	$player_data = $action->getTournamenPlayertList();
	$player_data = json_decode($player_data);

	if($player_data->success == 1){
		unset($_GET);
		$tournament = $player_data->data;
	} else {
		$tournament = array();
 	}

 	$url = 'http://localhost/players11/'; 	

	include_once 'include/head_layout.php';
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
									Tournament List
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item">
									<a href="crudAction.php?action=getTournament" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air">
										<span>
											<i class="fas fa-plus"></i>
											<span>Fetch Tournament</span>
										</span>
									</a>
								</li>
								<li class="m-portlet__nav-item"></li>
							</ul>
						</div>
					</div>
					<div class="m-portlet__body">

						<!--begin: Datatable -->
						<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Sport Name</th>
									<th>Tournament Name</th>
									<th>API Code</th>
									<th>Tournament Short Name</th>
									<th>Start Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach ($tournament as $key => $value) { 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->sport_name; ?></td>
									<td><?php echo $value->name; ?></td>
									<td><?php echo $value->api_code; ?></td>
									<td><?php echo $value->short_name; ?></td>
									<td><?php echo $value->start_date; ?></td>
									<td>
				                        <!--<a href="crudAction.php?action=deleteTournamentDate&id=<?php echo $value->id; ?>" class="delete-hover m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" 
				                        	onclick="return confirm('Are you sure want to delete this?')">
				                          <i class="fa fa-trash"></i>
				                        </a>-->
				                        <?php if($value->is_fetch == 0){ ?>
				                        	<a href="crudAction.php?action=scheduleTournament&id=<?php echo $value->id; ?>" class="btn-sm btn-success" title="Schedule">Schedule</a>
				                    	<?php } else { ?>
				                    		<a href="crudAction.php?action=scheduleTournament&id=<?php echo $value->id; ?>" class="btn-sm btn-info" title="Re Schedule">Re Schedule</a>
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

<script type="text/javascript">
	$( document ).ready(function() {
		var table = $('#m_table_2').DataTable({
			"responsive": true,
			"pagingType": "full_numbers",
			"processing": true,
		});
	});
</script>


<?php include_once 'include/footer_layout.php'; ?>
				