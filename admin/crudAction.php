<?php

	

	include_once '../include/admin/action.php';

	$action = new Action();

	$action_method = $_GET['action'];



	if(isset($action_method) && $action_method != '' && $action_method == 'getTournament'){

 		$get_tournament_data = $action->recent_tournament_api();

		$get_tournament_data = json_decode($get_tournament_data);

		unset($action_method);

		if($get_tournament_data->success == 1){

			header("location: tournamentList.php");

		}

 	}



	if(isset($action_method) && $action_method != '' && $action_method == 'deleteTournamentDate'){

 		$id = $_GET['id'];

 		$delete_tournament_data = $action->deleteTournament($id);

		$delete_tournament_data = json_decode($delete_tournament_data);

		unset($action_method);

		if($delete_tournament_data->success == 1){

			header("location: tournamentList.php");

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'scheduleTournament'){

 		$id = $_GET['id'];

 		$schedule_tournament_data = $action->scheduleTournament($id);

		$schedule_tournament_data = json_decode($schedule_tournament_data);

		unset($action_method);

		if($schedule_tournament_data->success == 1){

			header("location: tournamentList.php");

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'roundActive'){

 		$id = $_GET['id'];

 		$active_data = $action->TournamentRoundActive($id);

		$active_data = json_decode($active_data);

		unset($action_method);

		if($active_data->success == 1){

			header("location: tournamentRoundList.php");

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'roundDeactive'){

 		$id = $_GET['id'];

 		$deactive_data = $action->TournamentRoundDeactive($id);

		$deactive_data = json_decode($deactive_data);

		unset($action_method);

		if($deactive_data->success == 1){

			header("location: tournamentRoundList.php");

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'getTeam'){

 		$id = $_GET['id'];

 		$team_data = $action->getTeam($id);

		$team_data = json_decode($team_data);

		unset($action_method);

		if($team_data->success == 1){

			header("location: teamList.php");

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'get_entry_fee'){

 		$total_amount = $_REQUEST['total_amount'];

 		$total_entrie = $_REQUEST['total_entrie'];



 		$fee_data_json = $action->getEntryFee($total_amount, $total_entrie);

		$fee_data = json_decode($fee_data_json);

		unset($action_method);

		if($fee_data->success == 1){

			echo $fee_data->data->entry_fee;

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'show_leagues'){

 		$match_id = $_REQUEST['match_id'];

 		$show_leagues_data_json = $action->show_leagues($match_id);

		$show_leagues_data = json_decode($show_leagues_data_json);

		unset($action_method);

		if($show_leagues_data->success == 1){

			echo $show_leagues_data->data;

		} else {

			echo '';

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'deleteMatchLeagueDate'){

 		$id = $_GET['id'];

 		$delete_data = $action->deleteMatchLeague($id);

		$delete_data = json_decode($delete_data);

		unset($action_method);

		if($delete_data->success == 1){

			header("location: matchLeagueList.php");

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'show_player'){

 		$match_key = $_REQUEST['match_key'];

 		$show_player_data_json = $action->show_player($match_key);

		$show_player_data = json_decode($show_player_data_json);

		unset($action_method);

		if($show_player_data->success == 1){

			echo $show_player_data->data;

		} else {

			echo '';

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'deletePlayerType'){

 		$id = $_GET['id'];

 		$delete_data = $action->deletePlayerType($id);

		$delete_data = json_decode($delete_data);

		unset($action_method);

		if($delete_data->success == 1){

			header("location: pointTypeList.php");

		}

 	}



 	if(isset($action_method) && $action_method != '' && $action_method == 'getMatchPoints'){

 		$pdata = array(

 			'match_key' => $_GET['match_key'],

 			'tournament_key' => $_GET['tournament_key']

 		);

 		$delete_data = $action->getMatchPoints($pdata);

		$delete_data = json_decode($delete_data);

		unset($action_method);

		if($delete_data->success == 1){

			header("location: matchList.php");

		}

 	}


 	if(isset($action_method) && $action_method != '' && $action_method == 'user_logout'){
 		$delete_data = $action->user_logout();
		$delete_data = json_decode($delete_data);
		unset($action_method);
		if($delete_data->success == 1){
			header("location: index.php");
		}
 	}


?>