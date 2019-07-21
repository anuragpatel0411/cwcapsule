<?php
    session_start();
    $conn = new mysqli("localhost", "root","","cwcapsule");
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }
    if(isset($_POST['submitAns'])){}
?>
<html>
    <head>
       <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./styles/bootstrap.css">
		
        <link rel="stylesheet" href="./styles/login.css">
        <title>Add Teachers' Test Question</title> 
    </head>
    <body>
        <div class="container main">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 box">
                    <h1>
                        Add Test Questions For Teachers
                    </h1>
                </div>
                <?php
                    $opt1Err="";
                    $opt1="";
                    $opt2Err="";
                    $opt2="";
                    $opt3Err="";
                    $opt3="";
                    $opt4Err="";
                    $opt4="";
                    if($_SERVER["REQUEST_METHOD"]=="POST"){
                        if(empty($_POST["opt1"])){
                            $opt1Err = "Option 1 is mandatory";
                        }
                        else{
                            $opt1 = test_input($_POST["opt1"]);
                        }
                        if(empty($_POST["opt2"])){
                            $opt2Err = "Option 2 is mandatory";
                        }
                        else{
                            $opt2 = test_input($_POST["opt2"]);
                        }
                        if(empty($_POST["opt3"])){
                            $opt3Err = "Option 3 is mandatory";
                        }
                        else{
                            $opt3 = test_input($_POST["opt3"]);
                        }
                        if(empty($_POST["opt4"])){
                            $opt1Err = "Option 4 is mandatory";
                        }
                        else{
                            $opt1 = test_input($_POST["opt4"]);
                        }
                    }
                    function test_input($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                ?>                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                        <div class="col-12">
                            <textarea name="ques" placeholder="Type the question here...." class=""></textarea>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 box">
                            <input type="text" name="opt1" placeholder="Type Option 1" class="formInput">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 box">
                            <input type="text" name="opt2" placeholder="Type Option 1" class="formInput">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 box">
                            <input type="text" name="opt3" placeholder="Type Option 1" class="formInput">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 box">
                            <input type="text" name="opt4" placeholder="Type Option 1" class="formInput">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 box">
                            <input type="text" name="rytAns" placeholder="Type the right option" class="formInput">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 box">
                            <input type="submit" name="submitAns" value="Add Question" class="textQues">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>