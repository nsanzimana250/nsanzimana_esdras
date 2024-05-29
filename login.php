<?php
        session_start();
        $conn= new mysqli("localhost","root","","wordmission");
        if (isset($_POST['login'])) {
          $UserName=$_POST["UserName"];
          $Password=$_POST['Password'];
          
          $sql=$conn->query("SELECT * FROM `users` WHERE UserName='$UserName'");
          $result=$sql->fetch_assoc();
          if ($result) {
            if (password_verify($Password, $result['Password'])) {
              $_SESSION['username']=$result['UserName'];
              header("location: ./dashbord/index.php");
            }
            else{
              echo" <script>alert('Password worng  !')</script>";
            }
          }
          else{
            echo" <script>alert('UserName worng !')</script>";
          }
        }
        ?>  
<!DOCTYPE html>
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
        login form for users
      </h2>
      <form action="" method="post">
        <input type="text" name="UserName" id="" placeholder="username " required >
        <input type="password" name="Password" id="" placeholder="password" required >
        <button type="submit" name="login">login now</button>
        <p>if you don't have an ccount <a href="./signup.php">create it</a></p>
      </form>
    </div>
    <footer>
        &copy; <?php echo date("Y");?>  wmhs high school coppyright
      </footer>
  </div>
  
</body>
</html>