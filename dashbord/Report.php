<?php
session_start();
if (empty($_SESSION['username'])) {
  header("location:../index.php");
}
$conn= new mysqli("localhost","root","","wordmission");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: productin ::</title>
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
    <form action="view.php" method="post" target="_blank">
      <div>
        
        <div><label for="">select table</label></div>
        <select name="choice" id="">
          <option value="stock_in">product_in</option>
          <option value="stock_out">product_out</option>
        </select>
        </div><br>
      <div>
        <div><label for="">From when:</label></div>
      <input type="date" name="from" required>
      </div><br>
      <div>
      
      <div><label for=""> To when:</label></div>
      <input type="date" name="to" required>
      </div>
      <div><br><br>
        <button type="submit" name="Generate" >Generate</button>
        </div>
     </form>
  </div>
  </div>
</div>
</body>
</html>