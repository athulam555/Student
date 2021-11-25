<?php

include('connection.php');
 
if(isset($_REQUEST["term"])){

    $sql = "SELECT * FROM student WHERE name  LIKE ? ";
    
    if($stmt = mysqli_prepare($conn, $sql)){

        mysqli_stmt_bind_param($stmt, "s", $param_term);

        $param_term = $_REQUEST["term"] . '%';

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                echo "<br><center>";
                echo "<table style='width:50%;' border='1'>
                <tr>
                <th><center>Country Name</center></th>
                <th><center>DOB</center></th>
                <th><center>Gender</center></th>
                <th><center>Telephone</center></th>
                <th><center>Email</center></th>
                <th><center>Country</center></th>
                <th><center>City</center></th>
                <th><center>Courses</center></th>
                </tr>";
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

                    $countryquery = "SELECT * from country where id = '" . $row['nationality'] . "' ";
                    $countryqueryresult = $conn->query($countryquery);
            
                    $cityquery = "SELECT * from city where id = '" . $row['city'] . "' ";
                    $cityqueryresult = $conn->query($cityquery);
                    
                    $coursequery = "SELECT * from studentcourse where student_id = '" . $row['id'] . "' ";
                    $courseresult = $conn->query($coursequery);
                    $courseData = mysqli_fetch_all($courseresult, MYSQLI_ASSOC);
          
                    echo "<tr>
                    <td><center>" . $row['name'] . "</center></td>
                    <td><center>" . $row['dob'] . "</center></td>
                    <td><center>" . $row['gender'] . "</center></td>
                    <td><center>" . $row['telephone'] . "</center></td>
                    <td><center>" . $row['email'] . "</center></td>
                    <td><center>" . $countryqueryresult->fetch_assoc()['country_name'] . "</center></td>
                    <td><center>" . $cityqueryresult->fetch_assoc()['city_name'] . "</center></td>
                    <td><center>";
                    foreach ($courseresult as $courselist)
                    {
                      $coursenamequery = "SELECT name from courses where id = '" . $courselist['course_id'] . "' ";
                      $coursenameresult = $conn->query($coursenamequery);
                      echo '<br>';
                      echo $coursenameresult->fetch_assoc()['name'];
                    }
                    echo "</center></td>";
                    
                    // echo "<p>" . $row["name"] . "</p>";
                }
                echo "</table></center>";
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
$conn->close();
?>