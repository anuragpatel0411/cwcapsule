<?php 
    session_start();
    if(isset($_POST['logout'])){
        session_unset(); 
        session_destroy(); 
        header('Location: /cwcapsule/index.php');
    }
?>
        <link rel="stylesheet" href="./../styles/style.css">
        <link rel="stylesheet" href="./styles/style.css">

<header class="defaultHeader">
    <nav class="navbar navbar-expand-lg  navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="img/logo.png" alt="cwcapsule" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-menu"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                <li><a href="index.php">Home</a></li>
                <?php
                    if(!$_SESSION){
                        echo "<li><a href=''>Student</a></li>";
                        echo "<li><a href=''>Teacher</a></li>";
                    }
                ?>
                <?php
                    if($_SESSION){
                        if($_SESSION["role"]=='teacher'){
                                echo"<li><a href = ''>Answer Questions</a></li>";
                                echo"<li><a href = ''>Your Answers</a></li>";
                            }
                        if($_SESSION["role"]=='student'){
                            echo"<li><a href = ''>Ask Question</a></li>";
                            echo"<li><a href = ''>Your Questions</a></li>";
                            }
                    }
                ?>
                <li><a href="#">About Us</a></li>
                <li><a href="contacts.html">Contact Us</a></li>
                <?php
                    if($_SESSION){
                        echo "<li>
                                <form method='post'>
                                    <input type='submit' class='logout' name='logout' value='Logout'>
                                </form>
                             </li>";
                    }else{
                        echo"<li><a href = 'login.php'>Login</a></li>";
                        echo"<li><a href = 'register.php'>Signup</a></li>";
                    }
                ?>
                </ul>
            </div>
        </div>
    </nav>
</header>