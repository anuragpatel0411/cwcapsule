<?php
    session_start();
    $conn = new mysqli("localhost", "root","","cwcapsule");
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }
    $err = "";
    $subjectId = $_GET["sid"];
    if(isset($_POST["submitQues"])){
        $ques = $_POST["ques"];
        $opt1 = $_POST["opt1"];
        $opt2 = $_POST["opt2"];
        $opt3 = $_POST["opt3"];
        $opt4 = $_POST["opt4"];
        $rtyAns = $_POST["rytAns"];
        if($rytAns == "a"){
            $r1 = TRUE;
            $r2 = FALSE;
            $r3 = FALSE;
            $r4 = FALSE;
        }
        elseif($rytAns == "b"){
            $r1 = FALSE;
            $r2 = TRUE;
            $r3 = FALSE;
            $r4 = FALSE;
        }
        elseif($rytAns == "c"){
            $r1 = FALSE;
            $r2 = FALSE;
            $r3 = TRUE;
            $r4 = FALSE;
        }
        elseif($rytAns == "d"){
            $r1 = FALSE;
            $r2 = FALSE;
            $r3 = FALSE;
            $r4 = TRUE; 
        }
        if($ques! = NULL  && opt1! = NULL && opt2! = NULL && opt3! = NULL && opt4! = NULL && rtyAns! = NULL){
            $sql = "INSERT INTO teachertestquestions (subjectId,question) VALUES ('$subjectId','$ques')" ;
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                $sql2 = "INSERT INTO teachertestquestionchoices(quesid,is_right,choice) VALUES ($last_id,$r1,$opt1)";
                $sql3 = "INSERT INTO teachertestquestionchoices(quesid,is_right,choice) VALUES ($last_id,$r2,$opt2)";
                $sql4 = "INSERT INTO teachertestquestionchoices(quesid,is_right,choice) VALUES ($last_id,$r3,$opt3)";
                $sql5 = "INSERT INTO teachertestquestionchoices(quesid,is_right,choice) VALUES ($last_id,$r4,$opt4)";
                $conn->query($sql2);
                $conn->query($sql3);
                $conn->query($sql4);
                $conn->query($sql5);
                header("Location: http://localhost/cwcapsule/admin/responseOk.php");
            } 
            else {
                $err = "Error in uploading data";
            }
        }
        else{
            $err = "All fields are required";
        }
    }
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
                   
                ?>                
                <form method="post">
                    <div class="row">
                        <div style="color:red;text-align:center;"><?php echo $err; ?></div>
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
                            <input type="submit" name="submitQues" value="Add Question" class="textQues">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>