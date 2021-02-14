<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
  <title>My Purchases</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="topnavbar.js"></script>
<link rel="stylesheet" type="text/css" href="topnavbar.css">
<style type="text/css">
table,td
{
  border-collapse: collapse;
}
img.shops
{
  border:2px solid rgb(77,166,255);
}
input[type=text]
{
  display: none;
}
</style>
</head>
<body>
<?php
require 'titlebar.php';
require 'topnavbar.html';
?>
<?php
if(!empty($_SESSION))
{
$uid=$_SESSION['userid'];
?>
<div class="row">
<div class="col-lg-4 col-sm-12 w3-border-right">
<?php
$sql="select * from buystatus,seller where buystatus.userid='$uid' and seller.userid=buystatus.sellerid order by sno desc";
$result=mysqli_query($con,$sql);
if(!$result)
{
  echo "Error".mysqli_error($con);
}
if (mysqli_num_rows($result)>0) 
{

//echo "<a href='head.php' class='w3-button w3-small w3-light-grey w3-padding w3-round' style='text-decoration:none;'>Go to Home</a><br><br>";
  ?>
<div class="w3-padding " style="position:sticky;top:0px;background-color:rgb(77,166,255);">
  <center>
<input type="search"  class='w3-border-0' id="search" onkeyup="myFunction()" placeholder="Search items">
</center></div><br>
<table id="myTable" class="w3-table w3-small w3-striped w3-border-0">
  <?php
 while ($row=mysqli_fetch_assoc($result)) 
 {
  $shopname=$row['shopname'];
  $shoptype=$row['shoptype'];
  $itemdes=$row['itemdes'];
  $fname=$row['fname'];
  $shopprofile=$row['profile'];
  $itemimage=$row['itemimage'];
  $itemname=$row['itemname'];
  $itemprice=$row['itemprice'];
  $currency=$row['currency'];
  $itemper=$row['itemper'];
  $itemsper=$row['itemsper'];
  $noofitems=$row['noofitems'];
  $cost=$row['cost'];
  $dateoforder=$row['datetimebuy'];
  $statusbuy=$row['statusbuy'];
  $sellerid=$row['sellerid'];
  $sno=$row['sno'];
  $sellerphone=$row['phone'];
 ?>
 <tr>
  <?php
  if($statusbuy=='notdelivered')
  {
    $statusfull="Delivered?<br><button type='submit'  class='w3-button w3-round w3-margin-left w3-light-grey  w3-padding-small' name='yes'>yes</button>";
  }
  else
  {
   $statusfull="";
  }
  echo "<form action='deliveryprocess.php' method='post'><input type='text' name='ordereddate' value='$dateoforder'>";
 ?>
 <input type="text" name="itemimage" value="<?php echo $itemimage;?>" style="display: none;">
        <input type="text" name="itemdes" value="<?php echo $itemdes;?>" style="display: none;">
        <input type="text" name="currency" value="<?php echo $currency;?>" style="display: none;">
        <input type="text" name="itemprice" value="<?php echo $itemprice;?>" style="display: none;">
        <input type="text" name="itemper" value="<?php echo $itemper;?>" style="display: none;">
        <input type="text" name="itemname" value="<?php echo $itemname;?>" style="display: none;">
        <input type="text" name="sellerid" value="<?php echo $sellerid;?>" style="display: none;">
        <input type="text" name="shoptype" value="<?php echo $shoptype;?>" style="display: none;">
        <input type="text" name="sno" value="<?php echo $sno;?>" style="display: none;">
 <?php
  echo "<td><img src='sellerprofiles/$shopprofile' class=' w3-round-xxlarge shops' width='60' height='60'><br>$shopname</td><td><img src='fruits/$itemimage'  width='60' height='60'><br>$itemname<br>$itemprice$currency/$itemper</td>
  <td><button type='submit'  class='w3-button w3-round w3-blue w3-text-white w3-padding-small' name='buyagain'>Buy again</button><br>$statusfull<br>$sellerphone</td></tr><tr><td colspan='2'>Your purchase:$noofitems $itemsper   Total cost:$cost</td><td colspan='1'>$dateoforder</td></tr>";
  echo "</form>";
  ?>
 </tr>
 <?php
 }
 ?>
 </table>
 <?php
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>No Purchases Made.</div>";
}
?>

<?php
}//empty
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
</div>
</div>
<script>
  function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>