<?php 
include_once 'config/database.php';

	public function getDBConnection(){
        $database = new Database();
        return $database->getConnection();
    }

	public fuction sportList(){
		$db = $this->getDBConnection();
		
        $query = "SELECT id, sport_name FROM crm_sport_tbl";
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



?>