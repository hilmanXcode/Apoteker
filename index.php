<?php
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        header("Location: dashboard/index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
                <div class="box d-flex justify-content-center align-items-center">
                    <form action="pLogin.php" method="post">
                        <h2 class="text-center" style="color: black;">Login</h2>
                        <label for="username" class="loginText">Username</label>
                        <input type="text" class="form-control" name="username" value="" autocomplete="false">
            
                        <label for="password" class="loginText">Password</label>
                        <input type="password" class="form-control" name="password" value="" autocomplete="false">

                        <button type="submit" class="btn btn-primary mt-3 customCssButton">Login</button>
                        
                    </form>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php
        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
        }
        unset($_SESSION['error']);
    ?>
</body>
</html>