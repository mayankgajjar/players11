<?php 

	include_once '../include/admin/action.php';
	$player_data = array();
	$action = new Action();

	$player_data = $action->getTournamenPlayerList();
	$player_data = json_decode($player_data);

	if($player_data->success == 1){
		unset($_GET);
		$player = $player_data->data;
	} else {
		$player = array();
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
									Player List
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item">
									<a href="addTournamentPlayer.php" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air">
										<span>
											<i class="fas fa-plus"></i>
											<span>Add Player</span>
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
									<th>Player Name</th>
									<th>Player Short Name</th>
									<th>Team</th>
									<th>API Code</th>
									<th>Role</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach ($player as $key => $value) { 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->name; ?></td>
									<td><?php echo $value->short_name; ?></td>
									<td><?php echo $value->team_name; ?></td>
									<td><?php echo $value->api_code; ?></td>
									<td><?php echo $value->role; ?></td>
									<td><?php 
										if($value->status == 0){
											echo "<span class='alert-success'> Active </span>";
										} else {
											echo "<span class='alert-danger'> Deactive </span>";
										}
									?></td>
									<td>
										<a href="editTournamentPlayer.php?id=<?php echo $value->id; ?>" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Edit Player">
				                          <i class="fa fa-edit"></i>
				                        </a>

				                        <a href="crudAction.php?action=deleteTournamentDate&id=<?php echo $value->id; ?>" class="delete-hover m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" 
				                        	onclick="return confirm('Are you sure want to delete this?')">
				                          <i class="fa fa-trash"></i>
				                        </a>
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


<?php include_once '../include/admin/footer_layout.php'; ?>
				