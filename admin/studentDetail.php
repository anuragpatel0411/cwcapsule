<html>
    <head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./styles/bootstrap.css">
		
        <link rel="stylesheet" href="./styles/style.css">

        <title>Students</title>
    </head>
    <body>
        <div>
            <?php include 'header.php';?>
            <div class="container box">
                <div>
                    <h2><?php echo $_GET['name'] ?></h2>
                    <?php                                                     
                        
                        include "./../databaseConn.php";

                        $id= $_GET['id'];
                        $sql = "SELECT * FROM students WHERE studentId= '$id'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                echo "<table>";
                                echo "<tr><th>Student ID:</th><td>" . $row["studentId"] ."</td></tr>";
                                echo "<tr><th>Email:</th><td>" . $row["email"] ."</td></tr>";
                                echo "<tr><th>Mobile:</th><td>" . $row["mobile"] ."</td></tr>";
                                echo "<tr><th>Date of Birth:</th><td>" . $row["birthDate"] ."</td></tr>";
                                echo "<tr><th>Course:</th><td>" . $row["course"] ."</td></tr>";
                                echo "<tr><th>Major Subjects:</th><td>" . $row["majorSubject"] ."</td></tr>";
                                echo "<tr><th>Registration Date:</th><td>" . $row["registrationDate"] ."</td></tr>";
                                echo "</table>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>