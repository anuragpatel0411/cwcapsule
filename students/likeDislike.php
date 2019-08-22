<?php
    $id = $_POST['id'];
    $type= $_POST['type'];
    
    include "./../databaseConn.php";

    $sql ="";
    if($type == '1'){
        $sql = "UPDATE questionanswer SET rating = '1', status = 'Closed' WHERE questionId = '$id';";
    }elseif($type == '0'){
        $sql = "UPDATE questionanswer SET rating = '0', status = 'Closed' WHERE questionId = '$id';";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully ". $type;
    } else {
        echo "a".$type . "Error updating record: " . $conn->error;
    }
    $conn->close();
?>