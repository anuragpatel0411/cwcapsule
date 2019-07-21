<?php
    $id = $_POST['id'];
    $type= $_POST['type'];
    $conn = new mysqli("localhost", "root", "", "cwcapsule");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql ="";
    if($type == '1'){
        $sql = "UPDATE questionanswer SET rating = '1' WHERE questionId = '$id';";
    }elseif($type == '0'){
        $sql = "UPDATE questionanswer SET rating = '0' WHERE questionId = '$id';";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully ". $type;
    } else {
        echo "a".$type . "Error updating record: " . $conn->error;
    }
    $conn->close();
?>