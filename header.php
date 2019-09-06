<?php 
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    if(!isset($_SESSION))
        session_start();
    if(isset($_POST['logout'])){
        session_unset(); 
        session_destroy(); 
        header('Location: /cwcapsule/index.php');
    }

    include "configurl.php";
?>
        <link rel="stylesheet" href="./../styles/style.css">
        <link rel="stylesheet" href="./styles/style.css">

<header class="defaultHeader">
    <nav class="navbar navbar-expand-lg  navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <!-- <img src="img/logo.png" alt="cwcapsule" /> -->
                <span style="color:#fff;font-size:20px;font-weight:700">CW Capsule</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-menu"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                <li><a href="<?php echo $url;?>index.php">Home</a></li>
                <?php
                    if(!$_SESSION){
                        echo "<li><a href='#std'>Student</a></li>";
                        echo "<li><a href='#tech'>Teacher</a></li>";
                    }
                ?>
                <?php
                    if($_SESSION){
                        if($_SESSION["role"]=='teachers'){
                                echo"<li><a href = '" .$url . "teachers/answerQuestion.php'>Answer Questions</a></li>";
                                echo"<li><a href = '" .$url . "teachers/yourAnswers.php'>Your Answers</a></li>";
                            }
                        if($_SESSION["role"]=='students'){
                            echo"<li><a href = '" .$url . "students/askQuestion.php'>Ask Question</a></li>";
                            echo"<li><a href = '" .$url . "students/yourQuestion.php'>Your Questions</a></li>";
                            }
                    }
                ?>
                <li><a href="<?php echo $url;?>index.php#about">About Us</a></li>
                <li><a href="<?php echo $url;?>index.php#contact">Contact Us</a></li>
                <?php
                    if($_SESSION){
                        echo "<li><a href ='" .$url . $_SESSION["role"] . "/home.php'>Profile</a></li>";
                        echo "<form method='post'>
                                    <li><input type='submit' class='logout' name='logout' value='LOGOUT'><li>
                                </form> ";
                    }else{
                        echo"<li><a href = '" .$url . "login.php'>Login</a></li>";
                        echo"<li><a href = '" .$url . "register.php'>Signup</a></li>";
                    }
                ?>
                </ul>
            </div>
        </div>
    </nav>
</header>