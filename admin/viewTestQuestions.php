<!-- http://localhost/cwcapsule/teachers/teachertest.php?id=1 -->
<?php
    
    include "./../databaseConn.php";

    $subid = $_GET["sid"];
?>

<html>
	<head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <title>Test Questions</title>

	</head>
	<body class="paper">
		<div>
            <?php include './../header.php' ?>   
        </div>
        <div class="row">
            <div id="paper" class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 box container">
                <h2>Test Questions</h2>
                <form method="post">
                    <?php
                        $sql = "SELECT * FROM teachertestquestions where subjectId = '$subid'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<ol class=lis>";
                            while($row = $result->fetch_assoc()) {
                                $qid = $row['quesid'];
                                echo "<li> " . $row["question"];
                                $sql2 = "SELECT * FROM teachertestquestionchoices where quesid = '$qid'";
                                $result2 = $conn->query($sql2);
                                echo "<ol class='liop'>";
                                $name ="";
                                while($row2 = $result2->fetch_assoc()) {
                                    $name = $row2["quesid"];
                                    echo "<li>" . $row2["choice"] . "</li>";                            
                                }
                                echo "</ol></li>";
                            }
                            echo "</ol>";
                        } else {
                            echo "0 results";
                        }
                    ?>
                </form>
            </div>
        </div>
	</body>
</html>