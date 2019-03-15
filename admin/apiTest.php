<?php 
	
	include_once '../include/admin/action.php';
	$data = array();
	
	$match_key = '1035106654263316481';

	$action = new Action();
	$data = $action->getUserTotalPoint($match_key);
	$data = json_decode($data);

	echo '<pre>';
	print_r($data);

?>