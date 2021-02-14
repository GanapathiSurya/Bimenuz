<?php
require 'connection.php';
$myname=$_SESSION['firstname'];
if (isset($_POST['fest_deliver_submit'])) 
{
$city=$_POST['city'];
$state=$_POST['state'];
$country=$_POST['country'];
$address=$_POST['address'];
$pincode=$_POST['pincode'];
$itemimage=$_POST['itemimage'];
$currency=$_POST['currency'];
$itemprice=$_POST['itemprice'];
$itemper=$_POST['itemper'];
$itemname=$_POST['itemname'];
$festerid=$_POST['festerid'];
$festshopperid=$_POST['festshopperid'];
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
	 header("Location:festproductdetails.php?empty=please fill all the blanks.");
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
 	 $insertbuy="insert into festbuystatus(userid, username, itemimage, itemprice, currency, itemper, itemname, festerid,festshopperid, noofitems, itemsper, cost, city,pincode, state, country, address, datetimebuy,status) values('$uid' ,'$myname', '$itemimage','$itemprice', '$currency', '$itemper', '$itemname', '$festerid','$festshopperid', '$noofitems', '$itemsper','$cost', '$city','$pincode' ,'$state', '$country', '$address','$datetimebuy','notdelivered')";
 	 $insertbuyresult=mysqli_query($con,$insertbuy);
 	 if($insertbuyresult)
 	 {
 	 	$getfestshopperdetails="select * from festshopperdetails where festerid='$festerid' and festshopperid='$festshopperid'";
    $getfestshopperdetailsres=mysqli_query($con,$getfestshopperdetails);
    if (mysqli_num_rows($getfestshopperdetailsres)>0) 
    {
      while ($row=mysqli_fetch_assoc($getfestshopperdetailsres)) 
      {
        $festshopname=$row['festshopname'];
        $festshoppername=$row['festshoppername'];
        $festshopperphone=$row['festshopperphone'];
      }
 header("Location:festshopitemsdisplay.php?festerid=".$festerid."&festshopperid=".$festshopperid."&festshopname=".$festshopname."&festshoppername=".$festshoppername."&festshopperphone=".$festshopperphone);
    }
 	 }
 	 else
 	 {
 	 	echo mysqli_error($con);
 	 }

	}
}
?>
<?php
if (isset($_POST['delete_fest_order'])) 
{
  echo "string";
  $festerid=$_POST['festerid'];
  $sno=$_POST['sno'];
  $delete_fest_order="delete from festbuystatus where sno='$sno'";
  $delete_fest_order_res=mysqli_query($con,$delete_fest_order);
  header("Location:festorderstoseller.php?festerid=".$festerid);
}
?>