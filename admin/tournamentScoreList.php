<?php 

	include_once '../include/admin/action.php';
	$round_data = array();
	$action = new Action();

	$result_data = $action->getTournamentResult();
	$result_data = json_decode($result_data);

	if($result_data->success == 1){
		$result = $result_data->data;
	} else {
		$result = array();
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
									Tournament Result
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">

						<!--begin: Datatable -->
						<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Tournament Code</th>
									<th>Tournament Name</th>
									<th>Tournament Shortname</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach ($result as $key => $value) { 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->tournament_key; ?></td>
									<td><?php echo $value->name; ?></td>
									<td><?php echo $value->short_name; ?></td>
									<td>
										<a href="matchResultList.php?tournament_key=<?php echo $value->tournament_key; ?>" class="btn-sm btn-success" title="Show Match"><i class="fa fa-eye"></i></a>
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
				