<?php
require 'connection.php';
if (isset($_POST['addshortcut'])) 
{
 $shopname=$_POST['shopname'];
 $shopkeepername=$_POST['fname'];
 $shopkeeperid=$_POST['shopkeeperid'];
 $shoptype=$_POST['shoptype'];
 $profile=$_POST['shopkeeperprofile'];
 $uid=$_SESSION['userid'];
 $check="select * from shopaddshortcut where shopkeeperid='$shopkeeperid' and shopname='$shopname' and shoptype='$shoptype' and userid='$uid' and shopkeepername='$shopkeepername'";
 $checkresult=mysqli_query($con,$check);
 //echo mysqli_num_rows($checkresult);
 if (mysqli_num_rows($checkresult)>0) 
 {
 	
    header("Location:shopin.php");
 }
 else
 {
 $sql="insert into shopaddshortcut values('$uid','$shopkeepername','$shopname','$shopkeeperid','$shoptype','$profile')";
 $result=mysqli_query($con,$sql);
 if ($result) 
 {
 	header("Location:shopin.php");
 }
 else
 {
 	echo mysqli_error($con);
 }
}
}
if (isset($_POST['remove'])) {
	$shopname=$_POST['shopname'];
	$shopkeepername=$_POST['shopkeepername'];
	$shoptype=$_POST['shoptype'];
	$shopkeeperid=$_POST['shopkeeperid'];
	$uid=$_SESSION['userid'];
	$sql="delete from shopaddshortcut where shopname='$shopname' and shopkeepername='$shopkeepername' and shopkeeperid='$shopkeeperid' and shoptype='$shoptype' and userid='$uid'";
	$del=mysqli_query($con,$sql);
	if ($del) {
	echo mysqli_error($con);
	}
	header("Location:head.php");
}
if (isset($_POST['shopitemsdisplay'])) 
{
	$sellerid=$_POST['shopkeeperid'];
	header("Location:shopitemsdisplay.php?id=$sellerid");
}
?>