<?php
include('connection.php');

$nation = "SELECT * from country";
$course = "SELECT * from courses";

$nationresult = $conn->query($nation);
$courselist = $conn->query($course);

if (!empty($_POST["country_id"])) {

    $countryId = $_POST["country_id"];
    $city = "SELECT * from city where country_id = $countryId";

    $citylist =  $conn->query($city);
    if (!empty($citylist)) {
        echo '<option value="">Select</option>';
        foreach ($citylist as $state) { 
           echo '<option value='. $state["id"].'>'. $state["city_name"].'</option>';
        }
    } else { ?>
        <option value="">Select....</option>
<?php }
}

$conn->close();
?>