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
      $servername = "127.0.0.1";
      $username = "root";
      $password = "";
      $dbname = "emp";

      //Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM courses";
      $result = $conn->query($sql);
      echo '<center>Courses';
      if ($result->num_rows > 0) {
        echo "<table style='width:50%;' border='1'><tr><th><center>Course Name</center></th></tr>";


        while ($row = $result->fetch_assoc()) {
          echo "<tr><td><center>" . $row["name"] . "</center></td></tr>";
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
</style>