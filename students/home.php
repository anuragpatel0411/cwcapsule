<?php 
    session_start();
    if(!$_SESSION || $_SESSION["role"] != "students"){
        header('Location: /cwcapsule/login.php');
    }
?>
<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./../styles/footer.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./styles/registerlogin.css">
        <title><?php echo $_SESSION["username"];?></title>
	</head>
	<body>
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="container box">
           <h2> Welcome <?php echo $_SESSION["username"];?></h2>
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