<?php
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
        $rytAns = $_POST["rytAns"];
        $r1 = $r2 = $r3 = $r4 = FALSE;
        if($rytAns == "a"){
            $r1 = TRUE;
        }
        elseif($rytAns == "b"){
            $r2 = TRUE;
        }
        elseif($rytAns == "c"){
            $r3 = TRUE;
        }
        elseif($rytAns == "d"){
            $r4 = TRUE; 
        }
        if($ques != NULL && $opt1 != NULL && $opt2 != NULL && $opt3 != NULL && $opt4 != NULL && $rytAns != NULL){
            $sql = "INSERT INTO teachertestquestions (subjectId,question) VALUES ('$subjectId','$ques')" ;
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                $sql2 = "INSERT INTO teachertestquestionchoices(quesid,is_right,choice) VALUES ('$last_id','$r1','$opt1')";
                $sql3 = "INSERT INTO teachertestquestionchoices(quesid,is_right,choice) VALUES ('$last_id','$r2','$opt2')";
                $sql4 = "INSERT INTO teachertestquestionchoices(quesid,is_right,choice) VALUES ('$last_id','$r3','$opt3')";
                $sql5 = "INSERT INTO teachertestquestionchoices(quesid,is_right,choice) VALUES ('$last_id','$r4','$opt4')";
                $conn->query($sql2);
                $conn->query($sql3);
                $conn->query($sql4);
                $conn->query($sql5);
                header("Location: http://localhost/cwcapsule/admin/addTestQues.php?sid=" . $subjectId);
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
        <link rel="stylesheet" href="./styles/style.css">
        <title>Add Teachers' Test Question</title> 
    </head>
    <body>
        <div>
            <?php include 'header.php';?>
        </div>
        <div class="container box container">
            <div class="row">            
                <form method="post" >
                    <div class="col-12">
                        <h1>
                            Add Test Questions For Teachers
                        </h1>
                    </div>
                    <div class="col-12">
                        <div style="color:red;text-align:center;"><?php echo $err; ?></div>
                        <div class="col-12">
                            <textarea name="ques" placeholder="Type the question here...." class="qutext"></textarea>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                            A.<input type="text" name="opt1" placeholder="Type Option 1" class="formInput">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                            B.<input type="text" name="opt2" placeholder="Type Option 1" class="formInput">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                            C.<input type="text" name="opt3" placeholder="Type Option 1" class="formInput">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                            D.<input type="text" name="opt4" placeholder="Type Option 1" class="formInput">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                            Right Answer:
                            <select name=rytAns class='formInput'>
                                <option name='a'>A</option>
                                <option name='b'>B</option>
                                <option name='c'>C</option>
                                <option name='d'>D</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                            <input type="submit" name="submitQues" value="Add Question" class="textQues">
                        </div>
                    </div>
                </form>
                <div><a href="http://localhost/cwcapsule/admin/subjects.php"><<<span>Go Back</span></a></div>
            </div>
        </div>
    </body>
</html>