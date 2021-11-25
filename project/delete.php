<?php
include('connection.php');


$coursesql = "DELETE FROM studentcourse WHERE student_id ='" . $_GET["id"] . "'";

// $deletecourse = $conn->query($coursesql);

$studentsql = "DELETE FROM student WHERE id ='" . $_GET["id"] . "'";


if ($conn->query($coursesql) && $conn->query($studentsql) === TRUE  ) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}
header("Location: liststudent.php"); 
exit();
$conn->close();
?>
