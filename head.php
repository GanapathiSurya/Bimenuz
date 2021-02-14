<!DOCTYPE html>
<html>
<?php
require 'connection.php';
//error_reporting(0);
?>
<head>
<title> Bimenuz</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<style type="text/css">
/*input
{
  display: none;
}*/
</style>
<body>
  <?php
  require 'titlebar.php';
  ?>
<div class="row">
<div class="col-lg-4 col-sm-12 w3-padding w3-border-right">
    <div class="row w3-padding-small">
      <div class="col ">
        <a href="lotterymain.php" class=" w3-button w3-blue" style="text-decoration:none;border-radius:50%;padding:8px;"><i class="fas fa-ticket-alt w3-text-white" style="color:black;font-size:20px;"></i></a><br>Lottery
      </div>
      <div class="col">
         <a href="shopin.php" class=" w3-button w3-green" style="text-decoration:none;border-radius:50%;padding:8px;"><i class="fas fa-store-alt w3-text-white  " style="font-size:20px;color: black;"></i></a><br>Shopin
      </div>
      <div class="col">
        <a href="sellform.php" class=" w3-button w3-amber" style="text-decoration:none;border-radius:50%;padding:8px;"><i class="fas fa-money-bill-wave w3-text-white " style="color:black;font-size:20px;"></i></a><br>Sellhere
      </div>
    </div>
    <div class="row">
      <div class="col ">
        <a href="liveevents.php" class=" w3-button w3-red" style="text-decoration:none;border-radius:50%;padding:8px;margin-left:5px;"><i class="fa fa-forward w3-text-white" style="font-size:20px;"></i></a><br><font style="margin-left:6px;">Live</font>
      </div>
      <div class="col">
         <a href="deliverieslist.php" class="w3-button w3-orange" style="text-decoration:none;border-radius:50%;padding:8px;"><i class="fa fa-truck w3-text-white" style="font-size:20px;"></i></a><br>Delivery
      </div>
      <div class="col">
        <a href="" class=" w3-button w3-brown" style="text-decoration:none;border-radius:50%;padding:8px;"><i class="fas fa-group w3-text-white" style="color:black;font-size:20px;"></i></a><br>Advice
      </div>
    </div>
    <div class="row">
      <div class="col ">
        <a href="mylists.php" class=" w3-button  w3-light-grey w3-hover-white" style="text-decoration:none;border-radius:50%;padding:8px;margin-left:5px;"><i class="fas fa-sticky-note w3-text-blue" style="font-size:20px;"></i></a><br><font style="margin-left:5px;">MyLists</font>
      </div>
      <div class="col">
         <a href="cartpage.php" class=" w3-button  w3-light-grey w3-hover-white" style="text-decoration:none;border-radius:50%;padding:8px;"><i class="fas fa-cart-plus w3-text-blue" style="font-size:20px;"></i></a><br>MyCart
      </div>
      <div class="col">
        <a href="mypurchases.php" class=" w3-button  w3-light-grey w3-hover-white" style="text-decoration:none;border-radius:50%;padding:8px;"><i class="fas fa-shopping-bag w3-text-blue" style="color:white;font-size:20px;"></i></a><br>MyOrders
      </div>
    </div>
<?php
if (!empty($_SESSION)) 
{
?>
    <!--<div class="input-group w3-margin-top mb-3 container">
      <select  name="searchcategory" class=' w3-border w3-white' >
        <option disabled selected>Search by</option>
        <option value="genstu">General student Uses</option>
        <option value="cseit">CSE/IT student</option>
        <option value="civil">Civil student</option>
        <option value="mech">Mech student</option>
        <option value="eee">EEE student</option>
        <option value="ece">ECE student</option>
        <option value="chemical">Chemical student</option>
        <option value="jee">JeeMain student</option>
       </select>
      <div class="input-group-append">
        <button class="input-group-text w3-button w3-text-white w3-border-0 " style="background-color:rgb(77,166,255);">Go</button>
      </div>
    </div>-->
    
<?php
}
?>
  </div>
  <div class="col-lg-8 col-sm-12 ">
<?php
require 'addedshopslist.php';
?>
</div>
</div>  
<script>
</script>
</body>
</html>