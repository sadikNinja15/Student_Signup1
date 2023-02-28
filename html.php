<?php

header('Content-Type:apllication/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST,GET');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content_type ');

// $data = json_decode(file_get_contents("php://input"), true);
include "singleton.php";


class Student
{

    public $id = '';
    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $password = '';
    public $DOB = '';
    public $des = '';


    public function insertValidate($data, $conn)
    {

        //  print_r($data);
        //  die();

        if (empty($data["first_name"])) {
            echo "First Name cannot be blank .";
        } else if (strlen($data['first_name']) <= 5) {
            echo 'first name should be more than 5 characters.';
            exit;
        } else if (empty($data["email"])) {
            echo "Email cannot be blank ";
            exit;
        } else if (!empty($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                echo $data['email'] . ' this is not a valid email';
                exit;
            }
        }
        $email = $data['email'];
        $q = mysqli_query($conn, "select * from students where email= '$email'");
        if (mysqli_num_rows($q) > 0) {
            echo 'email is already add';
            exit;
        }
        // $re = '/^([_a-zA-Z0-9.-]+@+[a-z]+.+[a-z]{2,3})$/';

        $re = '/^[a-zA-Z0-9_.+-]+@(gmail|yahoo).com$/';

        // $re = '/^([_a-zA-Z0-9.]+@+[gmail]+.+[a-z]{2,3})$/';
        // $re = '/^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,3})$/';

        // $re = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        if (!preg_match($re, $email)) {
            echo 'invalid Email';
        } else if (empty($data['password'])) {
            echo "Password cannot be blank ";
        } else if (empty($data['date_of_birth'])) {
            echo "Date of birth cannot be blank ";
            exit;
        }
        if (!empty($_FILES['profile'])) {

            // print_r('//////');
            $fileName = $_FILES["profile"]["name"];
            $filesSize = $_FILES["profile"]["size"];
            $tmpName = $_FILES["profile"]["tmp_name"];

            $validExt = ['jpg', 'jpeg', 'png'];
            $imgExt = explode('.', $fileName);
            $imgExt = strtolower(end($imgExt));
            if (!in_array($imgExt, $validExt)) {
                echo ' profile ext  not valid';
            } else if ($filesSize > 1000000) {
                echo "size so large";
            } else {
                $this->lastName = empty($data['last_name']) ? "" : $data['last_name'];
                $this->firstName = $data['first_name'];
                $this->lastName = $data['last_name'];
                $this->email = $data['email'];
                $this->password = ($data['password']);
                $this->DOB = $data['date_of_birth'];
                // print_r('???????');
                $this->des = 'profile/' . $fileName;
                move_uploaded_file($tmpName, $this->des);


                // print_r($des);


            }
           
        }
        return $data;
    }

    public function insert($firstName, $lastName, $email, $password, $DOB, $des, $conn)
    {

        print_r('<br>this is new');
        $sql = "INSERT INTO `students` (`first_name`, `last_name`, `email`, `password`, `date_of_birth`,`profile`) VALUES ( '$firstName', '$lastName', '$email', '$password', '$DOB','$des')";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array('message' => 'Student record inserted:)'));
        } else {
            echo json_encode(array('message' => 'Student record not inserted:)'));
        }
    }


}
 
header('Content-Type:apllication/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content_type ');


$data = json_decode(file_get_contents("php://input"), true); 
// $data =  $_SERVER['REQUEST_METHOD'] == "POST";





// include "singleton.php";
// include('allInOne.php'); 

$obj = new Student();

print_r('hii');

//insert---------------------------------
// $result = $obj->insertValidate($data,$conn);
$result = $obj->insertValidate($data,$conn);
print_r('<br>byeee.....<br>');
if ($result) {
    $obj->insert($obj->firstName, $obj->lastName, $obj->email, $obj->password, $obj->DOB,$obj->des, $conn);
} else {
    echo 'something wrong!!';
}
