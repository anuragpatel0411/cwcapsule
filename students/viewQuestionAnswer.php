<?php
    $studentId = $_GET["id"];
    $questionId = $_GET["qid"];
    $sub = $_GET["sub"];
    $question = "./../questionanswer/" . $sub . "/questions/" . $questionId . ".html";
    $answer = "./../questionanswer/" . $sub . "/answers/" . $questionId . ".html";

    $conn = new mysqli("localhost", "root", "", "cwcapsule");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT * FROM questionanswer WHERE questionId = '$questionId'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $answerShow = "block";
    if($row["answerId"] == NULL){
        $answerShow = "none";
    }

    //like_dislike
    $likecolor = "none";
    $dislikecolor = "none";
    
    if($row["rating"] == '1'){
        $likecolor = "blue";
        $dislikecolor = "none";
    }
    if($row["rating"] == '0'){
        $likecolor = "none";
        $dislikecolor = "red";
    }
?>
<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    

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
            <div class="answer" style="display:<?php echo $answerShow; ?>">
                <h5><u>Answer:</u></h5>
                <span onclick="like('<?php echo $row['questionId']; ?>','1')"><i class="material-icons" style="font-size:36px;color:<?php echo $likecolor;?>">thumb_up</i></span>
                <span onclick="like('<?php echo $row['questionId']; ?>','0')"><i class="material-icons" style="font-size:36px;color:<?php echo $dislikecolor;?>">thumb_down</i></span>
                <?php 
                    include $answer;
                    if($row["answerAttachment"] == '1'){
                        echo "<h6>Attachments:</h6>";                    
                        echo "<a href = './../questionanswer/" . $sub ."/attachments/" . $row['answerAttachmentFile'] ."' target='_blank'>" . $row['answerAttachmentFile'] . "</a>";
                    }
                ?>
            </div>  
        </div>
        
		<?php include './../footer.php' ?>

        <script>
            function like(id, type){
                $.post("likeDislike.php", {id: id, type: type},function(data){
                    // alert(data);
                });
                location.reload(1);
            }
        </script>

	</body>
</html>