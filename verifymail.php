<?php
    $mail = $_GET["email"];
    $name = $_GET["name"];
    $role = $_GET["r"];

    include "databaseConn.php";

    if($role == 's'){
        $sql = "SELECT studentId FROM students WHERE email='$mail'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['studentId'];
            $sql2 = "UPDATE students SET verified= TRUE WHERE studentId='$id'";

            if ($conn->query($sql2) === TRUE) {
                $_SESSION["username"] = $_GET["name"];
                $_SESSION["id"] = $id;
                $_SESSION["role"] = "student";
                header('Location: http://localhost/cwcapsule/students/home.php?id='.$id);
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }

        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    }

    if($role == 't'){
        $sql = "SELECT teacherId FROM teachers WHERE email='$mail'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['teacherId'];
            $sql2 = "UPDATE teachers SET mailVerified= TRUE WHERE teacherId='$id'";

            if ($conn->query($sql2) === TRUE) {
                $_SESSION["username"] = $_GET["name"];
                $_SESSION["id"] = $id;
                $_SESSION["role"] = "teacher";
                header('Location: http://localhost/cwcapsule/teachers/teachertest.php?id='.$id);
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
?>