<?php

header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST,GET');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content_type ');


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

        if (empty($data["first_name"])) {
            echo "First Name cannot be blank .";exit;
        } else if (strlen($data['first_name']) < 4) {
            echo 'first name should be more than 4 characters.';
            exit;
        } else if (empty($data["email"])) {
            echo "Email cannot be blank ";
            exit;
        } else if (!empty($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                echo $data['email'] . ' this is not a valid email';
                exit;
            }else{
                echo '';
            }
        }

        $email = $data['email'];
        print_r($email);
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
         if(!preg_match($re, $email)) {
            echo ' invalid Email';
            exit;
        } else if (empty($data['password'])) {
            echo "Password cannot be blank ";
            exit;
        } else if (empty($data['date_of_birth'])) {
            echo "Date of birth cannot be blank ";
            exit;
        }
        // print_r("hello Bro");

        // print_r($data['profile']);
        // print_r($data['profile']['name']);
        // print_r($data['profile']['tmp_name']);

        else if (empty($_FILES['profile'])) {
            echo 'error';
            exit;
        }
        else if (!empty($_FILES['profile'])) {

            // print_r('//////');
            $fileName = $_FILES["profile"]["name"];
            // print_r($fileName);

            $tmpName = $_FILES["profile"]["tmp_name"];

            $validExt = ['jpg', 'jpeg', 'png'];
            $imgExt = explode('.', $fileName);
            $imgExt = strtolower(end($imgExt));
            if (!in_array($imgExt, $validExt)) {
                echo ' profile ext  not valid';
            } 
            else {

                $this->lastName = empty($data['last_name']) ? "" : $data['last_name'];
                $this->firstName = $data['first_name'];
                $this->lastName = $data['last_name'];
                $this->email = $data['email'];
                $this->password = ($data['password']);
                $this->DOB = $data['date_of_birth'];
                $this->des = 'profile/' . $fileName;
                move_uploaded_file($tmpName, $this->des);
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
           
            echo '<script language="javascript">';
            echo 'alert("message successfully Add")';
            echo '</script>';
            header("location: wel.php");

        } else {

            echo json_encode(array('message' => 'Student record not inserted:)'));
        }
    }

    //,'$destination'


    // public $id = '';
    // public $firstName = '';
    // public $lastName = '';
    // public $email = '';
    // public $password = '';
    // public $DOB = '';

    public function validate($data, $conn)
    {


        if (!empty($data["id"])) {
            $this->id = $data["id"];
            echo $this->id;
        } else {
            echo "ID cannot be blank";
            exit;
        }


        $sql = "SELECT * FROM students WHERE id=$this->id";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row) {

            $this->firstName = $row['first_name'];
            $this->lastName = $row['last_name'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->DOB = $row['date_of_birth'];
        } else {
            echo 'data not found:)';
            exit;
        }

        if (!empty($data["first_name"])) {
            $this->firstName = $data["first_name"];
            // print_r($this->firstName);
        }
        if (strlen($data['first_name']) <= 5) {
            echo 'first name should be more than 5 characters.';
            exit;
        }
        if (!empty($data["last_name"])) {
            $this->lastName = $data["last_name"];
            // print_r($this->lastName);
        }
        if (!empty($data["email"])) {
            $this->email = $data["email"];
        }
        if (!empty($data["password"])) {
            $this->password = $data["password"];
        }
        if (!empty($data["date_of_birth"])) {
            $this->DOB = $data["date_of_birth"];
        }

        // return $data;

    }

    public function update($conn, $firstName, $lastName, $email, $password, $DOB, $id)
    {
        print_r('......');

        $query = "UPDATE `students` SET `first_name` = '$firstName', `last_name` = '$lastName', `email` = '$email', `password` = '$password',`date_of_birth` = '$DOB' WHERE `id` =  $id";

        $run = mysqli_query($conn, $query);
        if ($run) {
            echo "updated Successfully";
        } else {
            echo "not updated";
        }
    }

    public function validateDelete($data)
    {

        if (empty($data["id"])) {;
            echo  "id cannot be blank ";
        } else {
            $this->id = $data["id"];
        }
    }

    function delStudent($id, $conn)
    {

        $sql = "DELETE FROM `students` WHERE `students`.`id` = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_affected_rows($conn);
        if ($row == 1) {
            echo "<br>Number of affected rows: $row <br>";
            echo "Deleted Successfully ";
        } else {
            echo "data not found:)";
        }
    }

    function getAllStudent($conn)
    {
        $sql = "SELECT * FROM students";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            // echo var_dump($row);
            echo $row['id'] .  ". Hello " . $row['first_name'] . $row['last_name'] . " your email is " . $row['email'] . " your DOB " . $row['date_of_birth'] . $row['profile'];
            echo "<br>";
        }
    }
}




 // // $re = '/^([_a-zA-Z0-9.]+@+[gmail]+.+[a-z]{2,3})$/';
        // // $re = '/^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,3})$/';

        // // $re = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
            // else if (!empty($data['profile'])) {
            //     $name = $data['profile'];
            //     // $filetmp =
            //     print_r($name);
            //     echo '<br>';
            //     $fileext = explode('.',$name);
            //     $filecheck = strtolower(end($fileext));
            //     print_r($filecheck);

            //     $filestore = array('png','jpg','jprg');

            //     if(in_array($filecheck,$filestore)){
            //         $destination = 'profile/'.$name;
            //         move_uploaded_file($name,$destination);
            //         print_r('...............');

            //     }
                // $extension = pathinfo($name, PATHINFO_EXTENSION);

                // $randomno = str_shuffle("avx65d7");
                // $rename = $randomno;
                

                // $newname = $rename . '.' . $extension;


                  // else if (!empty($data['profile'])) {
            //     $name = $data['profile'];
            //     // $filetmp =
            //     print_r($name);
            //     echo '<br>';
            //     $fileext = explode('.',$name);
            //     $filecheck = strtolower(end($fileext));
            //     print_r($filecheck);

            //     $filestore = array('png','jpg','jprg');

            //     if(in_array($filecheck,$filestore)){
            //         $destination = 'profile/'.$name;
            //         move_uploaded_file($name,$destination);
            //         print_r('...............');

            //     }
                // $extension = pathinfo($name, PATHINFO_EXTENSION);

                // $randomno = str_shuffle("avx65d7");
                // $rename = $randomno;
                

                // $newname = $rename . '.' . $extension;





            // else if (!empty($data['profile'])) {
            //     $name = $data['profile'];
            //     // $filetmp =
            //     print_r($name);
            //     echo '<br>';
            //     $fileext = explode('.',$name);
            //     $filecheck = strtolower(end($fileext));
            //     print_r($filecheck);

            //     $filestore = array('png','jpg','jprg');

            //     if(in_array($filecheck,$filestore)){
            //         $destination = 'profile/'.$name;
            //         move_uploaded_file($name,$destination);
            //         print_r('...............');

            //     }
                // $extension = pathinfo($name, PATHINFO_EXTENSION);

                // $randomno = str_shuffle("avx65d7");
                // $rename = $randomno;
                

                // $newname = $rename . '.' . $extension;

                // public function insertValidate($firstName,$lastName,$email,$password,$DOB, $conn)
                // if ($_SERVER['REQUEST_METHOD'] == "POST") {
                //     //  print_r($data);
                //     //  die();
                //     if(empty($firstName)){
                //         echo "First Name cannot be blank .";
                //     }
                //     if(empty($email)){
                //         echo "email Name cannot be blank .";
                //     }
                //     if(empty($password)){
                //         echo "password Name cannot be blank .";
                //     }
                //     if(empty($DOB)){
                //         echo "DOB Name cannot be blank .";
                //     }