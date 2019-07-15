<?php
    $id = $_POST['subid'];
    $table= $_POST['category'];
    $col= $_POST['attribute'];
    $conn = new mysqli("localhost", "root", "", "cwcapsule");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "DELETE FROM $table WHERE $col= '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully ",$table, $col;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();    
?>