<?php
    $conn = new mysqli("localhost", "root", "", "cwcapsule");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT COUNT(teacherId) FROM teachers";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $teacher= $row["COUNT(teacherId)"];
    }
    $sql = "SELECT COUNT(studentId) FROM students";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $student= $row["COUNT(studentId)"];
    }
    $sql = "SELECT COUNT(subjectId) FROM subjects";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $subject= $row["COUNT(subjectId)"];
    }
    // $sql = "SELECT COUNT(quesid) FROM qadetail";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $questions= $row["COUNT(quesid)"];
    // }
    // $sql = "SELECT COUNT(quesid) FROM qadetail WHERE ansid IS NOT NULL";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $answerd= $row["COUNT(quesid)"];
    // }
    // $sql = "SELECT COUNT(quesid) FROM qadetail WHERE ansid IS NULL";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $unanswerd= $row["COUNT(quesid)"];
    // }
    $conn->close();
?>

<html>
    <head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./styles/bootstrap.css">
		
        <link rel="stylesheet" href="./styles/style.css">

        <title>Admin Dashboard</title>
    </head>
    <body>
        <div>
            <?php include 'header.php';?>
            <div class="container box">
                <h2 class="title">Admin Dashboard</h2>
                <div class="details row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="card">
                            <h3>User Information</h3>
                            <div class="counts">Total Number of Teachers: <span><?php echo $teacher; ?> </span></div>
                            <div class="counts">Total Number of Students: <span><?php echo $student;?> </span></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="card">
                            <h3>Subject Information</h3>
                            <div class="counts">Total Number of Subjects: <span><?php echo $subject?> </span></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="card">
                            <h3>Question Details</h3>
                            <div class="counts">Total Number of Questions: <span><?php echo $questions;?> </span></div>
                            <div class="counts">Total Number of Answerd Questions: <span><?php echo $answerd;?> </span></div>
                            <div class="counts">Total Number of Unanswerd Questions: <span><?php echo $unanswerd;?> </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>