<!-- http://localhost/cwcapsule/teachers/documentUpload.php?id=1 -->
<?php

    $id = $_GET['id'];

    include "./../databaseConn.php";

    $sql = "SELECT documentVerified, documentUpload  FROM teachers where teacherId = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($row["documentVerified"] == TRUE){
            header('Location: http://localhost/cwcapsule/teachers/home.php?id=' . $id);
        }
        if($row["documentUpload"] == TRUE){
            header('Location: http://localhost/cwcapsule/teachers/documentVerificationWait.php?id=' . $id);
        }
    }

    $err1 = "";
    $err2 = "";
    $err3 = "";
    $err4 = "";
    if(isset($_POST['submit'])){
        $target_dir = "documentsUploads/" . $id . "/";
        mkdir("documentsUploads/" . $id . "/");

        $target_file1 = $target_dir . basename($_FILES["id"]["name"]);
        $target_file2 = $target_dir . basename($_FILES["qualification"]["name"]);
        $target_file3 = $target_dir . basename($_FILES["cv"]["name"]);
        $target_file4 = $target_dir . basename($_FILES["pan"]["name"]);

        $uploadOk1 = 1;
        $uploadOk2 = 1;
        $uploadOk3 = 1;
        $uploadOk4 = 1;

        $imageFileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
        $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
        $imageFileType3 = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));
        $imageFileType4 = strtolower(pathinfo($target_file4,PATHINFO_EXTENSION));


        // file1
        if ($_FILES["id"]["size"] > 500000) {
            $err1 .= "Sorry, your file is too large.<br>";
            $uploadOk1 = 0;
        }else{
            if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg" ) {
                $err1 .= "Wrong file format.<br>";
                $uploadOk1 = 0;
            }else{
                if ($uploadOk1 == 0) {
                    $err1 .= "Sorry, your file was not uploaded.<br>";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["id"]["tmp_name"], $target_file1)) {
                        $err1 .= "The file ". basename( $_FILES["id"]["name"]). " has been uploaded.";
                    } else {
                        $err1 .= "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }

        // file2
        if ($_FILES["qualification"]["size"] > 1000000) {
            $err2 .= "Sorry, your file is too large.<br>";
            $uploadOk2 = 0;
        }else{
            if($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" ) {
                $err2 .= "Wrong file format.<br>";
                $uploadOk2 = 0;
            }else{
                if ($uploadOk2 == 0) {
                    $err2 .= "Sorry, your file was not uploaded.<br>";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["qualification"]["tmp_name"], $target_file2)) {
                        $err2 .= "The file ". basename( $_FILES["qualification"]["name"]). " has been uploaded.";
                    } else {
                        $err2 .= "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }

        // file3
        if ($_FILES["cv"]["size"] > 5000000) {
            $err3 .= "Sorry, your file is too large.<br>";
            $uploadOk3 = 0;
        }else{
            if($imageFileType3 != "pdf" && $imageFileType3 != "doc" && $imageFileType3 != "docs" ) {
                $err3 .= "Wrong file format.<br>";
                $uploadOk3 = 0;
            }else{
                if ($uploadOk3 == 0) {
                    $err3 .= "Sorry, your file was not uploaded.<br>";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file3)) {
                        $err3 .= "The file ". basename( $_FILES["cv"]["name"]). " has been uploaded.";
                    } else {
                        $err3 .= "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }

        // file4
        if($_FILES["pan"]["size"] != 0){
            if ($_FILES["pan"]["size"] > 1000000) {
                $err4 .= "Sorry, your file is too large.<br>";
                $uploadOk4 = 0;
            }else{
                if($imageFileType4 != "jpg" && $imageFileType4 != "png" && $imageFileType4 != "jpeg" ) {
                    $err4 .= "Wrong file format.<br>";
                    $uploadOk4 = 0;
                }else{
                    if ($uploadOk4 == 0) {
                        $err4 .= "Sorry, your file was not uploaded.<br>";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["pan"]["tmp_name"], $target_file4)) {
                            $err4 .= "The file ". basename( $_FILES["pan"]["name"]). " has been uploaded.";
                        } else {
                            $err4 .= "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            } 
        }  
        
        //store info in database
        if($uploadOk1 ==1 && $uploadOk2 ==1 &&$uploadOk3 ==1){
            
            include "./../databaseConn.php";

            $panno = $_POST['panno'];
            $idss = basename($_FILES["id"]["name"]);
            $qul = basename($_FILES["qualification"]["name"]);
            $cv = basename($_FILES["cv"]["name"]);
            $pan = basename($_FILES["pan"]["name"]);
            $sql = "UPDATE teachers SET id = '$idss', qualificationCerti = '$qul', cv = '$cv', pan = '$pan', panno = '$panno', documentUpload = '1' WHERE teacherId = '$id'";

            if ($conn->query($sql) === TRUE) {
                header('Location: http://localhost/cwcapsule/teachers/documentVerificationWait.php?id=' . $id);
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
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
        <title>Upload Document</title>

	</head>
	<body class="paper">
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="row">
            <div id="paper" class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 box tabcontent" >
            <h2>Document Upload</h2>                    
                <div class="msg">
                    <p>You hav qualified the eligibility test.</p>
                    <p>This is final step.</p>
                    <p>Upload documents to verify your account.</p>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div>
                        <h3>Photo Id</h3>
                        <div class="custom-file col-12 col-md-6">
                            <input type="file" class="custom-file-input" id="inputID" name="id">
                            <label class="custom-file-label" for="inputID">Choose file</label>
                        </div>(*.jpg, *.jpeg, *.png)<span style="color:red">*required</span>
                        <div style="color:blue"><?php echo $err1;?></div>
                    </div>
                    <div>
                        <h3>Qualification Certificate</h3>
                        <div class="custom-file col-12 col-md-6">
                            <input type="file" class="custom-file-input" id="inputG" name="qualification">
                            <label class="custom-file-label" for="inputG">Choose file</label>
                        </div>
                        (*.jpg, *.jpeg, *.png)<span style="color:red">*required</span>
                        <div style="color:blue"><?php echo $err2;?></div>
                    </div>
                    <div>
                        <h3>Resume or CV</h3>
                        <div class="custom-file col-12 col-md-6">
                            <input type="file" class="custom-file-input" id="inputCV" name="cv">
                            <label class="custom-file-label" for="inputCV">Choose file</label>
                        </div>                        
                        (*.pdf, *.doc, *.docs)<span style="color:red">*required</span>
                        <div style="color:blue"><?php echo $err3;?></div>
                    </div>
                    <div>
                        <h3>PAN Card</h3>
                        <input type="text" name="panno" placeholder="PAN Number" class="panno"><br>
                        <div class="custom-file col-12 col-md-6">
                            <input type="file" class="custom-file-input" id="inputPAN" name="pan">
                            <label class="custom-file-label" for="inputPAN">Choose file</label>
                        </div>
                        (*.jpg, *.jpeg, *.png)
                        <p>For Indian tutor if pan is provided then tax wil b 10% otherwise tax will be 20%.</p>
                        <div style="color:blue"><?php echo $err4;?></div>
                    </div>
                    <div class="btns">
                        <input class="btn" type="submit" name="submit" value="submit">
                    </div>
                </form>

            <script>
                $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script>
            </div>
        </div>
        
        <div>
            <?php include './../footer.php' ?>   
        </div>
	</body>
</html>