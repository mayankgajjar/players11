<?php 
	
	include_once '../include/admin/action.php';
	$gamefee_data = array();
	$action = new Action();

	if(isset($_GET['action']) && $_GET['action'] != '' && $_GET['action'] == 'delete'){
 		$id = $_GET['id'];

 		$fee_data = $action->deleteGameFee($id);
		$fee_data = json_decode($fee_data);

		if($fee_data->success == 1){
			header("location: gameFeeList.php",  true,  301 );
		} 
 	}

	
	$gamefee_data = $action->getGameFees();
	$gamefee_data = json_decode($gamefee_data);

	if($gamefee_data->success == 1){
		$gamefee = $gamefee_data->data;
	} else {
		$gamefee = array();
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
									Game Fees
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item">
									<a href="addGameFee.php" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air">
										<span>
											<i class="fas fa-plus"></i>
											<span>Add New</span>
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
									<th>Min</th>
									<th>Max</th>
									<th>GST Tax</th>
									<th>PG Commission</th>
									<th>Commission</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach ($gamefee as $key => $value) { 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->sport_name; ?></td>
									<td><?php echo $value->min_value; ?></td>
									<td><?php echo $value->max_value; ?></td>
									<td><?php echo $value->gst_tax; ?></td>
									<td><?php echo $value->pg_comm; ?></td>
									<td><?php echo $value->comm; ?></td>
									<td>
										<a href="editGameFee.php?id=<?php echo $value->id; ?>" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
				                          <i class="fa fa-edit"></i>
				                        </a>
				                        <a href="gameFeeList.php?action=delete&id=<?php echo $value->id; ?>" class="delete-hover m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" 
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
				