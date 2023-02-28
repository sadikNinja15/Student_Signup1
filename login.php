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
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>
<?php include "n.php"; ?>
    <h1> Login form</h1>

    <div class="form_container">
    
        <form action="" method="POST" onsubmit="return validateForm()" class="comm_form">


            Email: <input type="text" name="email" class="form_input" id="email" placeholder="Enter your Email">
            <span id="email_s"></span>

            Password: <input type="password" name="password" id="password" class="form_input" placeholder="Enter your password">
            <span id="password_s"></span>


            <input type="submit" name="save" class="form_button">

        </form>
    </div>

    <script type="text/javascript">
        function validateForm() {

            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            if (email == "") {
                document.getElementById('email_s').innerHTML = " ** Please fill the email field!"

                return false;
            }

            if (password == "") {
                document.getElementById('password_s').innerHTML = " ** Please fill the password field!"

                return false;
            }

        }
    </script>

</html>

<?php

include "singleton.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    echo $email;
    $sql = "Select * from students where email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num >= 1) {
        $login = true;
        $_SESSION['email'] = $email;
        header("location: profile.php");
    } else {
        echo "Invalid details plz fill the correct details.";
        exit;
    }
}

?>


</body>