<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>Cart Page</title> 
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	th
  	{
  		background-color: rgb(77,166,255);
  	}
  	input[type=text]
  	{
  		display: none;
  	}
    a
    {
      text-decoration:underline;
    }
    th
    {
      color:white;
    }
</style>
</head>
<body>
<?php
require 'titlebar.php';
?>
<div class="row">
<div class="col-lg-4 col-sm-12 w3-border-right">
<?php
if (!empty($_SESSION)) 
{
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
 $countitem=0;
$number="select * from cartproducts where cartadderid='$uid'";
$numberresult=mysqli_query($con,$number);
if (mysqli_num_rows($numberresult)>0) 
{
  while ($row=mysqli_fetch_assoc($numberresult)>0) 
  {
    $countitem=$countitem+1;
  }
} 
echo "<form action='cartprocess.php' method='post'>";
if ($countitem!=0) 
{
echo "<div class='w3-margin w3-left w3-small'>My Cart<span class='w3-badge'>$countitem</span></div>";
echo "<button class='w3-light-grey w3-padding w3-small w3-border-0 w3-round w3-margin w3-right' name='cart_delete_all'>Empty Cart</button>"; 
}
echo "</form>";
$mycart="select * from cartproducts where cartadderid='$uid'";
$mycartresult=mysqli_query($con,$mycart);
if (mysqli_num_rows($mycartresult)>0) 
{
  $total=0;
  $countitems=0;
?>
<table id="myTable" class="w3-table w3-small  w3-border-0">
  <tr><th>Item</th><th>Details</th><th>Shop</th></tr>
<?php
 while ($row=mysqli_fetch_assoc($mycartresult)) 
 {
  $itemimage=$row['itemimage'];
    $itemname=$row['itemname'];
    $sellerid=$row['sellerid'];
    $sellerprofile=$row['sellerprofile'];
    $shopname=$row['shopname'];
    $shopkeepername=$row['shopkeepername'];
    $itemdes=$row['itemdes'];
    $itemprice=$row['itemprice'];
    $itemper=$row['itemper'];
    $currency=$row['currency'];
    $datetime=$row['datetime'];
    $cost=$row['customercost'];
    $per=$row['customerper'];
    $count=$row['customercount'];
    $total=$total+$cost;
    $countitems=$countitems+1;
 ?>
  <tr class="w3-border-bottom">
  <!--<td class='w3-border-0'><img src='sellprofiles/$sellerprofile' class=' w3-round-xxlarge' width='60' height='60'></td>-->
  <?php
  echo "<form action='cartprocess.php' method='post'>";
  echo "<input type='text' name='itemname' value='$itemname'><input type='text' name='sellerid' value='$sellerid'><input type='text' name='datetime' value='$datetime'>";
  echo "<td class='w3-border-0'><img src='fruits/$itemimage' class=' w3-round-xxlarge' width='60' height='60'></td><td class='w3-border-0'>$itemname<br>$itemprice$currency/$itemper</td><td class='w3-border-0'>$shopname<br>$shopkeepername<br></td></tr>
     <tr><td colspan='1'>Number of items:$count$per Cost:$cost</td><td class='w3-border-0' colspan='2'><button type='submit'  class='w3-button w3-red w3-text-white w3-round w3-padding-small' name='cart_product_remove'>Remove</button></td></tr>";
  echo "</form>";
  ?>
 </tr>
 <?php
 }
 echo "<tr><td></td><td><b>Number of items:$countitems</b></td><td align='center'><b>Total:$total$currency.</b></td></tr>";
 ?>
 </table>
 <?php
echo "<button type='submit' style='background-color:rgb(77,166,255)' class='w3-button w3-block w3-padding   w3-round w3-padding-small ' onclick='buy()'><font>Buy</font></button>";
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>Cart is Empty!..</div>";
}
}//empty
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
<br><br>
</div>
</div>
<div id="deliverydetailsmodal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('deliverydetailsmodal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
<?php
$autoaddress="select * from registration where userid='$uid'";
$autoaddressresult=mysqli_query($con,$autoaddress);
if(mysqli_num_rows($autoaddressresult)>0)
{
  while($row=mysqli_fetch_assoc($autoaddressresult))
  {
   $city=$row['city'];
   $address=$row['address'];
   $state=$row['state'];
   $country=$row['country'];
   $pincode=$row['pincode'];
  }
}
else
{
   $city="";
   $address="";
   $state="";
   $country="";
   $pincode="";
}

?>
      <form action="cartprocess.php" method="post">
        <b>Confirm the details-</b><br>
        No.of items:<input type="text" name="noofitems" id='usernoofitems' readonly style="display: block;">
        Total cost:<input type="text" name="total" id='usercost' readonly style="display: block;"><br>
        <b>City</b><br>
        <input type="text" name="city" class="w3-input" value="<?php echo $city;?>" style="display: block;" required>
        <b>Pincode</b><br>
        <input type="number" name="pincode" class="w3-input" value="<?php echo $pincode;?>" style="display: block;" required>
        <b>State</b><br>
        <input type="text" name="state" class="w3-input" value="<?php echo $state;?>" style="display: block;" required>
        <b>Country</b><br>
        <input type="text" name="country" class="w3-input" value="<?php echo $country;?>" style="display: block;" required>
        <b>Delivery location</b><br>
        <textarea name="address" cols="30" rows="5" required>
        <?php echo $address;?>
        </textarea><br>
        <button type="submit" name="cart_products_submit" class="w3-btn w3-round-large w3-padding-small" style="background-color: rgb(77,166,255);">Confirm</button>
      </form>
    </div>
  </div>
</div>

<script>
function buy()
{
document.getElementById('deliverydetailsmodal').style.display='block';
var a="<?php echo $countitems;?>";
document.getElementById('usernoofitems').value=a;
var c="<?php echo $total.$currency?>";
document.getElementById('usercost').value=c;
}
</script>
</body>
</html>

