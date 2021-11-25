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

            if (count($_POST) > 0) {

                // model class for student saving not implemented need some more work
                // $model =  new Student();
                // $model->name = $_POST["student_name"];
                // $model->$name = $_POST["dob"];
                // $model->$dob = $_POST["student_name"];
                // $model->$gender = $_POST["gender"];
                // $model->$telephone = $_POST["phone"];
                // $model->$email = $_POST["employee_email"];
                // $model->$city = $_POST["city"];
                // $model->$nationality = $_POST["nation"];
                // $model->$course_selection = $_POST["student_name"];
                // $model->$photo = $_POST["course"];
                // $data = $model->save();
                // echo $data;

                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $isUploaded = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                // if ($isUploaded) {
                //     echo 'file uploaded';
                // } else {
                //     echo 'not uploaded';
                // }
                $sql = "INSERT INTO student (name,dob,gender,telephone,email,city,nationality,photo)
                VALUES ('" . $_POST["student_name"] . "','" . $_POST["dob"] . "','" . $_POST["gender"] . "','" . $_POST["phone"] . "','" . $_POST["employee_email"] . "',
                '" . $_POST["city"] . "','" . $_POST["nation"] . "','" . basename($_FILES["image"]["name"]) . "')";

                if ($conn->query($sql) === TRUE) {
                    $save = true;
                } else {
                    $save = false;
                }
                $studentID = 'select id from student where name= "' . $_POST["student_name"] . '" AND email = "' . $_POST["employee_email"] . '" ';
                $studentIDdata = $conn->query($studentID);
                $id = $studentIDdata->fetch_assoc()['id'];
                $courseCount = count($_POST['course']);

                for ($i = 0; $i < $courseCount; $i++) {
                    $coursesql = "INSERT INTO studentcourse (student_id,course_id) VALUES ('" . $id . "','" . $_POST['course'][$i] . "') ";
                    if ($conn->query($coursesql) === TRUE) {
                        $save = true;
                    } else {
                        $save = false;
                    }
                }
                if ($save === true) {
                    echo "Saved Successfully";
                } else {
                    echo "Some data not saved";
                }
                // print_r($_POST);
                header("Location: liststudent.php"); 
                exit();
            }
            $conn->close();
            ?>

            <center><u><b>ADD STUDENT DETAILS</b></u><br></center>
            <br>
            <form action="addstudent.php" method="post" id="studentform" enctype="multipart/form-data">
                <div class="row">
                    <table align="center">
                        <tr>
                            <td>Student Name</td>
                            <td><input id="name" class="form-control" type="text" name="student_name"></td>
                        </tr>
                        <tr>
                            <td>Date Of Birth</td>
                            <td><input id="dob" class="form-control" type="date" name="dob"></textarea></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><input id="gender" type="radio" name="gender" value="male">Male
                                <input id="gender" type="radio" name="gender" value="female">Female
                            </td>
                        </tr>
                        <tr>
                            <td>Nationality</td>
                            <td><select id="nation" name="nation" class="form-control" onchange="getState(this.value)">
                                    <option value="">Select Nation</option>
                                    <?php foreach ($nationresult as $data) { ?>

                                        <option value="<?= $data['id'] ?>"><?= $data['country_name'] ?></option>
                                    <?php } ?>
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
                            <td><input id="phone" class="form-control" name="phone"></td>
                        </tr>
                        <tr>
                            <td>Email Id</td>
                            <td><input id="email" class="form-control" onchange="validatemail(this.value)" name="employee_email"></td>
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
                            <td><input type="submit" class="btn btn-success" value="Submit"></td>
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