<?php

session_start();



session_unset();



session_destroy();

header("location: login.php");

// session_start();

// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
//     header("location: login.php");
//     exit;
// }
// if(isset($_SESSION['first_name']) ){
//     header("location: login.php");
//     exit;}
// if(isset($_SESSION['first_name']) ){
    //     header("location: login.php");
    //     exit;}
//     if(isset($_SESSION['email']))
// {
//     header("location: profile.php");
//     exit;
// }
?>

