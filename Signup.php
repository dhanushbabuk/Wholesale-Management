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

        <form action="/project/Signup.php" method="post">
            <h3>SIGN up</h3>
            <span>Name</span>
            <input type="text" name="name" class="box" placeholder="Enter your Name" id="">
            <span>Phone Number</span>
            <input type="text" name="number" class="box" placeholder="Enter your phone number" id="">
            <span>E-Mail</span>
            <input type="email" name="mail" class="box" placeholder="Enter your email" id="">
            <span>Username</span>
            <input type="text" name="username" class="box" placeholder="Enter username" id="">
            <span>New Password</span>
            <input type="password" name="password" class="box" placeholder="Enter your password" id="">
            <span>Confirm Password</span>
            <input type="password" name="cpass" class="box" placeholder="Confirm password" id="">
            <div class="checkbox">
            <label for="remember-me"> enter same as new password</label>
            </div>
            <a href="login.php"><input type="submit" value="Sign Up" name="signup" class="btn"></a>

        </form>

    </div>

    <?php
        include 'basic.php';
        if(isset($_POST['signup']))
        {
          echo "successfull";
            $name = $_POST['name'];
            $number = $_POST['number'];
            $mail = $_POST['mail'];
            $username = $_POST['username'];
            $pass = $_POST['password'];
            $cpass=$_POST['cpass'];

           if($pass==$cpass)
          {

            $sql = "create table IF NOT EXISTS Admins(Name varchar(30), Number varchar(10), Mail varchar(35), Username varchar(15) primary key, Password varchar(15))";
            $result= mysqli_query($conn,$sql);

            $sql = "insert into Admins(Name, Number, Mail, Username,Password) values('$name', '$number', '$mail', '$username', '$pass')";

            $result = mysqli_query($conn, $sql);
        

            if($result)
            {
                echo "Signed Up Successfully!";
                header("location:login.php");
            }
            else
                echo mysqli_error($conn);
            
       }
    }
  ?>
</body>

</html>