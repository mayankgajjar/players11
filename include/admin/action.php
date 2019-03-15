<?php
//include_once 'config/database.php';

//include_once 'config/database.php';

class Action
{
    
    /*private $host = "localhost";
    private $db_name = "nexusuvx_player11";
    private $username = "nexusuvx_nexus";
    private $password = 'VbYD%$Rhq&s5';*/
	
	private $host = "localhost";
    private $db_name = "nexusuvx_player11";
    private $username = "root";
    private $password = '';
	
    public $conn;

    function __construct()
    {
        
    }


    public function getDBConnection(){
        $this->conn = null;
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if($this->conn === false){
            die("ERROR: Could not connect. " . $mysqli->connect_error);
        }
        return $this->conn;
    }

    function callAPI($method, $url, $data){
       $curl = curl_init();
       switch ($method){
          case "POST":
             curl_setopt($curl, CURLOPT_POST, 1);
             if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
             break;
          case "PUT":
             curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
             if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                              
             break;
          default:
             if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
       }
       // OPTIONS:
       curl_setopt($curl, CURLOPT_URL, $url);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
       // EXECUTE:
       $result = curl_exec($curl);
       if(!$result){die("Connection Failure");}
       curl_close($curl);
       return $result;
    }

    public function Login($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $email = $data['email'];
            $password = md5($data['password']);
            $query = "SELECT * FROM crm_users_tbl WHERE email='".$email."' AND password='".$password."' AND role_id='1'";
            $result = mysqli_query($db,$query);
            if($result->num_rows == 1){
                $row=$result->fetch_object();
                $_SESSION['login_user'] = $row;
                $respons = array('success' => '1', 'data' => $row, 'massage' => 'Login success.');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Login failed.');
                return json_encode($respons);
            }
        }
    }

    public function user_logout(){
        $db = $this->getDBConnection();
        session_start();
        session_destroy();
        $respons = array('success' => '1', 'data' => $row, 'massage' => '');
        return json_encode($respons);
    }

    public function getSport(){
        $db = $this->getDBConnection();
        $query = "SELECT id, sport_name FROM crm_sport_tbl WHERE is_deleted = 'N'";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function getSportbyId($id = null){
        $db = $this->getDBConnection();
        $query = "SELECT id, sport_name FROM crm_sport_tbl WHERE id = $id";
        $result = mysqli_query($db,$query);
        if($result->num_rows == 1){
            $row=$result->fetch_object();
            $respons = array('success' => '1', 'data' => $row, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function updateSport($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_name = $data['sport_name'];
            $id = $data['id'];
            $query = "UPDATE crm_sport_tbl SET sport_name = '".$sport_name."' WHERE id = '".$id."'";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Sport has been updated.');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Sport Not updated.');
                return json_encode($respons);
            }
        }
    }

    public function addSport($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_name = $data['sport_name'];
            $query = "INSERT INTO crm_sport_tbl (sport_name, is_deleted, created_at, updated_at) VALUES 
            ('".$sport_name."', 'N', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Sport has been Added.');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Sport Not Added.');
                return json_encode($respons);
            }
        }
    }

    public function deleteSport($id = null){
        $db = $this->getDBConnection();
        $query = "UPDATE crm_sport_tbl SET is_deleted = 'Y' WHERE id = '".$id."'";
        $result = mysqli_query($db,$query);
        if($result){
            $respons = array('success' => '1', 'data' => array(), 'massage' => 'Sport has been deleted.');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'Sport Not deleted.');
            return json_encode($respons);
        }
    }

    public function getPlayerType(){
        $db = $this->getDBConnection();
        $query = "SELECT crm_player_type_tbl.id, crm_player_type_tbl.player_type, crm_sport_tbl.sport_name FROM crm_player_type_tbl 
            JOIN crm_sport_tbl ON crm_sport_tbl.id=crm_player_type_tbl.sport_id 
            WHERE crm_player_type_tbl.is_deleted = 'N'";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function addPlayerType($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $player_type = $data['player_type'];
            $query = "INSERT INTO crm_player_type_tbl (sport_id, player_type, is_deleted, created_at, updated_at) VALUES 
            ('".$sport_id."','".$player_type."', 'N', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Player Type has been Added.');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Player Type Not Added.');
                return json_encode($respons);
            }
        }
    }

    public function getPlayerTypebyId($id = null){
        $db = $this->getDBConnection();
        $query = "SELECT id, sport_id, player_type FROM crm_player_type_tbl WHERE id = $id";
        $result = mysqli_query($db,$query);
        if($result->num_rows == 1){
            $row=$result->fetch_object();
            $respons = array('success' => '1', 'data' => $row, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function updatePlayerType($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $player_type = $data['player_type'];
            $id = $data['id'];
            $query = "UPDATE crm_player_type_tbl SET sport_id = '".$sport_id."', player_type = '".$player_type."'  WHERE id = '".$id."'";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Player Type has been updated.');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Player Type Not updated.');
                return json_encode($respons);
            }
        }
    }

    public function deletePlayerType($id = null){
        $db = $this->getDBConnection();
        $query = "UPDATE crm_player_type_tbl SET is_deleted = 'Y' WHERE id = '".$id."'";
        $result = mysqli_query($db,$query);
        if($result){
            $respons = array('success' => '1', 'data' => array(), 'massage' => 'Player Type has been deleted.');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'Player Type Not deleted.');
            return json_encode($respons);
        }
    }

    public function getContestType(){
        $db = $this->getDBConnection();
        $query = "SELECT crm_contest_type_tbl.id, crm_contest_type_tbl.contact_type, crm_sport_tbl.sport_name
            FROM crm_contest_type_tbl 
            JOIN crm_sport_tbl ON crm_sport_tbl.id=crm_contest_type_tbl.sport_id 
            WHERE crm_contest_type_tbl.is_deleted = 'N'";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function addContestType($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $contact_type = $data['contact_type'];
            $query = "INSERT INTO crm_contest_type_tbl (sport_id, contact_type, is_deleted, created_at, updated_at) VALUES 
            ('".$sport_id."','".$contact_type."', 'N', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Contest Type has been Added.');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Contest Type Not Added.');
                return json_encode($respons);
            }
        }
    }

    public function getContestTypebyId($id = null){
        $db = $this->getDBConnection();
        $query = "SELECT id, sport_id, contact_type FROM crm_contest_type_tbl WHERE id = $id";
        $result = mysqli_query($db,$query);
        if($result->num_rows == 1){
            $row=$result->fetch_object();
            $respons = array('success' => '1', 'data' => $row, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function updateContestType($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $contact_type = $data['contact_type'];
            $id = $data['id'];
            $query = "UPDATE crm_contest_type_tbl SET sport_id = '".$sport_id."', contact_type = '".$contact_type."'  WHERE id = '".$id."'";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Contest Type has been updated.');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Contest Type Not updated.');
                return json_encode($respons);
            }
        }
    }

    public function deleteContestType($id = null){
        $db = $this->getDBConnection();
        $query = "UPDATE crm_contest_type_tbl SET is_deleted = 'Y' WHERE id = '".$id."'";
        $result = mysqli_query($db,$query);
        if($result){
            $respons = array('success' => '1', 'data' => array(), 'massage' => 'Contest Type has been deleted.');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'Contest Type Not deleted.');
            return json_encode($respons);
        }
    }

    public function ApiAuthentication(){
        $params = array(
            'access_key' => '8e907549fac1ef4dcd82e01a8176985a',
            'secret_key' => '663acc4bca9a8d352b971a116ee4edda',
            'app_id' => 'players11_football',
            'device_id' => 'test',
        );
        $url = 'https://api.footballapi.com/v1/auth/';
        $method = 'POST';
        $res = $this->callAPI($method, $url, $params);
        return $res;
    }

    public function getTournamentList(){
        $db = $this->getDBConnection();
        $query = "SELECT game_tournament.id, crm_sport_tbl.sport_name, game_tournament.api_code,game_tournament.name,
            game_tournament.short_name, game_tournament.start_date, game_tournament.is_fetch
            FROM game_tournament 
            JOIN crm_sport_tbl ON crm_sport_tbl.id=game_tournament.sport_id
            ORDER BY game_tournament.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function deleteTournament($id = null){
        $db = $this->getDBConnection();
        $query = "DELETE FROM game_tournament WHERE id = '".$id."'";
        $result = mysqli_query($db,$query);
        if($result){
            $respons = array('success' => '1', 'data' => array(), 'massage' => 'Tournament has been deleted.');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'Tournament Not deleted.');
            return json_encode($respons);
        }
    }

    public function recent_tournament_api(){
        $db = $this->getDBConnection();
        $token_result  = $this->ApiAuthentication();
        $token_result = json_decode($token_result);
        $token = $token_result->auth->access_token;
        $url = 'https://api.footballapi.com/v1/recent_tournaments/?access_token='.$token;
        //$url = 'https://api.footballapi.com/v1/recent_tournaments/?access_token='.$token;
        $method = 'GET';
        $params  = false;
        $res = $this->callAPI($method, $url, $params);
        $result_data = json_decode($res);
        $tournamentsList = $result_data->data->tournaments;
        $result = '';
        foreach ($tournamentsList as $key => $value) {
            $sport_id = '2';
            $api_code = $value->key;
            $competition_key = $value->competition->key;
            $name = $value->name;
            $short_name = $value->short_name;
            $start_date = date('Y-m-d', strtotime(substr($value->start_date->gmt,0 ,10)));
            $count_query = "SELECT COUNT(id) as total_id FROM game_tournament WHERE api_code = '".$api_code."'";
            $count_result=mysqli_query($db,$count_query);
            if($count_result->num_rows == '1'){
                $row=$count_result->fetch_object();
                if($row->total_id == 0){
                    $query = "INSERT INTO game_tournament (sport_id, api_code, competition_key, name, short_name, start_date, is_fetch, created_at, updated_at) VALUES 
                        ('".$sport_id."','".$api_code."','".$competition_key."','".$name."','".$short_name."','".$start_date."','0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
                    mysqli_query($db,$query);
                }
            }
        }
        $respons = array('success' => '1', 'data' => array(), 'massage' => 'Tournament has been Added.');
        return json_encode($respons);
    }

    public function scheduleTournament($id = null){
        $db = $this->getDBConnection();
        $query = "UPDATE game_tournament SET is_fetch = '1' WHERE id = '".$id."'";
        $result = mysqli_query($db,$query);
        $get_tournament_key_query = "SELECT * FROM game_tournament WHERE id = '".$id."'";
        $get_tournament_key_result=mysqli_query($db,$get_tournament_key_query);
        if($get_tournament_key_result->num_rows == '1'){
            $row=$get_tournament_key_result->fetch_object();
            $api_code = $row->api_code;
            $round_result = $this->getTournamentRound($api_code);
            $round_data = $round_result->data->tournament->rounds;
            foreach ($round_data as $key => $value) {
                $tournament_id = $id;
                $tournament_api_code = $api_code;
                $round_api_code = $value->key;
                $round_name = $value->name;
                $count_query = "SELECT COUNT(id) as total_id FROM game_tournament_round WHERE round_api_code = '".$round_api_code."'";
                $count_result=mysqli_query($db,$count_query);
                if($count_result->num_rows == '1'){
                    $row=$count_result->fetch_object();
                    if($row->total_id == 0){
                        $insert_query = "INSERT INTO game_tournament_round (tournament_id, tournament_api_code, round_api_code, round_name, is_fetch, status,created_at, updated_at) VALUES 
                            ('".$tournament_id."','".$tournament_api_code."','".$round_api_code."','".$round_name."', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
                        mysqli_query($db,$insert_query);
                    }
                }
            }
        }
        if($result){
            $respons = array('success' => '1', 'data' => array(), 'massage' => 'Tournament has been schedule.');
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'Tournament Not schedule.');
        }
        return json_encode($respons);
    }

    public function getTournamentRound($api_code = null){
        $token_result  = $this->ApiAuthentication();
        $token_result = json_decode($token_result);
        $token = $token_result->auth->access_token;
        $url = 'https://api.footballapi.com/v1/tournament/'.$api_code.'/?access_token=ACCESS_TOKEN'.$token;
        $method = 'GET';
        $params  = false;
        $res = $this->callAPI($method, $url, $params);
        $result_data = json_decode($res);
        return $result_data;
    }

    public function getTournamentRoundList(){
        $db = $this->getDBConnection();
        $query = "SELECT game_tournament_round.id, game_tournament.name, game_tournament_round.round_name, game_tournament_round.round_api_code,game_tournament_round.is_fetch
            FROM game_tournament_round 
            JOIN game_tournament ON game_tournament.id=game_tournament_round.tournament_id
            ORDER BY game_tournament_round.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function getTeamInfo($team_key = null){
        $db = $this->getDBConnection();
        $query = "SELECT * FROM game_team WHERE team_key = '".$team_key."'";
        $result=mysqli_query($db,$query);
        return $result;
    }

    public function TournamentRoundActive($id = null){
        $db = $this->getDBConnection();
        $query = "UPDATE game_tournament_round SET is_fetch = '1' WHERE id = '".$id."'";
        $result = mysqli_query($db,$query);
        $get_tournament_Round_key_query = "SELECT * FROM game_tournament_round WHERE id = '".$id."'";
        $get_tournament_Round_key_result=mysqli_query($db,$get_tournament_Round_key_query);
        if($get_tournament_Round_key_result->num_rows == '1'){
            $row=$get_tournament_Round_key_result->fetch_object();
            $tournament_api_code = $row->tournament_api_code;
            $round_api_code = $row->round_api_code;
            $match_result = $this->getTournamentRoundMatch($tournament_api_code, $round_api_code, $action = 'active');
            $match_data = $match_result->data->round->matches;
            $team_data = $match_result->data->round->teams;
            foreach ($team_data as $key => $value) {
                $sport_id = '2';
                $name = $value->name;
                $team_key = $value->key;
                $team_short_name = $value->code;
                $count_query = "SELECT COUNT(id) as total_id FROM game_team WHERE team_key = '".$team_key."'";
                $count_result=mysqli_query($db,$count_query);
                if($count_result->num_rows == '1'){
                    $row=$count_result->fetch_object();
                    if($row->total_id == 0){
                        $insert_query = "INSERT INTO game_team (sport_id, name, team_key, team_short_name, tournament_api_code, round_api_code, status, created_at, updated_at) VALUES 
                            ('".$sport_id."','".$name."','".$team_key."','".$team_short_name."','".$tournament_api_code."','".$round_api_code."','0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                        mysqli_query($db,$insert_query);
                    }
                }
            }
            foreach ($match_data as $key => $value) {
                $match_data = $value->match;
                $match_key = $match_data->key;
                $count_query = "SELECT COUNT(id) as total_id FROM game_tournament_match WHERE match_key = '".$match_key."'";
                $count_result=mysqli_query($db,$count_query);
                if($count_result->num_rows == '1'){
                    $row=$count_result->fetch_object();
                    if($row->total_id == 0){
                        $match_status = $match_data->status;
                        if( $match_status == 'completed'){
                            continue;
                        }
                        $home_key = $match_data->home;
                        $away_key = $match_data->away;
                        $home_name_result = $this->getTeamInfo($home_key);
                        if($home_name_result->num_rows == '1'){
                            $row=$home_name_result->fetch_object();
                            $home_name = $row->name;
                            $home_short_name = $row->team_short_name;
                            $team_key = $row->team_key;
                            $player_data = $this->getTeamPlayers($tournament_api_code, $team_key);
                            $playerList = $player_data->data->team->players;
                            $this->save_players($playerList, $tournament_api_code, $round_api_code, $match_key, $team_key);
                        }
                        $away_name_result = $this->getTeamInfo($away_key);
                        if($away_name_result->num_rows == '1'){
                            $row=$away_name_result->fetch_object();
                            $away_name = $row->name;
                            $away_short_name = $row->team_short_name;
                            $team_key = $row->team_key;
                            $player_data = $this->getTeamPlayers($tournament_api_code, $team_key);
                            $playerList = $player_data->data->team->players;
                            $this->save_players($playerList, $tournament_api_code, $round_api_code, $match_key, $team_key);
                        }
                        
                        $match_title = $match_data->name;
                        $round_key = $match_data->round->key;
                        $round_name = $match_data->round->name;
                        $match_short_name = $match_data->short_name;
                        $stadium_key = $match_data->stadium->key;
                        $stadium_city = $match_data->stadium->city;
                        $stadium_contry_key = $match_data->stadium->country;
                        $stadium_name = $match_data->stadium->name;
                        $start_date_gmt = date('Y-m-d', strtotime(substr($match_data->start_date->gmt,0 ,10)));
                        $start_date_timestamp = $match_data->start_date->timestamp;
                        $tournament_key = $match_data->tournament->key;
                        $tournament_name = $match_data->tournament->name;                        
                        $tournament_legal_name = $match_data->tournament->legal_name;
                        $tournament_short_name = $match_data->tournament->short_name;
                        
                        $insert_query = "INSERT INTO game_tournament_match (match_key, home_key, away_key, 
                            home_name, away_name, home_short_name, away_short_name, match_title, round_key,
                            round_name, match_short_name, stadium_key, stadium_city, stadium_contry_key, 
                            stadium_name, start_date_gmt, start_date_timestamp, tournament_key, 
                            tournament_name, tournament_legal_name, tournament_short_name, match_status, created_at, updated_at) VALUES 
                        ('".$match_key."','".$home_key."','".$away_key."','".$home_name."','".$away_name."',
                        '".$home_short_name."','".$away_short_name."','".$match_title."','".$round_key."',
                        '".$round_name."','".$match_short_name."','".$stadium_key."','".$stadium_city."',
                        '".$stadium_contry_key."','".$stadium_name."','".$start_date_gmt."',
                        '".$start_date_timestamp."','".$tournament_key."','".$tournament_name."',
                        '".$tournament_legal_name."','".$tournament_short_name."',
                        '".$match_status."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                        mysqli_query($db,$insert_query);
                    }
                }
            }
        }
        if($result){
            $respons = array('success' => '1', 'data' => array(), 'massage' => 'Round has been Active.');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'Round Not Active.');
            return json_encode($respons);
        }
    }

    public function save_players($playerList = null, $tournament_api_code = null, $round_api_code = null, $match_key = null, $team_key = null){
        if($playerList != null && $tournament_api_code != null && $round_api_code != null && $match_key != null && $team_key != null){
            $db = $this->getDBConnection();
            foreach ($playerList as $key => $value) {
                $sport_id = '2';
                $name = $value->name;
                $short_name = $value->legal_name;
                $api_code = $value->key;
                $tournament_api_code = $tournament_api_code;
                $round_api_code = $round_api_code;
                $role = $value->role;
                $count_query = "SELECT COUNT(id) as total_id FROM game_player WHERE tournament_api_code = '".$tournament_api_code."' AND round_api_code = '".$round_api_code."' AND api_code = '".$api_code."'";
                $count_result=mysqli_query($db,$count_query);
                if($count_result->num_rows == '1'){
                    $row=$count_result->fetch_object();
                    if($row->total_id == 0){
                        $query = "INSERT INTO game_player (sport_id, name, short_name, api_code, tournament_api_code, role, round_api_code, status, match_key, team_key, created_at, updated_at) VALUES 
                            ('".$sport_id."','".$name."','".$short_name."','".$api_code."','".$tournament_api_code."','".$role."','".$round_api_code."','0','".$match_key."','".$team_key."',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
                        mysqli_query($db,$query);
                    }
                }
            }
        }
    }

    public function getTeamPlayers($tournament_api_code = null, $team_key = null){
        if($tournament_api_code != null && $team_key != null){
            $db = $this->getDBConnection();
            $token_result  = $this->ApiAuthentication();
            $token_result = json_decode($token_result);
            $token = $token_result->auth->access_token;
            $url = 'https://api.footballapi.com/v1/tournament/'.$tournament_api_code.'/team/'.$team_key.'/?access_token='.$token;
            $method = 'GET';
            $params  = false;
            $res = $this->callAPI($method, $url, $params);
            $result_data = json_decode($res);
            return $result_data;
        }
    }

    public function getTournamentRoundMatch($tournament_api_code, $round_api_code, $action = 'active'){
        $token_result  = $this->ApiAuthentication();
        $token_result = json_decode($token_result);
        $token = $token_result->auth->access_token;
        if($action == 'active'){
            $url  = 'https://api.footballapi.com/v1/tournament/'.$tournament_api_code.'/round-detail/'.$round_api_code.'/?access_token='.$token;
            $method = 'GET';
            $params  = false;
            $res = $this->callAPI($method, $url, $params);
            $result_data = json_decode($res);
            
            //$team_data = $result_data->
        } else {
        }
        return $result_data;
        
    }

    public function TournamentRoundDeactive($id = null){
        $db = $this->getDBConnection();
        $query = "UPDATE game_tournament_round SET is_fetch = '0' WHERE id = '".$id."'";
        $result = mysqli_query($db,$query);
        if($result){
            $respons = array('success' => '1', 'data' => array(), 'massage' => 'Round has been Deactive.');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'Round Not Deactive.');
            return json_encode($respons);
        }
    }

    public function getTeam(){
        $db = $this->getDBConnection();
        $token_result  = $this->ApiAuthentication();
        $token_result = json_decode($token_result);
        $token = $token_result->auth->access_token;
        $url = 'https://api.footballapi.com/v1/recent_tournaments/?access_token='.$token;
        $method = 'GET';
        $params  = false;
        $res = $this->callAPI($method, $url, $params);
        $result_data = json_decode($res);
        $tournamentsList = $result_data->data->tournaments;
        $result = '';
        foreach ($tournamentsList as $key => $value) {
            $sport_id = '2';
            $api_code = $value->key;
            $competition_key = $value->competition->key;
            $name = $value->name;
            $short_name = $value->short_name;
            $start_date = date('Y-m-d', strtotime(substr($value->start_date->gmt,0 ,10)));
            $count_query = "SELECT COUNT(id) as total_id FROM game_tournament WHERE api_code = '".$api_code."'";
            $count_result=mysqli_query($db,$count_query);
            if($count_result->num_rows == '1'){
                $row=$count_result->fetch_object();
                if($row->total_id == 0){
                    $query = "INSERT INTO game_tournament (sport_id, api_code, competition_key, name, short_name, start_date, is_fetch, created_at, updated_at) VALUES 
                        ('".$sport_id."','".$api_code."','".$competition_key."','".$name."','".$short_name."','".$start_date."','0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
                    mysqli_query($db,$query);
                }
            }
        }
        $respons = array('success' => '1', 'data' => array(), 'massage' => 'Tournament has been Added.');
        return json_encode($respons);
    }

    public function getTeamList(){
        $db = $this->getDBConnection();
        $query = "SELECT game_team.id, game_team.name, game_team.team_key, game_team.team_short_name,game_team.status
            FROM game_team
            ORDER BY game_team.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function getMatchList(){
        $db = $this->getDBConnection();
        $query = "SELECT matchList.id, matchList.tournament_name, matchList.match_title, matchList.match_title, 
            matchList.start_date_gmt,matchList.match_status,matchList.is_squad,matchList.is_league,matchList.match_key,
            (SELECT COUNT(id) FROM game_tournament_match_league WHERE match_id=matchList.id) AS total_league, matchList.match_status,matchList.tournament_key,matchList.is_point_count
            FROM game_tournament_match as matchList
            ORDER BY matchList.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function getTournamenPlayerList(){
        $db = $this->getDBConnection();
        $query = "SELECT game_player.id, game_player.name, game_player.short_name, 
            game_player.api_code,game_player.role,game_team.name AS team_name,game_player.status
            FROM game_player
            JOIN game_team ON game_team.team_key=game_player.team_key
            ORDER BY game_player.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function getPlayerbyId($id = null){
        $db = $this->getDBConnection();
        $query = "SELECT id, sport_id, match_key, team_key, name, short_name, api_code, profile_pic, credits, role, tournament_api_code, round_api_code, status  FROM game_player WHERE id = $id";
        $result = mysqli_query($db,$query);
        if($result->num_rows == 1){
            $row=$result->fetch_object();
            $respons = array('success' => '1', 'data' => $row, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }
    public function updatePlayer($data = null, $files = null){
        if($data != null){
            $db = $this->getDBConnection();
            $name = $data['name'];
            $short_name = $data['short_name'];
            $api_code = $data['api_code'];
            $credits = $data['credits'];
            $role = $data['role'];
            $status = $data['status'];
            $team_key = $data['team_key'];
            $sport_id = $data['sport_id'];
            $id = $data['id'];
            $old_data_query = "SELECT * FROM game_player WHERE id = '".$id."'";
            $old_data_result=mysqli_query($db,$old_data_query);
            if($old_data_result->num_rows == '1'){
                $row=$old_data_result->fetch_object();
                $image = $row->profile_pic;
            }
            if($files != '' && $files != null){
                $file_name = 'profile_pic';
                $target_dir = "uploads/player/";
                $file_status = $this->upload_file($target_dir, $files, $file_name);
                $file_status = json_decode($file_status);
                if($file_status->success == 1){
                    if($image != '' && $image != null){
                        unlink($image);
                    }
                    $image = $file_status->data->file_name;
                } else {
                    $respons = array('success' => '0', 'data' => array(), 'massage' => $file_status->massage);
                    return json_encode($respons);
                }
            }
            $query = "UPDATE game_player SET name = '".$name."', short_name = '".$short_name."', api_code = '".$api_code."', credits = '".$credits."', role = '".$role."', status = '".$status."', team_key = '".$team_key."', profile_pic = '".$image."', sport_id = '".$sport_id."' WHERE id = '".$id."'";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Player has been updated.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Player Not updated.');
            }
            return json_encode($respons);
        }
    }

    public function addPlayer($data = null, $files = null){
        if($data != null){
            $db = $this->getDBConnection();
            $name = $data['name'];
            $short_name = $data['short_name'];
            $api_code = $data['api_code'];
            $credits = $data['credits'];
            $role = $data['role'];
            $status = $data['status'];
            $team_key = $data['team_key'];
            $sport_id = $data['sport_id'];
            if($files != '' && $files != null){
                $file_name = 'profile_pic';
                $target_dir = "uploads/player/";
                $file_status = $this->upload_file($target_dir, $files, $file_name);
                $file_status = json_decode($file_status);
                if($file_status->success == 1){
                    $image = $file_status->data->file_name;
                } else {
                    $respons = array('success' => '0', 'data' => array(), 'massage' => $file_status->massage);
                    return json_encode($respons);
                }
            }
            //$query = "UPDATE game_player SET name = '".$name."', short_name = '".$short_name."', api_code = '".$api_code."', credits = '".$credits."', role = '".$role."', status = '".$status."', team_key = '".$team_key."', profile_pic = '".$image."' WHERE id = '".$id."'";
            $insert_query = "INSERT INTO game_player (sport_id, name, short_name, api_code, credits, role, status, team_key, created_at, updated_at) VALUES 
                            ('".$sport_id."','".$name."','".$short_name."','".$api_code."','".$credits."','".$role."','".$status."','".$team_key."',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
            $result = mysqli_query($db,$insert_query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Player has been added.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Player Not added.');
            }
            return json_encode($respons);
        }
    }

    public function upload_file($target_dir = null, $files = null, $file_name = null){
        if($target_dir != null && $target_dir != '' && $files != null && $files != '' ){
            
            $target_file = $target_dir . basename($files[$file_name]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION);
            $actual_file_name = $target_dir.time().'.'.$imageFileType;
            // Check if file already exists
            if (file_exists($actual_file_name)) {
                //$respons = array('success' => '0', 'data' => array(), 'massage' => 'Sorry, file already exists.');
                $respons_msg = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES[$file_name]["size"] > 500000) {
                //$respons = array('success' => '0', 'data' => array(), 'massage' => 'Sorry, your file is too large.');
                $respons_msg = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                //$respons_msg = array('success' => '0', 'data' => array(), 'massage' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
                $respons_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $respons = array('success' => '0', 'data' => array(), 'massage' => $respons_msg);
                //$respons_msg = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $actual_file_name)) {
                    $respons = array('success' => '1', 'data' => array('file_name' => $actual_file_name), 'massage' => 'The file has been uploaded.');
                } else {
                    $respons = array('success' => '0', 'data' => array(), 'massage' => 'Sorry, there was an error uploading your file.');
                }
            }
            return json_encode($respons);
        }
        
    }

    public function getLeague(){
        $db = $this->getDBConnection();
        $query = "SELECT game_league.id, crm_sport_tbl.sport_name, game_league.title, 
            game_league.total_winners,game_league.total_entries,game_league.total_amount,
            game_league.is_grand,game_league.is_multi,game_league.status 
            FROM game_league
            JOIN crm_sport_tbl ON crm_sport_tbl.id=game_league.sport_id
            ORDER BY game_league.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function getGameFees(){
        $db = $this->getDBConnection();
        $query = "SELECT game_fees.id, crm_sport_tbl.sport_name, game_fees.min_value, 
            game_fees.max_value,game_fees.gst_tax,game_fees.pg_comm,
            game_fees.comm
            FROM game_fees
            JOIN crm_sport_tbl ON crm_sport_tbl.id=game_fees.sport_id
            ORDER BY game_fees.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function addGameFee($data = null){
        if($data != ''){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $min_value = $data['min_value'];
            $max_value = $data['max_value'];
            $gst_tax = $data['gst_tax'];
            $pg_comm = $data['pg_comm'];
            $comm = $data['comm'];
            $query = "INSERT INTO game_fees (sport_id, min_value, max_value, gst_tax, pg_comm, comm) VALUES 
            ('".$sport_id."','".$min_value."','".$max_value."','".$gst_tax."','".$pg_comm."','".$comm."')";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Sport has been Added.');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Sport Not Added.');
                return json_encode($respons);
            }
        }
    }

    public function deleteGameFee($id = null){
        $db = $this->getDBConnection();
        $query = "DELETE FROM `game_fees` WHERE id=$id";
        if (mysqli_query($db, $query)) {
            $respons = array('success' => '1', 'data' => array(), 'massage' => 'Record deleted successfully');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'Record Not deleted.');
            return json_encode($respons);
        }
    }

    public function getGameFeebyId($id = null){
        $db = $this->getDBConnection();
        $query = "SELECT * FROM game_fees WHERE id = $id";
        $result = mysqli_query($db,$query);
        if($result->num_rows == 1){
            $row=$result->fetch_object();
            $respons = array('success' => '1', 'data' => $row, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function updateGameFee($data = null){
        if($data != ''){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $min_value = $data['min_value'];
            $max_value = $data['max_value'];
            $gst_tax = $data['gst_tax'];
            $pg_comm = $data['pg_comm'];
            $comm = $data['comm'];
            $id = $data['id'];
            $query = "UPDATE game_fees SET sport_id = '".$sport_id."', min_value = '".$min_value."', max_value = '".$max_value."', gst_tax = '".$gst_tax."', pg_comm = '".$pg_comm."', comm = '".$comm."' WHERE id = '".$id."'";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Game Fee has been updated.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Game Fee Not updated.');
            }
            return json_encode($respons);
        }
    }

    public function getEntryFee($total_amount = null, $total_entrie = null){
        if($total_amount != null && $total_entrie != null){
            if($total_entrie == 0){
                $total_entrie = 1;
            }
            $db = $this->getDBConnection();
            $tex_query = "SELECT id, gst_tax, pg_comm, comm FROM game_fees WHERE min_value <= $total_amount AND max_value >= $total_amount LIMIT 1";
            $result = mysqli_query($db,$tex_query);
            if($result->num_rows == 1){
                $row=$result->fetch_object();
                $total_tex_result = $row->gst_tax + $row->pg_comm + $row->comm;
            }
            $tot_tex = 100 + $total_tex_result;
            $player_amount = $total_amount/$total_entrie;
            $per_player_amount = round($total_amount * $tot_tex / 100 / $total_entrie);
            if($per_player_amount != '' && $per_player_amount != null){
                $respons = array('success' => '1', 'data' => array('total_tax'=>$total_tex_result, 'entry_fee' => $per_player_amount, 'total_amt' => $total_amount), 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => '');
            }
            return json_encode($respons);
        }
    }

    public function addGameLeague($data = null){
        $db = $this->getDBConnection();
        $sport_id = $data['sport_id'];
        $title = $data['title'];
        $total_amount = $data['total_amount'];
        $total_entries = $data['total_entries'];
        $entry_fee = $data['entry_fee'];
        $confirm_ratio = $data['confirm_ratio'];
        $is_multi = $data['is_multi'];
        $is_customize = $data['is_customize'];
        $is_auto_create = $data['is_auto_create'];
        $is_grand = $data['is_grand'];
        $is_confirm = $data['is_confirm'];
        $status = $data['status'];
        $total_winners = $data['total_winners'];
        if($total_winners == ''){
            $total_winners = 1;
        }  
        if(isset($data['win_data'] )){
            $win_data = $data['win_data'];
        }
        if($total_amount == 0 && $entry_fee == 0){
            $is_practise = 0;
        } else {
            $is_practise = 1;
        }
        $query = "INSERT INTO game_league (sport_id, title, total_amount, total_entries, entry_fee, confirm_ratio, is_multi, is_customize, is_auto_create, is_grand, status, total_winners, is_practise, is_confirm) VALUES 
            ('".$sport_id."','".$title."','".$total_amount."','".$total_entries."','".$entry_fee."','".$confirm_ratio."','".$is_multi."','".$is_customize."','".$is_auto_create."','".$is_grand."','".$status."','".$total_winners."','".$is_practise."','".$is_confirm."')";
        $result = mysqli_query($db,$query);
        $match_league_id = $db->insert_id;
        if($total_winners == 1){
            $rank = 1;
            $rank_range = 0;
            $win_ratio = 100;
            $win_amount = $total_amount;
            $win_query = "INSERT INTO game_tournament_match_league_winner (match_league_id, rank, rank_range, win_ratio, win_amount) VALUES 
            ('".$match_league_id."','".$rank."','".$rank_range."','".$win_ratio."','".$win_amount."')";
            $win_result = mysqli_query($db,$win_query);
        } else {
            if(isset($win_data) && $win_data != ''){
                foreach ($win_data as $key => $value) {
                    $rank = $value['rank'];
                    $rank_range = $value['rank_range'];
                    $win_ratio = $value['win_ratio'];
                    $win_amount = $value['win_amount'];
                    if($rank_range == ''){
                        $rank_range = 0;
                    }
                    $win_query = "INSERT INTO game_tournament_match_league_winner (match_league_id, rank, rank_range, win_ratio, win_amount) VALUES 
                    ('".$match_league_id."','".$rank."','".$rank_range."','".$win_ratio."','".$win_amount."')";
                    $win_result = mysqli_query($db,$win_query);
                }
            }
        }
        
        if($result){
            $respons = array('success' => '1', 'data' => array(), 'massage' => 'Game League has been Added.');
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'Game League Not Added.');
        }
        return json_encode($respons);
    }

    public function updateGameLeague($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $title = $data['title'];
            $total_amount = $data['total_amount'];
            $total_entries = $data['total_entries'];
            $entry_fee = $data['entry_fee'];
            $confirm_ratio = $data['confirm_ratio'];
            $is_multi = $data['is_multi'];
            $is_customize = $data['is_customize'];
            $is_auto_create = $data['is_auto_create'];
            $is_grand = $data['is_grand'];
            $is_confirm = $data['is_confirm'];
            $status = $data['status'];
            $total_winners = $data['total_winners'];
            $id = $data['id'];
            if($total_winners == ''){
                $total_winners = 1;
            }        
            if(isset($data['win_data'] )){
                $win_data = $data['win_data'];
            }
            if($total_amount == 0 && $entry_fee == 0){
                $is_practise = 0;
            } else {
                $is_practise = 1;
            }
            $query = "UPDATE game_league SET sport_id = '".$sport_id."', title = '".$title."', total_amount = '".$total_amount."', total_entries = '".$total_entries."', entry_fee = '".$entry_fee."', confirm_ratio = '".$confirm_ratio."', is_multi = '".$is_multi."', is_customize = '".$is_customize."', is_auto_create = '".$is_auto_create."', is_grand = '".$is_grand."', status = '".$status."', total_winners = '".$total_winners."', is_practise = '".$is_practise."', is_confirm = '".$is_confirm."' WHERE id = '".$id."'";
            $result = mysqli_query($db,$query);
            $del_query = "DELETE FROM game_tournament_match_league_winner WHERE match_league_id = $id";
            mysqli_query($db, $del_query);
            if($total_winners == 1){
                $rank = 1;
                $rank_range = 0;
                $win_ratio = 100;
                $win_amount = $total_amount;
                $win_query = "INSERT INTO game_tournament_match_league_winner (match_league_id, rank, rank_range, win_ratio, win_amount) VALUES 
                ('".$id."','".$rank."','".$rank_range."','".$win_ratio."','".$win_amount."')";
                $win_result = mysqli_query($db,$win_query);
            } else {
                if(isset($win_data) && $win_data != ''){
                    foreach ($win_data as $key => $value) {
                        $rank = $value['rank'];
                        $rank_range = $value['rank_range'];
                        $win_ratio = $value['win_ratio'];
                        $win_amount = $value['win_amount'];
                        if($rank_range == ''){
                            $rank_range = 0;
                        }
                        $win_query = "INSERT INTO game_tournament_match_league_winner (match_league_id, rank, rank_range, win_ratio, win_amount) VALUES 
                        ('".$id."','".$rank."','".$rank_range."','".$win_ratio."','".$win_amount."')";
                        $win_result = mysqli_query($db,$win_query);
                    }
                }
            }
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Game League has been updated.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Game League Not updated.');
            }
            return json_encode($respons);
        }
    }

    public function getGameLeaguebyId($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "SELECT * FROM game_league WHERE id = $id LIMIT 1";
            $result = mysqli_query($db,$query);
            if($result->num_rows == 1){
                $row=$result->fetch_object();   
                $win_query = "SELECT * FROM game_tournament_match_league_winner WHERE match_league_id = $id";
                $win_result = mysqli_query($db,$win_query);
                if($win_result->num_rows > 0){
                    while ($win_row = mysqli_fetch_assoc($win_result)) {
                        $result_data[] = $win_row;
                    }
                }
                $row->win_data = $result_data;
                $respons = array('success' => '1', 'data' => $row, 'massage' => '');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
                return json_encode($respons);
            }
        }
    }

    public function show_leagues($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $game_league_query = "SELECT id,title,total_amount,entry_fee,total_winners,is_confirm,is_practise,is_grand,is_multi FROM game_league WHERE id NOT IN (SELECT ref_league_id FROM game_tournament_match_league WHERE match_id = $id)";
            $game_league_result = mysqli_query($db,$game_league_query);
            if($game_league_result->num_rows > 0){
                while ($row = mysqli_fetch_assoc($game_league_result)) {
                    $result_data[] = $row;
                }
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
                return json_encode($respons);
            }
            if(sizeof($result_data) > 0){
                $model_html = $this->league_html($result_data);
                $respons = array('success' => '1', 'data' => $model_html, 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function show_player($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $game_player_query = "SELECT game_player.id,game_player.name as player_name,game_team.name as team_name,game_player.role,game_player.credits
            FROM game_player 
            JOIN game_team ON game_player.team_key=game_team.team_key
            WHERE game_player.match_key = $id
            ORDER BY game_player.role ASC";
            $game_player_result = mysqli_query($db,$game_player_query);
            if($game_player_result->num_rows > 0){
                while ($row = mysqli_fetch_assoc($game_player_result)) {
                    $result_data[] = $row;
                }
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
                return json_encode($respons);
            }
            if(sizeof($result_data) > 0){
                $player_type = $this->getPlayerType();
                $player_type = json_decode($player_type);
                $model_html = $this->player_html($result_data,$player_type->data);
                $respons = array('success' => '1', 'data' => $model_html, 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function assignMatchLeague($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $match_key = $data['match_key'];
            foreach ($data['id_list'] as $key => $value) {
                $match_query = "SELECT id,title,total_amount,total_entries,total_winners,entry_fee,is_multi,is_customize,is_auto_create,is_grand,is_confirm,confirm_ratio,is_practise FROM game_league WHERE id = $value LIMIT 1";
                $match_result = mysqli_query($db,$match_query);
                if($match_result->num_rows == 1){
                    $row=$match_result->fetch_object();
                    $insert_query = "INSERT INTO game_tournament_match_league (match_key, ref_league_id, title, total_amount, total_entries,total_winners,total_joins,entry_fee, is_multi, is_customize, is_auto_create, is_grand,is_confirm,confirm_ratio,is_practise,is_lock,is_full,status) VALUES 
                    ('".$match_key."','".$value."','".$row->title."','".$row->total_amount."','".$row->total_entries."','".$row->total_winners."','0','".$row->entry_fee."','".$row->is_multi."','".$row->is_customize."','".$row->is_auto_create."','".$row->is_grand."','".$row->is_confirm."','".$row->confirm_ratio."','".$row->is_practise."','0','0','0')";
                    $insert_result = mysqli_query($db,$insert_query);
                }
            }
            $query = "UPDATE game_tournament_match SET is_league = '1' WHERE id = '".$match_id."'";
            $result = mysqli_query($db,$query);
            if($match_result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'League has been assign.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'League Not assign.');
            }
            return json_encode($respons);   
        }
    }

    public function getMatchLeaguesList(){
        $db = $this->getDBConnection();
        $query = "SELECT game_tournament_match_league.id, game_tournament_match.match_short_name,game_tournament_match_league.title, game_tournament_match_league.total_amount,game_tournament_match_league.total_entries, game_tournament_match_league.total_winners, game_tournament_match_league.is_grand, game_tournament_match_league.is_multi, game_tournament_match_league.status
            FROM game_tournament_match_league
            JOIN game_tournament_match ON game_tournament_match.id=game_tournament_match_league.match_id
            ORDER BY game_tournament_match_league.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            return json_encode($respons);
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            return json_encode($respons);
        }
    }

    public function deleteMatchLeague($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "DELETE FROM game_tournament_match_league WHERE id = '".$id."'";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'League has been deleted.');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'League Not deleted.');
                return json_encode($respons);
            }
        }
    }

    public function getScoreByTournament(){
        $db = $this->getDBConnection();
        $token_result  = $this->ApiAuthentication();
        $token_result = json_decode($token_result);
        $token = $token_result->auth->access_token;
        $url = 'https://api.footballapi.com/v1/tournament/1035099664262762497/round-detail/1035099952327561217/?access_token='.$token;
        //$url = 'https://api.footballapi.com/v1/recent_tournaments/?access_token='.$token;
        $method = 'GET';
        $params  = false;
        $res = $this->callAPI($method, $url, $params);
        $result_data = json_decode($res);
        $matchList = $result_data->data->round->matches;
        foreach ($matchList as $key => $value) {
            $value = $value->match;
            if($value->status == 'completed'){
                $match_key = $value->key;
                $url = 'https://api.footballapi.com/v1/match/'.$match_key.'/?access_token='.$token;
                //$url = 'https://api.footballapi.com/v1/recent_tournaments/?access_token='.$token;
                $method = 'GET';
                $params  = false;
                $scorecard = $this->callAPI($method, $url, $params);
                $scorecard_data = json_decode($scorecard);
                $players_scorecard = $scorecard_data->data->players;
                foreach ($players_scorecard as $key => $value) {
                    $tournament_key = '1035099664262762497';
                    $tournament_id = 0;
                    $match_key = $match_key;
                    $match_id = 0;
                    $player_key = $value->key;
                    $player_id = 0;
                    
                    $in_playing_squad = $value->in_playing_squad == '' ? '1' : '0';
                    $in_bench_squad = $value->in_bench_squad == '' ? '1' : '0';
                    $clean_sheet = $value->stats->clean_sheet == '' ? '1' : '0';
                    //$clean_sheet = 0;
                    
                    $foul_committed = $value->stats->foul->committed;
                    $foul_drawn = $value->stats->foul->drawn;
                    $red_card = $value->stats->card->RC;
                    $y2c_card = $value->stats->card->Y2C;
                    $yellow_card = $value->stats->card->YC;
                    $goal_assist = $value->stats->goal->assist;
                    $goal_conceded = $value->stats->goal->conceded;
                    $goal_own_goal_conceded = $value->stats->goal->own_goal_conceded;
                    $goal_scored = $value->stats->goal->scored;
                    $minutes_played = $value->stats->minutes_played;
                    $panalty_missed = $value->stats->penalty->missed;
                    $panalty_saved = $value->stats->penalty->saved;
                    $panalty_scored = $value->stats->penalty->scored;
                    $insert_query = "INSERT INTO game_tournament_match_player_scorecard (tournament_key, tournament_id, match_key, match_id, player_key, player_id, in_bench_squad, in_playing_squad, clean_sheet, foul_committed, foul_drawn, red_card, y2c_card, yellow_card, goal_assist, goal_conceded, goal_own_goal_conceded, goal_scored, minutes_played, panalty_missed, panalty_saved, panalty_scored) VALUES 
                    ('".$tournament_key."','".$tournament_id."','".$match_key."','".$match_id."','".$player_key."','".$player_id."','".$in_bench_squad."','".$in_playing_squad."','".$clean_sheet."','".$foul_committed."','".$foul_drawn."','".$red_card."','".$y2c_card."','".$yellow_card."','".$goal_assist."','".$goal_conceded."','".$goal_own_goal_conceded."','".$goal_scored."','".$minutes_played."','".$panalty_missed."','".$panalty_saved."','".$panalty_scored."')";
                    
                    $insert_result = mysqli_query($db,$insert_query);
                }
            }
        }
    }

    public function assignCreditsToPlayer($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $match_key = $data['match_key'];
            $query = "UPDATE game_tournament_match SET is_league = '0' WHERE match_key = '".$match_key."'";
            $result = mysqli_query($db,$query);
            foreach ($data['pdata'] as $key => $value) {
                $id = $value['id'];
                $credits = $value['credits'];
                $role = $value['player_type'];
                $query = "UPDATE game_player SET credits = '".$credits."', role = '".$role."' WHERE id = '".$id."' AND match_key = '".$match_key."'";
                $result = mysqli_query($db,$query);
            }
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Credit has been assign.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Credit Not assign.');
            }
            return json_encode($respons);
        }
    }

    public function getPointType(){
        $db = $this->getDBConnection();
        $query = "SELECT game_point_type.id, crm_sport_tbl.sport_name, game_point_type.point_type, 
            game_point_type.status
            FROM game_point_type
            JOIN crm_sport_tbl ON crm_sport_tbl.id=game_point_type.sport_id
            ORDER BY game_point_type.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
        }
        return json_encode($respons);
    }

    public function addPointType($data = null,$files = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $point_type = $data['pont_type'];
            $status = $data['status'];
            if($files != '' && $files != null){
                $file_name = 'icon';
                $target_dir = "uploads/icon/";
                $file_status = $this->upload_file($target_dir, $files, $file_name);
                $file_status = json_decode($file_status);
                if($file_status->success == 1){
                    $image = $file_status->data->file_name;
                } else {
                    $respons = array('success' => '0', 'data' => array(), 'massage' => $file_status->massage);
                    return json_encode($respons);
                }
            } else {
                $image = '';
            }
            $insert_query = "INSERT INTO game_point_type (sport_id, point_type, status, icon) VALUES 
            ('".$sport_id."','".$pont_type."','".$status."','".$image."')";
            $insert_result = mysqli_query($db,$insert_query);
            if($insert_result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Point type has been added.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Point type Not added.');
            }
            return json_encode($respons);
        }
    }

    public function deletePointType($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "DELETE FROM `game_point_type` WHERE id = $id";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Point type has been deleted.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Point type Not deleted.');
            }
            return json_encode($respons);
        }
    }

    public function getPointTypeById($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "SELECT id,sport_id,point_type,icon,status FROM game_point_type WHERE id = $id";
            $result = mysqli_query($db,$query);
            if($result){
                $row=$result->fetch_object();
                $respons = array('success' => '1', 'data' => $row, 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function updatePointType($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $point_type = $data['pont_type'];
            $status = $data['status'];
            $id = $data['id'];
            $old_data = $this->getPointTypeById($id);
            $old_data = json_decode($old_data);
            $image = $old_data->data->icon;
            if($files != '' && $files != null){
                $file_name = 'icon';
                $target_dir = "uploads/icon/";
                $file_status = $this->upload_file($target_dir, $files, $file_name);
                $file_status = json_decode($file_status);
                if($file_status->success == 1){
                    if($image != '' && $image != null){
                        unlink($image);
                    }
                    $image = $file_status->data->file_name;
                } else {
                    $respons = array('success' => '0', 'data' => array(), 'massage' => $file_status->massage);
                    return json_encode($respons);
                }
            }
            $query = "UPDATE game_point_type SET sport_id = '".$sport_id."', point_type = '".$point_type."', status = '".$status."' WHERE id = '".$id."'";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Point type has been updated.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Point type Not updated.');
            }
            return json_encode($respons);
        }
    }

    public function getPointSystem(){
        $db = $this->getDBConnection();
        $query = "SELECT game_point_system_tbl.id,crm_sport_tbl.sport_name,game_point_type.point_type, 
            game_point_system_tbl.title,game_point_system_tbl.total_point,game_point_system_tbl.status,game_point_system_tbl.point_unit,game_point_system_tbl.code 
            FROM game_point_system_tbl
            JOIN crm_sport_tbl ON crm_sport_tbl.id=game_point_system_tbl.sport_id
            JOIN game_point_type ON game_point_type.id=game_point_system_tbl.point_type_id
            ORDER BY game_point_system_tbl.id DESC";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
        }
        return json_encode($respons);
    }

    public function addPointSystem($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $point_type_id = $data['point_type_id'];
            $title = $data['title'];
            $point_unit = $data['point_unit'];
            $total_point = $data['total_point'];
            $code = $data['code'];
            $status = $data['status'];
            if(isset($data['role']) && $data['role'] != ''){
                $role = json_encode($data['role']);
            } else {
                $id_list_query = "SELECT id FROM crm_player_type_tbl WHERE sport_id = '2' ORDER BY player_type";
                $id_list_result = mysqli_query($db,$id_list_query);
                $id_array = array();
                if($id_list_result->num_rows > 0){
                    while ($row = mysqli_fetch_assoc($id_list_result)) {
                        $idList = $row['id'];
                        array_push($id_array, $idList);
                    }
                }
                $role = json_encode($id_array);
            }
            $insert_query = "INSERT INTO game_point_system_tbl (sport_id, role, point_type_id, title, point_unit, total_point, code, status) VALUES
            ('".$sport_id."','".$role."','".$point_type_id."','".$title."','".$point_unit."',
            '".$total_point."','".$code."','".$status."')";
            $insert_result = mysqli_query($db,$insert_query);
            if($insert_result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Point system has been Added.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Point system Not Added.');
            }
            return json_encode($respons);
        }
    }

    public function getPointSystemById($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "SELECT * FROM game_point_system_tbl WHERE id = $id LIMIT 1";
            $result = mysqli_query($db,$query);
            if($result->num_rows == 1){
                $row=$result->fetch_object();
                $respons = array('success' => '1', 'data' => $row, 'massage' => '');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
                return json_encode($respons);
            }
        }
    }

    public function editPointSystem($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $sport_id = $data['sport_id'];
            $point_type_id = $data['point_type_id'];
            $title = $data['title'];
            $point_unit = $data['point_unit'];
            $total_point = $data['total_point'];
            $code = $data['code'];
            $status = $data['status'];
            $id = $data['id'];
            if(isset($data['role']) && $data['role'] != ''){
                $role = json_encode($data['role']);
            } else {
                $id_list_query = "SELECT id FROM crm_player_type_tbl WHERE sport_id = '2' ORDER BY player_type";
                $id_list_result = mysqli_query($db,$id_list_query);
                $id_array = array();
                if($id_list_result->num_rows > 0){
                    while ($row = mysqli_fetch_assoc($id_list_result)) {
                        $idList = $row['id'];
                        array_push($id_array, $idList);
                    }
                }
                $role = json_encode($id_array);
            }
            $update_query = $query = "UPDATE game_point_system_tbl SET sport_id = '".$sport_id."', point_type_id = '".$point_type_id."', 
                title = '".$title."', point_unit = '".$point_unit."', total_point = '".$total_point."', code = '".$code."', status = '".$status."', role = '".$role."' WHERE id = '".$id."'";
            $result = mysqli_query($db,$update_query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Point system has been Added.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Point system Not Added.');
            }
            return json_encode($respons);
        }
    }

    public function deletePointSystem($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "DELETE FROM game_point_system_tbl WHERE id = '".$id."'";
            $result = mysqli_query($db,$query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Point System has been deleted.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Point System Not deleted.');
            }
            return json_encode($respons);
        }
    }

    public function getTournamentResult(){
        $db = $this->getDBConnection();
        $query = "SELECT scard_tbl.id as scard_id, scard_tbl.tournament_key, game_tournament.name, game_tournament.short_name
            FROM game_tournament_match_player_scorecard as scard_tbl
            JOIN game_tournament ON game_tournament.api_code=scard_tbl.tournament_key
            GROUP BY scard_tbl.tournament_key";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
        }
        return json_encode($respons);
    }

    public function getmatchResult($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "SELECT scard_tbl.id as scard_id, scard_tbl.tournament_key, game_tournament.name, game_tournament_match.match_title,game_tournament_match.match_short_name,scard_tbl.match_key
            FROM game_tournament_match_player_scorecard as scard_tbl
            JOIN game_tournament ON game_tournament.api_code=scard_tbl.tournament_key
            JOIN game_tournament_match ON game_tournament_match.match_key=scard_tbl.match_key
            WHERE scard_tbl.tournament_key = $id
            GROUP BY scard_tbl.match_key";
            $result = mysqli_query($db,$query);
            if($result->num_rows > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    $result_data[] = $row;
                }
                $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function getMatchScorecard($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $match_key = $data['match_key'];
            $tournament_key = $data['tournament_key'];
            $query = "SELECT scard_tbl.id as scard_id, scard_tbl.tournament_key, game_tournament.name, game_tournament_match.match_title,game_tournament_match.match_short_name,scard_tbl.match_key,scard_tbl.player_key, game_player.name as player_name
            FROM game_tournament_match_player_scorecard as scard_tbl
            JOIN game_tournament ON game_tournament.api_code=scard_tbl.tournament_key
            JOIN game_tournament_match ON game_tournament_match.match_key=scard_tbl.match_key
            JOIN game_player ON game_player.api_code=scard_tbl.player_key
            WHERE scard_tbl.tournament_key = $tournament_key AND scard_tbl.match_key = $match_key";
            $result = mysqli_query($db,$query);
            if($result->num_rows > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    $result_data[] = $row;
                }
                $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function getScorecardbyId($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "SELECT scard_tbl.* , game_tournament.name, game_player.name as player_name,game_tournament_match.match_title
                    FROM game_tournament_match_player_scorecard as scard_tbl
                    JOIN game_tournament ON game_tournament.api_code=scard_tbl.tournament_key
                    JOIN game_tournament_match ON game_tournament_match.match_key=scard_tbl.match_key
                    JOIN game_player ON game_player.api_code=scard_tbl.player_key
                    WHERE scard_tbl.id = $id
                    LIMIT 1";
            $result = mysqli_query($db,$query);
            if($result->num_rows == 1){
                $row=$result->fetch_object();
                $respons = array('success' => '1', 'data' => $row, 'massage' => '');
                return json_encode($respons);
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
                return json_encode($respons);
            }
        }
    }

    public function updateScorecard($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $id = $data['id'];
            $total_passes = $data['total_passes'];
            $total_shots_save_gk = $data['total_shots_save_gk'];
            $total_shots_target = $data['total_shots_target'];
            $total_goal_conceded_dif_gk = $data['total_goal_conceded_dif_gk'];
            $total_successful_tackles_made = $data['total_successful_tackles_made'];
            $update_query = "UPDATE game_tournament_match_player_scorecard SET total_passes = '".$total_passes."', total_shots_save_gk = '".$total_shots_save_gk."', total_shots_target = '".$total_shots_target."', total_goal_conceded_dif_gk = '".$total_goal_conceded_dif_gk."', 
                total_successful_tackles_made = '".$total_successful_tackles_made."' WHERE id = '".$id."'";
            $result = mysqli_query($db,$update_query);
            if($result){
                $respons = array('success' => '1', 'data' => array(), 'massage' => 'Scorecard has been updated.');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'Scorecard Not updated.');
            }
            return json_encode($respons);
        }
    }

    public function getMatchPoints($data = null){
        $db = $this->getDBConnection();
        $match_key = $data['match_key'];
        $tournament_key = $data['tournament_key'];
        $update_query = "UPDATE game_tournament_match SET is_point_count = '0' WHERE match_key = '".$match_key."' AND tournament_key = '".$tournament_key."'";
        $result = mysqli_query($db,$update_query);
        $player_key_query = "SELECT gtmps.*, gp.name, ptt.player_type, ptt.id as role_id 
                FROM game_tournament_match_player_scorecard as gtmps
                JOIN game_player as gp ON gp.api_code=gtmps.player_key
                JOIN crm_player_type_tbl as ptt ON ptt.player_type=gp.role
                WHERE gtmps.match_key = '".$match_key."' AND tournament_key = '".$tournament_key."'";
        $player_key_result = mysqli_query($db,$player_key_query);
        $PkeyList = array();
        if($player_key_result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($player_key_result)) {
                $sport_id = '2';
                $tournament_key = $row['tournament_key'];
                $tournament_id = $row['tournament_id'];
                $match_key = $row['match_key'];
                $match_id = $row['match_id'];
                $player_key = $row['player_key'];
                $player_id = $row['player_id'];
                $in_bench_squad = $row['in_bench_squad'];
                $in_playing_squad = $row['in_playing_squad'];
                $role_id = $row['role_id'];
                $red_card = $row['red_card'];
                $yellow_card = $row['yellow_card'];
                $goal_assist = $row['goal_assist'];
                $goal_own_goal_conceded = $row['goal_own_goal_conceded'];
                $y2c_card = $row['y2c_card'];
                $clean_sheet = $row['clean_sheet'];
                $foul_committed = $row['foul_committed'];
                $foul_drawn = $row['foul_drawn'];
                $goal_conceded = $row['goal_conceded'];
                $goal_scored = $row['goal_scored'];
                $panalty_missed = $row['panalty_missed'];
                $panalty_saved = $row['panalty_saved'];
                $panalty_scored = $row['panalty_scored'];
                $minutes_played = $row['minutes_played'];
                $total_passes = $row['total_passes'];
                $total_shots_target = $row['total_shots_target'];
                $total_shots_save_gk = $row['total_shots_save_gk'];
                $total_goal_conceded_dif_gk = $row['total_goal_conceded_dif_gk'];
                $total_successful_tackles_made = $row['total_successful_tackles_made'];
                if($in_playing_squad == 0 && $in_playing_squad = 1){
                    $is_playing = 0;
                } else {
                    $is_playing = 1;
                }
                /*echo 'role_id = '.$role_id;
                        echo '<br>';
                echo 'player_key = '.$player_key;
                        echo '<br>';*/
                $point_sys_query = "SELECT * FROM game_point_system_tbl";
                $point_sys_result = $result = mysqli_query($db,$point_sys_query);
                if($point_sys_result->num_rows > 0){
                    $count_point = 0;
                    while ($row02 = mysqli_fetch_assoc($point_sys_result)) {
                        
                        $total_point = $row02['total_point'];
                        $api_code = $row02['code'];
                        $role_id_array = json_decode($row02['role']);
                        if (array_key_exists($api_code,$row)) {
                            if(in_array($role_id, $role_id_array)){
                                if($row02['point_unit'] == 0){
                                    /*$i = 0;
                                    echo '<br>';
                                    echo 'plus'.$i.'_'.$api_code.'_'.$total_point;*/
                                    $count_point = $count_point + $total_point;
                                    /*$i++;
                                    echo '<br>';
                                    echo $count_point;
                                    echo '<br>';*/
                                } else {
                                    /*$i = 100;
                                    echo '<br>';
                                    echo 'minus'.$i.'_'.$api_code.'_'.$total_point;*/
                                    $count_point = $count_point - $total_point;
                                    /*$i++;
                                    echo '<br>';
                                    echo $count_point;
                                    echo '<br>';*/
                                }
                            } else {
                                /*echo '<br>';
                                echo 'not in role';
                                echo '<br>';*/
                                $count_point + 0;    
                            }
                        } else {
                            if(in_array($role_id, $role_id_array)){
                                $res_str = '';
                                if($minutes_played != 0){
                                    if($minutes_played > 55){
                                        $count_point = $api_code == 'minutes_played_more_55' ? $count_point + $total_point : $count_point + 0;
                                    } else {
                                        $count_point = $api_code == 'minutes_played_less_55' ? $count_point + $total_point : $count_point + 0;
                                    }
                                } else {
                                    $count_point + 0;
                                }
                                if($api_code == '10_passes'){
                                    $res_str = $total_passes != 0 ? number_format($total_passes / 10, 1) : '0.0';
                                }
                                if ($api_code == '2_goal_conceded_dif_gk'){
                                    $res_str = $total_goal_conceded_dif_gk != 0 ? number_format($total_goal_conceded_dif_gk / 2, 1) : '0.0';
                                } 
                                if ($api_code == '2_shots_target'){
                                    $res_str = $total_shots_target != 0 ? number_format($total_shots_target / 2, 1) : '0.0';
                                } 
                                if ($api_code == '3_shots_save_gk'){
                                    $res_str = $total_shots_save_gk != 0 ? number_format($total_shots_save_gk / 3, 1) : '0.0';
                                } 
                                if ($api_code == '3_successful_tackles_made'){
                                    $res_str = $total_successful_tackles_made != 0 ? number_format($total_successful_tackles_made / 3, 1) : '0.0';
                                }
                                if($res_str != ''){
                                    $res_array = explode(".",$res_str);
                                    $tpasses = $res_array['0'];
                                    $tpasses_point = $tpasses * $total_point;
                                    if($row02['point_unit'] == 0){
                                        $count_point = $count_point + $tpasses_point;
                                    } else {
                                        $count_point = $count_point - $tpasses_point;
                                    }
                                    
                                    /*echo '<br>';
                                    echo $count_point;
                                    echo '<br>';*/
                                } else {
                                    $count_point + 0;        
                                }
                            } else {
                                $count_point + 0;    
                            }
                        }
                    }
                    /*echo '<br>';
                    echo '=============';
                    echo '<br>';
                    die();*/
                    $insert_query = "INSERT INTO game_match_player_total_point(sport_id, tournament_id, tournament_key, match_id, match_key, player_id, player_key, is_playing, total_point) VALUES 
                                (".$sport_id.",".$tournament_id.",".$tournament_key.",".$match_id.",".$match_key.",".$player_id.",".$player_key.",".$is_playing.",".$count_point.")";
                    $result = mysqli_query($db,$insert_query);
                    unset($count_point);
                }
            }
        }
        $respons = array('success' => '1', 'data' => array(), 'massage' => '');
        return json_encode($respons);
    }

    public function getTournamentPointResult(){
        $db = $this->getDBConnection();
        $query = "SELECT point_tbl.id as point_id, point_tbl.tournament_key, game_tournament.name, game_tournament.short_name
            FROM game_match_player_total_point as point_tbl
            JOIN game_tournament ON game_tournament.api_code=point_tbl.tournament_key
            GROUP BY point_tbl.tournament_key";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $result_data[] = $row;
            }
            $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
        } else {
            $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
        }
        return json_encode($respons);
    }

    public function getmatchPointResult($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "SELECT point_tbl.id as point_id, point_tbl.tournament_key, game_tournament.name, game_tournament_match.match_title,game_tournament_match.match_short_name,point_tbl.match_key
            FROM game_match_player_total_point as point_tbl
            JOIN game_tournament ON game_tournament.api_code=point_tbl.tournament_key
            JOIN game_tournament_match ON game_tournament_match.match_key=point_tbl.match_key
            WHERE point_tbl.tournament_key = $id
            GROUP BY point_tbl.match_key";
            $result = mysqli_query($db,$query);
            if($result->num_rows > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    $result_data[] = $row;
                }
                $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function getPointResult($data = null){
        if($data != null){
            $db = $this->getDBConnection();
            $match_key = $data['match_key'];
            $tournament_key = $data['tournament_key'];
            $query = "SELECT point_tbl.id as point_id, point_tbl.tournament_key, game_tournament.name, game_tournament_match.match_title,game_tournament_match.match_short_name,point_tbl.match_key,point_tbl.player_key,game_player.name as player_name,point_tbl.total_point 
            FROM game_match_player_total_point as point_tbl
            JOIN game_tournament ON game_tournament.api_code=point_tbl.tournament_key
            JOIN game_tournament_match ON game_tournament_match.match_key=point_tbl.match_key
            JOIN game_player ON game_player.api_code=point_tbl.player_key
            WHERE point_tbl.tournament_key = $tournament_key AND point_tbl.match_key = $match_key";
            $result = mysqli_query($db,$query);
            if($result->num_rows > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    $result_data[] = $row;
                }
                $respons = array('success' => '1', 'data' => $result_data, 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function cronJob(){
        $db = $this->getDBConnection();
        $token_result  = $this->ApiAuthentication();
        $token_result = json_decode($token_result);
        $token = $token_result->auth->access_token;
        $tournament_json = $this->getTournamentList();
        $tournamentList = json_decode($tournament_json);
        $tournamentList = $tournamentList->data;
        foreach ($tournamentList as $key => $value) {
            if($value->is_fetch == '0'){
                continue;
            }
            $tournament_key = $value->api_code;
            $match_query = "SELECT id, match_key, match_status FROM game_tournament_match WHERE tournament_key = $tournament_key";
            $match_result = mysqli_query($db,$match_query);
            if($match_result->num_rows > 0){
                while ($row = mysqli_fetch_assoc($match_result)) {
                    $match_key = $row['match_key'];
                    $match_old_status = $row['match_status'];
                    $id = $row['id'];
                    $url = "https://api.footballapi.com/v1/match/$match_key/?access_token=$token";
                    $method = 'GET';
                    $params  = false;
                    $match_info = $this->callAPI($method, $url, $params);
                    $match_data = json_decode($match_info);
                    $new_status = $match_data->data->match->status;
                    if($match_old_status != $new_status){
                        $update_query = "UPDATE game_tournament_match SET match_status = '".$new_status."' WHERE id = '".$id."'";
                        $result = mysqli_query($db,$update_query);
                        $tournament_Id_query = "SELECT id FROM game_tournament WHERE api_code = $tournament_key LIMIT 1";
                        $tournament_Id_result = mysqli_query($db,$tournament_Id_query);
                        if($tournament_Id_result->num_rows == 1){
                            $row=$tournament_Id_result->fetch_object(); 
                            $tournament_id = $row->id;
                        }
                        $match_Id_query = "SELECT id FROM game_tournament_match WHERE match_key = $match_key LIMIT 1";
                        $match_Id_result = mysqli_query($db,$match_Id_query);
                        if($match_Id_result->num_rows == 1){
                            $row=$match_Id_result->fetch_object(); 
                            $match_id = $row->id;
                        }
                        $player_Id_query = "SELECT id FROM game_player WHERE match_key = $match_key LIMIT 1";
                        $player_Id_result = mysqli_query($db,$player_Id_query);
                        if($player_Id_result->num_rows == 1){
                            $row=$player_Id_result->fetch_object(); 
                            $player_id = $row->id;
                        }
                        if($new_status == 'completed'){                        
                            $players_scorecard = $match_data->data->players;
                            foreach ($players_scorecard as $key => $value) {
                                
                                $tournament_key = $tournament_key;
                                $match_key = $match_key;
                                $player_key = $value->key;
                                $in_playing_squad = $value->in_playing_squad != '' ? $value->in_playing_squad : '0';
                                $in_bench_squad = $value->in_bench_squad != '' ? $value->in_bench_squad : '0';
                                if(isset($value->stats->clean_sheet)){
                                    $clean_sheet = $value->stats->clean_sheet != '' ? $value->stats->clean_sheet : '0';
                                } else {
                                    $clean_sheet = '0';
                                }
                                $foul_committed = $value->stats->foul->committed;
                                $foul_drawn = $value->stats->foul->drawn;
                                $red_card = $value->stats->card->RC;
                                $y2c_card = $value->stats->card->Y2C;
                                $yellow_card = $value->stats->card->YC;
                                $goal_assist = $value->stats->goal->assist;
                                if(isset($value->stats->goal->conceded)){
                                    $goal_conceded = $value->stats->goal->conceded != '' ? $value->stats->goal->conceded : '0';
                                } else {
                                    $goal_conceded = '0';
                                }
                                $goal_own_goal_conceded = $value->stats->goal->own_goal_conceded;
                                $goal_scored = $value->stats->goal->scored;
                                $minutes_played = $value->stats->minutes_played;
                                $panalty_missed = $value->stats->penalty->missed;
                                $panalty_saved = $value->stats->penalty->saved;
                                $panalty_scored = $value->stats->penalty->scored;
                                $insert_query = "INSERT INTO game_tournament_match_player_scorecard
                                (tournament_key, tournament_id, match_key, match_id, player_key, player_id, in_bench_squad, in_playing_squad, clean_sheet, foul_committed, foul_drawn, red_card, y2c_card, yellow_card, goal_assist, goal_conceded, goal_own_goal_conceded, goal_scored, minutes_played, panalty_missed, panalty_saved, panalty_scored) VALUES 
                                ('".$tournament_key."','".$tournament_id."','".$match_key."','".$match_id."','".$player_key."','".$player_id."','".$in_bench_squad."','".$in_playing_squad."','".$clean_sheet."','".$foul_committed."','".$foul_drawn."','".$red_card."','".$y2c_card."','".$yellow_card."','".$goal_assist."','".$goal_conceded."','".$goal_own_goal_conceded."','".$goal_scored."','".$minutes_played."','".$panalty_missed."','".$panalty_saved."','".$panalty_scored."')";
                                $insert_result = mysqli_query($db,$insert_query);
                            }
                        }
                    }
                }
            }
        }
    }

    public function getPointbyId($id = null){
        if($id != null){
            $db = $this->getDBConnection();
            $query = "SELECT point_tbl.*,game_player.name as player_name,game_tournament.name as tournament_name, game_tournament_match.match_title as match_title
                FROM game_match_player_total_point as point_tbl
                JOIN game_tournament ON game_tournament.api_code=point_tbl.tournament_key
                JOIN game_tournament_match ON game_tournament_match.match_key=point_tbl.match_key
                JOIN game_player ON game_player.api_code=point_tbl.player_key
                WHERE point_tbl.id = $id 
                LIMIT 1";
            $point_result = mysqli_query($db,$query);
            if($point_result->num_rows == 1){
                $row=$point_result->fetch_object();
                $respons = array('success' => '1', 'data' => $row, 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function getScorecardInfo($tournament_key = null, $match_key = null, $player_key = null){
        if($tournament_key != null && $match_key != null && $player_key != null){
            $db = $this->getDBConnection();
            $query = "SELECT * FROM game_tournament_match_player_scorecard WHERE match_key = $match_key AND tournament_key = $tournament_key AND player_key = $player_key LIMIT 1";
            $scorecard_result = mysqli_query($db,$query);
            if($scorecard_result->num_rows == 1){
                $row=$scorecard_result->fetch_object();
                $respons = array('success' => '1', 'data' => $row, 'massage' => '');
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function getUserTotalPoint($id = null){
        if($id != ''){
            $db = $this->getDBConnection();
            $query = "SELECT * FROM user_team WHERE match_key = $id";
            $team_result = mysqli_query($db,$query);
            if($team_result->num_rows > 0){
                while ($row = mysqli_fetch_assoc($team_result)) {
                    $match_key = $row['match_key'];
                    $user_id = $row['user_id'];
                    $captain_key = $row['captain_key'];
                    $vcaptain_key = $row['vcaptain_key'];
                    $team_no = $row['team_no'];
                    $query02 = "SELECT * FROM user_team_player WHERE match_key = $match_key AND user_id = $user_id AND team_no = $team_no";
                    $query02_result = mysqli_query($db,$query02);
                    if($query02_result->num_rows > 0){
                        while ($row02 = mysqli_fetch_assoc($query02_result)) {
                            $pid = $row02['id'];
                            $player_key_json = $row02['player_key_json'];
                            $player_id_json = $row02['player_id_json'];
                            $player_array = json_decode($player_key_json);
                            $tpoint = 0;
                            foreach ($player_array as $key03 => $value03) {
                                $player_key = $value03;
                                $tpoint_query = "SELECT * FROM game_match_player_total_point WHERE match_key = $match_key AND player_key = $player_key LIMIT 1";
                                $tpoint_result = mysqli_query($db,$tpoint_query);
                                if($tpoint_result->num_rows > 0) {
                                    $tpoint_row=$tpoint_result->fetch_object();
                                    $total_point = $tpoint_row->total_point;
                                    if($captain_key == $player_key){
                                        $total_point = $total_point * 2;
                                    }
                                    if($vcaptain_key == $player_key){
                                        $total_point = $total_point * 1.5;
                                    }
                                    $tpoint = $tpoint + $total_point;
                                }
                            }
                            $update_query = "UPDATE user_team_player SET total_point = '".$tpoint."' WHERE id = '".$pid."'";
                            $update_result = mysqli_query($db,$update_query);
                            
                        }
                        $rank_query = "SELECT * FROM user_team_player WHERE match_key = $match_key ORDER BY total_point DESC";
                        $rank_result = mysqli_query($db,$rank_query);
                        if($rank_result->num_rows > 0){
                            $i = 1;
                            while ($rank_row = mysqli_fetch_assoc($rank_result)) {
                                $rid = $rank_row['id'];
                                $rank_query_05 = "SELECT * FROM user_team_player WHERE match_key = $match_key AND id = $rid LIMIT 1";
                                $rank_result_05 = mysqli_query($db,$rank_query_05);
                                if($rank_result_05->num_rows > 0) {
                                    $result_05_row=$rank_result_05->fetch_object();
                                    $crank = $result_05_row->rank;
                                }
                                if($crank == '0'){
                                    $tpoint = $rank_row['total_point'];
                                    $rank_query_02 = "SELECT * FROM user_team_player WHERE match_key = $match_key AND total_point = $tpoint" ;
                                    $rank_query_02_result = mysqli_query($db,$rank_query_02);
                                    if($rank_query_02_result->num_rows > 0){
                                        $rank_update_query = "UPDATE user_team_player SET rank = '".$i."' WHERE total_point = '".$tpoint."'";
                                        $rank_update_result = mysqli_query($db,$rank_update_query);
                                    } else {
                                        $rank_update_query = "UPDATE user_team_player SET rank = '".$i."' WHERE id = '".$rank_row['id']."'";
                                        $rank_update_result = mysqli_query($db,$rank_update_query);
                                    }                                  
                                }
                                $i++;
                            }
                        }
                        $respons = array('success' => '1', 'data' => array(), 'massage' => '');
                    } else {
                        $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
                    }
                }
            } else {
                $respons = array('success' => '0', 'data' => array(), 'massage' => 'No Data Found.');
            }
            return json_encode($respons);
        }
    }

    public function getUserTournamentResult(){
        $db = $this->getDBConnection();
        $query = "SELECT DISTINCT gtm.tournament_key, utp.match_key, , gt.*
                FROM user_team_player as utp
                JOIN game_tournament_match as gtm ON gtm.match_key=utp.match_key
                JOIN game_tournament as gt ON gt.api_code=gtm.tournament_key
                ORDER BY gtm.tournament_key";
        $result = mysqli_query($db,$query);
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                
            }
        }
    }

    public function league_html($data = null){
        $html = "<div class='modal-dialog modal-lg'>
          <div class='modal-content'>
            <div class=modal-header>
              <h4 class='modal-title'>League List</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <!-- Modal body -->
            <div class='modal-body'>
                <div style='height:400px; overflow-y:scroll;'>
                <table class='table table-striped- table-bordered table-hover table-checkable' id='m_table_2' style='table-layout: fixed; width: 100%; height:100%;'>
                    <thead>
                        <tr>
                            <th>
                                <label class='m-checkbox m-checkbox--solid m-checkbox--state-success'>
                                    <input type='checkbox' id='action_checkbox'> 
                                    <span></span>
                                </label>
                            </th>
                            <th>Title</th>
                            <th>Winning</th>
                            <th>Entry Fee</th>
                            <th>Total Winners</th>
                            <th>Confirm</th>
                            <th>Practise</th>
                            <th>Grand</th>
                            <th>Multi Entry</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach ($data as $key => $value) { 
                            if($value['is_confirm'] == 0){
                                $is_confirm = '<span class=alert-success> YES </span>';
                            } else {
                                $is_confirm = '<span class=alert-danger> No </span>';
                            }
                            if($value['is_practise'] == 0){
                                $is_practise = '<span class=alert-success> YES </span>';
                            } else {
                                $is_practise = '<span class=alert-danger> No </span>';
                            }
                            if($value['is_practise'] == 0){
                                $is_practise = '<span class=alert-success> YES </span>';
                            } else {
                                $is_practise = '<span class=alert-danger> No </span>';
                            }
                            if($value['is_grand'] == 0){
                                $is_grand = '<span class=alert-success> YES </span>';
                            } else {
                                $is_grand = '<span class=alert-danger> No </span>';
                            }
                            if($value['is_multi'] == 0){
                                $is_multi = '<span class=alert-success> YES </span>';
                            } else {
                                $is_multi = '<span class=alert-danger> No </span>';
                            }
                            $html .= "<tr>
                                <td>
                                    <label class='m-checkbox m-checkbox--solid m-checkbox--state-success'>
                                        <input type='checkbox' class='ch_checkbox' name='id_list[]' value='".$value['id']."'> 
                                        <span></span>
                                    </label>
                                </td>
                                <td>".$value['title']."</td>
                                <td>".$value['total_amount']."</td>
                                <td>".$value['entry_fee']."</td>
                                <td>".$value['total_winners']."</td>
                                <td>".$is_confirm."</td>
                                <td>".$is_practise."</td>
                                <td>".$is_grand."</td>
                                <td>".$is_multi."</td>
                            </tr>";
                        }
                        
                    $html .= "</tbody>
                </table>
                </div>
            </div>
            <!-- Modal footer -->
            <div class='modal-footer'>
                <button type='submit' class='btn btn-info'>Save</button>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>";
        return $html;
    }

    public function player_html($data = null,$player_type = null){
        $html = "<div class='modal-dialog modal-lg'>
          <div class='modal-content'>
            <div class=modal-header>
              <h4 class='modal-title'>Player List</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <!-- Modal body -->
            <div class='modal-body'>
                <div style='height:400px; overflow-y:scroll;'>
                <table class='table table-striped- table-bordered table-hover table-checkable' id='m_table_2' style='table-layout: fixed; width: 100%; height:100%;'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Team</th>
                            <th>Name</th>
                            <th>Credits</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                        $i = 1;
                        foreach ($data as $key => $value) { 
                            if($value['credits'] == 0){
                                $credits = 0;
                            } else {
                                $credits = $value['credits'];
                            }
                            $html .= "<tr>
                                <input type='hidden' name='pdata[".$key."][id]' value=".$value['id'].">
                                <td>".$i."</td>
                                <td>".$value['team_name']."</td>
                                <td>".$value['player_name']."</td>
                                <td><input type='text' name='pdata[".$key."][credits]' value='".$credits."' class='form-control m-input m-input--solid' /></td>
                                <td>
                                <select class='form-control m-input m-input--solid' class='form-control m-input m-input--solid' name='pdata[".$key."][player_type]'>";
                                foreach ($player_type as $key02 => $value02) {
                                        if($value02->player_type == $value['role']){
                                            $sel = 'selected';
                                        } else {
                                            $sel = '';
                                        }
                                        $html .= "<option value=".$value02->player_type." ".$sel.">".$value02->player_type."</option>";
                                    }
                                $html .= "
                                </select>
                                </td>
                            </tr>";
                        $i++; }
                        
                    $html .= "</tbody>
                </table>
                </div>
            </div>
            <!-- Modal footer -->
            <div class='modal-footer'>
                <button type='submit' class='btn btn-info'>Save</button>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>";
        return $html;
    }
}
?>
