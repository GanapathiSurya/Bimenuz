<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
  <title>Fest Product Details</title>

<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
* {box-sizing: border-box;}

.img-zoom-container {
  position: relative;
}

.img-zoom-lens {
  position: absolute;
  border: 1px solid #d4d4d4;
  width: 40px;
  height: 40px;
}

.img-zoom-result {
  border: 1px solid #d4d4d4;
  /*set the size of the result div:*/
  width: 300px;
  height: 300px;
}
@media screen and (max-width:1200px)
{
#myresult
{
display:none;
}
.img-zoom-lens
{
  display: none;
}
}
@media screen and (min-width:1200px)
{
  .img-zoom-lens
  {
    display: block;
  }
}

@media screen and (min-width:1000px)
{
#searchdiv
  {
    background-color:#f2f2f2;
  } 
}
@media screen and (max-width:800px)
{
  #searchdiv
  {
    background-color:rgb(77,166,255);
  }
  #name
  {
    display: none;
  }
 /* #addsearch
  {
    background-color: rgb(77,166,255);
  }*/
}
</style>
</head>
<body onload="totalbill()">
<?php
require 'titlebar.php';
?>
<?php
if(!empty($_SESSION))
{
?> 

<div class="row">
<div class="col-lg-9 col-sm-12 w3-border-right">
<div class="w3-bar">
<div class="w3-bar-item">
<div class="img-zoom-container" onmouseover="document.getElementById('myresult').style.visibility='visible'" onmouseleave="document.getElementById('myresult').style.visibility='hidden'"> 
<?php

$itemimage=$_SESSION['festshopitemimage'];
$currency=$_SESSION['festshopcurrency'];
$itemprice=$_SESSION['festshopitemprice'];
$itemper=$_SESSION['festshopitemper'];
$itemname=$_SESSION['festshopitemname'];
$festerid=$_SESSION['festfesterid'];
$festshopperid=$_SESSION['festfestshopperid'];

?>
<img id="myimage"  src="<?php echo 'festproducts/'.$itemimage;?>" width="200" height="200">
</div>
</div> 
<div class="w3-bar-item w3-center">
<?php
echo $itemname."<br>";
echo $itemprice.$currency."/".$itemper."<br>";
?>
<?php
/*
$festproduct_in_cart_exist="select * from cartproducts where itemname='$itemname' and festerid='$festerid' and cartadderid='$uid'";
$existresult=mysqli_query($con,$product_in_cart_exist);
if (mysqli_num_rows($existresult)==0) 
{
  $status="Add to cart";
}
else
{
$status="Added to cart";
}*/
?>
<center>
 <!-- <form action="cartprocess.php" method="post">
  <input type="text" name="itemimage" value="<?php echo $itemimage;?>" style="display: none;"><input type="text" name="currency" value="<?php echo $currency;?>" style="display: none;"><input type="text" name="itemprice" value="<?php echo $itemprice;?>" style="display: none;"><input type="text" name="itemper" value="<?php echo $itemper;?>" style="display: none;"><input type="text" name="itemname" value="<?php echo $itemname;?>" style="display: none;"><input type="text" name="itemdes" value="<?php echo $itemdes;?>" style="display: none;"><input type="text" name="sellerid" value="<?php echo $sellerid;?>" style="display: none;"><input type="text" name="shoptype" value="<?php echo $shoptype;?>" style="display: none;">-->
<?php
if($itemper=='item'|| $itemper=='dozen')
{
?>
<b>Number of items</b><br>
<input type='number' class='w3-margin-right' name='count' required style='width:50px;' value='1' oninput='this.value = Math.abs(this.value)' id='noofitems' oninput="totalbill()" onchange="totalbill()">
<select name='per' id="itemsper" onchange="totalbill()" oninput="totalbill()"><option value='dozen'>dozen</option><option value='item' selected>item</option></select><br>
<?php
}
elseif($itemper=='kg' || $itemper=='gram')
{
  ?>
<b>Number of kgs/gms</b><br>
<input type='number' class='w3-margin-right' name='count' required style='width:50px;' value='1' min='1' oninput='this.value = Math.abs(this.value)' id='noofitems' oninput="totalbill()" onchange="totalbill()">
<select name='per' id="itemsper" onchange="totalbill()" oninput="totalbill()"><option value='kg'>kg</option><option value='gram' selected>gram</option></select>
<?php
}
?>
<p id="finalcost"></p>.
<!--
<button class="w3-button w3-round w3-padding w3-hover-text-white w3-hover-black w3-margin-top w3-center w3-amber"  type="submit" name="cart_add_submit"><i class="fa fa-shopping-cart"></i><?php echo $status; ?></button><br>-->
<!--<button class="w3-button w3-round w3-padding w3-amber w3-hover-text-white w3-hover-black w3-margin-top"><i class="fa fa-user"></i>Seek Advice</button>--><br>
</center>
<!--</form>-->
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
<button class="w3-button w3-round w3-padding w3-blue w3-text-white w3-hover-black w3-margin-top" onclick="buy()" class="w3-button">Buy</button>
<p><b>Cash on delivery available!</b></p>

<div id="deliverydetailsmodal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('deliverydetailsmodal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <form action="festdeliveryprocess.php" method="post">
        <b>Confirm your Delivery details-</b><br>
        <input type="text" name="itemimage" value="<?php echo $itemimage;?>" style="display: none;">
        <input type="text" name="currency" value="<?php echo $currency;?>" style="display: none;">
        <input type="text" name="itemprice" value="<?php echo $itemprice;?>" style="display: none;">
        <input type="text" name="itemper" value="<?php echo $itemper;?>" style="display: none;">
        <input type="text" name="itemname" value="<?php echo $itemname;?>" style="display: none;">
        <input type="text" name="festerid" value="<?php echo $festerid;?>" style="display: none;">
        <input type="text" name="festshopperid" value="<?php echo $festshopperid;?>" style="display: none;">
        <input type="text" name="noofitems" id='usernoofitems' readonly>
        <input type="text" name="pertype" id='useritemsper' readonly ><br>Total:
        <p id="modalfinalcost"></p>
        <b>City</b><br>
        <input type="text" name="city" class="w3-input w3-border" value="<?php echo $city;?>">
        <b>Pincode</b><br>
        <input type="number" name="pincode" class="w3-input w3-border" value="<?php echo $pincode;?>">
        <b>State</b><br>
        <input type="text" name="state" class="w3-input w3-border" value="<?php echo $state;?>">
        <b>Country</b><br>
        <input type="text" name="country" class="w3-input w3-border" value="<?php echo $country;?>">
        <b>Delivery location</b><br>
        <textarea name="address" cols="30" rows="5" class="w3-border">
        <?php echo $address;?>
        </textarea><br>
        <button type="submit" name="fest_deliver_submit" class="w3-btn w3-round-large w3-padding-small" style="background-color: rgb(77,166,255);">Confirm</button>
      </form>
    </div>
  </div>
</div>
</div>
<div class="w3-bar-item">
<div id="myresult" class="img-zoom-result" style="visibility:hidden;"></div>
</div> 
</div>
</div>
<div class="col-lg-3 col-sm-12 w3-border-right">
<?php
if (empty($_SESSION)) 
{
echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>"; 
}
else
{
 $festshops="select * from festshopperdetails where festerid='$festerid' and festshopname!='NULL' and festshopperid!='$festshopperid'";
 $festshopsresult=mysqli_query($con,$festshops);
if (mysqli_num_rows($festshopsresult)>0) 
 {
 ?>
<div class="w3-padding " id='searchdiv'>
  <center>
<input type="search" class='w3-border-0' id="searchshop" onkeyup="myFunctions()" placeholder="Search Other shops..">
</center></div>
 <table class="table w3-border-0 w3-large" id="myTables">
 <?php
  while ($row=mysqli_fetch_assoc($festshopsresult)) 
  {   
      $festshopname=$row['festshopname'];
      $festshopperid=$row['festshopperid'];
      $festshoppername=$row['festshoppername']; 
      $festerid=$row['festerid'];
      $festshopperphone=$row['festshopperphone'];
      ?>
      <tr class="w3-border-bottom"><form action="eventprocess.php" method='post'>
      <input type="text" name="festerid" value="<?php echo $festerid;?>" style="display: none;">
      <input type="text" name="festshopperid" value="<?php echo $festshopperid;?>" style="display: none;">
      <input type="text" name="festshoppername" value="<?php echo $festshoppername;?>" style="display: none;">
      <input type="text" name="festshopname" value="<?php echo $festshopname;?>" style="display: none;">
      <input type="text" name="festshopperphone" value="<?php echo $festshopperphone;?>" style="display: none;">
      <td><?php echo "<span style='font-family:pristina;' class='w3-xxlarge'>".$festshopname."</span><br>".$festshoppername;?></td><td><button type="submit" class="w3-button w3-green w3-padding-small w3-round" name="festshopperproducts">Go</button></td>
      </form></tr>
      <?php     
  }
  ?>
  <!--<i class='fas fa-store-alt w3-text-green'></i>-->
 </table>
<?php
}
}
?>  

</div>
</div>
<?php
}
else
{
echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
<script type="text/javascript">
imageZoom("myimage", "myresult");
function imageZoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  /*create lens:*/
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /*insert lens:*/
  img.parentElement.insertBefore(lens, img);
  /*calculate the ratio between result DIV and lens:*/
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /*set background properties for the result DIV:*/
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
  /*execute a function when someone moves the cursor over the image, or the lens:*/
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  /*and also for touch screens:*/
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);
  function moveLens(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image:*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    /*calculate the position of the lens:*/
    x = pos.x - (lens.offsetWidth / 2);
    y = pos.y - (lens.offsetHeight / 2);
    /*prevent the lens from being positioned outside the image:*/
    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
    if (x < 0) {x = 0;}
    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
    if (y < 0) {y = 0;}
    /*set the position of the lens:*/
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /*display what the lens "sees":*/
    result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}
