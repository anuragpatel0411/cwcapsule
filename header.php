<?php 
        session_start();
        $_SESSIION["username"]="a";
?>
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
<<<<<<< HEAD
                <li><a href="index.html">Home</a></li>
=======
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
>>>>>>> 354f7ded89de813f52d82b205c2105e17a7da980
                <li><a href="#">Student</a></li>
                <li><a href="#">Teacher</a></li>
                <?php
                    if(!$_SESSIION["username"]){
                        echo"<li><a href='login.php'>Login</a></li>";
                        echo"<li><a href='register.php'>Sign-up</a></li>";}
                    else{
                        //login header
                        if($_SESSION["role"]=='teacher'){
                                echo"<li><a href='index.php'>Logout</a></li>";
                            }
                            if($_SESSION["role"]=='student'){
                                echo"<li><a href='index.php'>Logout</a></li>";
                            }
                    }
                ?>
                <li><a href="#">About Us</a></li>
                <li><a href="contacts.html">Contact Us</a></li>
<<<<<<< HEAD
=======

                <li><a href="login.php">Login</a></li>
                <li><a href="http://localhost/cwcapsule/register.php">Sign-up</a></li>

>>>>>>> 354f7ded89de813f52d82b205c2105e17a7da980
                </ul>
            </div>
        </div>
    </nav>
</header>
    
        <!-- 
        <?php 
        session_start();
        if(!$_SESSIION["username"]){
                //header before login at homepage

        }
        else{
            //login header
            if($_SESSION["role"]=='teacher'){
                    //teacher header
                }
                if($_SESSION["role"]=='teacher'){
                    //student header
                }
        }
        ?> -->