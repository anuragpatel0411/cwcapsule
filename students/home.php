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
        <div class="box" align="center">
            <div class="homeuser"><H2><?php echo $_SESSION["username"];?></H2></div>
            <div>
                <img src="./../images/user.png" alt="profile" height="150" width="150">
            </div>
            <div class="homemail">
                <?php 
                    include "./../databaseConn.php";
                    $sql = "SELECT email FROM students WHERE studentId=" . $_SESSION["id"];
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    echo $row["email"];
                ?>
            </div>
            <div class="row cards">
                <div class="col-11 col-sm-11 col-md-4 col-lg-4 col-xl-4">
                    <div class=card>
                        Upadte Profile
                        <div class="links"><a href="update.php">Go &rArr;</a></div>
                    </div>
                </div>
                <div class="col-11 col-sm-11 col-md-4 col-lg-4 col-xl-4">
                    <div class=card>
                        Membership
                        <?php 
                            $sql = "SELECT membership FROM students WHERE studentId=" . $_SESSION["id"];
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            if($row["membership"]==0){
                                echo "<div class='links'><a href='membership.php?opt=1'>Buy Membership &rArr;</a></div>";
                            }else{
                                echo "<div class='links'><a href='membership.php?opt=2'>Membership Details &rArr;</a></div>";
                            }
                            $conn->close();
                        ?>
                    </div>
                </div>
                <div class="col-11 col-sm-11 col-md-4 col-lg-4 col-xl-4">
                    <div class=card>
                        Change Password
                        <div class="links"><a href="chngPass.php">Go &rArr;</a></div>
                    </div>
                </div>
            </div>
           </div>
        </div>
        <div>
            <?php include './../footer.php' ?>   
        </div>
	</body>
</html>