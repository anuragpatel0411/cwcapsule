<?php
    session_start();
    if(!$_SESSION["username"]){
        header('Location: /cwcapsule/admin/login.php');
    }
    if(isset($_POST['submit']) ||  $_SESSION["role"]!="admin"){
        session_unset(); 
        session_destroy(); 
        header('Location: /cwcapsule/admin/login.php');
    }    
    function active($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);  
    if($currect_page == $url){
        echo 'active'; //class name in css 
    }elseif($currect_page == "subjects.php" && $url == "addSubject.php"){
        echo 'active';
    }
    }

?>
<div>
    <form method="post">
        <ul>
            <li><a class="<?php active('home.php');?>" href="home.php">Home</a></li>
            <li><a class="<?php active('teachers.php');?>" href="teachers.php">Teachers</a></li>
            <li><a class="<?php active('students.php');?>" href="students.php">Students</a></li>
            <li><a class="<?php active('subjects.php');?>" href="subjects.php">Subjects</a></li>
            <li><a class="<?php active('questions.php');?>" href="questions.php">Questions</a></li>
            <li>
                    <input type="submit" class="logout" name="submit" value="Logout">
            </li>
        </ul>
    </form>
</div>