<?php
session_start();
if (empty($_SESSION['username'])) {
  header("location:../index.php");
}
$conn = new mysqli("localhost", "root", "", "wordmission");

if (isset($_POST['save'])) {
    $product_id = $_POST['product_id'];
    $Date = $_POST['Date'];
    $Quantity = $_POST['Quantity'];
    $UniquePrice = $_POST['UniquePrice'];
    $TotalPrice = $Quantity * $UniquePrice;

    $complex = $conn->query("SELECT * FROM `stock_in` WHERE `product_id` = '$product_id' AND `Quantity` >= $Quantity");
    if (mysqli_num_rows($complex) > 0) {
        $result = $complex->fetch_assoc();
        if ($result) {
            $new_quantity = $result['Quantity'] - $Quantity;
            $new_total = $new_quantity * $result['UniquePrice'];
            $sql = $conn->query("INSERT INTO `stock_out`(`product_id`, `Date`, `Quantity`, `UniquePrice`, `TotalPrice`) VALUES ('$product_id', '$Date', '$Quantity', '$UniquePrice', '$TotalPrice')");
            $sql = $conn->query("UPDATE `stock_in` SET `Quantity`='$new_quantity', `TotalPrice`='$new_total' WHERE `product_id`='$product_id'");
            header("location: stock_out.php");
        }
    } 
    else {
        echo '<script>alert("Product out is greater than product in")</script>';
    }
}



if (isset($_GET['Delete'])) {
  $id=$_GET['Delete'];
  $delete=$conn->query("DELETE FROM `stock_out` WHERE `product_id`='$id'");
  header("location: stock_out.php");
}

$update=false;
$id=0;
$ProductCode='';
$Date='';
$Quantity='';
$UniquePrice='';
$TotalPrice="";
if (isset($_GET['Edit'])) {
  $id=$_GET['Edit'];
  $update=true;
  $sql=$conn->query("SELECT * FROM `stock_out` WHERE  product_id='$id'");
  $result=$sql->fetch_array();
  $Date=$result[1];
  $Quantity=$result[2];
  $UniquePrice=$result[3];
}
if (isset($_POST['update'])) {
  $id=$_POST['id'];
  $Date=$_POST['Date'];
  $Quantity=$_POST['Quantity'];
  $UniquePrice=$_POST['UniquePrice'];
  $TotalPrice=$Quantity*$UniquePrice;
  $sql=$conn->query("UPDATE `stock_out` SET `Date`='$Date',`Quantity`='$Quantity',`UniquePrice`='$UniquePrice',`TotalPrice`='$TotalPrice' WHERE `product_id`='$id'");
  header("location: stock_out.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: ProductOut ::</title>
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
  <h3>stock_out</h3>
    <form action="" method="post">
    <select name="product_id" id="">
        <option>Select Product</option>
        <?php
         $select=$conn->query("SELECT * FROM `Products`");
         while ($row=$select->fetch_array()) { ?>
          <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
         <?php  }    ?>
      </select>
      <input type="hidden" name="id" value="<?php echo$id ?>" >
      <input type="date" name="Date" id="" value="<?php echo $Date ?>"   required placeholder="Date">
      <input type="number" name="Quantity" required value="<?php echo $Quantity ?>"  placeholder="Quantity">
      <input type="number" name="UniquePrice" value="<?php echo$UniquePrice ?>"  required placeholder="UniquePrice">
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
        <th colspan="8" >product record</th>
      </tr>
      <tr>
        <th>number</th>
        <th>product</th>
        <th>Date</th>
        <th>Quantity</th>
        <th>UniquePrice</th>
        <th>TotalPrice</th>
        <th colspan="2" >Action</th>
      </tr>
      <?php
      $sql=$conn->query("SELECT * FROM stock_out INNER JOIN Products WHERE stock_out.product_id=Products.product_id");
      $number=1;
      while ($row=$sql->fetch_array()) { ?>
       <tr class="tr" >
        <td><?php echo $number; ?></td>
        <td><?php echo $row['ProductName']; ?></td>
        <td><?php echo $row['1'] ;?></td>
        <td><?php echo $row['2'] ;?></td>
        <td><?php echo $row['3'] ;?></td>
        <td><?php echo $row['4'] ;?></td>
        <td class="a" ><a class="delete"  href="?Delete=<?php echo $row['0'] ;?>">Delete</a></td>
        <td class="a" ><a class="update" href="?Edit=<?php echo $row['0'] ;?>">update</a></td>
      </tr>
        
     <?php $number++;  } ?>
    </table>
  </div>
  <footer class="footer2"  >
    <p>&copy;Copyright 2024 All Rights Reserved.designer<a href="#">_es_dras_____</a></p>
  </footer>
  </div>
</body>
</html>
