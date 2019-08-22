<?php
    $msg = "";
    if(isset($_POST['add'])){
        if($_POST['name']){
            $sname	= $_POST['name'];
            
            include "./../databaseConn.php";

            $sql = $conn->prepare("INSERT INTO subjects(subjectName) VALUES(?)");
            $sql->bind_param("s", $sname);
            $sql->execute();
            
            mkdir("./../questionanswer/". $sname);
            mkdir("./../questionanswer/" . $sname . "/answers");
            mkdir("./../questionanswer/" . $sname . "/questions");
            mkdir("./../questionanswer/" . $sname . "/attachments");

            $msg = 'Subject Successfully added..';
            // header("Location: http://localhost/cwcapsule/admin/subjects.php");  
            $conn->close();
        }else{
            $msg = "Enter all Fields";
        }
    }    
?>

<html>
    <head>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./styles/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		
        <link rel="stylesheet" href="./styles/style.css">

        <title>Subjects</title>
    </head>
    <body>
        <div>
            <div>
                <?php include 'header.php';?>
            </div>
            <div class="container box">
                <h3>Subjects</h3>

                <div class="search">
                    <input type="text" placeholder="Type Your Search..." id="search" class="search">
                    <form method="post">
                        <div>
                            <span>New Subject: </span>
                            <input type="text" name="name" placeholder="Subject Name">
                            <input type="submit" name="add" value="Add">
                        </div>
                        <div style="color:red; text-align:center;"><?php echo $msg;?></div>                            
                    </form>
                </div>

                <?php                                                     
                    
                    include "./../databaseConn.php";

                    $sql = "SELECT * FROM subjects ORDER BY subjectName ASC";
                    $result = $conn->query($sql);
                ?>
                <table id="detailTable1">
                    <thead>   
                        <th>Subject ID</th>
                        <th>Subject Name</th>
                        <th></th>
                    </thead>
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>" . $row["subjectId"] . "</td>";
                                $id = '"'.$row["subjectId"].'"';
                                echo "<td>" . $row["subjectName"] . "</td>";
                                echo "<td>";
                                // echo "<a href='subjectDetail.php?id=" . $row["subjectId"] . "&sub=" . $row["subjectName"] . "'>View &#x1F4DD; </a>";
                                // echo "&nbsp; &nbsp;";
                                echo "<span style='color:red;' onclick = 'deleteSubject(".$id.")'>Delete &#10006;</span></td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </table>

                <!-- questions of test -->
                <h3>Test Questions</h3>
                <table id="detailTable1">
                    <thead>   
                        <th>Subject Name</th>
                        <th>No of Questions</th>
                        <th></th>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM subjects ORDER BY subjectName ASC";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>" . $row["subjectName"] . "</td>";

                                $sid = $row["subjectId"];
                                $sql2 = "SELECT COUNT(quesid) FROM teachertestquestions WHERE subjectid = '$sid'";
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();

                                echo "<td>" . $row2["COUNT(quesid)"] . "</td>";
                                echo "<td>";
                                echo "<a href='viewTestQuestions.php?sid=" . $row["subjectId"]. "'>View &#x1F4DD; </a>";
                                echo "&nbsp; &nbsp;";
                                echo "<a href='addTestQues.php?sid=" . $row["subjectId"] . "'><span style='color:red;'>Add Questions <span style='font-size:20;font-weight:9&#x2b;00'>+</span></span></a></td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </table>
                
            </div>
        </div>

        <script>
            function filterTable(event) {
                var filter = event.target.value.toUpperCase();
                var rows = document.querySelector("#detailTable1 tbody").rows;
                
                for (var i = 0; i < rows.length; i++) {
                    var firstCol = rows[i].cells[1].textContent.toUpperCase();
                    if (firstCol.indexOf(filter) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }      
                }
            }
            document.querySelector('#search').addEventListener('keyup', filterTable, false);

            function deleteSubject(id){
                var r = confirm("Do you want to delete the subject?");
                if (r == true) {
                    $.post("deleteData.php", {subid: id, category: 'subjects',attribute: 'subjectId'},function(data){
                        alert(data);
                    });
                    location.reload(0);
                }
            }
        </script>
    </body>
</html>