<?php 
// Connect to database
	$connection=mysqli_connect('localhost','nexusuvx_nexus','VbYD%$Rhq&s5','nexusuvx_player11');
	$request_method=$_REQUEST["REQUEST_METHOD"];
	switch($request_method)
	{
		case 'userList':
			// Retrive User
			if(!empty($_REQUEST["user_id"]))
			{
				$user_id=intval($_REQUEST["user_id"]);
				get_user($user_id);
			} else {
				get_user();
			}
			break;
		case 'adduser':
			// Insert User
			insert_user();
			break;
		case 'edituser':
			// Update User
			$user_id=intval($_REQUEST["user_id"]);
			update_user($user_id);
			break;
		case 'deleteuser':
			// Delete User
			$user_id=intval($_REQUEST["user_id"]);
			delete_user($user_id);
			break;
		case 'userLogin':
			// User Login
			user_login();
			break;
		case 'countries':
			countries();
			break;
		case 'states':
			states();
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}


	function insert_user()
	{
		global $connection;
		$name = $_REQUEST["name"];
		$team_name = $_REQUEST["team_name"];
		$email = $_REQUEST["email"];
		$password = md5($_REQUEST["password"]);
		$state = $_REQUEST["state"];
		$gender = $_REQUEST["gender"];
		$date_of_birth = $_REQUEST["date_of_birth"];
		$contact_number = $_REQUEST["contact_number"];
		$role_id = '2';
		$device_token = $_REQUEST["device_token"];
		$device_type = $_REQUEST["device_type"];


		$chk_email_query = "SELECT user_id FROM crm_users_tbl WHERE role_id = '2' AND email = '$email'";
		$result = mysqli_query($connection,$chk_email_query);
		if($result->num_rows == 1){
			$response=array(
				'status' => 0,
				'data' => array(),
				'status_message' =>'This email address is already taken. please try another.'
			);
		} else{
			$chk_contact_query = "SELECT user_id FROM crm_users_tbl WHERE role_id = '2' AND contact_number = '$contact_number'";
			$result02 = mysqli_query($connection,$chk_contact_query);
			if($result02->num_rows == 1){
				$response=array(
					'status' => 0,
					'data' => array(),
					'status_message' =>'This Connect Number is already taken. please try another.'
				);
			} else {
				$query = "INSERT INTO crm_users_tbl (name, team_name, email, password, state, gender, date_of_birth, role_id, contact_number,device_token,device_type) VALUES 
				('$name','$team_name','$email','$password','$state','$gender','$date_of_birth','$role_id','$contact_number','$device_token','$device_type')";
				if(mysqli_query($connection, $query)){
					$last_id = $connection->insert_id;
					$user_obj = new stdClass;
					$user_obj->user_id = $last_id;
					$user_obj->name = $name;
					$user_obj->team_name = $team_name;
					$user_obj->email = $email;
					$user_obj->contact_number = $contact_number;
					$user_obj->gender = $gender;
					$user_obj->role_id = 2;
					$response=array(
						'status' => 1,
						'data' => array($user_obj),
						'status_message' =>'User Added Successfully.'
					);
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function get_user($user_id = 0)
	{
		global $connection;
		
		$query="SELECT * FROM crm_users_tbl WHERE role_id = '2' AND is_deleted = '1'";
		
		if($user_id != 0)
		{
			$query.=" AND user_id =".$user_id." LIMIT 1";
		}
		$response=array();
		$result=mysqli_query($connection, $query);
		
		while($row=mysqli_fetch_object($result))
		{
			$res_data[]=$row;
		}
		$response=array(
			'status' => 1,
			'data' => $res_data,
			'status_message' =>''
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}


	function delete_user($user_id)
	{
		global $connection;
		
		$query="DELETE FROM crm_users_tbl WHERE user_id=".$user_id;
		
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'data' => array(),
				'status_message' =>'User Deleted Successfully.'
			);
		} else {
			$response=array(
				'status' => 0,
				'data' => array(),
				'status_message' =>'User Deletion Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}


	function update_user($user_id)
	{
		global $connection;
		$name = $_REQUEST["name"];
		$team_name = $_REQUEST["team_name"];
		$state = $_REQUEST["state"];
		$gender = $_REQUEST["gender"];
		$date_of_birth = $_REQUEST["date_of_birth"];
		
		$query="UPDATE crm_users_tbl SET name='{$name}', team_name='{$team_name}', state='{$state}', gender='{$gender}', date_of_birth='{$date_of_birth}' WHERE user_id =".$user_id;
		
		if(mysqli_query($connection, $query)){
			$response=array(
				'status' => 1,
				'data' => array(),
				'status_message' =>'User Updated Successfully.'
			);
		} else {
			$response=array(
				'status' => 0,
				'data' => array(),
				'status_message' =>'User Updation Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}


	function user_login(){
		global $connection;
		$email = $_REQUEST["email"];
		$password = md5($_REQUEST["password"]);
		$device_token = $_REQUEST["device_token"];
		$device_type = $_REQUEST["device_type"];
		$query = "SELECT user_id,name,team_name,email,contact_number,gender,role_id FROM crm_users_tbl WHERE role_id = '2' AND email = '$email' AND password = '$password' LIMIT 1";
		$result = mysqli_query($connection,$query);
		if($result->num_rows != 0) {
			$row = $result->fetch_object();
			$update_query="UPDATE crm_users_tbl SET device_token='{$device_token}', device_type='{$device_type}' WHERE user_id =".$row->user_id;
			$update_result = mysqli_query($connection,$update_query);
			$response=array(
				'status' => 1,
				'data' => array($row),
				'status_message' =>'Login success.'
			);
		} else {
			$response=array(
				'status' => 0,
				'data' => array(),
				'status_message' =>'Invalid username or password.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function countries(){
		global $connection;
		$query = "SELECT countryID,localName,region FROM countries";
		$result = mysqli_query($connection, $query);	
		
		while($row=mysqli_fetch_object($result))
		{
			$res_data[]=$row;
		}
		$response=array(
			'status' => 1,
			'data' => $res_data,
			'status_message' =>''
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function states(){
		global $connection;
		$countryID = $_REQUEST['countryID'];
		$query = "SELECT stateID,stateName,countryID FROM states WHERE countryID='$countryID'";

		$result = mysqli_query($connection, $query);	
		
		while($row=mysqli_fetch_object($result))
		{
			$res_data[]=$row;
		}
		$response=array(
			'status' => 1,
			'data' => $res_data,
			'status_message' =>''
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	// Close database connection
	mysqli_close($connection);
?>