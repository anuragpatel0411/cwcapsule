<?php
    $msg = "";
    $err = "";
    session_start();
    
    include "databaseConn.php";
    include "configurl.php";

    if(isset($_POST['submitStudent'])){
        $email	= $_POST['email'];
        $pass = $_POST['pass'];
            $sql = "SELECT * FROM students WHERE email = '$email' AND pass= '$pass'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION["username"] = $row["studentName"];
                $_SESSION["id"] = $row["studentId"];
                $_SESSION["role"] = "students";
                $_SESSION["questionId"] = "0";
                header('Location: ' . $url . 'students/home.php');
            } else {
                $msg = "Wrong email or password...";
            }
            $conn->close();        
    }
    if(isset($_POST['submitTeacher'])){
        $mail = $_POST['email'];
        $pass	= $_POST['pass'];
        $sql = "SELECT * FROM teachers WHERE email = '$mail' AND pass= '$pass'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["username"] = $row["teacherName"];
            $_SESSION["id"] = $row["teacherId"];
            $_SESSION["role"] = "teachers";
            $_SESSION["questionId"] = "0";
            header('Location: ' . $url . 'teachers/home.php');
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
		
        <link rel="stylesheet" href="./styles/styles.css">
        <link rel="stylesheet" href="./styles/registerlogin.css">
        <title>Login</title>
	</head>
	<body class="regdbox">
		<div>
            <?php include 'header.php' ?>   
        </div>
        <div class="row">
            <div class="col-12">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 head">
                    <div class="tab row">
                        <button class="tablinks active" onclick="change(event, 'student')">Login Student</button>
                        <button class="tablinks" onclick="change(event, 'teacher')">Login Teacher</button>
                    </div> 
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 box">
                <div style="color:red; text-align:center;"><?php echo $msg;?></div>   
                
                <div id="student" style="display:block;" class="tabcontent">            
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
                    <div style="font-size:12px;color:blue;text-align:center"><a href="register.php">Don't have account? Register</a></div>           
                </div>

                <div id="teacher" style="display:none;" class="tabcontent">            
                    <form method="post" class="row">
                        <span class="col-12">
                            <input type="email" class="formInput" placeholder="Email" name="email">
                        </span>
                        <span class="col-12">
                            <input type="password" class="formInput" placeholder="Password" name="pass">
                        </span>
                        <span class="col-12">
                            <input type="submit" class="submitButton" value="Login" name="submitTeacher">
                        </span>

                    </form>     
                    <div style="font-size:12px;color:blue;text-align:center"><a href="register.php">Don't have account? Register</a></div>           
                </div>

            </div>
        </div>

        <script>
            function change(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>

	</body>
</html>