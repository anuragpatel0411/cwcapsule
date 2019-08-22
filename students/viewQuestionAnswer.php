<?php
    $studentId = $_GET["id"];
    $questionId = $_GET["qid"];
    $sub = $_GET["sub"];
    $question = "./../questionanswer/" . $sub . "/questions/" . $questionId . ".html";
    $answer = "./../questionanswer/" . $sub . "/answers/" . $questionId . ".html";

    include "./../databaseConn.php";

    $query = "SELECT teacherId FROM questionanswer WHERE questionId = $questionId";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $teacherId = $row["teacherId"];

    $query = "SELECT teacherName FROM teachers WHERE teacherId = $teacherId";
    $result = $conn->query($query);
    if($result->num_rows > 0)
        $row = $result->fetch_assoc();
    $teacherName = $row["teacherName"];
 
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
                <span style="color:red;padding:15px;font-size:12px">By rating the question the session for question will be closed.</span>
                <?php 
                    include $answer;
                    if($row["answerAttachment"] == '1'){
                        echo "<h6>Attachments:</h6>";                    
                        echo "<a href = './../questionanswer/" . $sub ."/attachments/" . $row['answerAttachmentFile'] ."' target='_blank'>" . $row['answerAttachmentFile'] . "</a>";
                    }
                ?>
            </div>  

            <div class="chat">
                <h4>Messages:</h4>
                <!-- <div><button type="button" style="width:120px" class="btn btn-info btn-xs start_chat" data-touserid="<?php echo $teacherId;?>" data-tousername="<?php echo $teacherName;?>"><h4>Messages</h4></button></div> -->
				<div id="user_model_details"></div>                    
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



<script>  
$(document).ready(function(){

    var to_user_id = <?php echo $teacherId;?>;
    var to_user_name = "<?php echo $teacherName;?>";
    make_chat_dialog_box(to_user_id, to_user_name);

    // $("#user_dialog_"+to_user_id).dialog({
    // 	autoOpen:false,
    // 	width:400
    // });
    // $('#user_dialog_'+to_user_id).dialog('open');

    setInterval(function(){ // set interval for take messages for every 1 seconds and show into chat 
        refreshMsg();
    }, 1000); // <---- here 

    function refreshMsg() {
        var hvatajPoruke = $.ajax({
            url: "http://localhost/cwcapsule/liveChatUser/take_msg.php",
            method: "POST",
            data:{to_user_id:to_user_id,quid: <?php echo $questionId?>},
            success: function(data) {
                $('#chat_history_'+to_user_id).html(data);
            }
        })
    }

	function make_chat_dialog_box(to_user_id, to_user_name) {
        var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" style="background-color:" title="You have chat with '+to_user_name+'">';
        modal_content += '<input type="text" name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="formInput messageArea" placeholder="Type a message">';
		modal_content += '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button>';
		modal_content += '<div class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'"></div>';
		modal_content += '</div>';
		$('#user_model_details').html(modal_content);
	}
	//abort ajax call if user close chat :) 
	$( ".selector" ).on( "dialogclose", function( event, ui ) {
		//alert("todo - later");
	});
	$(document).on('click', '.send_chat', function(){
		var to_user_id = $(this).attr('id');
		var chat_message = $('#chat_message_'+to_user_id).val();
		if(chat_message !=''){
            $.ajax({
			url:"http://localhost/cwcapsule/liveChatUser/insert_chat.php",
			method:"POST",
			data:{to_user_id:to_user_id, chat_message:chat_message, quid: <?php echo $questionId?>},
			success:function(data){
			$('#chat_message_'+to_user_id).val('');
			$('#chat_history_'+to_user_id).html(data);
			}
		})
        }
	});

});  
</script>