function myFunctions() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchshop");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTables");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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
function buy()
{
document.getElementById('deliverydetailsmodal').style.display='block';
var a=document.getElementById('noofitems').value;
document.getElementById('usernoofitems').value=a;
var b=document.getElementById('itemsper').value;
document.getElementById('useritemsper').value=b;
}
function totalbill()
{
var itemprice,itemper,pergram,perkg,tbitemsper,tbnoofitems,tbcost,peritem,perdozen;
var tbnoofitems=document.getElementById('noofitems').value; 
var tbitemsper=document.getElementById('itemsper').value;
var currency="<?php echo $currency;?>";
itemprice="<?php echo $_SESSION['festshopitemprice']?>";
itemper="<?php echo $_SESSION['festshopitemper']?>";
var tbcost="";
if (tbitemsper=='gram' && itemper=='kg') 
{
  pergram=itemprice/1000;
  tbcost=pergram *tbnoofitems;
}
if (tbitemsper=='kg' && itemper=='kg') 
{
  perkg=itemprice;
  tbcost=tbnoofitems*perkg;
}

if (tbitemsper=='gram' && itemper=='gram') 
{
  pergram=itemprice;
  tbcost=pergram *tbnoofitems;
}
if (tbitemsper=='kg' && itemper=='gram') 
{
  perkg=1000*itemprice;
  tbcost=tbnoofitems*perkg;
}
if (tbitemsper=='item' && itemper=='item') 
{
peritem=itemprice;
tbcost=tbnoofitems*peritem;
}
if (tbitemsper=='dozen' && itemper=='item') 
{
peritem=itemprice;
perdozen=12*peritem;
tbcost=tbnoofitems*perdozen;
}
if (tbitemsper=='item' && itemper=='dozen') 
{
peritem=itemprice/12;
tbcost=tbnoofitems*peritem;
}
if (tbitemsper=='dozen' && itemper=='dozen' ) 
{
perdozen=itemprice;
tbcost=tbnoofitems*perdozen;
}
document.getElementById('finalcost').innerHTML=currency+tbcost;
document.getElementById('modalfinalcost').innerHTML=currency+tbcost;
}
</script>
</body>
</html>

