<?php
    session_start();
    $id = $_SESSION["id"]
?>
<html>
    <head> 
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="./../styles/bootstrap.css">
		
        <link rel="stylesheet" href="./../styles/styles.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./../styles/registerlogin.css">
        <title>Answer Questions</title>
    </head>
    <body>
        <div>
            <?php include './../header.php' ?>
        </div>
        <h3 class="quhead">Open Questions</h3>
        <div class="container box">
            
            <div class="row">
                <div class="searchbar">
                    <input type="text" id="search" placeholder="Type to search....." class="search">
                </div>
                <?php
                    
                    include "./../databaseConn.php";

                    $sql = "SELECT subjects.subjectId , subjects.subjectName FROM subjects INNER JOIN teachers ON teachers.subject = subjects.subjectName WHERE teachers.teacherId = '$id' ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $sId = $row["subjectId"]; 
                        $sName = $row["subjectName"];   
                    }
                     $sql = "SELECT * FROM questionanswer WHERE subjectId = '$sId' AND answerId IS NULL";
                     $result = $conn->query($sql);
                ?>
                 <table id="detailTable1">
                        <thead>
                            <th>Question</th>
                            <th>Attachment</th>
                            <th></th>
                        </thead>
                        <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td>" . $row["question"] . "</td>";
                                    if($row["quesAttachment"] == '0'){
                                        echo "<td>No File Attached</td>";
                                    }else{
                                        echo "<td>" . $row["quesAttachmentFile"] . "</td>";
                                    }
                                    echo "<td><a href='viewQuestionAnswer.php?id=" . $id . "&qid=" . $row["questionId"] . "&sName=" . $sName ."'>View</a>";
                                    // echo "<span style='color:red;' onclick = 'deleteSubject(".$id.")'>Delete &#10006;</span>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td colspan='4' style='text-align:center'>No result</tr>";
                            }
                            $conn->close();
                        ?>
                    </table>   
             </div>
         </div>
         
        <div>
            <?php include './../footer.php' ?>   
        </div>
        
        <script>
            function filterTable(event) {
                var filter = event.target.value.toUpperCase();
                var rows = document.querySelector("#detailTable1 tbody").rows;
                
                for (var i = 0; i < rows.length; i++) {
                    var firstCol = rows[i].cells[1].textContent.toUpperCase();
                    var thirdCol = rows[i].cells[0].textContent.toUpperCase();
                    if (firstCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }      
                }
            }
            document.querySelector('#search').addEventListener('keyup', filterTable, false);
        </script>

     </body>
 </html>