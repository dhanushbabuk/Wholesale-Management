<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-form-container">

        <div id="close-login-btn" class="fas fa-times"></div>

        <form action="/project/login.php" method="POST">
            <h3>login</h3>
            <span>Username</span>
            <input type="text" name="username" class="box" placeholder="Enter your username" id="">
            <span>Password</span>
            <input type="password" name="pass" class="box" placeholder="Enter your password" id="">
            <div class="checkbox">
                <input type="checkbox" name="remember" id="remember-me">
                <label for="remember-me"> Remember me</label>
            </div>
            <input type="submit" value="Login" class="btn" name="login"><a href="edo.php">Create One</a>
            <p>Forget Password ? <a href="#">Click Here</a></p>
            <p>Don't Have An Account ? <a href="Signup.php">Create One</a></p>
        </form>
    </div>

    <?php
        include 'basic.php';
        if(isset($_POST['login']))
        {
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $sql = "SELECT * FROM Admins where Username = '$username' and Password = '$pass'";
            $result = mysqli_query($conn, $sql);
            $i = mysqli_num_rows($result);
            if($i == 1)
            {
                echo "Login Successful!";
                header("location:edo.php");
            }
            else
                echo "Invalid Credentials";
        }
    ?>
</body>

</html>