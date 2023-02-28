<?php

include "singleton.php";

$id = $_GET['id'];

$sql = "DELETE FROM `students` WHERE id=$id";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Deleted successfully.";
    session_start();



    session_unset();



    session_destroy();


    header("location: login.php");
} else {
    echo " not deleted.";
}
