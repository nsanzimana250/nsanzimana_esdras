<?php
session_start();
if (empty($_SESSION['username'])) {
  header("location:../login.php");
}
$conn= new mysqli("localhost","root","","wordmission");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./dash.css">
  <title>dashbord</title>
</head>
<body>
<div class="containter">
  <div class="left">
  <div class="user"></div>
      <ul>
        
        <li><a href="./index.php">Home</a></li>
        <li><a href="./Product.php ">product</a></li>
        
        <li><a href="./stock_in.php">stock_in</a></li>
        <li><a href="./stock_out.php">stock_out</a></li>
        <li><a href="./Report.php">Report</a></li>
        <li><a href="./logout.php">Log Out</a></li>
      </ul>
    </div>
  <div class="right">

  <header>
    <h1> welcome You Can make change </h1>
    <h3> user::<?php echo $_SESSION['username']; ?> ::</h3>
  </header>
   <div class="allcard">
   <div class="cord">
    <h1>
    <?php
        $sql=$conn->query("SELECT * FROM `users`");
        $result=mysqli_num_rows($sql);
        echo $result;
         ?>
    </h1>
      <h4>users</h4>
    </div>
    <div class="cord">
      <h1>
        <?php
        $sql=$conn->query("SELECT * FROM `Products`");
        $result=mysqli_num_rows($sql);
        echo $result;
         ?>
      </h1>
      <h4>all product</h4>
    </div>
    <div class="cord">
    <h1>
    <?php
        $sql=$conn->query("SELECT * FROM `stock_out`");
        $result=mysqli_num_rows($sql);
        echo $result;
         ?>
    </h1>
      <h4>stock_out</h4>
    </div>
    <div class="cord">
    <h1>
    <?php
        $sql=$conn->query("SELECT * FROM `stock_in`");
        $result=mysqli_num_rows($sql);
        echo $result;
         ?>
    </h1>
      <h4>stock_in</h4>
    </div>
   </div>
   <footer class="footer">
    <p>&copy;Copyright 2024<a href="#">_es_dras_____</a></p>
  </footer>
  </div>
  </div>
  
</body>
</html>