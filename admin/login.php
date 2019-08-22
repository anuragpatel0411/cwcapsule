<?php
    $msg = "";
    $err = "";
    session_start();
    
    include "./../databaseConn.php";

    if(isset($_POST['submitStudent'])){
        $email	= $_POST['email'];
        $pass = $_POST['pass'];
            $sql = "SELECT * FROM admin WHERE email = '$email' AND pass= '$pass'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION["username"] = $row["adminName"];
                $_SESSION["id"] = $row["adminID"];
                $_SESSION["role"] = "admin";
                header('Location: http://localhost/cwcapsule/admin/home.php');
            } else {
                $msg = "Wrong email or password...";
            }
            $conn->close();        
    }

?>


<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./styles/bootstrap.css">
		
        <link rel="stylesheet" href="./styles/login.css">
        <title>Admin Login</title>
	</head>
	<body class="regdbox">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 box">
                <h2>Admin Login</h2>
                <div style="color:red; text-align:center;"><?php echo $msg;?></div>   
                
                <div class="tabcontent">            
                    <form method="post" class="row">
                        <span class="col-12">
                            <input type="email" class="formInput" placeholder="Email" name="email">
                        </span>
                        <span class="col-12">
                            <input type="password" class="formInput" placeholder="Password" name="pass">
                        </span>
                        <span class="col-12">
                            <input type="submit" class="submitButton" value="Login" name="submitStudent">
                        </span>

                    </form>
                </div>
            </div>
        </div>
	</body>
</html>