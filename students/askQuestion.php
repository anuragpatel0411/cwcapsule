<?php
    session_start();
    $msg = "";
    $err= "";
    $conn = new mysqli("localhost", "root", "", "cwcapsule");    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    if(isset($_POST['submitQues'])){
        $subjectId	= $_POST['subs'];
        $ques = $_POST['question'];
        $studentId = $_SESSION["id"];

        $sql = "SELECT subjectName FROM subjects WHERE subjectId = '$subjectId'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $sub= $row["subjectName"];
        $attachment = FALSE;
        $attachmentName = "";
        $question = substr($ques,0,100);

        $target_dir = "./../questionanswer/" . $sub . "/attachments/";
        $name = basename($_FILES["attach"]["name"]);
        if($name){
            $attachmentName = basename($_FILES["attach"]["name"]);
            $target_file = $target_dir . basename($_FILES["attach"]["name"]);
            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            if ($_FILES["attach"]["size"] > 500000) {
                $err .= "Sorry, your file is too large.<br>";
                $uploadOk = 0;
            }else{
                if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "pdf" && $fileType != "doc" && $fileType != "docs" && $fileType != "ppt" ) {
                    $err .= "Wrong file format.<br>";
                    $uploadOk = 0;
                }else{
                    if ($uploadOk == 0) {
                        $err .= "Sorry, your file was not uploaded.<br>";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["attach"]["tmp_name"], $target_file)) {
                            $err .= "The file ". basename( $_FILES["attach"]["name"]). " has been uploaded.";
                            $attachment = TRUE;
                            $attachementName = $name;
                        } else {
                            $err .= "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            }
        }

        //store in database
        $sql = $conn->prepare("INSERT INTO questionanswer(subjectId, studentId, question, quesAttachment, quesAttachmentFile) VALUES(?, ?, ?, ?, ?)");
        $sql->bind_param("iisss", $subjectId, $studentId, $question, $attachment, $attachementName);
        $sql->execute();

        //get id of saved question
        $sql = "SELECT questionId FROM questionanswer WHERE question = '$question'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $id= $row["questionId"];
        }
        $conn->close();

        $myfile = fopen(".\\..\\questionanswer\\".$sub . "\\questions\\" . $id . ".html", "w") or die("Unable to open file!");
        $txt = "<pre>" . $ques . "</pre>";

        fwrite($myfile, $txt);
        fclose($myfile);      
        // header("Location: http://localhost/cwcapsule/students/responseOK.php");        
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
            <h2> Ask the questions form our experts in your required field...</h2>
            <div class="answer">
                <h4>Question:</h4>
                <form method="post" enctype="multipart/form-data">
                    <div class="subjectSelect">
                        Select Subject: 
                        <?php
                            $conn = new mysqli("localhost", "root", "", "cwcapsule");    
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            $sql = "SELECT * FROM subjects";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo "<select name='subs'>";
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["subjectId"] . "'>" . $row["subjectName"] . "</option>";
                                }
                                echo "</select>";
                            } else {
                                echo "0 results";
                            }
                        ?>
                    </div>
                    <textarea name="question" placeholder="Type your question here" class="textQues"></textarea>
                    <div>
                        <input type="file" id="attach" name="attach">
                    </div>
                    <input type="submit" name="submitQues" value="Add Question">
                </form>
            </div>
        </div>
	</body>
</html>