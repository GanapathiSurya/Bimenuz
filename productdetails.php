<!DOCTYPE html>
<html>
<?php
require 'connection.php'?>
<head>
  <title>Product Details</title>
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

</style>
</head>
<body onload="totalbill()">
<?php
require 'titlebar.php';
?>
<div class="row">
<div class="col-lg-9 col-sm-12 w3-border-right">
<?php
if(!empty($_SESSION))
{
$itemimage=$_SESSION['shopitemimage'];
$currency=$_SESSION['shopcurrency'];
$itemprice=$_SESSION['shopitemprice'];
$itemper=$_SESSION['shopitemper'];
$itemname=$_SESSION['shopitemname'];
$itemdes=$_SESSION['shopitemdes'];
$stype=$_SESSION['shopshoptype'];
$sellerid=$_SESSION['shopsellerid']; 

?>
<div class="w3-bar">
<div class="w3-bar-item">
<?php
$getratings="select sum(satisfied),sum(dissatisfied),sum(good) from buystatus where sellerid='$sellerid' and itemname='$itemname' and itemprice='$itemprice' and itemper='$itemper'";
$getratingsres=mysqli_query($con,$getratings);
if (!$getratingsres) 
{
 echo mysqli_error($con);
}
if (mysqli_num_rows($getratingsres)>0) 
{
 while ($row=mysqli_fetch_assoc($getratingsres)) 
 {
   $dissatisfied=$row["sum(dissatisfied)"];
   $satisfied=$row["sum(satisfied)"];
   $good=$row["sum(good)"];
 }
if ($good!=NULL && $dissatisfied!=NULL && $satisfied!=NULL) 
{
//echo "string1";
echo "<div id='piechart_3d'class='' style='border:0px solid black;'>
</div>"; 
}
}
else
{
  echo "string";
}
?>
</div>
<div class="w3-bar-item">
<div class="img-zoom-container" onmouseover="document.getElementById('myresult').style.visibility='visible'" onmouseleave="document.getElementById('myresult').style.visibility='hidden'"> 
<img id="myimage"  src="<?php echo 'fruits/'.$itemimage;?>" width="200" height="200">
</div>
</div> 
<div class="w3-bar-item w3-center">
<?php
echo $itemname."<br>";
echo $itemprice.$currency."/".$itemper."<br>";
echo $itemdes."<br>";
?>
<?php
$product_in_cart_exist="select * from cartproducts where itemname='$itemname' and sellerid='$sellerid' and cartadderid='$uid'";
$existresult=mysqli_query($con,$product_in_cart_exist);
if (mysqli_num_rows($existresult)==0) 
{
  $status="Add to cart";
}
else
{
$status="Added to cart";
}
?>
<center>
  <form action="cartprocess.php" method="post">
  <input type="text" name="itemimage" value="<?php echo $itemimage;?>" style="display: none;"><input type="text" name="currency" value="<?php echo $currency;?>" style="display: none;"><input type="text" name="itemprice" value="<?php echo $itemprice;?>" style="display: none;"><input type="text" name="itemper" value="<?php echo $itemper;?>" style="display: none;"><input type="text" name="itemname" value="<?php echo $itemname;?>" style="display: none;"><input type="text" name="itemdes" value="<?php echo $itemdes;?>" style="display: none;"><input type="text" name="sellerid" value="<?php echo $sellerid;?>" style="display: none;"><input type="text" name="shoptype" value="<?php echo $stype;?>" style="display: none;">
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
<select name='per' id="itemsper" onchange="totalbill()" oninput="totalbill()"><option value='kg'>kg</option><option value='gram' selected>gram</option></select><br>
<?php
}
?>
<p id="finalcost"></p>.
<button class="w3-button w3-round w3-padding w3-hover-text-white w3-hover-black w3-margin-top w3-center w3-amber"  type="submit" name="cart_add_submit"><i class="fa fa-shopping-cart"></i><?php echo $status; ?></button><br>
<a href="cartpage.php" style="text-decoration:underline;color: black">Go to cart</a>
<!--<button class="w3-button w3-round w3-padding w3-amber w3-hover-text-white w3-hover-black w3-margin-top"><i class="fa fa-user"></i>Seek Advice</button>--><br>
</center>
</form>
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
<button class="w3-button w3-round w3-padding w3-blue w3-hover-text-white w3-hover-black w3-margin-top" onclick="buy()" class="w3-button">Buy</button>
<p><b>Cash on delivery available!</b></p>
<?php
$paynumber="select phonepegooglepay from seller where userid='$sellerid'";
$paynumberres=mysqli_query($con,$paynumber);
if (mysqli_num_rows($paynumberres)>0) 
{
while ($row=mysqli_fetch_assoc($paynumberres)) 
{
$phonepegooglepay=$row['phonepegooglepay'];
}
}
if($phonepegooglepay!="")
{
?>
<p><b>ONLINE</b>:GooglePay-<?php echo $phonepegooglepay;?></p>
<?php
}
?>
<div id="deliverydetailsmodal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('deliverydetailsmodal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <form action="deliveryprocess.php" method="post">
        <b>Confirm your Delivery details-</b><br>
        <input type="text" name="itemimage" value="<?php echo $itemimage;?>" style="display: none;">
        <input type="text" name="itemdes" value="<?php echo $itemdes;?>" style="display: none;">
        <input type="text" name="currency" value="<?php echo $currency;?>" style="display: none;">
        <input type="text" name="itemprice" value="<?php echo $itemprice;?>" style="display: none;">
        <input type="text" name="itemper" value="<?php echo $itemper;?>" style="display: none;">
        <input type="text" name="itemname" value="<?php echo $itemname;?>" style="display: none;">
        <input type="text" name="sellerid" value="<?php echo $sellerid;?>" style="display: none;">
        <input type="text" name="shoptype" value="<?php echo $stype;?>" style="display: none;">
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
        <button type="submit" name="deliver_submit" class="w3-btn w3-round-large w3-padding-small" style="background-color: rgb(77,166,255);">Confirm</button>
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
  <div class=" w3-large w3-center w3-padding" id="similarhead">
