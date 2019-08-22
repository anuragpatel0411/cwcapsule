<?php
include('database_connection.php');
session_start();
if(!isset($_SESSION['id'])){
	header("location: ./../login.php");
}
$data = array(
 ':to_user_id'  => $_POST['to_user_id'],
 ':from_user_id'  => $_SESSION['id'],
 ':chat_message'  => $_POST['chat_message'],
 ':question_id'  => $_POST['quid'],
 ':status'   => '1'
);
$query = "INSERT INTO chat_message (to_user_id, from_user_id, chat_message, status, questionId) VALUES (?, ?, ?, ?, ?)";
$statement = $connect->prepare($query);
$statement->bind_param("ssssi", $data[":to_user_id"], $data[":from_user_id"], $data[":chat_message"], $data[":status"], $data[":question_id"]);

if($statement->execute()){
	echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $connect);
}
?>
