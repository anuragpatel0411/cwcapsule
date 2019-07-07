<!-- http://localhost/cwcapsule/teachers/teachertest.php?id=1 -->
<?php
    $msg = "";
    $ans = array();
    $id = $_GET["id"];
    $conn = new mysqli("localhost", "root", "", "cwcapsule");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT testPass, subject FROM teachers where teacherId = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sub = $row['subject'];
        if($row["testPass"] == TRUE){
            header('Location: http://localhost/cwcapsule/teachers/documentUpload.php?id='.$id);
        }
        $sql = "SELECT subjectId FROM subjects where subjectName = '$sub'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $subid = $row['subjectId'];
    } else {
        echo "0 results";
    }

    if(isset($_POST['submit'])){
        $sql = "SELECT quesid FROM teachertestquestions where subjectId = '$subid'";
        $score = 0;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $qid = $row["quesid"];
                $userans = $_POST[$qid];
                $sql2 = "SELECT * FROM teachertestquestionchoices where quesid = '$qid'";
                $result2 = $conn->query($sql2);
                while($row2 = $result2->fetch_assoc()) {
                    if($row2["is_right"] == 1){
                        if($row2["choiceid"] == $userans){
                            $score++;
                        }
                    }                            
                }
            }
        }
        if($score >=7){
            $sql = "UPDATE teachers SET testPass = 1 WHERE teacherId = '$id'";
            if ($conn->query($sql) === TRUE) {
                header('Location: http://localhost/cwcapsule/teachers/documentUpload.php?id='.$id);
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }else{
            $msg = "You failed to qualify the eligibility test. Please give retest....";
        }
    }
?>

<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
	</head>
	<body class="paper">
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 box tabcontent">
                <p style="color:red"><?php echo $msg;?></p>
                <h2>Eligiblity Test</h2>
                <p>To Actvae your teacher's profile you have to pass the test.</p>
                <p>Qualify the test with 70% correct answer to activate your profile.</p>
                <div class='btns'><input class="btn" type='button' value='Start Test' onclick="change(event, 'paper')"></div>
            </div>
            <div id="paper" class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 box tabcontent" style="display:none">
                <h2>Test</h2>
                <form method="post">
                    <?php
                        $sql = "SELECT * FROM teachertestquestions where subjectId = '$subid'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<ol type='1'>";
                            while($row = $result->fetch_assoc()) {
                                $qid = $row['quesid'];
                                echo "<li class='ques'> " . $row["question"];
                                $sql2 = "SELECT * FROM teachertestquestionchoices where quesid = '$qid'";
                                $result2 = $conn->query($sql2);
                                echo "<ol type='a'>";
                                $name ="";
                                while($row2 = $result2->fetch_assoc()) {
                                    $name = $row2["quesid"];
                                    echo "<li><input type='radio' name='" . $row2["quesid"] . "' value='" . $row2["choiceid"] . "'>" . $row2["choice"] . "</li>";                            
                                }
                                echo "<li style='display:none'><input type='radio' name='" . $name . "' value='default' checked>" . "</li>";
                                echo "</ol></li>";
                            }
                            echo "</ol>";
                        } else {
                            echo $subid."0 results";
                        }
                    ?>
                    <div class="btns">
                        <input type="submit" name="submit" value="submit" class="btn">
                    </div>
                </form>
            </div>
        </div>

        <script>
            function change(evt, events) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(events).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>

	</body>
</html>