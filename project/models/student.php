<?php

 class Student {
     
    public $name;
    public $dob;
    public $gender;
    public $telephone;
    public $email;
    public $city;
    public $nationality;
    public $course_selection;
    public $photo;
    
    public function save()
    {
        include('connection.php');

        $courseCount = count($this->course_selection);
        for ($i = 0; $i < $courseCount; $i++) {
            $sql = "INSERT INTO student (name,dob,gender,telephone,email,city,nationality,course_selection,photo)
            VALUES ('" . $this->name . "','" . $this->dob . "','" . $this->gender . "','" . $telephone . "','" . $this->email . "',
            '" . $this->city . "','" . $this->nationality. "','" . $this->course_selection[$i] . "','')";

        if ($conn->query($sql) === TRUE) {
            return "New records insert successfully";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    }

}

?>