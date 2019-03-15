<?php 

	include_once '../include/admin/action.php';
	$leagues_data = array();
	$action = new Action();

	$leagues_data = $action->getMatchLeaguesList();
	$leagues_data = json_decode($leagues_data);

	if($leagues_data->success == 1){
		unset($_GET);
		$leagues = $leagues_data->data;
	} else {
		$leagues = array();
 	}

 	$url = 'http://localhost/players11/'; 	

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
									Match Leagues List
								</h3>
							</div>
						</div>
						<!--<div class="m-portlet__head-tools">
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
						</div>-->
					</div>
					<div class="m-portlet__body">

						<!--begin: Datatable -->
						<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Match Name</th>
									<th>Title</th>
									<th>Winning</th>
									<th>League Player</th>
									<th>Total Winners</th>
									<th>Grand</th>
									<th>Multi Entry</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach ($leagues as $key => $value) { 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->match_short_name; ?></td>
									<td><?php echo $value->title; ?></td>
									<td><?php echo $value->total_amount; ?></td>
									<td><?php echo $value->total_entries; ?></td>
									<td><?php echo $value->total_winners; ?></td>
									<td>
										<?php 
											if($value->is_grand == 0){
												echo "<span class='alert-success'> Yes </span>";
											} else {
												echo "<span class='alert-danger'> No </span>";
											}
										?>
									</td>
									<td>
										<?php 
											if($value->is_multi == 0){
												echo "<span class='alert-success'> Yes </span>";
											} else {
												echo "<span class='alert-danger'> No </span>";
											}
										?>
									</td>
									<td><?php 
										if($value->status == 0){
											echo "<span class='alert-success'> Active </span>";
										} else {
											echo "<span class='alert-danger'> Deactive </span>";
										}
									?></td>
									<td>

				                        <a href="crudAction.php?action=deleteMatchLeagueDate&id=<?php echo $value->id; ?>" class="delete-hover m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" 
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
				