Similar Shops<i class="fa fa-caret-down w3-margin"></i>
</div>
<div class="w3-padding " style="background-color:rgb(77,166,255);" id="searchdiv">
  <center>
<input type="search" id="searchshop" class="w3-border-0" onkeyup="myFunctions()" placeholder="Search Shops">
</center></div><br>
 <?php
$similarshops="select * from seller ";
$similarshopsresult=mysqli_query($con,$similarshops);
if (mysqli_num_rows($similarshopsresult)>0) 
{
?>
<table id="myTables" class="w3-table  w3-border-0">
  <?php
 while ($row=mysqli_fetch_assoc($similarshopsresult)) 
 {
  $shopname=$row['shopname'];
  $shoptype=$row['shoptype'];
  $fname=$row['fname'];
  $shopkeeperid=$row['userid'];
  $shopprofile=$row['profile'];
  if($shopkeeperid==$sellerid)
  {
    continue;
  }
  $cstype=explode(",", $stype);
  $cshoptype=explode(",", $shoptype);
  $result=array_intersect($cstype,$cshoptype);
  //print_r($result);
  if ($uid==$shopkeeperid||$sellerid==$shopkeeperid||count($result)==0) 
  {
   continue;
  }
 ?>
 <tr class='w3-border-bottom'>
  <?php
  $similaraddcheck="select * from shopaddshortcut where shopkeeperid='$shopkeeperid' and shopname='$shopname' and shoptype='$shoptype' and userid='$uid'";
  $similaraddcheckresult=mysqli_query($con,$similaraddcheck);
  if (mysqli_num_rows($similaraddcheckresult)>0) 
  {
    $variable="Added";
  }
  else
  {
    $variable="Add Shortcut";
  }
  echo "<form action='shopprocess.php' method='post'>
  <input type='text' value='$shopname' name='shopname' style='display: none;'>
  <input type='text' value='$shoptype' name='shoptype' style='display: none;'>
  <input type='text' value='$fname' name='fname' style='display: none;'>
  <input type='text' value='$shopkeeperid' name='shopkeeperid' style='display: none;'>
  <input type='text' value='$shopprofile' name='shopkeeperprofile' style='display: none;'>";
  echo "<td>$shopname<br>$fname<br><button type='submit' value='go' class='w3-button w3-card-1 w3-round w3-padding-small w3-blue' name='shopitemsdisplay' >GO</button><button type='submit'  class='w3-button w3-round w3-margin-left w3-light-grey w3-padding-small' name='addshortcut'>$variable</button></td>";
  echo "<td><img src='sellerprofiles/$shopprofile' class=' w3-round-xxlarge sideshopimage' width='60' height='60' style='border:2px solid rgb(77,166,255)'></td></form>";
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
 echo "<div class='w3-large w3-center w3-margin '>No Similar Shops Yet.</div>"; 
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
itemprice="<?php echo $_SESSION['shopitemprice']?>";
itemper="<?php echo $_SESSION['shopitemper']?>";
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

var totalRowCount = $("#myTables tr").length;
if (totalRowCount==0) 
{
  document.getElementById('similarhead').style.display='none';
  document.getElementById('searchdiv').style.display='none';
}
else
{
  document.getElementById('similarhead').style.display='block';
  document.getElementById('searchdiv').style.display='block';
}
</script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
var dissatisfied=parseInt('<?php echo $dissatisfied; ?>');
var satisfied=parseInt('<?php echo $satisfied; ?>');
var good=parseInt('<?php echo $good; ?>');
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Type', 'Percentages'],
  ['Good',good],
  ['Dissatisfied',dissatisfied],
  ['Satisfied', satisfied]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':180, 'height':100};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  chart.draw(data, options);
}
</script>

</body>
</html>

