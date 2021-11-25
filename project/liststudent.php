<html>
<title>View</title>
<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
<?php include ('navbar.php') ?>
  <div class="container">
    <div class="card text-center">
      <?php
      include('connection.php');

      $sql = "SELECT * FROM student";
      $result = $conn->query($sql);
      $studentData = mysqli_fetch_all($result, MYSQLI_ASSOC);

      // print_r($studentData);
     
      echo '<center><h3>Students</h3>';
      if ($result->num_rows > 0) {
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
        <th><center>Delete</center></th>
        <th><center>Update</center></th>
        </tr>";
        foreach ($studentData as $row)
        {
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
          echo "</center></td>
          <td><a href='delete.php?id=".$row['id']."'>Delete</a></td>
          <td><a href='update.php?id=".$row['id']."''>Update</a></td>
          </tr>";
        }
        echo "</table>";
      } else {
        echo "0 results";
      }
      echo '</courses>';
      $conn->close();
      ?>
    </div>
  </div>
</body>

</html>
<style>
  th {
    padding: 10px;
  }
  td {
    padding: 10px;
  }
</style>