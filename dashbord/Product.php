<?php
session_start();
if (empty($_SESSION['username'])) {
  header("location:../index.php");
}
$conn= new mysqli("localhost","root","","wordmission");
if (isset($_POST['save'])) {
  $ProductName=$_POST['ProductName'];
  $sql=$conn->query("SELECT * FROM `Products` WHERE ProductName='$ProductName' ");
  if (mysqli_num_rows($sql)>0) {
    $result=$sql->fetch_assoc();
    if ($result) {
      echo' <div class="error">
      <p>product already storeded</p>
      <form method="post">
      <button type="submit" name="error" >OK</button>
      </form>
    </div>'; 
    }
  }else{
    $sql=$conn->query("INSERT INTO `Products`(`ProductName`) VALUES ('$ProductName')");
    header("location:Product.php");
  }
}

if (isset($_GET['Delete'])) {
  $id=$_GET['Delete'];
  $sql=$conn->query("DELETE FROM `Products` WHERE product_id=$id");
  header("location:Product.php");
}
$ProductName="";
$id=1;
$update=false;
if (isset($_GET['Edit'])) {
  $id=$_GET['Edit'];
  $update=true;
  $sql=$conn->query("SELECT * FROM `Products` WHERE `product_id`='$id'");
  $data=$sql->fetch_array();
  $ProductName=$data['1'];
}
if (isset($_POST['update'])) {
  $id=$_POST['id'];
  $ProductName=$_POST['ProductName'];
  $sql=$conn->query("UPDATE `Products` SET `ProductName`='$ProductName' WHERE product_id=$id");
  header("location:Product.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: Add Product ::</title>
  <link rel="stylesheet" href="./dash.css">
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
  <div class="form">

    <h3>Add Product</h3>
    <form action="" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
    <input type="text" name="ProductName" required value="<?php echo $ProductName; ?>" placeholder="ProductName">

    <?php if($update==TRUE): ?>
    <button type="submit" name="update" >Update</button>
    <?php else: ?>
    <button type="submit" name="save" >Add</button>
    <?php endif; ?>
    
    </form>

  </div>

  <div class="table">

    <table>
      <tr>
        <th colspan="6" >product record</th>
      </tr>
      <tr>
        <th>Number</th>
        <th>Product Name</th>
        <th colspan="2" >Action</th>
      </tr>
      <?php
      $sql=$conn->query("SELECT * FROM `Products`");
      $number=1;
      while ($row=$sql->fetch_array()) { ?>
      <tr class="tr" >
        <td><?php echo $number; ?></td>
        <td><?php echo $row['1'] ;?></td>
        <td class="a" ><a class="delete"  href="?Delete=<?php echo $row['0'] ;?>">Delete</a></td>
        <td class="a" ><a class="update" href="?Edit=<?php echo $row['0'] ;?>"> update</a></td>
      </tr>
        
     <?php $number++; }  ?>

    </table>

  </div>

  <footer class="footer2" >
    <p>&copy;Copyright 2024 All Rights Reserved.designer<a href="#">_es_dras_____</a></p>
  </footer>

  </div>
  
  </div>
</body>
</html>