<?php
session_start();
$conn=new mysqli("localhost","root","","wordmission");
$error=array();
$username=$email=$password=$cpassword="";
if (isset($_POST['signup'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $pass=password_hash($password, PASSWORD_DEFAULT);
    $usernamecheck=$conn->query("SELECT * FROM `users` WHERE `UserName`='$username'");
    if ($usernamecheck==true) {
        $result=$usernamecheck->fetch_assoc();
        if ($result==true) {
            array_push($error,"username aleady taken  ");
        }
    }
    if (strlen($password)<6) {
        array_push($error,"password must be 6 or more characters  ");
    }
    if ($password!=$cpassword) {
        array_push($error,"password not much ");
    }
    if (count($error)>0) {
        foreach ($error as $key) {
            echo" 
            <script>alert('$key')</script>
            ";
        }
    }
    else{
        $emailcheck=$conn->query("INSERT INTO `users`(`UserName`, `Password`) VALUES ('$username','$pass')");
        header("location: login.php");
    }
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>home</title>
  <link rel="stylesheet" href="./stylesheet/home.css">
</head>
<body>
  <div class="contaniner">
    <header>
    <div class="header">
        <h3>NEW HIGH SCHOOL </h3>
      </div>
      <nav>
        <ul>
          <li><a href="./index.php">home</a></li>
          <li><a href="login.php">login</a></li>
          <li><a href="signup.php">signup</a></li>
        </ul>
      </nav>
    </header>
    <div class="php">

    </div>

    <div class="form">
      <h2>
        signup form for users
      </h2>
      <form action="" method="post">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="password"required >
        <input type="password" name="cpassword" placeholder="comform password" required>
        <button type="submit" name="signup">signup now</button>
        <p>Aleady have an account <a href="./login.php">login now</a></p>
      </form>
    </div>
    
    <footer>
        &copy; <?php echo date("Y");?>  wmhs high school coppyright
      </footer>
  </div>
</body>
</body>
</html>