<?php 
    session_start();
    if(!$_SESSION || $_SESSION["role"] != "teachers"){
        header('Location: /cwcapsule/login.php');
    }

    $id = $_SESSION["id"];

    $conn = new mysqli("localhost", "root", "", "cwcapsule");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT documentVerified FROM teachers WHERE teacherId = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($row["documentVerified"] == FALSE){
                echo "hi";
                header('Location: /cwcapsule/teachers/teachertest.php?id='.$id);                
            }
        }
    }
    $conn->close();
?>
<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./../styles/registerlogin.css">
        <title><?php echo $_SESSION["username"];?></title>
	</head>
	<body>
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="container box">
           <h2> Welcome <?php echo $_SESSION["username"];?></h2>Teacher
           <div>
                <div>
                   <a href="update.php">Update Profile</a>
                </div>    
                <div>
                    <a href="chngPass.php">Change Password</a>
                </div>    
           </div>
        </div>
        
        <div>
            <?php include './../footer.php' ?>   
        </div>
	</body>
</html>