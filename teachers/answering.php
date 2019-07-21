<?php
    session_start();
    $questionId = $_GET["qid"];
    $teacherId = $_SESSION["id"];
    $sub = $_GET["sName"];
    $question = "./../questionanswer/" . $sub . "/questions/" . $questionId . ".html";
    $conn = new mysqli("localhost", "root", "", "cwcapsule");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT * FROM questionanswer WHERE questionId = '$questionId'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $err="";
    if(isset($_POST['submitAns'])){
        $ans = $_POST['answer'];

        $attachment = FALSE;
        $attachmentName = "";
        $uploadOk = 1;

        $target_dir = "./../questionanswer/" . $sub . "/attachments/";
        $name = basename($_FILES["attach"]["name"]);
        if($name){
            $attachmentName = basename($_FILES["attach"]["name"]);
            $target_file = $target_dir . basename($_FILES["attach"]["name"]);
            $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            if ($_FILES["attach"]["size"] > 4000000) {
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
        if($uploadOk == 1){
            $date=date("Y/m/d");
            //store in database
            $sql = $conn->prepare("UPDATE questionanswer SET answerId=?, dateOfAnswer=?, teacherId=?, answering='0', answerAttachment=?, answerAttachmentFile=? WHERE questionId=?");
            $sql->bind_param("issssi", $questionId, $date, $teacherId, $attachment, $attachementName, $questionId);
            $sql->execute();

            
            $conn->close();

            $myfile = fopen(".\\..\\questionanswer\\".$sub . "\\answers\\" . $questionId . ".html", "w") or die("Unable to open file!");
            $txt = "<pre>" . $ans . "</pre>";

            fwrite($myfile, $txt);
            fclose($myfile);      
            header("Location: http://localhost/cwcapsule/students/responseOK.php"); 
        }
    }
?>
    
<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./../styles/registerlogin.css">
        <title>Your Question</title>
	</head>
	<body>
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="container box">
            <div class="question">
                <h5><u>Question:</u></h5>
                <?php 
                    include $question;
                    if($row["quesAttachment"] == '1'){
                        echo "<h6>Attachments:</h6>";                    
                        echo "<a href = './../questionanswer/" . $sub ."/attachments/" . $row['quesAttachmentFile'] ."' target='_blank'>" . $row['quesAttachmentFile'] . "</a>";
                    }
                ?>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="answer">
                    <h4>Answer:</h4>
                    <textarea name="answer" placeholder="Type your answer here..." class="anstext"></textarea>
                    <div>
                        <div class="custom-file col-12 col-md-6">
                            <input type="file" class="custom-file-input" id="attach" name="attach">
                            <label class="custom-file-label" for="attach">Choose file</label>
                        </div> (*.jpg, *.jpeg, *.png, *.docs, *.pdf)
                        <div style="color:blue"><?php echo $err;?></div>
                    </div>
                    <input type="submit" name="submitAns" value="Add Answer" class="submitAns">
                </div>
            </form> 
        </div>
        
        <div>
            <?php include './../footer.php' ?>   
        </div>
	</body>
</html>