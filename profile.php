<?php

include "singleton.php";


session_start();

if(!isset($_SESSION['email']))
{
    header("location: login.php");
    exit;
}



$email = $_SESSION['email'];



$q = "SELECT `id`,`first_name`,`last_name`,`email`,`date_of_birth`,`profile` FROM `students` where `email` = '$email'";
// $q = "select id,first_name,last_name,email,date_of_birth,profile from students";

$result = mysqli_query($conn, $q);

echo "Welcome you are login:)";
echo $email;
// $row = mysqli_fetch_assoc($result); 


// while ( $result = mysqli_fetch_array($row))


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- include "singleton.php";  echo $_SESSION['first_name']; ?>-->
</head>

<body  style=background:#edeef3;>
    
    <div class="container">


        <h1>This is your profile.</h1>
        
        <a href="logout.php">Logout</a>
        
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Date Of Birth</th>
                    <th>Profile</th>
                    <th>Edit</th>
                    

                </thead>

                <tbody>


                    <?php


                    while ($row = mysqli_fetch_assoc($result)) {


                        $_SESSION['first_name'] = $row['first_name'];
                        // $name= $row['first_name'];
                        // print_r($_SESSION['first_name']);
                        $_SESSION['id'] = $row['id'];
                        

                        echo 'Hello Mr. ' . $_SESSION['first_name'];
                        // echo 'Hello Mr. ' . $name;

                        echo "<tr>
           

           
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['date_of_birth'] . "</td>
           
            
            <td><img src='" . $row['profile'] . "' height='100' weight='100'/></td>          
            <td><a href=\"update.php\">Edit</a> 
          
            </td>
          </tr>


         "
          ;
                    }

                    
                    ?>
                    
                </tbody>
                <?php echo $_SESSION['id']; ?>
                
               
                
            </table>
           
        </div>
    </div>

  
</body>



</html>