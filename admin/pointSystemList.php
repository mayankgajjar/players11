<?php 
	
	include_once '../include/admin/action.php';
	$sport_data = array();
	$action = new Action();

	if(isset($_GET['action']) && $_GET['action'] != '' && $_GET['action'] == 'delete'){
 		$id = $_GET['id'];

 		$point_data = $action->deletePointSystem($id);
		$point_data = json_decode($point_data);

		if($point_data->success == 1){
			header("location: pointSystemList.php",  true,  301 );
		} else {
			$sport = array();
	 	}
 	}

	
	$point_data = $action->getPointSystem();
	$point_data = json_decode($point_data);

	if($point_data->success == 1){
		$point = $point_data->data;
	} else {
		$point = array();
 	} 	

	include_once '..include/admin/head_layout.php';
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
									Point System List
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item">
									<a href="addPointSystem.php" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air">
										<span>
											<i class="fas fa-plus"></i>
											<span>New Point System</span>
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
									<th>Point Type</th>
									<th>Title</th>
									<th>Point</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach ($point as $key => $value) { 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->sport_name; ?></td>
									<td><?php echo $value->point_type; ?></td>
									<td><?php echo $value->title; ?></td>
									<td><?php echo $value->total_point; ?></td>
									<td>
										<?php 
											if($value->status == 0) {
												echo "<span class='alert-success'> Active </span>";
											} else {
												echo "<span class='alert-danger'> Inactive </span>";
											}
										?>
									</td>
									<td>
										<a href="editPointSystem.php?id=<?php echo $value->id; ?>" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
				                          <i class="fa fa-edit"></i>
				                        </a>
				                        
				                        <a href="pointSystemList.php?action=delete&id=<?php echo $value->id; ?>" class="delete-hover m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" 
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


<?php include_once 'include/footer_layout.php'; ?>
				