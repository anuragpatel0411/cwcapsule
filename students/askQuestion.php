<?php
    session_start();
    $msg = "";
    $err= "";
    
    include "./../databaseConn.php";
    include "./../configurl.php";

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
            //store in database
            $status = "Waiting";
            $sql = $conn->prepare("INSERT INTO questionanswer(subjectId, studentId, question, quesAttachment, quesAttachmentFile, status) VALUES(?, ?, ?, ?, ?, ?)");
            $sql->bind_param("iissss", $subjectId, $studentId, $question, $attachment, $attachementName, $status);
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
            header("Location: " . $url . "students/responseOK.php");     
        }   
    }
?>
<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./../styles/registerlogin.css">
        <title>Question</title>
	</head>
	<body>
		<div>
            <?php include './../header.php' ?>   
        </div>
        <h2 class='quhead'> ASK A QUESTION?</h2>
        <div class="container box">
            <div class="answer">
                <form method="post" enctype="multipart/form-data">
                    <div class="subjectSelect">
                        Select Subject: 
                        <?php
                            
                            include "./../databaseConn.php";

                            $sql = "SELECT * FROM subjects";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo "<select name='subs' class='formInput'>";
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["subjectId"] . "'>" . $row["subjectName"] . "</option>";
                                }
                                echo "</select>";
                            } else {
                                echo "0 results";
                            }
                        ?>
                    </div>
                    <textarea name="question" placeholder="Type your question here..." class="textQues"></textarea>
                    <div>
                        <div class="custom-file col-12 col-md-6">
                            <input type="file" class="custom-file-input" id="attach" name="attach">
                            <label class="custom-file-label" for="attach">Choose file</label>
                        </div> (*.jpg, *.jpeg, *.png, *.docs, *.pdf)
                        <div style="color:blue"><?php echo $err;?></div>
                    </div>
                    <input type="submit" name="submitQues" value="Add Question" class="submitQues">
                </form>
            </div>
        </div>       

		<?php include './../footer.php' ?>

        <script>
            $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>
	</body>
</html>