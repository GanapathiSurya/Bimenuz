<?php
//ob_start();
require 'connection.php';
$uid=$_SESSION['userid'];
if (isset($_POST['product_detail_submit'])) 
{
$itemimage=$_POST['itemimage'];
$currency=$_POST['currency'];
$itemdes=$_POST['itemdes'];
$itemprice=$_POST['itemprice'];
$itemper=$_POST['itemper'];
$itemname=$_POST['itemname'];
$shoptype=$_POST['shoptype'];
echo $itemper;
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
if (isset($_POST['fest_product_detail_submit'])) 
{
$itemimage=$_POST['itemimage'];
$currency=$_POST['currency'];
$itemprice=$_POST['itemprice'];
$itemper=$_POST['itemper'];
$itemname=$_POST['itemname'];
$festerid=$_POST['festerid'];
$festshopperid=$_POST['festshopperid'];

$_SESSION['festshopitemimage']=$itemimage;
$_SESSION['festshopcurrency']=$currency;
$_SESSION['festshopitemprice']=$itemprice;
$_SESSION['festshopitemper']=$itemper;
$_SESSION['festshopitemname']=$itemname;
$_SESSION['festfesterid']=$festerid;
$_SESSION['festfestshopperid']=$festshopperid;
header("Location:festproductdetails.php");

}
?>