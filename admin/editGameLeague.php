<?php 
	
	include_once '../include/admin/action.php';
	$sport_data = array();
	$action = new Action();

	$sport_data = $action->getSport();
	$sport_data = json_decode($sport_data);

	if($sport_data->success == 1){
		$sport = $sport_data->data;
	} else {
		$sport = array();
 	}

 	$league_data = $action->getGameLeaguebyId($_GET['id']);
 	$league_data = json_decode($league_data);
 	if($league_data->success == 1){
		$league = $league_data->data;
	} else {
		$league = array();
 	}

 	/*echo '<pre>';
 	print_r($league->win_data);
 	die();*/

 	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$t_data = $action->updateGameLeague($_POST);
		$t_data = json_decode($t_data);

		if($t_data->success == 1){
			header("location: gameLeagueList.php",  true,  301 );
		}
	}

	include_once '../include/admin/head_layout.php'; 

?>

	<div class="m-content">
		<div class="row">
			<div class="col-md-12">
				<div class="m-portlet m-portlet--tab">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
									<i class="la la-gear"></i>
								</span>
								<h3 class="m-portlet__head-text">
									Edit League
								</h3>
							</div>
						</div>
					</div>

					<!--begin::Form-->
					<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="">
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Sport</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square m-input--solid" id="exampleSelect1" name="sport_id" required="required">
										<option value=""> -- Select Sport -- </option>
										<?php foreach ($sport as $key => $value) { ?>
											<option value="<?php echo $value->id; ?>" <?php if($league->sport_id == $value->id) { echo 'selected'; } ?>><?php echo $value->sport_name; ?></option>
										<?php } ?>
									</select>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Title</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="title" name="title" required="required" value="<?php echo $league->title; ?>">
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Winning Amount</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="number" id="total_amount" name="total_amount" required="required" value="<?php echo $league->total_amount; ?>">
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Total Players</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="number" id="total_entries" name="total_entries" required="required" value="<?php echo $league->total_entries; ?>">
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Entry Fee</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="text" id="entry_fee" name="entry_fee" readonly="readonly" value="<?php echo $league->entry_fee; ?>">
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Confirm(%)</label>
								<div class="col-4">
									<input class="form-control m-input m-input--solid" type="number" id="confirm_ratio" name="confirm_ratio" required="required" value="<?php echo $league->confirm_ratio; ?>">
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Multi Entry Team</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square is_multi m-input--solid" id="exampleSelect1" name="is_multi">
										<option value="1" <?php if($league->is_multi == 1) { echo 'selected'; } ?>> No </option>
										<option value="0" <?php if($league->is_multi == 0) { echo 'selected'; } ?>> Yes </option>
									</select>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Customize Winnings</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square is_customize m-input--solid" id="exampleSelect1" name="is_customize">
										<option value="1" <?php if($league->is_customize == 1) { echo 'selected'; } ?>> No </option>
										<option value="0" <?php if($league->is_customize == 0) { echo 'selected'; } ?>> Yes </option>
									</select>
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Auto Create League</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square is_auto_create m-input--solid" id="exampleSelect1" name="is_auto_create">
										<option value="1" <?php if($league->is_auto_create == 1) { echo 'selected'; } ?>> No </option>
										<option value="0" <?php if($league->is_auto_create == 0) { echo 'selected'; } ?>> Yes </option>
									</select>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Grand League</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square is_grand m-input--solid" id="exampleSelect1" name="is_grand">
										<option value="1" <?php if($league->is_grand == 1) { echo 'selected'; } ?>> No </option>
										<option value="0" <?php if($league->is_grand == 0) { echo 'selected'; } ?>> Yes </option>
									</select>
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-2 col-form-label">Confirm League</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square is_confirm m-input--solid" id="exampleSelect1" name="is_confirm">
										<option value="1" <?php if($league->is_confirm == 1) { echo 'selected'; } ?>> No </option>
										<option value="0" <?php if($league->is_confirm == 0) { echo 'selected'; } ?>> Yes </option>
									</select>
								</div>
								<label for="example-text-input" class="col-2 col-form-label">Status</label>
								<div class="col-4">
									<select class="form-control m-input m-input--square status m-input--solid" id="exampleSelect1" name="status">
										<option value="0" <?php if($league->status == 0) { echo 'selected'; } ?>> Active </option>
										<option value="1" <?php if($league->status == 1) { echo 'selected'; } ?>> Inactive </option>
									</select>
								</div>
							</div>

							<div class="form-group m-form__group row winning-div">
								<label for="example-text-input" class="col-2 col-form-label">Set No. of Winners</label>
								<div class="col-2">
									<input class="form-control m-input m-input--solid total_winners" type="number" id="total_winners" name="total_winners" value="<?php echo $league->total_winners; ?>">
								</div>
								<div class="col-1">
									<button type="button" class="btn btn-info set-winners" id="set-btn">Set</button>
								</div>
								<div class="col-1">
									<button type="button" class="btn btn-primary calc-winners" id="calculate-btn">Calculate</button>
								</div>
								<div class="col-1">&nbsp;</div>
								<div class="col-5">
									<table class="table table-hover">
										<thead>
										    <tr>
										      	<th scope="col">Rank</th>
										      	<th scope="col">Upto</th>
										      	<th scope="col">Winning %</th>
										      	<th scope="col">Amount</th>
										    </tr>
										</thead>
										<tbody class="win-table-td">
										    <?php $i = 1; foreach ($league->win_data as $key => $value) { ?>
										    	<tr>
										    		<td><input type='text' name='win_data[<?php echo $i; ?>][rank]' id='each-rank-<?php echo $i; ?>' value='<?php echo $i; ?>' class='form-control each-rank' placeholder='Start'></td>
										    		<td><input type='text' name='win_data[<?php echo $i; ?>][rank_range]' id='each-rank-range-<?php echo $i; ?>' class='form-control each-rank-range' data-input-index='<?php echo $i; ?>' placeholder='End' value="<?php echo $value->rank_range; ?>"></td>
										    		<td><input type='text' name='win_data[<?php echo $i; ?>][win_ratio]' id='each-win-ratio-<?php echo $i; ?>' class='form-control each-win-ratio' data-input-index='<?php echo $i; ?>' placeholder='(%)' value='<?php echo $value->win_ratio; ?>'></td>
										    		<td><input type='text' name='win_data[<?php echo $i; ?>][win_amount]' id='each-win-amount-<?php echo $i; ?>' class='form-control each-win-amount' data-input-index='<?php echo $i; ?>' placeholder='Rs' value='<?php echo $value->win_amount; ?>'></td>
										    	</tr>
										    <?php $i++; } ?>
										</tbody>
										<tfoot>
											<td colspan="2"> Total </td>
											<?php 
												$tot_per = 0;
												$tot_amount = 0;
												foreach ($league->win_data as $key => $value) {
													$tot_per = $tot_per + $value->win_ratio;
													$tot_amount = $tot_amount + $value->win_amount;
												} 
											?>
											<td><input type="text" readonly="readonly" class="form-control m-input m-input--solid total-win-ratio" value="<?php echo $tot_per; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control m-input m-input--solid total-win-amount" value="<?php echo $tot_amount; ?>"></td>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="form-group m-form__group row">
							</div>
						</div>
						<div class="m-portlet__foot m-portlet__foot--fit">
							<div class="m-form__actions">
								<div class="row">
									<div class="col-2">
									</div>
									<div class="col-10">
										<button type="Submit" class="btn btn-success" id="save-league">Submit</button>
										<a href="gameLeagueList.php" class="btn btn-secondary">Back</a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">

	$('.winning-div').show();

	$(document).on('change', '.is_customize', function() {
		var customize = $('.is_customize').val();
		if(customize == 1){
			$('.winning-div').hide();
		} else {
			$('.winning-div').show();
		}

	});

	$(document).on('click', '#save-league', function() {
		if($('.total_winners').val() != ''){
			var total_win_ratio  = $('.total-win-ratio').val();
			var total_win_amount  = $('.total-win-amount').val();
			var total_amount = $('#total_amount').val();

			if(total_win_ratio != 100){
				alert('Total winning percentage is a mismatch.');
				return false;
			} else if(total_amount != total_win_amount){
				alert('Total winning amount is a mismatch.');
				return false;
			} else {
				return true;
			}	
		}
	});

	$(document).on('click', '.set-winners', function() {
		var total_winners  = $('#total_winners').val();
		var i;
		var html = '';
		for (i = 1; i <= total_winners; i++) { 
			html += "<tr>";
			html += "<td><input type='text' name='win_data["+i+"][rank]' id='each-rank-"+i+"' value='"+i+"' class='form-control each-rank' placeholder='Start'></td>";
			html += "<td><input type='text' name='win_data["+i+"][rank_range]' id='each-rank-range-"+i+"' class='form-control each-rank-range' data-input-index='"+i+"' placeholder='End'></td>";
			html += "<td><input type='text' name='win_data["+i+"][win_ratio]' id='each-win-ratio-"+i+"' class='form-control each-win-ratio' data-input-index='"+i+"' placeholder='(%)' value='0'></td>";
			html += "<td><input type='text' name='win_data["+i+"][win_amount]' id='each-win-amount-"+i+"' class='form-control each-win-amount' data-input-index='"+i+"' placeholder='Rs' value='0'></td>";
			html += "</tr>";
		}

		$('.win-table-td').html(html);
	});

	$(document).on('change', '.each-rank-range', function() {
		var range_val = $(this).val();
		var index_val = $(this).data("input-index") + 1;
		var new_rank = parseInt(range_val) + 1;
		//$('#each-rank-'+index_val).val(new_rank);
		
		$('#each-rank-'+index_val).attr("data-input-index", new_rank);
		$('#each-rank-range-'+index_val).attr("data-input-index", new_rank);
		$('#each-win-ratio-'+index_val).attr("data-input-index", new_rank);
		$('#each-win-amount-'+index_val).attr("data-input-index", new_rank);

		$(this).closest('tr').next('tr').find('.each-rank').attr('id','each-rank-'+new_rank);
		$(this).closest('tr').next('tr').find('.each-rank-range').attr('id','each-rank-range-'+new_rank);
		$(this).closest('tr').next('tr').find('.each-win-ratio').attr('id','each-win-ratio-'+new_rank);
		$(this).closest('tr').next('tr').find('.each-win-amount').attr('id','each-win-amount-'+new_rank);
		$(this).closest('tr').next('tr').find('.each-rank').val(new_rank);

	});

	$(document).on("change", "#total_amount, #total_entries", function () {
	     get_entry_fee();
	});

	function get_entry_fee(){
		var total_entrie = $('#total_entries').val();
		var total_amount = $('#total_amount').val();

		if(total_entrie == ''){
			total_entrie = 0;
		}

		$.ajax({
            type: "POST",
            url: "crudAction.php?action=get_entry_fee",
            data: {total_entrie: total_entrie, total_amount: total_amount},
            success: function (data) {
            	$('#entry_fee').val(data);
            },
        });
	}

	$(document).on("change", ".each-win-ratio", function () {
	    var win_ratio = $(this).val();
	    var total_amount = $('#total_amount').val();
	    var each_win_amount =  parseFloat(total_amount) * parseFloat(win_ratio) / 100;
	    var amount = Math.round(each_win_amount);
	    $(this).closest('tr').find('.each-win-amount').val(amount);
	    get_grand_total();
	});


	$(document).on("change", ".each-win-amount", function () {
	    var each_win_amount = $(this).val();
	    var total_amount = $('#total_amount').val();
	    var win_ratio = parseFloat(each_win_amount) * 100 / parseFloat(total_amount);
	    //var each_win_amount =  parseFloat(total_amount) * parseFloat(win_ratio) / 100;
	    var per = Math.round(win_ratio);
	    $(this).closest('tr').find('.each-win-ratio').val(per);
	    get_grand_total();
	});


	function get_grand_total(){
		var total_per = 0;
		var total_amount = 0;
		
		$('.each-win-ratio').each(function (index, value) { 
		  	total_per = parseFloat(total_per) + parseFloat($(this).val());
		})
		$('.total-win-ratio').val(total_per);

		$('.each-win-amount').each(function (index, value) { 
		  total_amount = parseFloat(total_amount) + parseFloat($(this).val());
		})
		$('.total-win-amount').val(total_amount);
	}

</script>

<?php include_once '../include/admin/footer_layout.php'; ?>
				