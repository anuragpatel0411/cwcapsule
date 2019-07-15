<html>
    <head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./styles/bootstrap.css">
		
        <link rel="stylesheet" href="./styles/style.css">

        <title>Teachers</title>
    </head>
    <body>
        <div>
            <?php include 'header.php';?>
            <div class="container box">
                <div>
                    <h3>Teachers</h3>
                    <div class="notverified">
                        <h4>In Process...</h4>
                        <div class="search">
                            <input type="text" id="search2" placeholder="Type Your Search..." class="search">
                        </div>
                        <?php                                                     
                            $conn = new mysqli("localhost", "root", "", "cwcapsule");
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            $sql = "SELECT * FROM teachers WHERE mailVerified = '0' OR testPass = '0' OR documentUpload = '0' OR documentVerified = '0' ORDER BY documentVerified, documentUpload,testPass DESC";
                            $result = $conn->query($sql);
                        ?>
                        <table id="detailTable2">
                            <thead>   
                                <th>Teacher ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Mail Verified</th>
                                <th>Test Pass</th>
                                <th>Document Uploaded</th>
                                <th>Document Verified</th>
                                <th></th>
                            </thead>
                            <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()){
                                        echo "<tr>";
                                        $id = '"'.$row["teacherId"].'"';
                                        echo "<td>" . $row["teacherId"] . "</td>";
                                        echo "<td>" . $row["teacherName"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["mobile"] . "</td>";
                                        if($row["mailVerified"]==1){
                                            echo "<td>Yes</td>";
                                        }else{
                                            echo "<td>No</td>";
                                        }
                                        if($row["testPass"]==1){
                                            echo "<td>Yes</td>";
                                        }else{
                                            echo "<td>No</td>";
                                        }
                                        if($row["documentUpload"]==1){
                                            echo "<td>Yes</td>";
                                        }else{
                                            echo "<td>No</td>";
                                        }
                                        if($row["documentVerified"]==1){
                                            echo "<td>Yes</td>";
                                        }else{
                                            echo "<td>No</td>";
                                        }
                                        echo "<td><a href='teacherDetail.php?id=" . $row["teacherId"] . "&name=" . $row["teacherName"] . "'>View &#x1F4DD; </a>";
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
                        <h4>Activated Account...</h4>
                        <div class="search">
                            <input type="text" id="search" placeholder="Type Your Search..." class="search">
                        </div>
                        <?php                                                     
                            $conn = new mysqli("localhost", "root", "", "cwcapsule");
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            $sql = "SELECT * FROM teachers WHERE mailVerified = '1' AND testPass = '1' AND documentUpload = '1' AND documentVerified = '1' ORDER BY teacherName ASC";
                            $result = $conn->query($sql);
                        ?>
                        <table id="detailTable1">
                            <thead>   
                                <th>Teacher ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th></th>
                            </thead>
                            <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()){
                                        echo "<tr>";
                                        $id = '"'.$row["teacherId"].'"';
                                        echo "<td>" . $row["teacherId"] . "</td>";
                                        echo "<td>" . $row["teacherName"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["mobile"] . "</td>";
                                        echo "<td><a href='teacherDetail.php?id=" . $row["teacherId"] . "&name=" . $row["teacherName"] . "'>View &#x1F4DD; </a>";
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