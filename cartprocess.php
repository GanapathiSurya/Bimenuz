<?php
require 'connection.php';
$myname=$_SESSION['firstname'];
if (isset($_POST['cart_add_submit'])) 
{
$itemimage=$_POST['itemimage'];
$currency=$_POST['currency'];
$itemprice=$_POST['itemprice'];
$itemper=$_POST['itemper'];
$itemname=$_POST['itemname'];
$itemdes=$_POST['itemdes'];
$sellerid=$_POST['sellerid'];
$shoptype=$_POST['shoptype'];
$noofitems=$_POST['count'];
$itemsper=$_POST['per'];
if ($itemsper=='gram' && $itemper=='kg') 
{
  $pergram=$itemprice/1000;
  $cost=$pergram *$noofitems;
}
if ($itemsper=='kg' && $itemper=='kg') 
{
  $perkg=$itemprice;
  $cost=$noofitems*$perkg;
}

if ($itemsper=='gram' && $itemper=='gram') 
{
  $pergram=$itemprice;
  $cost=$pergram *$noofitems;
}
if ($itemsper=='kg' && $itemper=='gram') 
{
  $perkg=1000*$itemprice;
  $cost=$noofitems*$perkg;
}
if ($itemsper=='item' && $itemper=='item') 
{
$peritem=$itemprice;
$cost=$noofitems*$peritem;
}
if ($itemsper=='dozen' && $itemper=='item') 
{
$peritem=$itemprice;
$perdozen=12*$peritem;
$cost=$noofitems*$perdozen;
}
if ($itemsper=='item' && $itemper=='dozen') 
{
$peritem=$itemprice/12;
$cost=$noofitems*$peritem;
}
if ($itemsper=='dozen' && $itemper=='dozen' ) 
{
$perdozen=$itemprice;
$cost=$noofitems*$perdozen;
}
echo $cost;
$product_in_cart_exist="select * from cartproducts where itemname='$itemname' and sellerid='$sellerid' and cartadderid='$uid'";
$exist_result=mysqli_query($con,$product_in_cart_exist);
if (mysqli_num_rows($exist_result)>0) 
{
header("Location:productdetails.php?itemimage=".$itemimage."&currency=".$currency."&itemprice=".$itemprice."&itemper=".$itemper."&itemname=".$itemname."&itemdes=".$itemdes."&shoptype=".$shoptype."&sellerid=".$sellerid);
}
else
{
$getsellerdetails="select * from seller where userid='$sellerid'";
$getsellerdetailsresult=mysqli_query($con,$getsellerdetails);
if (mysqli_num_rows($getsellerdetailsresult)>0) 
{
	while ($row=mysqli_fetch_assoc($getsellerdetailsresult)) 
	{
		$shopname=$row['shopname'];
		$shopkeepername=$row['fname'];
		$profile=$row['profile'];
	}
}
date_default_timezone_set("Asia/kolkata");
$datetimeaddcart=date("d-m-Y h:i:sa");
$insertcart="insert into cartproducts values('$itemimage','$currency','$itemprice','$itemper','$itemname','$itemdes','$sellerid','$shopname','$shopkeepername','$profile','$uid','$itemsper','$noofitems','$cost','$datetimeaddcart')";
$insertcartresult=mysqli_query($con,$insertcart);
if ($insertcartresult) 
{
	echo "inserted";
	header("Location:productdetails.php?itemimage=".$itemimage."&currency=".$currency."&itemprice=".$itemprice."&itemper=".$itemper."&itemname=".$itemname."&itemdes=".$itemdes."&shoptype=".$shoptype."&sellerid=".$sellerid);

}
else
{
	echo "not inserted".mysqli_error($con);
}	
}
}
if (isset($_POST['cart_product_remove'])) 
{
$itemname=$_POST['itemname'];
$sellerid=$_POST['sellerid'];
$timeofcartadd=$_POST['datetime'];
echo "string";
echo $itemname;
echo $sellerid;
$product_in_delete="delete  from cartproducts where itemname='$itemname' and sellerid='$sellerid' and cartadderid='$uid' and datetime='$timeofcartadd'";
$delete_result=mysqli_query($con,$product_in_delete);
if ($delete_result) 
{
 header("Location:cartpage.php");
}
else
{
	echo mysqli_error($con);
}
}
if (isset($_POST['cart_products_submit'])) 
{  
$city=$_POST['city'];
$state=$_POST['state'];
$country=$_POST['country'];
$address=$_POST['address'];
$pincode=$_POST['pincode'];
if(empty($city)||empty($state)||empty($country)||empty($address)||empty($pincode))
{
    header("cartpage.php?empty=please fill the blanks");
}
else
{
 
echo $pincode;
echo $address;
	$usercartproducts="select * from cartproducts where cartadderid='$uid'";
	$usercartproductsresult=mysqli_query($con,$usercartproducts);
	if (mysqli_num_rows($usercartproductsresult)>0) 
	{
		$checkdeliver="select * from registration where userid='$uid' and city='$city' and state='$state' and country='$country' and pincode='$pincode' and address='$address'";
     $checkdeliverresult=mysqli_query($con,$checkdeliver);
     if (mysqli_num_rows($checkdeliverresult)==0) 
     {
 	  echo $uid;
 		$addressupdate="update registration set city='$city',state='$state',country='$country',address='$address',pincode='$pincode' where userid='$uid'";
 		$addressupdateresult=mysqli_query($con,$addressupdate);
 		if (!$addressupdateresult) 
 		{
 			echo "63.".mysqli_error($con);
 		}
 	 }
	
		while ($row=mysqli_fetch_assoc($usercartproductsresult)) 
		{
  $itemdes=$row['itemdes'];
  $itemimage=$row['itemimage'];
  $itemname=$row['itemname'];
  $itemprice=$row['itemprice'];
  $currency=$row['currency'];
  $itemper=$row['itemper'];
  $itemdes=$row['itemdes'];
  $sellerid=$row['sellerid'];
  $noofitems=$row['customercount'];
  $itemsper=$row['customerper'];
  $cost=$row['customercost'];
  date_default_timezone_set("Asia/kolkata");
  $datetimebuy=date("d-m-Y h:i:sa");
  $datess=date("d-m-Y");
  $timess=date("h:i:sa");
 //echo "<br>$address";
  $insertbuy="insert into buystatus(userid, username, itemimage, itemdes, itemprice, currency, itemper, itemname, sellerid, noofitems, itemsper, cost, city,pincode, state, country, address, datetimebuy, statusbuy,sellerstatus,datess,timess,good,satisfied,dissatisfied) values('$uid' ,'$myname', '$itemimage','$itemdes', '$itemprice', '$currency', '$itemper', '$itemname', '$sellerid', '$noofitems', '$itemsper','$cost', '$city','$pincode', '$state', '$country', '$address','$datetimebuy','notdelivered','approved','$datess','$timess','0','0','0')";
 	 $insertbuyresult=mysqli_query($con,$insertbuy);
 	 if($insertbuyresult)
 	 {
 	 	echo "helloinsertcartintobuystatus";
 $deleteall="delete from cartproducts where cartadderid='$uid'";
 $deleteallresult=mysqli_query($con,$deleteall);
 	  header("Location:mypurchases.php");
 	 }
 	 else
 	 {
 	 	echo mysqli_error($con);
 	 }
		}
	}
    
}   
}
if (isset($_POST['cart_delete_all'])) 
{
 $deleteall="delete from cartproducts where cartadderid='$uid'";
 $deleteallresult=mysqli_query($con,$deleteall);
 if ($deleteallresult) 
 {
 	header("Location:cartpage.php");
 }
 else
 {

 }
}
?>
