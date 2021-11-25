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
    <?php include('navbar.php') ?>
    <div class="container">
        <div class="card text-center">
            <?php
            include('connection.php');

            $nation = "SELECT * from country";
            $course = "SELECT * from courses";

            $nationresult = $conn->query($nation);
            $courselist = $conn->query($course);

            if($_GET)
            {
                $id = $_GET['id'];

                $studentquery = "SELECT * FROM student where id= '".$id."'";
                $studentresult = $conn->query($studentquery);
                $student = mysqli_fetch_all($studentresult, MYSQLI_ASSOC);

                // print_r($student);
                // echo $student[0]['nationality'];
                $countryquery = "SELECT * from country where id = '" .  $student[0]['nationality'] . "' ";
                $countryqueryresult = $conn->query($countryquery);
       
                $cityquery = "SELECT * from city where id = '" . $student[0]['city'] . "' ";
                $cityqueryresult = $conn->query($cityquery);
            }
            $conn->close();
            ?>

            <center><u><b>ADD STUDENT DETAILS</b></u><br></center>
            <br>
            <form action="updateform.php" method="post" id="studentform" enctype="multipart/form-data">
                <div class="row">
                    <table align="center">
                        <tr>
                            <td>Student Name</td>
                            <input name="id" type="hidden" value="<?= $student[0]['id'] ?>">
                            <td><input id="name" class="form-control" type="text" name="student_name" value="<?= $student[0]['name'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Date Of Birth</td>
                            <td><input id="dob" class="form-control" type="date" name="dob" value="<?=  $student[0]['dob'] ?>"></textarea></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                            <?php if ($student[0]['gender'] == 'male'){ ?>
                                    <input id="gender" checked type="radio" name="gender" value="male">Male
                                <?php } else { ?>
                                    <input id="gender" type="radio" name="gender" value="male">Male
                                <?php } ?>
                                <?php if ($student[0]['gender'] == 'female'){ ?>
                                <input id="gender" type="radio" checked name="gender" value="female">Female
                                <?php } else { ?>
                                    <input id="gender" type="radio"  name="gender" value="female">Female
                                    <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nationality</td>
                            <td><select  id="nation" name="nation" class="form-control" onchange="getState(this.value)">
                                    <option value="">Select Nation</option>
                                        <?php foreach ($nationresult as $data) { 
                                        if($student[0]['nationality'] ==  $data['id'] ) { ?>
                                        <option value="<?= $data['id'] ?>" selected ><?= $data['country_name'] ?></option>
                                        <?php } else { ?>
                                        <option value="<?= $data['id'] ?>"><?= $data['country_name'] ?></option>
                                    <?php } } ?>
                                </select>

                        <tr>
                            <td>City</td>
                            <td>
                                <select class="form-control" name="city" id="cities">
                                    <option value="">Select State</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><input id="phone" class="form-control" name="phone" value="<?=  $student[0]['telephone']  ?>"></td>
                        </tr>
                        <tr>
                            <td>Email Id</td>
                            <td><input id="email" class="form-control" onchange="validatemail(this.value)" name="email"  value="<?=  $student[0]['email']  ?>"></td>
                        </tr>
                        <tr>
                            <td>Course</td>
                            <td>
                                <select id="course" class="form-control" name="course[]" multiple="multiple" id="course">
                                    <?php foreach ($courselist as $data) { ?>

                                        <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td><input id="image" class="form-control" type="file" name="image"></td>
                        </tr>
                        <tr class="text-center">
                            <td><input type="submit" class="btn btn-success" value="Update"></td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</body>
</head>

</html>

<script>
    function getState(val) {
        $.ajax({
            type: "POST",
            url: "fetch_city.php",
            data: 'country_id=' + val,
            success: function(html) {
                console.log(html)
                $("select#cities").html(html);
                // $('#course').select2();
            }
        }).done(function() {
            $('#course').select2();
        });
    }

    $(document).ready(function() {
        $('#course').select2();
    });

    function validatemail(mail) {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
            return (true)
        }
        alert("You have entered an invalid email address!")
        return (false)
    }

    $('#studentform').submit(function() {
        if ($('#name').val() == '') {
            alert('Please Name');
            return false;
        }
        if ($('#dob').val() == '') {
            alert('Please insert Date Of birth');
            return false;
        }
        if ($('#gender').is(":checked") == false) {
            alert('Please insert gender');
            return false;
        }
        if ($('#nation').val() == '') {
            alert('Please insert Nationality');
            return false;
        }
        if ($('#city').val() == '') {
            alert('Please insert city');
            return false;
        }
        if ($('#phone').val() == '') {
            alert('Please insert phone number');
            return false;
        }
        if (!$('#phone').val().match('[0-9]{10}')) {
            alert("Please put 10 digit mobile number");
            return false;
        }
        if ($('#email').val() == '') {
            alert('Please insert email');
            return false;
        }
        if ($('#course').val() == '') {
            alert('Please insert atleast one course');
            return false;
        }
        if ($('#image').val() == '') {
            alert('Please insert an Image');
            return false;
        }
    })
</script>

<style>
    .form-control {
        margin-bottom: 10px !important;
    }
</style>