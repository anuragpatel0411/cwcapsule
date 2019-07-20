<?php
    session_start();
    $id = $_SESSION["id"]
?>
<html>
    <head>
        <title>Your Answered Questions</title>
    </head>
    <body>
        <div>
            <?php include './../header.php' ?>
        </div>
        <div class="container box">
            <h3>
                Your Answered Questions
            </h3>
            <div class="row">
                <div class="searchbar">
                    <input type="text" id="search2" placeholder="Type to search....." class="search">
                </div>
                <?php
                    $conn = new mysqli("localhost","root","","cwcapsule");
                    if($conn->connect_error){
                        die("Connection failed: ".$conn->connect_error);
                    }
                    $sql = "SELECT subjects.subjectId , subjects.subjectName FROM subjects INNER JOIN teachers ON teachers.subject = subjects.subjectName WHERE teachers.teacherId = '$id' ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $sId = $row["subjectId"]; 
                        $sName = $row["subjectName"];   
                    }
                     $sql = "SELECT * FROM questionanswer WHERE subjectId = '$sId' AND answerId IS NOT NULL";
                     $result = $conn->query($sql);
                ?>
                 <table id="detailTable2">
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
     </body>
 </html>