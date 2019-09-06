<?php 
    session_start();
    if(!$_SESSION || $_SESSION["role"] != "students"){
        header('Location: /cwcapsule/login.php');
    }

    include "./../databaseConn.php";

    $id = $_SESSION["id"];
    $opt = $_GET["opt"];
    $memershipdetail = "block";
    $buymembership = "none";
    if($opt==1){
        $memershipdetail = "none";
        $buymembership = "block";
    }
    
?>
<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./../styles/registerlogin.css">
        <title><?php echo $_SESSION["username"];?></title>
	</head>
	<body>
		<div>
            <?php include './../header.php' ?>   
        </div>

        <div class="container" style="display:<?php echo $memershipdetail;?>">View</div>
        <div class="container" style="display:<?php echo $buymembership;?>">
            <div class="row">
                <div class="col-6 card">10 Question One Month<br>$20.00</div>
                <div class="col-6 card">1 Quwstion<br>$3.00</div>
            </div>
        </div>

        <div>
            <?php include './../footer.php' ?>   
        </div>
	</body>
</html>