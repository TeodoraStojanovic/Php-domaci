<?php

require "model/user.php";
require "dbbroker.php";

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $userL = $_POST['username'];
    $passL = $_POST['password'];

    $odg = User::logInUser($userL, $passL, $conn);
    if ($odg->num_rows == 1) {
        $_SESSION['user_admin'] = $userL;
        header('Location: shop.php');
        exit();
    }
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Login</title>

</head>

<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <h1>ULOGUJ SE</h1>
                <div class="container">
                    <input type="text" placeholder="Username" name="username" class="form-control" required>
                    <br>
                    <input type="password" placeholder="Password" name="password" class="form-control" required>
                    <br>
                    <button class="btn btn-success" name="submit" type="sumbit">Prijavi se</button>
                </div>
            </form>
        </div>
</body>

</html>