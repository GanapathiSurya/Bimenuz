<?php
require 'connection.php';
$myname=$_SESSION['firstname'];
if (isset($_POST['deliver_submit'])) 
{
$city=$_POST['city'];
$state=$_POST['state'];
$country=$_POST['country'];
$address=$_POST['address'];
$pincode=$_POST['pincode'];
$itemimage=$_POST['itemimage'];
$itemdes=$_POST['itemdes'];
$currency=$_POST['currency'];
$itemprice=$_POST['itemprice'];
$itemper=$_POST['itemper'];
$itemname=$_POST['itemname'];
$sellerid=$_POST['sellerid'];
$noofitems=$_POST['noofitems'];
$itemsper=$_POST['pertype'];
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
echo $address;
	if (empty($city)||empty($state)||empty($country)||empty($address)||empty($pincode)) 
	{
    echo "70";
	 header("Location:productdetails.php?empty=please fill all the blanks.");
	}
	else
	{
    echo "75";
     $checkdeliver="select * from registration where userid='$uid' and city='$city' and state='$state' and country='$country' and address='$address' and pincode='$pincode'";
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
 	 date_default_timezone_set("Asia/kolkata");
 	 $datetimebuy=date("d-m-Y h:i:sa");
   $datess=date("d-m-Y");
   $timess=date("h:i:sa");
 	 $insertbuy="insert into buystatus(userid, username, itemimage, itemdes, itemprice, currency, itemper, itemname, sellerid, noofitems, itemsper, cost, city,pincode, state, country, address, datetimebuy, statusbuy,sellerstatus,datess,timess,good,satisfied,dissatisfied) values('$uid' ,'$myname', '$itemimage','$itemdes', '$itemprice', '$currency', '$itemper', '$itemname', '$sellerid', '$noofitems', '$itemsper','$cost', '$city','$pincode' ,'$state', '$country', '$address','$datetimebuy','notdelivered','approved','$datess','$timess','0','0','0')";
 	 $insertbuyresult=mysqli_query($con,$insertbuy);
 	 if($insertbuyresult)
 	 {
 	 	header("Location:mypurchases.php");
 	 }
 	 else
 	 {
 	 	echo mysqli_error($con);
 	 }

	}
}
if (isset($_POST['yes'])) 
{
$datetimebuy=$_POST['ordereddate'];
$sellerid=$_POST['sellerid'];
$sno=$_POST['sno'];
$delivered="update buystatus set statusbuy='delivered' where userid='$uid' and datetimebuy='$datetimebuy' and sno='$sno'";
$deliveredresult=mysqli_query($con,$delivered);
if (!$deliveredresult) 
{
echo mysqli_error($con);
}
else
{
echo "jj";
header("Location:feedback.php?sellerid=".$sellerid."&sno=".$sno);	
}
}


if (isset($_POST['buyagain'])) 
{
  $shoptype=$_POST['shoptype'];
  $itemdes=$_POST['itemdes'];
  $itemimage=$_POST['itemimage'];
  $itemname=$_POST['itemname'];
  $itemprice=$_POST['itemprice'];
  $currency=$_POST['currency'];
  $itemper=$_POST['itemper'];
  $sellerid=$_POST['sellerid'];
  
$_SESSION['shopitemimage']=$itemimage;
$_SESSION['shopcurrency']=$currency;
$_SESSION['shopitemprice']=$itemprice;
$_SESSION['shopitemper']=$itemper;
$_SESSION['shopitemname']=$itemname;
$_SESSION['shopitemdes']=$itemdes;
$_SESSION['shopshoptype']=$shoptype;
$_SESSION['shopsellerid']=$sellerid;
  header("Location:productdetails.php");
}
?>