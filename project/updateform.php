<?php

include('connection.php');


// echo "<pre>";print_r($_GET['id']);die();
if(count($_POST)>0) {

$coursesql = "DELETE FROM studentcourse WHERE student_id ='" . $_POST["id"] . "'";
$conn->query($coursesql);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$isUploaded = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);


$sql = "UPDATE student set name='" . $_POST['student_name'] . "', dob='" . $_POST['dob'] . "', gender='" . $_POST['gender'] . "', nationality='" . $_POST['nation'] . "' ,city='" . $_POST['city'] . "' , telephone='" . $_POST['phone'] . "' , email='" . $_POST['email'] . "', photo='" .  basename($_FILES["image"]["name"]) . "' WHERE id='" . $_POST['id'] . "'";

    $courseCount = count($_POST['course']);
    for ($i = 0; $i < $courseCount; $i++) {
        $coursesql = "INSERT INTO studentcourse (student_id,course_id) VALUES ('" . $_POST['id'] . "','" . $_POST['course'][$i] . "') ";
        if ($conn->query($coursesql) === TRUE) {
            $save = true;
        } else {
            $save = false;
        }
    }
if ($conn->query($sql) === TRUE) {
    echo "Updated";
    $save = true;
} else {
    echo "not updated";
    $save = false;
}
header("Location: liststudent.php"); 
exit();

}
?>