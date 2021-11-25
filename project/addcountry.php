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
            if (count($_POST) > 0) {

                $sql = "INSERT INTO country (country_name)
    VALUES ('" . $_POST["country_name"] . "')";

                if ($conn->query($sql) === TRUE) {
                    echo "New records insert successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
            ?>
            <html>
            <title>Add Country</title>

            <head>

            <body>
                <center><u><b>Add Country</b></u><br></center>
                <br>
                <form action="addcountry.php" method="post">
                    <table align="center">
                        <tr>
                            <td>Country Name:</td>
                            <td><input class="form-control" type="text" name="country_name" placeholder="Name...."></td>
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