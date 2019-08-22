<?php
    $conn = new mysqli("localhost","root","","cwcapsule");
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }
?>