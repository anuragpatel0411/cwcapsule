<?php 
    session_start();
    if(!$_SESSION || $_SESSION["role"] != "teachers"){
        header('Location: /cwcapsule/login.php');
    }

    include "./../databaseConn.php";

    $id = $_SESSION["id"];
    $opt = $_GET["opt"];
    $showadd = "block";
    $showview = "none";
    if($opt==2){
        $showadd = "none";
        $showview = "block";
    }
    $msg = "";
    if(isset($_POST['submit'])){

        $name = $_POST["name"];
        $bank = $_POST["bank"];
        $accno = $_POST["accno"];
        $ifsc = $_POST["ifsc"];

        if($name && $bank && $accno && $ifsc){
                $sql = $conn->prepare("UPDATE teachers SET  bankName = ?, accHolderName = ?, accountNo = ?, IFSC = ? WHERE teacherId = ?");
                $sql->bind_param("sssss", $bank, $name, $accno, $ifsc, $id);
                $sql->execute();
                $conn->close();
                header("Location: bankdetail.php?opt=2");        
        }else{
            $msg = "Enter All Fields";
        }
        $conn->close();
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
        
        <div style="display:<?php echo $showadd;?>">
            <form method="post" align="center" class="pass">
                <h3>Bank Details</h3>
                <h4 style="color:red;"><?php echo $msg; ?></h4>
                <div>
                    <input type="text" name="name" class="formInput" placeholder="Account Holder Name">
                </div>
                <div>
                    <input type="text" name="bank" class="formInput" placeholder="Bank Name">
                </div>
                <div>
                    <input type="text" name="accno" class="formInput" placeholder="Account Number">
                </div>
                <div>
                    <input type="text" name="ifsc" class="formInput" placeholder="IFSC Code">
                </div>
                <div>
                    <input type="submit" name="submit" class="submitPass" value="Add">
                </div>
            </form>   
        </div>
        <div class="container" style="display:<?php echo $showview;?>">
            <h3 align="center">Bank Details</h3>
            <?php
                $sql = "SELECT bankName, accHolderName, accountNo, IFSC FROM teachers WHERE teacherId = $id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo "<div class='row'><h3 class='col-5'>Account Holder Name:</h3><h3 class='col-7'> " . $row["accHolderName"] . "</h3></div>";
                echo "<div class='row'><h3 class='col-5'>Bank Name:</h3><h3 class='col-7'> " . $row["bankName"] . "</h3></div>";
                echo "<div class='row'><h3 class='col-5'>Account Number:</h3><h3 class='col-7'> " . $row["accountNo"] . "</h3></div>";
                echo "<div class='row'><h3 class='col-5'>IFSC Code</h3><h3 class='col-7'> " . $row["IFSC"] . "</h3></div>";
            ?>
        </div>

        <div>
            <?php include './../footer.php' ?>   
        </div>
	</body>
</html>