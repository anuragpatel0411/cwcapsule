<?php
    session_start();
    
    include "./../databaseConn.php";

    $id = $_SESSION["id"];
    $sql = "SELECT * FROM students WHERE studentId= '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    $msg = "";
    if(isset($_POST['submit'])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $college = $_POST["college"];
        $mobile = $_POST["mobile"];
        if($name && $mobile && $email && $college){
            $sql = $conn->prepare("UPDATE students SET  studentName = ?, college = ?, email = ?, mobile = ? WHERE studentid = ?");
            $sql->bind_param("sssss", $name, $college, $email, $mobile, $id);
            $sql->execute();
            $conn->close();
            $msg = "Deatils Updated";
        }
        else{
            $msg = "Update Fail";
        }
    }
?>

<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./styles/registerlogin.css">
        <title>Question</title>
	</head>
	<body>
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="container box">
            <h3>You are not allowed to update your profile</h3>
            <!-- <form method="post">
                <h3>Update Porfile</h3>
                <h4 style="color:blue;"><?php echo $msg; ?></h4>
                <div>
                    <span>Name: </span>
                    <input type="text" name="name" value="<?php echo $row['studentName']; ?>">
                </div>
                <div>
                    <span>DOB: </span>
                    <input type="text" name="dob" value="<?php echo $row['birthDate']; ?>">
                </div>
                <div>
                    <span>Course: </span>
                    <input type="text" name="course" value="<?php echo $row['course']; ?>">
                </div>
                <div>
                    <span>Major Subjects: </span>
                    <input type="text" name="subject" value="<?php echo $row['majorSubject']; ?>">
                </div>
                <div>
                    <input type="submit" name="submit" value="Save">
                    <a href="home.php">
                        <input type="button" name="discard" value="Cancel">
                    </a>
                </div>
            </form> -->
        </div>
        
		<?php include './../footer.php' ?>
        
    </body>
</html>