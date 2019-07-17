<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "cwcapsule");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $msg = "";
    if(isset($_POST['submit'])){
        $id = $_SESSION["id"];
        $sql = "SELECT pass FROM students WHERE studentId= '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $opass = $_POST["oldpass"];
        $pass = $_POST["newpass"];
        $repass = $_POST["repass"];

        if($row["pass"] == $opass){
            if($pass == $repass){
                $sql = $conn->prepare("UPDATE students SET  pass = ? WHERE studentId = ?");
                $sql->bind_param("ss", $pass, $id);
                $sql->execute();
                $conn->close();
                $msg = "Password Change Successfully";
            }else{
                $msg = "Retype correct password";
            }            
        }else{
            $msg = "Old Password doesnot match";
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
            <form method="post" align="center" class="pass">
                <h3>Change Password</h3>
                <h4 style="color:blue;"><?php echo $msg; ?></h4>
                <div>
                    <input type="password" name="oldpass" class="formInput" placeholder="Current Password">
                </div>
                <div>
                    <input type="password" name="newpass" class="formInput" placeholder="New Password">
                </div>
                <div>
                    <input type="password" name="repass" class="formInput" placeholder="Retype New Password">
                </div>
                <div>
                    <input type="submit" name="submit" class="submitPass" value="Change Password">
                </div>
            </form>        
        </div>
    </body>
</html>