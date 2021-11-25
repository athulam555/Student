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

            $sql = "SELECT * FROM country";
            $result = $conn->query($sql);

            if (count($_POST) > 0) {

                $sql = "INSERT INTO city (city_name,country_id)
    VALUES ('" . $_POST["city_name"] . "','" . $_POST['country_name'] . "')";

                if ($conn->query($sql) === TRUE) {
                    echo "New records insert successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
            ?>
            <center><u><b>Add City</b></u><br></center>
            <br>
            <form action="addcity.php" method="post">
                <table align="center">
                    <tr>
                        <td>Country Name:</td>
                        <td><select class="form-control" type="text" name="country_name" placeholder="Name....">

                                <?php
                                foreach ($result as $data) { ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['country_name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>City name:</td>
                        <td><input type="text" name="city_name"> </td>
                    </tr>
                    <tr>
                        <td><input class="btn btn-success" type="submit" value="Submit"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</head>

</html>