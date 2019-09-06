
<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./../styles/registerlogin.css">
        <title>Submitted</title>
	</head>
	<body class="resp">
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="container box">
            <div class="response">
                Your Response Is Submitted
                <div><a href= '<?php include "./../configurl.php"; echo $url;?>students/home.php'>Click to go back</a></div>
            </div>
        </div>
        
		<?php include './../footer.php' ?>
        
	</body>
</html>