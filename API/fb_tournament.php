<?php 

	$connection=mysqli_connect('localhost','nexusuvx_nexus','VbYD%$Rhq&s5','nexusuvx_player11');

	$request_method=$_REQUEST["REQUEST_METHOD"];


	switch($request_method)
	{
		case 'tournamentList':
			if(!empty($_REQUEST["id"]))
			{
				$id=intval($_REQUEST["id"]);
				get_tournament($id);
			} else {
				get_tournament();
			}
			break;
		case 'matchList':
			if(!empty($_REQUEST["id"]))
			{
				$id=intval($_REQUEST["id"]);
				get_match($id);
			} else {
				get_match();
			}
			break;
		case 'leagueList':
			$match_key=intval($_REQUEST["match_key"]);
			get_league($match_key);
			break;
		case 'playerList':
			$match_key=intval($_REQUEST["match_key"]);
			get_player($match_key);
			break;
		case 'createTeam':
			create_team();
			break;
		case 'joinContest':
			join_contest();
			break;
		case 'pointSystem':
			point_system();
			break;
		case 'match':
			myMatch();
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

	function api_response($data = '', $status = '', $remark = ''){

		$search = new stdClass();
		$search->sort = 'id';
		$search->by = 'asc';
		$search->limit = '20';
		$search->offset = '0';

		$res = new stdClass();
		$res->auth = $status;
		$res->remark = $remark;
		$res->search = $search;
		$res->data = $data;
		$res->status = $status;
		$res->server_date = date("Y-m-d h:i:s");
		$res->total = sizeof($data);

		header('Content-Type: application/json');
		return json_encode($res);	
		
	}

	function get_tournament($id = 0)
	{

		global $connection;
		
		$query="SELECT id,api_code,name,short_name,start_date FROM game_tournament WHERE is_fetch = '1'";
		
		if($id != 0) {
			$query.=" AND id =".$id." LIMIT 1";
		}

		$result=mysqli_query($connection, $query);

		if($result->num_rows != 0){
			while($row=mysqli_fetch_object($result)) {
				$res_data[]=$row;
			}

			if(sizeof($res_data) != 0) {
				$response = api_response($res_data, $status = true, $remark = "Data Found.");
			} 
		} else {
			$res_data  = array();
			$response = api_response($res_data, $status = false, $remark = "No Data Found.");
		}

		echo $response;
	}


	function get_match($id = 0) {
		global $connection;
		$query = "SELECT id,match_key,home_short_name,away_short_name,home_key,away_key,match_title,match_short_name FROM `game_tournament_match` WHERE `match_status` = 'not_started' AND `is_squad` = '0' AND `is_league` = '0'";


		if($id != 0) {
			$query.=" AND id =".$id." LIMIT 1";
		}
		$result=mysqli_query($connection, $query);
		if($result->num_rows != 0){
			while($row=mysqli_fetch_object($result)) {
				$res_data[]=$row;
			}

			if(sizeof($res_data) != 0) {
				$response = api_response($res_data, $status = true, $remark = "Data Found.");
			} 
		} else {
			$res_data  = array();
			$response = api_response($res_data, $status = false, $remark = "No Data Found.");
		}
		echo $response;
	}


	function get_league($match_key = 0){
		global $connection;

		if(isset($_REQUEST["league_type"])){
			$league_type = $_REQUEST["league_type"];
		} else {
			$league_type = '';
		}
		
		$query = "SELECT id,match_id,ref_league_id,title,total_amount,total_entries,total_winners,total_joins,entry_fee,is_full
		,is_practise,is_confirm,is_customize FROM game_tournament_match_league WHERE match_key = $match_key AND is_full = 1";
		
		if($league_type = 'free' && $league_type != '') {
			$query.=" AND is_practise = 0";
		} else {
			$query.=" AND is_practise = 1";
		}
		
		$result = mysqli_query($connection,$query);
		if($result->num_rows != 0){
			while($row=mysqli_fetch_object($result)) {
				$res_data[]=$row;
			}

			if(sizeof($res_data) != 0) {
				$response = api_response($res_data, $status = true, $remark = "Data Found.");
			} 
		} else {
			$res_data  = array();
			$response = api_response($res_data, $status = false, $remark = "No Data Found.");
		}
		echo $response;
	}


	function get_player($match_key){
		global $connection;
		$query = "SELECT id,match_key,team_key,name,api_code,tournament_api_code,credits,role
			FROM game_player 
			WHERE match_key = $match_key";

		$result = mysqli_query($connection,$query);

		if($result->num_rows != 0) { 
			while($row=mysqli_fetch_object($result)) {
				$res_data[]=$row;
			}

			if(sizeof($res_data) != 0) {
				$response = api_response($res_data, $status = true, $remark = "Data Found.");
			} 
		} else {
			$res_data  = array();
			$response = api_response($res_data, $status = false, $remark = "No Data Found");
		}
		echo $response;
	}


	function create_team(){
		global $connection;
		
		$player_array = json_decode($_REQUEST['player_json'], True);
		$match = json_decode($_REQUEST['match'], True);
		$captain = json_decode($_REQUEST['captain'], True);
		$vcaptain = json_decode($_REQUEST['vcaptain'], True);
		$total_credit = $_REQUEST['total_credit'];
		$used_credit = $_REQUEST['used_credit'];
		$user_id = $_REQUEST['user_id'];
		$pjson = $_REQUEST['player_json'];
		$pjson = json_encode($_REQUEST['player_json']);


		$player_key_json = json_encode(array_values($player_array), True);
		//$player_id_json = serialize(array_keys($player_array));
		$player_id_json = json_encode(array_keys($player_array), True);
		$player_id_json = json_encode($player_id_json);
		$captain_id = array_keys($captain);
		$captain_key = array_values($captain);
		$vcaptain_id = array_keys($vcaptain);
		$vcaptain_key = array_values($vcaptain);
		$match_id = array_keys($match);
		$match_key = array_values($match);
		//$team_no = '10';
		$sel_query = "SELECT MAX(team_no) AS max_team_no FROM user_team WHERE match_key = $match_key[0] AND user_id = $user_id";
		$result_02 = mysqli_query($connection,$sel_query);

		if($result_02->num_rows == 1) {
			while($row=mysqli_fetch_object($result_02)) {
				if($row->max_team_no != '' && $row->max_team_no != null) {
					if($row->max_team_no == 5) {
						$res_data  = array();
						$response = api_response($res_data, $status = false, $remark = "Only 5 team allow on one match.");
						echo $response;
						die();
					} else {
						$team_no = $row->max_team_no + 1;	
					}	
				} else {
					$team_no = 1;
				}
			}
		} 

		$user_team_insert = "INSERT INTO user_team(user_id, match_id, match_key, team_no, captain_id, vcaptain_id, captain_key, vcaptain_key, total_credit, used_credit) VALUES ($user_id,".$match_id[0].",".$match_key[0].",$team_no,".$captain_id[0].",".$vcaptain_id[0].",".$captain_key[0].",".$vcaptain_key[0].",".$total_credit[0].",".$used_credit[0].")";
		$result = mysqli_query($connection,$user_team_insert);
		$user_tean_id = $connection->insert_id;	

		$user_team_player_insert = "INSERT INTO user_team_player(user_tean_id, user_id, match_id, match_key, team_no, player_key_json,player_id_json) VALUES (".$user_tean_id.",".$user_id.",".$match_id[0].",".$match_key[0].",".$team_no.",".$pjson.",".$player_id_json.")";
		$result01 = mysqli_query($connection,$user_team_player_insert);

		if($result01){
			$res_data = array();
			$response = api_response($res_data, $status = true, $remark = "Team has been created.");
		} else {
			$res_data = array();
			$response = api_response($res_data, $status = false, $remark = "Something went wrong please try again.");
		}
		echo $response;
	}


	function join_contest(){
		global $connection;
		
		$user_id = $_REQUEST['user_id'];
		$match_league_id = $_REQUEST['match_league_id'];
		$user_team_id = $_REQUEST['user_team_id'];
		$rank = 0;

		$league_info_query = "SELECT * FROM game_tournament_match_league WHERE id = $match_league_id LIMIT 1";

		$league_info_result = mysqli_query($connection,$league_info_query);

		if($league_info_result->num_rows == 1) {
			while($row=mysqli_fetch_object($league_info_result)) {

				$gt_match_league_id = $row->id;
				$match_id = $row->match_id;
				$match_key = $row->match_key;
				$ref_league_id = $row->ref_league_id;
				$title = $row->title;
				$total_amount = $row->total_amount;
				$total_entries = $row->total_entries;
				$total_winners = $row->total_winners;
				$entry_fee = $row->entry_fee;
				$is_multi = $row->is_multi;
				$is_customize = $row->is_customize;
				$total_joins =  $row->total_joins;
				$is_auto_create = $row->is_auto_create;
				$is_grand = $row->is_grand;
				$is_confirm = $row->is_confirm;
				$confirm_ratio = $row->confirm_ratio;
				$is_practise = $row->is_practise;
				$is_lock = $row->is_lock;
				$is_full = $row->is_full;
				$status = $row->status;

				if($total_entries > $total_joins){
					$new_join_count  = $total_joins + 1;
					$update_query = "UPDATE game_tournament_match_league SET total_joins = $new_join_count WHERE id = $gt_match_league_id";
					$update_query_result = mysqli_query($connection,$update_query);
					if($update_query_result){
						$join_contest_query = "INSERT INTO game_tournament_match_league_entry(match_league_id, user_id, user_team_id, rank) VALUES (".$match_league_id.",".$user_id.",".$user_team_id.",".$rank.")";
						$result01 = mysqli_query($connection,$join_contest_query);				
					}
					$new_info_query = "SELECT total_joins,total_entries,is_auto_create FROM game_tournament_match_league WHERE id = $match_league_id LIMIT 1";
					$result = mysqli_query($connection,$new_info_query);
					if($result->num_rows == 1) {
						while($row01 = mysqli_fetch_object($result)) {
							if($row01->total_joins == $row01->total_entries){
								if($row01->is_auto_create == 0) {
									$is_full_update_query = "UPDATE game_tournament_match_league SET is_full = '0' WHERE id = $gt_match_league_id";
									$is_full_query_result = mysqli_query($connection,$is_full_update_query);
									$ntotal_joins = 0;
									$nis_full = 1;
									$create_league_query = "INSERT INTO game_tournament_match_league(match_id, match_key, ref_league_id, title, total_amount, total_entries, total_winners, total_joins, entry_fee, is_multi, is_customize, is_auto_create, is_grand, is_confirm, confirm_ratio, is_practise, is_lock, is_full, status) VALUES ($match_id,$match_key,$ref_league_id,'$title',$total_amount,$total_entries,$total_winners,$ntotal_joins,$entry_fee,$is_multi,$is_customize,$is_auto_create,$is_grand,$is_confirm,$confirm_ratio,$is_practise,$is_lock,$nis_full,$status)";
									$create_league_result = mysqli_query($connection,$create_league_query);									
								}
							}
						}
					}
				}

			}

			$res_data = array();
			$response = api_response($res_data, $status = true, $remark = "Contest successfully join.");

		} else{
			$res_data = array();
			$response = api_response($res_data, $status = false, $remark = "Something went wrong please try again.");
		}

		echo $response;
	}


	function myMatch(){
		global $connection;

		$user_id = $_REQUEST['user_id'];
		$match_type = $_REQUEST['match_type'];

		$sel_query = "SELECT ut.match_key,gtm.home_name,gtm.away_name,gtm.home_short_name,gtm.away_short_name,gtm.match_title,gtm.match_short_name,gtm.tournament_name,gtm.match_status
			FROM user_team as ut
			JOIN game_tournament_match as gtm ON gtm.match_key=ut.match_key
			WHERE ut.user_id = $user_id";
		
		if($match_type == 'upcoming') {
			$sel_query.=" AND gtm.match_status = 'not_started'";
		} else if($match_type == 'live') {
			$sel_query.=" AND gtm.match_status = 'started'";
		} else if($match_type == 'completed') {
			$sel_query.=" AND gtm.match_status = 'completed'";
		}

		$sel_query.=" GROUP BY ut.match_key";
		$sel_query.= " ORDER BY gtm.created_at DESC";
		$result = mysqli_query($connection,$sel_query);

		if($result->num_rows != 0){
			while($row=mysqli_fetch_object($result)) {
				$res_data[]=$row;
			}

			if(sizeof($res_data) != 0) {
				$response = api_response($res_data, $status = true, $remark = "Data Found.");
			} 
		} else {
			$res_data = array();
			$response = api_response($res_data, $status = false, $remark = "No Data Found.");
		}
		echo $response;
	}


	function point_system(){
		global $connection;
		$point_query = "SELECT game_point_system_tbl.id,crm_sport_tbl.sport_name,game_point_type.point_type, 
            game_point_system_tbl.title,game_point_system_tbl.total_point,game_point_system_tbl.status,game_point_system_tbl.point_unit,game_point_system_tbl.role
            FROM game_point_system_tbl
            JOIN crm_sport_tbl ON crm_sport_tbl.id=game_point_system_tbl.sport_id
            JOIN game_point_type ON game_point_type.id=game_point_system_tbl.point_type_id
            ORDER BY game_point_system_tbl.id DESC";
		$point_query_result = mysqli_query($connection,$point_query);
		if($point_query_result->num_rows != 0){
			$i = 0;
			while($row=mysqli_fetch_object($point_query_result)) {
				
				$role_array = json_decode($row->role);
				$role_name = '';

				foreach ($role_array as $key => $value) {
					$player_type_query = "SELECT player_type FROM crm_player_type_tbl WHERE id = $value";
					$player_type_result = mysqli_query($connection,$player_type_query);
					if($player_type_result->num_rows != 0){
						while($row01=mysqli_fetch_object($player_type_result)) {
							$role_name.=$row01->player_type;
							$role_name.= ",";
						}
					}
				}

				$res_data[] = $row;
				$res_data[$i]->role = rtrim($role_name,',');
				$i++;
			}

			if(sizeof($res_data) != 0) {
				$response = api_response($res_data, $status = true, $remark = "Data Found.");
			}

		} else {
			$res_data = array();
			$response = api_response($res_data, $status = false, $remark = "No Data Found.");
		}
		echo $response;	
	}

	// Close database connection
	mysqli_close($connection);
?>