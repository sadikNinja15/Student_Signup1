
<?php
session_start();


if (isset($_SESSION['email'])) {
    header("location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">

   
</head>

<body>
<?php include "n.php"; ?>
    <h1> Signup Form</h1>
<div class="container">
    <div class="form_container">

    <form action="insert.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" id="form_s" class="comm_form">
        
        First Name: <input type="text" class="form_input" name="first_name" id="firstName" placeholder="Enter your First Name" >
        <span id="firstName_s"></span> 
        
       
        Last Name: <input type="text" class="form_input" name="last_name" placeholder="Enter your last name" >
   
      

        Email: <input type="text" class="form_input" name="email" id="email" placeholder="Enter your Email">
        <span id="email_s" ></span>
       

        DOB: <input type="text" class="form_input" name="date_of_birth" id="DOB" placeholder="Enter your date of birth" >
        <span id="DOB_s" ></span>
        

        password: <input type="password" class="form_input" name="password" id="password" placeholder="enter your password">
        <span id="password_s" >
      
        file: <input type="file" class="form_input" name="profile" > 
      

        <input type="submit" class="form_button" name="save" >
       
        
    </form></div>
    
</div>
<script type="text/javascript">

        function validateForm() {

            var firstName = document.getElementById('firstName').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var DOB = document.getElementById('DOB').value;

            if (firstName == "") {
                document.getElementById('firstName_s').innerHTML = " ** Please fill the First Name field!"
                return false;
            }
            if (firstName.length < 4) {
                document.getElementById('firstName_s').innerHTML = " ** first Name must be 4 characters!"

                return false;
            }

            if (!isNaN(firstName)) {
                document.getElementById('firstName_s').innerHTML = " **Only characters are allow!"

                return false;

            }

            if (email == "") {
                document.getElementById('email_s').innerHTML = " ** Please fill the email field!"

                return false;
            }
            if (email.indexOf('@') <= 0) {
                document.getElementById('email_s').innerHTML = " **@ invalid position!"

                return false;
            }

            if ((email.charAt(email.length - 4) != '.') && (email.charAt(email.length - 3) != '.')) {
                document.getElementById('email_s').innerHTML = " ** invalid position!"

                return false;
            }
            
             
            if (password == "") {
                document.getElementById('password_s').innerHTML = " ** Please fill the password field!"

                return false;
            }
            if (password.length <= 5) {
                document.getElementById('password_s').innerHTML = " **password must be greater 5 keywords!"

                return false;
            }
            if (DOB == "") {
                document.getElementById('DOB_s').innerHTML = " ** Please fill the email field!"

                return false;
            }
            var form = document.getElementById("form_s").value;
            console.log(form)
            form.submit();
            
        }
          

    </script>
 
</body>



   {# <span id="firstName_s"></span> 
    <span id="email_s" ></span> 
     <span id="DOB_s" ></span><br><br>
      <span id="password_s" ></span>   #}
</html>














