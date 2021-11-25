<?php

 class Course {
     
    public $name;
    
    public function save()
    {
        include('connection.php');

        $sql = "INSERT INTO courses (name)
            VALUES ('" . $this->name . "')";

        if ($conn->query($sql) === TRUE) {
            return "New records insert successfully";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

?>