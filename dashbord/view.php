<?php
session_start();
if (empty($_SESSION['username'])) {
  header("location:../index.php");
}
$conn= new mysqli("localhost","root","","wordmission");
$choice=$_POST['choice'];
$from=$_POST['from'];
$to=$_POST['to'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            margin: 30px;
        }
        table{
            padding: 4px 20px 5px 20px;
            width: 70%;
            border-collapse: collapse;
        }
        table th, td{
            padding: 10px;
            border: dashed 1px;
            border-collapse: collapse;
        }
        .th{
            text-align: end;
        }
    </style>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
Kigali-Rwanda <br>
world mission high school <br>
Kitchen management <br>
report for: <?php echo $choice ?>
<br>
<b><u> report from <?php
echo $from.'  to  '.$to;
?>
</u></b><br>

________________________________________________________________________________________________________________________
<br><br>
<table>
    <tr>
        <th>number</th>
        <th>Product</th>
        <th>Date</th>
        <th>Quantity</th>
        <th>UniquePrice</th>
        <th>TotalPrice</th>
    </tr>
<?php
if ($choice=='stock_in') {
    $sql=$conn->query("SELECT * FROM `stock_in` INNER JOIN Products
     WHERE
     stock_in.product_id=Products.product_id 
     AND stock_in.Date BETWEEN '$from' and '$to'");
    $number=1;
    while ($row=$sql->fetch_array()) { ?> 
    <tr>
        <td><?php echo $number; ?></td>
        <td><?php echo $row['ProductName']; ?></td>
        <td><?php echo $row['1'] ;?></td>
        <td><?php echo $row['2'] ;?></td>
        <td><?php echo $row['3'] ;?></td>
        <td><?php echo $row['4'] ;?></td>
        <?php $total=$total + $row['TotalPrice']; ?>
    </tr>
<?php $number++; }
}
else {
    $sql=$conn->query("SELECT * FROM `stock_out` INNER JOIN Products
    WHERE
    stock_out.product_id=Products.product_id 
    AND stock_out.Date BETWEEN '$from' and '$to'");
   $number=1;
   while ($row=$sql->fetch_array()) { ?> 
    <tr>
        <td><?php echo $number; ?></td>
        <td><?php echo $row['ProductName']; ?></td>
        <td><?php echo $row['1'] ;?></td>
        <td><?php echo $row['2'] ;?></td>
        <td><?php echo $row['3'] ;?></td>
        <td><?php echo $row['4'] ;?></td>
        <?php $total=$total + $row['TotalPrice']; ?>
    </tr>
<?php $number++; }

 }
 ?>
 <tr>
    <th class="th" colspan="9" ><?php echo $total." "."RWF"; ?></th>
 </tr>
 </table><br>
 <?php
 
 
 ?>
 _____________________________________________________________________________________________________________________
    <p>&copy;CopyLight world mission high school. designer: <a href="#">_es_dras__</a> </p>
<body>
</body>
</html>