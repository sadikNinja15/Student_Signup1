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
<?php include "n.php"; ?>
<body style=background:lightblue;>
    <h1>Welcome you are successfully signup </h1>
    <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, qui hic? Soluta sint est voluptatem dolorem rerum omnis ea quibusdam beatae, sed distinctio eveniet id numquam dolorum harum consectetur provident? Blanditiis inventore atque delectus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, cupiditate voluptate culpa, itaque similique commodi ipsum quae dolorem sit rem totam facere dolor amet eveniet minus, suscipit numquam dignissimos quos hic error et. Omnis totam maiores officia minima ad eaque accusamus suscipit minus quas.</h3>
    <div class="container">

        <a href="login.php">Login</a>
        <a href="signup.php">Signup</a>

    </div>
</body>

</html>