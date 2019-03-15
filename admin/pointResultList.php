<?php 

	include_once '../include/admin/action.php';
	$round_data = array();
	$action = new Action();

	$data = array(
		'match_key' => $_GET['match_key'],
		'tournament_key' => $_GET['tournament_key']
	);

	$round_data = $action->getPointResult($data);
	$round_data = json_decode($round_data);


	if($round_data->success == 1){
		$result = $round_data->data;
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
									Player Point
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
									<th>Match Title</th>
									<th>Match Short Title</th>
									<th>Player Name</th>
									<th>Total Point</th>
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
									<td><?php echo $value->match_title; ?></td>
									<td><?php echo $value->match_short_name; ?></td>
									<td><?php echo $value->player_name; ?></td>
									<td><?php echo $value->total_point; ?></td>
									<td>
										<a href="viewPoint.php?id=<?php echo $value->point_id; ?>" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Show Scorecard">
											<i class="fa fa-eye"></i>
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
				