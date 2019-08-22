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
                    <h3>Students</h3>
                    <div class="notverified">
                        <h4>Email not verified...</h4>
                        <div class="search">
                            <input type="text" id="search2" placeholder="Type Your Search..." class="search">
                        </div>
                        <?php                                                     
                            
                            include "./../databaseConn.php";

                            $sql = "SELECT * FROM students WHERE verified = '0' ORDER BY studentName ASC";
                            $result = $conn->query($sql);
                        ?>
                        <table id="detailTable2">
                            <thead>   
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th></th>
                            </thead>
                            <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()){
                                        echo "<tr>";
                                        $id = '"'.$row["studentId"].'"';
                                        echo "<td>" . $row["studentId"] . "</td>";
                                        echo "<td>" . $row["studentName"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["mobile"] . "</td>";
                                        echo "<td><a href='studentDetail.php?id=" . $row["studentId"] . "&name=" . $row["studentName"] . "'>View &#x1F4DD; </a>";
                                        // echo "<span style='color:red;' onclick = 'deleteSubject(".$id.")'>Delete &#10006;</span>";
                                        ECHO "</td>";
                                        echo "</tr>";
                                    }
                                }
                                $conn->close();
                            ?>
                        </table>
                    </div>
                    <div class="verified">
                        <h4>Email verified...</h4>
                        <div class="search">
                            <input type="text" id="search" placeholder="Type Your Search..." class="search">
                        </div>
                        <?php                                                     
                            
                            include "./../databaseConn.php";
 
                            $sql = "SELECT * FROM students WHERE verified = '1' ORDER BY studentName ASC";
                            $result = $conn->query($sql);
                        ?>
                        <table id="detailTable1">
                            <thead>   
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th></th>
                            </thead>
                            <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()){
                                        echo "<tr>";
                                        $id = '"'.$row["studentId"].'"';
                                        echo "<td>" . $row["studentId"] . "</td>";
                                        echo "<td>" . $row["studentName"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["mobile"] . "</td>";
                                        echo "<td><a href='studentDetail.php?id=" . $row["studentId"] . "&name=" . $row["studentName"] . "'>View &#x1F4DD; </a>";
                                        // echo "<span style='color:red;' onclick = 'deleteSubject(".$id.")'>Delete &#10006;</span>"
                                        ECHO "</td>";
                                        echo "</tr>";
                                    }
                                }
                                $conn->close();
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                            
        <script>
            function filterTable(event) {
                var filter = event.target.value.toUpperCase();
                var rows = document.querySelector("#detailTable1 tbody").rows;
                
                for (var i = 0; i < rows.length; i++) {
                    var firstCol = rows[i].cells[1].textContent.toUpperCase();
                    var secondCol = rows[i].cells[2].textContent.toUpperCase();
                    var thirdCol = rows[i].cells[3].textContent.toUpperCase();
                    if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }      
                }
            }
            document.querySelector('#search').addEventListener('keyup', filterTable, false);

            function filterTable2(event) {
                var filter = event.target.value.toUpperCase();
                var rows = document.querySelector("#detailTable2 tbody").rows;
                
                for (var i = 0; i < rows.length; i++) {
                    var firstCol = rows[i].cells[1].textContent.toUpperCase();
                    var secondCol = rows[i].cells[2].textContent.toUpperCase();
                    var thirdCol = rows[i].cells[3].textContent.toUpperCase();
                    if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }      
                }
            }
            document.querySelector('#search2').addEventListener('keyup', filterTable2, false);
        </script>

    </body>
</html>