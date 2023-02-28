<?php

header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content_type ');


// $data = json_decode(file_get_contents("php://input"), true); 
// $data =  $_SERVER['REQUEST_METHOD'] == "POST";
// var_dump($_POST);
// var_dump($_FILES);


$data = array(
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'date_of_birth' => $_POST['date_of_birth'],
    'profile' => $_FILES['profile']

);

// print_r($data);
// print_r($data['profile']);
// $data = array(
//     'first_name' => $_POST['first_name'],
// );


// include "singleton.php";
include('allInOne.php'); 

$obj = new Student();



//insert---------------------------------

$result = $obj->insertValidate($data,$conn);

if ($result) {
    $obj->insert($obj->firstName, $obj->lastName, $obj->email, $obj->password, $obj->DOB,$obj->des, $conn);
} else {
    echo 'something wrong!!';
}




// $firstName=filter_input(INPUT_POST, 'first_name');
// $lastName=filter_input(INPUT_POST, 'last_name');
// $email=filter_input(INPUT_POST, 'email');
// $password=filter_input(INPUT_POST, 'password');
// $DOB=filter_input(INPUT_POST, 'date_of_birth');
// $profile=filter_input(INPUT_POST, 'profile');


// var data = JSON.parse(request.data);

// $firstName=filter_input(INPUT_POST, 'first_name');
// $lastName=filter_input(INPUT_POST, 'last_name');
// $email=filter_input(INPUT_POST, 'email');
// $password=filter_input(INPUT_POST, 'password');
// $DOB=filter_input(INPUT_POST, 'date_of_birth');
// $profile=filter_input(INPUT_POST, 'profile');


// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     $firstName = $_POST['first_name'];
//     $lastName = $_POST['last_name'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $DOB = $_POST['date_of_birth'];
//     }

