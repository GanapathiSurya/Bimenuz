<?php
require 'connection.php';
if (isset($_POST['deliverownsubmit'])) 
{
$title=$_POST['title'];
$start=$_POST['start'];
$end=$_POST['end'];
$price=$_POST['price'];
//$per=$_POST['per'];
$insert="insert into bimenuzdeliveries(title,fromlocation,tolocation,price,name,phone,userid) values('$title','$start','$end','$price','$myname','$myphone','$uid')";
$insertres=mysqli_query($con,$insert);
if ($insertres) 
{
	header("Location:deliverieslist.php");
}
else
{
	echo mysqli_error($con);
}
}
if (isset($_POST['give_submit'])) 
{
$title=$_POST['title'];
$deliveryid=$_POST['id'];
$number=$_POST['number'];
$price=$_POST['price'];
$ownerid=$_POST['ownerid'];
$cost=$number*$price;
date_default_timezone_set("Asia/Kolkata");
$datetime= date("d m Y h:i:sa");
$insert="insert into deliveryreg(deliveryid,title,name,phone,userid,number,price,cost,status,picked,datetime,ownerid) values('$deliveryid','$title','$myname','$myphone','$uid','$number','$price','$cost','no','no','$datetime','$ownerid')";
$insertsql=mysqli_query($con,$insert);
if ($insertsql) 
{
header("Location:deliverieslist.php");
}
else
{
echo mysqli_error($con);
}
}
if (isset($_POST['pick'])) 
{
$deliveryid=$_POST['deliveryid'];
$userid=$_POST['userid'];
$datetime=$_POST['datetime'];
$updatepick="update deliveryreg set picked='yes' where userid='$userid' and ownerid='$uid' and deliveryid='$deliveryid' and datetime='$datetime'";
$updatepickres=mysqli_query($con,$updatepick);
if ($updatepickres)
{
	header("Location:mydeliveries.php");
}
else
{
	echo mysqli_error($con);
}
}

if (isset($_POST['deliver'])) 
{
$deliveryid=$_POST['deliveryid'];
$userid=$_POST['userid'];
$datetime=$_POST['datetime'];
$updatedel="update deliveryreg set status='yes' where userid='$userid' and ownerid='$uid' and deliveryid='$deliveryid' and datetime='$datetime'";
$updatedelres=mysqli_query($con,$updatedel);
if ($updatedelres)
{
	header("Location:mydeliveries.php");
}
}

if (isset($_POST['enddelivery'])) 
{
$deliveryid=$_POST['deliveryid'];
$deletedel="delete from bimenuzdeliveries where userid='$uid'";
$deletedelres=mysqli_query($con,$deletedel);
$deletedels="delete from deliveryreg where ownerid='$uid'";
$deletedelsres=mysqli_query($con,$deletedels);
if ($deletedelres && $deletedelsres) 
{
header("Location:deliverieslist.php");
}
}
?>