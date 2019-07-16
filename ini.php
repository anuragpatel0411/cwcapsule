<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE cwa";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();



$con=mysqli_connect("localhost","root","","cwa");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "CREATE TABLE students (studentId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, studentName VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL, birthDate varchar(10) NOT NULL, course varchar(20) NOT NULL, majorSubject varchar(20) NOT NULL, pass varchar(20) NOT NULL,  registrationDate TIMESTAMP);";
$sql .="CREATE TABLE subjects (subjetId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, subjectName VARCHAR(30) NOT NULL);";

$sql .="INSERT INTO `subjects`(`subjectName`) VALUES ('Science');";
$sql .="INSERT INTO `subjects`(`subjectName`) VALUES ('Management');";
$sql .="INSERT INTO `subjects`(`subjectName`) VALUES ('Engineering');";

$sql .="ALTER TABLE `students` ADD `mobile` VARCHAR(20) NOT NULL AFTER `email`;";

$sql .="ALTER TABLE `students` CHANGE `mobile` `mobile` varchar(20) NOT NULL;";
$sql .="ALTER TABLE `students` ADD UNIQUE(`email`);";
$sql .="ALTER TABLE `students` ADD `verified` boolean NOT NULL;";


$sql .="CREATE TABLE teachers (teacherId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, teacherName VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL UNIQUE, mobile VARCHAR(20) NOT NULL, birthDate varchar(10) NOT NULL, qualification varchar(20) NOT NULL, subject varchar(20) NOT NULL, pass varchar(20) NOT NULL,  registrationDate TIMESTAMP, mailVerified boolean, testPass boolean, documentVerified boolean); ";



$sql .="CREATE TABLE teacherTestQuestions(quesid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, subjectId INT(6), question varchar(300));";
$sql .="CREATE TABLE teacherTestQuestionChoices(choiceid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, quesid INT(6), is_right boolean, choice varchar(50));";


$sql .="INSERT INTO `teachertestquestionchoices`(`quesid`, `is_right`, `choice`) VALUES (6,FALSE,'Heat is evolved');";
$sql .="INSERT INTO `teachertestquestionchoices`(`quesid`, `is_right`, `choice`) VALUES (6,FALSE,'Heat is absorbed');";
$sql .="INSERT INTO `teachertestquestionchoices`(`quesid`, `is_right`, `choice`) VALUES (6,TRUE,'Temperature increases');";
$sql .="INSERT INTO `teachertestquestionchoices`(`quesid`, `is_right`, `choice`) VALUES (6,FALSE,'Light is produced');";

$sql .="INSERT INTO `teachertestquestionchoices`(`quesid`, `is_right`, `choice`) VALUES (9,FALSE,'Heat is evolved');";
$sql .="INSERT INTO `teachertestquestionchoices`(`quesid`, `is_right`, `choice`) VALUES (9,FALSE,'Heat is absorbed');";
$sql .="INSERT INTO `teachertestquestionchoices`(`quesid`, `is_right`, `choice`) VALUES (9,TRUE,'Temperature increases');";
$sql .="INSERT INTO `teachertestquestionchoices`(`quesid`, `is_right`, `choice`) VALUES (9,FALSE,'Light is produced');";

$sql .="ALTER TABLE `teachers` ADD `id` VARCHAR(100) NOT NULL DEFAULT 'None' AFTER `documentVerified`, ADD `qualificationCerti` VARCHAR(100) NOT NULL AFTER `id`, ADD `cv` VARCHAR(100) NOT NULL AFTER `qualificationCerti`, ADD `pan` VARCHAR(100) NULL AFTER `cv`, ADD `panno` VARCHAR(20) NULL AFTER `pan`;";
$sql .="ALTER TABLE `teachers` ADD `documentUpload` BOOLEAN NOT NULL DEFAULT FALSE AFTER `testPass`;";

$sql .= "CREATE TABLE admin (adminID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, adminName VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL, pass varchar(20) NOT NULL,  registrationDate TIMESTAMP);";
$sql .= "INSERT INTO `admin`(`adminName`, `email`, `pass`) VALUES ('admin', 'admin@gmail.com', 'admin');";

$sql .= "create TABLE questionanswer(questionId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, subjectId INT(6) NOT NULL, studentId INT(6) NOT NULL, dateofQuestion TIMESTAMP, question varchar(100), quesAttachment boolean, quesAttachmentFile varchar(50), answerId INT(6), dateOfAnswer varchar(10), teacherId INT(6), rating boolean, answering boolean, answerAttachment boolean, answerAttachmentFile varchar(50));";
echo $sql;


// Execute multi query
if (mysqli_multi_query($con,$sql))
{
  do
    {
    // Store first result set
    if ($result=mysqli_store_result($con)) {
      // Fetch one and one row
      while ($row=mysqli_fetch_row($result))
        {
        printf("%s\n",$row[0]);
        }
      // Free result set
      mysqli_free_result($result);
      }
    }
  while (mysqli_next_result($con));
}

mysqli_close($con);
?>


<!-- http://localhost/cwcapsule/verifymail.php?email=richa@g.c&name=Richa BhardwajBhardewaj&r=t -->
