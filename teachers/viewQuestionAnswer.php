<?php

    include "./../databaseConn.php";
    
    $questionId = $_GET["qid"];
    $sub = $_GET["sName"];

    $query = "SELECT studentId FROM questionanswer WHERE questionId = $questionId";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $studentId = $row["studentId"];

    $query = "SELECT studentName FROM students WHERE studentId = $studentId";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $stdName = $row["studentName"];

    $question = "./../questionanswer/" . $sub . "/questions/" . $questionId . ".html";
    $answer = "./../questionanswer/" . $sub . "/answers/" . $questionId . ".html";

    include "./../databaseConn.php";

    $sql = "SELECT * FROM questionanswer WHERE questionId = '$questionId'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $answerShow = "block";
    $buttonShow = "block";
    if($row["answerId"] == NULL){
        $answerShow = "none";
        $buttonShow = "block";
    }
    else{
        $answerShow = "block";
        $buttonShow = "none";  
    }
    if(isset($_POST['submit'])){
        $sql = "UPDATE questionAnswer SET answering='1' WHERE questionId = '$questionId' ";

        if ($conn->query($sql) === TRUE) {
            header("Location: http://localhost/cwcapsule/teachers/answering.php?qid=".$questionId."&sName=".$sub);
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
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
        <title>Your Question</title>
	</head>
	<body>
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="container box">
            <div class="question">
                <h4><u>Question:</u></h4>
                <?php 
                    include $question;
                    if($row["quesAttachment"] == '1'){
                        echo "<h6>Attachments:</h6>";                    
                        echo "<a href = './../questionanswer/" . $sub ."/attachments/" . $row['quesAttachmentFile'] ."' target='_blank'>" . $row['quesAttachmentFile'] . "</a>";
                    }
                ?>
            </div>  
            <div class="answer" style="display:<?php echo $answerShow; ?>">
                <h4><u>Answer:</u></h4>
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
                <!-- <div><button type="button" style="width:120px" class="btn btn-info btn-xs start_chat" data-touserid="<?php echo $studentId;?>" data-tousername="<?php echo $stdName;?>"><h4>Messages</h4></button></div> -->
				<div id="user_model_details"></div>                    
            </div>

            <?php 
                if($row["answering"] != 1){
                    echo "<div class='button' style='display:";
                    echo $buttonShow;
                    echo "'>
                    <form method='post'>
                         <input type='submit' value='Answer' name='submit' class='submitPass'><span> Only Answer the question if you are able to</span>
                    </form>
                 </div>  ";
                }else{
                    echo "<p style='color:red'>Someone has Taken The Question before you</p>";
                }
            ?>
        </div>
        
        <div>
            <?php include './../footer.php' ?>   
        </div>
	</body>
</html>


<script>  
$(document).ready(function(){

    var to_user_id = <?php echo $studentId;?>;
    var to_user_name = "<?php echo $stdName;?>";
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
		$.ajax({
			url:"http://localhost/cwcapsule/liveChatUser/insert_chat.php",
			method:"POST",
			data:{to_user_id:to_user_id, chat_message:chat_message, quid: <?php echo $questionId?>},
			success:function(data){
			$('#chat_message_'+to_user_id).val('');
			$('#chat_history_'+to_user_id).html(data);
			}
		})
	});

});  
</script>
