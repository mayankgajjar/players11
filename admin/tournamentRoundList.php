<?php 

	include_once '../include/admin/action.php';
	$round_data = array();
	$action = new Action();

	$round_data = $action->getTournamentRoundList();
	$round_data = json_decode($round_data);

	if($round_data->success == 1){
		$round = $round_data->data;
	} else {
		$round = array();
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
									Round List
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
									<th>Tournament Name</th>
									<th>Round Name</th>
									<th>Round API Code</th>
									<th>Round Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach ($round as $key => $value) { 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->name; ?></td>
									<td><?php echo $value->round_name; ?></td>
									<td><?php echo $value->round_api_code; ?></td>
									<td><?php 
										if($value->is_fetch == 0){
											echo "<span class='alert-danger'> Deactive </span>";
										} else {
											echo "<span class='alert-success'> Active </span>";
										}
									?></td>
									<td>
				                        <?php if($value->is_fetch == 0){ ?>
				                        	<a href="crudAction.php?action=roundActive&id=<?php echo $value->id; ?>" class="btn-sm btn-success" title="Active Round">Active</a>
				                    	<?php } else { ?>
				                    		<a href="crudAction.php?action=roundDeactive&id=<?php echo $value->id; ?>" class="btn-sm btn-danger" title="Deactive Round">Deactive</a>
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


<?php include_once '../include/admin/footer_layout.php'; ?>
				