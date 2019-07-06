<?php
    $mail = $_GET["email"];
    $name = $_GET["name"];

    $conn = new mysqli("localhost", "root", "", "cwcapsule");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT studentId FROM students WHERE email='$mail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['studentId'];
        $sql2 = "UPDATE students SET verified= TRUE WHERE studentId='$id'";

        if ($conn->query($sql2) === TRUE) {
            header('Location: http://localhost/cwcapsule/students/home.php?id='.$id);
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }

    } else {
        
        $sql = "SELECT teacherId FROM teachers WHERE email='$mail'";
        $result = $conn->query($sql);
        ecHO "HI";  
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['teacherId'];
            $sql2 = "UPDATE teachers SET mailVerified= TRUE WHERE teacherId='$id'";

            if ($conn->query($sql2) === TRUE) {
                header('Location: http://localhost/cwcapsule/teachers/accountcreate.php?id='.$id.'&step=2');
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        }

    }
    $conn->close();
?>