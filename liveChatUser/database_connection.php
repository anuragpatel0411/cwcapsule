<?php
$connect = new mysqli("localhost","root","","cwcapsule");
if($connect->connect_error){
    die("Connection failed: ".$connect->connect_error);
}
date_default_timezone_set('Asia/Kolkata');

function fetch_user_chat_history($from_user_id, $to_user_id, $connect){
	$query = "SELECT * FROM chat_message WHERE (from_user_id = '".$from_user_id."' AND to_user_id = '".$to_user_id."') OR (from_user_id = '".$to_user_id."' AND to_user_id = '".$from_user_id."') ORDER BY timestamp DESC";
	$result = $connect->query($query);
	// $statement = $connect->prepare($query);
	// $statement->execute();
	// $result = $statement->fetchAll();
	$output = '<ul class="list-unstyled">';
		if($result->num_rows > 0){	
			while($row = $result->fetch_assoc()){
				$user_name = '';
				if($row["from_user_id"] == $from_user_id){
					$user_name = '<b class="text-success">You</b>';
				} else {
					$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
				}
				$output .= '
			<li style="border-bottom:1px dotted #ccc">
			<p>'.$user_name.' - '.$row["chat_message"].'
				<div align="right">
				- <small><em>'.$row['timestamp'].'</em></small>
				</div>
			</p>
			</li>
			';
			}
		}else{
			$output .= "0 result";
		}
	$output .= '</ul>';
	return $output;
}

function get_user_name($user_id, $connect){
	// $query = "SELECT username FROM login WHERE user_id = '$user_id'";
	// $statement = $connect->prepare($query);
	// $statement->execute();
	// $result = $statement->fetchAll();
	// foreach($result as $row){
	// 	return $row['username'];
	// }
	
	if($_SESSION["role"]=="teachers"){
		$nameofsender = 'Student';
	}elseif($_SESSION["role"]=="students"){
		$nameofsender = 'Guru';
	}
	return $nameofsender;
}

function count_unseen_message($from_user_id, $to_user_id, $connect){
	$query = "SELECT * FROM chat_message WHERE from_user_id = '$from_user_id' AND to_user_id = '$to_user_id' AND status = '1'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$count = $statement->rowCount();
	$output = '';
	if($count > 0){
		$output = '<span class="label label-success">'.$count.'</span>';
	}
	return $output;
}

?>