<h1>Update your details</h1>

<?php
// including the database connection file
include "singleton.php";

session_start();

if (isset($_POST['update'])) {

    // $id = mysqli_real_escape_string($conn, $_POST['id']);
    // $id = mysqli_real_escape_string($conn, $_POST['id']);
    // $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    // $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    // $password = mysqli_real_escape_string($conn, $_POST['password']);

    $id = ($_POST['id']);
    $firstName = ($_POST['firstName']);
    $lastName = ($_POST['lastName']);
    $password = ($_POST['password']);



    $DOB = mysqli_real_escape_string($conn, $_POST['DOB']);


    if (empty($firstName)) {
        echo "<font color='red'>Name field is empty.</font><br/>";
    } else {
        //updating the table


        $sql = "UPDATE `students` SET `first_name`='$firstName',`last_name`= '$lastName',`password`='$password', `date_of_birth`= '$DOB' WHERE `students`.`id`=$id";



        $result = mysqli_query($conn, $sql);

        header("Location: profile.php");
    }
}

?>

<?php
//getting id from url
// $id = $_GET['id'];
$id = $_SESSION['id'];



$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
    $firstName = $res['first_name'];
    $lastName = $res['last_name'];
    $email = $res['email'];
    $password = $res['password'];
    $DOB = $res['date_of_birth'];
}

?>
<html>

<head>
    <title>Edit Data</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

  
  

    <div class="form_container">

    <form action="" method="POST" id="form_s" class="comm_form">
        
        First Name: <input type="text" class="form_input" name="firstName" id="firstName" value="<?php echo $firstName; ?>">
        <span id="firstName_s"></span> 
        
       
        Last Name: <input type="text" class="form_input" name="lastName" value="<?php echo $lastName; ?>" >
    
      
    
        Email: <input type="text" class="form_input" name="email" id="email" disabled value="<?php echo $email; ?>">
        <span id="email_s" ></span>
       
    
        DOB: <input type="text" class="form_input" name="DOB" id="DOB" value="<?php echo $DOB; ?>" >
        <span id="DOB_s" ></span>
        
    
        password: <input type="password" class="form_input" name="password" id="password" value="<?php echo $password; ?>">
        <span id="password_s" >
      
        
      
        <input type="hidden" name="id" value=<?php echo $_SESSION['id']; ?>>
        <input type="submit" class="form_button"  name="update" value="Update" >
       
        
    </form></div>
</body>

</html>