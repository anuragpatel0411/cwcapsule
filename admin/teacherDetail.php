<?php
    $msg ="";
    if(isset($_POST['verify'])){
            
            include "./../databaseConn.php";
 
            $id = $_POST["id"];
            $sql = "UPDATE teachers SET documentVerified = TRUE WHERE teacherId='$id'";
            $result = $conn->query($sql);
            if ($conn->query($sql) === TRUE) {
                $msg= "Documents Verified";
            } else {
                $msg = "Not Verified Error...";
            }
            $conn->close();        
        }
        if(isset($_POST['adds'])){
            
            include "./../databaseConn.php";
    
            $id = $_POST["id"];
            $sub = $_POST["subject"];
            $sql = "UPDATE teachers SET subject = '$sub' WHERE teacherId='$id'";
            $result = $conn->query($sql);
            if ($conn->query($sql) === TRUE) {
                $msg= "Subject Updated";
            } else {
                $msg = "Not Verified Error...";
            }
            $conn->close();        
        }
?>
<html>
    <head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./styles/bootstrap.css">
		
        <link rel="stylesheet" href="./styles/style.css">

        <title>teachers</title>
    </head>
    <body>
        <div>
            <?php include 'header.php';?>
            <div class="container box">
                <div>
                    <h2><?php echo $_GET['name']; ?></h2>
                    <?php                                                     
                        
                        include "./../databaseConn.php";
 
                        $id= $_GET['id'];
                        $sql = "SELECT * FROM teachers WHERE teacherId= '$id'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                if($row["documentVerified"] == '1'){
                                    echo "<h5 style='color:blue'>Verified Account</h5>";
                                }
                                echo "<table>";
                                echo "<tr><th>Teacher ID:</th><td>" . $row["teacherId"] ."</td></tr>";
                                echo "<tr><th>Email:</th><td>" . $row["email"] ."</td></tr>";
                                echo "<tr><th>Mobile:</th><td>" . $row["mobile"] ."</td></tr>";
                                echo "<tr><th>Date of Birth:</th><td>" . $row["birthDate"] ."</td></tr>";
                                echo "<tr><th>Qualification:</th><td>" . $row["qualification"] ."</td></tr>";
                                echo "<tr><th>Subjects:</th><td>" . $row["subject"] ."</td></tr>";
                                echo "<tr><th>Registration Date:</th><td>" . $row["registrationDate"] ."</td></tr>";
                                echo "</table>";
                                echo "<br><br>";
                                if( $row["mailVerified"] == '1' && $row["testPass"] == '1' && $row["documentUpload"] == '1' &&   $row["documentVerified"] == '1'){
                                    echo "<table>";
                                    echo "<tr><th>ID:</th><td><a href='http://localhost/cwcapsule/teachers/documentsUploads/" . $row["teacherId"] . "/" . $row["id"] . "'>" . $row["id"] ."</a></td></tr>";
                                    echo "<tr><th>Qualification Certificate:</th><td><a href='http://localhost/cwcapsule/teachers/documentsUploads/" . $row["teacherId"] . "/" . $row["qualificationCerti"] . "'>" . $row["qualificationCerti"] ."</a></td></tr>";
                                    echo "<tr><th>Mobile:</th><td><a href='http://localhost/cwcapsule/teachers/documentsUploads/" . $row["teacherId"] . "/" . $row["cv"] . "'>" . $row["cv"] ."</a></td></tr>";
                                    if($row["pan"] != NULL){
                                        echo "<tr><th>PAN:</th><td><a href='http://localhost/cwcapsule/teachers/documentsUploads/" . $row["teacherId"] . "/" . $row["pan"] . "'>" . $row["pan"] ."</a></td></tr>";
                                        echo "<tr><th>PAN No.:</th><td>" . $row["panno"] ."</td></tr>";
                                    }
                                    echo "</table>";
                                }else{
                                    echo "<table>";
                                    echo "<tr><th>Mail Verified:</th><td>" . $row["mailVerified"] ."</td></tr>";
                                    echo "<tr><th>Test Passed:</th><td>" . $row["testPass"] ."</td></tr>";
                                    echo "<tr><th>Document Uploaded:</th><td>" . $row["documentUpload"] ."</td></tr>";
                                    if($row["documentUpload"] == '1'){
                                        echo "<table>";
                                        echo "<tr><th>ID:</th><td><a href='http://localhost/cwcapsule/teachers/documentsUploads/" . $row["teacherId"] . "/" . $row["id"] . "'>" . $row["id"] ."</a></td></tr>";
                                        echo "<tr><th>Qualification Certificate:</th><td><a href='http://localhost/cwcapsule/teachers/documentsUploads/" . $row["teacherId"] . "/" . $row["qualificationCerti"] . "'>" . $row["qualificationCerti"] ."</a></td></tr>";
                                        // echo "<tr><th>Mobile:</th><td><a href='http://localhost/cwcapsule/teachers/documentsUploads/" . $row["teacherId"] . "/" . $row["cv"] . "'>" . $row["cv"] ."</a></td></tr>";
                                        if($row["pan"] != NULL){
                                            echo "<tr><th>PAN:</th><td><a href='http://localhost/cwcapsule/teachers/documentsUploads/" . $row["teacherId"] . "/" . $row["pan"] . "'>" . $row["pan"] ."</a></td></tr>";
                                            echo "<tr><th>PAN No.:</th><td>" . $row["panno"] ."</td></tr>";
                                        }
                                        echo "</table>";
                                            if($row["subject"]=="Others"){
                                                echo "<form method='post'>";
                                                echo "<select name='subject' class='formInput'>
                                                    <option>----Select Subjects----</option>";                                                    
                                                    
                                                        include "./../databaseConn.php";
                                                        
                                                        $sql2 = "SELECT subjectName FROM subjects";
                                                        $result2 = $conn->query($sql2);
                                                        
                                                        if ($result2->num_rows > 0) {
                                                            while($row2 = $result2->fetch_assoc()) {
                                                                echo "<option>" . $row2["subjectName"] . "</option>";
                                                            }
                                                        } else {
                                                            echo "0 results";
                                                        }
                                                        $conn->close();
                                                
                                                    echo "</select>";
                                                    echo "<input type='text' value=" . $row["teacherId"] . " name='id' style='display:none'>";
                                                echo "<input type='submit' class='verify' name='adds' value='Add Subject'> <br>";
                                                echo "</form>";
                                            }
                                                
                                        echo "<form method='post'>
                                                    <input type='text' value=" . $row["teacherId"] . " name='id' style='display:none'> 
                                                    <input type='submit' class='verify' name='verify' value='Verify Documents'>
                                                </form>";
                                    }
                                    echo "</table>";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>