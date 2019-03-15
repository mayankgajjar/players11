<?php 

	include_once '../include/admin/action.php';
	$team_data = array();
	$action = new Action();

	$team_data = $action->getTeamList();
	$team_data = json_decode($team_data);

	if($team_data->success == 1){
		unset($_GET);
		$team = $team_data->data;
	} else {
		$team = array();
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
									Team List
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<!--<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item">
									<a href="crudAction.php?action=getTeam" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air">
										<span>
											<i class="fas fa-plus"></i>
											<span>Fetch Team</span>
										</span>
									</a>
								</li>
								<li class="m-portlet__nav-item"></li>
							</ul>-->
						</div>
					</div>
					<div class="m-portlet__body">

						<!--begin: Datatable -->
						<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Name</th>
									<th>Short Name</th>
									<th>API Code</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach ($team as $key => $value) { 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->name; ?></td>
									<td><?php echo $value->team_short_name; ?></td>
									<td><?php echo $value->team_key; ?></td>
									<td><?php 
										if($value->status == 0){
											echo "<span class='alert-success'>Active</span>";
										} else {
											echo "<span class='alert-danger'>Inactive</span>";
										}
									?></td>
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
				