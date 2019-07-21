<!-- http://localhost/cwcapsule/teachers/documentVerificatioWait.php?id=' . $id -->
<?php 
    $conn = new mysqli("localhost", "root", "", "cwcapsule");    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $id = $_GET['id'];
        $sql = "SELECT documentVerified FROM teachers WHERE teacherId = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if( $row['documentVerified'] == TRUE){
                header('Location: http://localhost/cwcapsule/teachers/home.php?id=' . $id);
            }
        }
        $conn->close();        
?>

<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <title>Document Verify</title>

	</head>
	<body class="paper">
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="row">
            <div id="paper" class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 box verify">
                <h3>Administrator will verify your document within 24hours of document upload...!</h3>
                <h3>Please wait for your documents to b verified.</h3>
                <a href="http://localhost/cwcapsule">Home</a>
            </div>
        </div>
        
        <div>
            <?php include './../footer.php' ?>   
        </div>
	</body>
</html>