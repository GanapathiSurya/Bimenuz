<!DOCTYPE html>
<html>
<?php 
require 'connection.php';
?>
<head>
<title>Shopitemsdisplay</title>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <style type="text/css">
  td
  {
  	border:none;
  }
  input[type=text]
  {
    display:none;
  }
  .sideshopimage
  {
    border:2px solid rgb(77,166,255);
  }
  </style>
</head>
<body>
<?php
require 'titlebar.php';
?>
<?php
if (!empty($_SESSION)) 
{
?>
<div class="row">
<div class="col-lg-9  col-sm-12 w3-border-right">
<div class="w3-bar w3-border-bottom">
<?php
$sellerid=$_GET['id'];
$sql="select * from seller where userid='$sellerid'";
$result=mysqli_query($con,$sql);
if (mysqli_num_rows($result)>0) 
{
while ($row=mysqli_fetch_assoc($result)) 
{
$shopname=$row['shopname'];
$city=$row['city'];
$state=$row['state'];
$stype=$row['shoptype'];
$fname=$row['fname'];
$phone=$row['phone'];
$shopkeeperid=$row['userid'];
}
?>
<div class="w3-bar-item">
<img src="sellerprofiles/<?php echo $_GET['id'];?>" width='70' height='70' style="border:2px solid rgb(77,166,255);border-radius: 50%;">    
</div>
<div class="w3-bar-item">
<?php
echo "<b>$shopname</b><br>";
echo $fname."<br>";
echo "<i class='fa fa-map-marker w3-text-red'></i>$city<br>$state<br>";
echo "<i class='fa fa-phone w3-text-green'></i>$phone";
}
?>
<!--<a href="accountsettings.php">
<div class="w3-padding" style="background-color:rgb(77,166,255);width:50px;height:48px;color:white;border-radius:50%"><i class="fa fa-pencil" aria-hidden="true" style="font-size:20px;"></i>
</div>
</a>--> 
</div>
<div class="w3-bar-item">
<button onclick="document.getElementById('ratings').style.display='block'"
class="w3-button w3-hover-white"><i class="fa fa-pie-chart w3-text-blue w3-xxlarge"></i></button>
</div>
</div>
<div id="ratings" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <button onclick="document.getElementById('ratings').style.display='none'"
      class="w3-button w3-red w3-margin-top">CLOSE</button>
      
<?php
$sellerid=$_GET['id'];
$shoprat="select * from ratings where sellerid='$sellerid'";
$shopratres=mysqli_query($con,$shoprat);
if(mysqli_num_rows($shopratres)>0)
{
while($row=mysqli_fetch_assoc($shopratres))
{
  $satisfied=$row['satisfied'];
  $dissatisfied=$row['dissatisfied'];
  $good=$row['good'];
}
?>
<div id="piechart_3d"></div>
<?php
}
else
{
  echo "<h6>Ratings of this shop is still not available.</h6>";
}
?>
    </div>
  </div>
</div>
<div class="container">
<center>
<button class="w3-button w3-light-grey w3-hover-light-grey w3-border-0 w3-round  w3-margin" data-toggle="collapse" data-target="#list" style="outline: none;font-size:17px;"><i class="fa fa-edit"></i>List</button>
<!--<button class="w3-button w3-round w3-light-grey w3-margin-right" title="You will be notified when shopkeeper uploaded any new item.">Subscribe</button>
<button class="w3-button w3-round w3-light-grey w3-margin-right" title="Convey what you want">Chat</button>
<button class="w3-button w3-round w3-light-grey"  title="share link"><i class="fa fa-share"></i></button>-->
<a href="whatsapp://send?text=asssail.000webhostapp.com/shopitemsdisplay.php?id=<?php echo $sellerid;?>" data-action="share/whatsapp/share" class="w3-button w3-round"><i class="fab fa-whatsapp-square " style='font-size:40px;color:rgb(77,166,255)'></i></a>
</center>
<div class="collapse" id="list">
<form action="uploadlist.php" method="post" class="w3-margin" enctype="multipart/form-data">
  <input type="text" name="sellerid" style="display:none;" value="<?php echo $sellerid;?>">
<input type="file" name="list" id="listtoUpload">
<button class="w3-button w3-blue w3-padding-small w3-margin w3-round" type="submit" name="list_submit">Send</button>
</form>
</div>
</div>
<?php
$stock = "SELECT * FROM sellproducts where userid='$sellerid'";
$stockresult = mysqli_query($con,$stock);
if(!$stockresult) 
{
  echo "error is".mysqli_error($con);
}
if (mysqli_num_rows($stockresult) > 0) 
{
?>
 <div class="w3-padding " style="background-color:rgb(77,166,255);position:sticky;top:0px;">
<center>
<input type="search" id="search" onkeyup="myFunction()" placeholder="Search items" class="w3-border-0">
</center></div><br>
  <table id="myTable" class="w3-table w3-striped w3-border-0">
  <?php
 while ($row=mysqli_fetch_assoc($stockresult)) 
 {
    $itemname=$row['itemtitle'];
    $itemdes=$row['itemdescription'];
    $itemprice=$row['itemprice'];
    $itemper=$row['per'];
    $itemimage=$row['image'];
    $currency=$row['itemcurrency'];
    $sellerid=$row['userid'];
 ?>
 <tr>
  <?php
  echo "<form action='productdetailsprocess.php' method='post'><input type='text' name='itemname' value='$itemname'><input type='text' name='itemdes' value='$itemdes'><input type='text' name='itemprice' value='$itemprice'><input type='text' name='itemper' value='$itemper'><input type='text' name='itemimage' value='$itemimage'><input type='text' name='currency' value='$currency'><input type='text' name='shoptype' value='$stype'><input type='text' name='sellerid' value='$sellerid'>";
  echo "<td class='w3-border-0'><img src='fruits/$itemimage' class='' width='60' height='60'></td><td class='w3-border-0'>$itemname<br>$itemprice$currency/$itemper</td><td class='w3-border-0'><button type='submit' value='go' class='w3-button w3-blue w3-card-1 w3-round w3-padding-small' name='product_detail_submit'>GO</button></a></td>";
  echo "</form>";
  ?>
 </tr>
 <?php
 }
 ?>
 </table>
 <hr>
 <?php
}
else
{
  echo "<div class='w3-large w3-center w3-margin '>No Products Added</div>";
}
?>
</div>
<div class="col-lg-3 col-sm-12 w3-border-left">
<div class=" w3-large w3-center w3-padding" id="similarhead">
Similar Shops<i class="fa fa-long-arrow-down w3-margin"></i>
</div>
<div class="w3-padding " style="background-color:rgb(77,166,255);" id="searchdiv">
  <center>
<input type="search" id="searchshop" class="w3-border-0" onkeyup="myFunctions()" placeholder="Search Shops">
</center></div><br>
<?php
$similarshops="select * from seller";
$similarshopsresult=mysqli_query($con,$similarshops);
if (mysqli_num_rows($similarshopsresult)>0) 
{
  ?>
<table id="myTables" class="w3-table w3-border-0">
  <?php
 while ($row=mysqli_fetch_assoc($similarshopsresult)) 
 {
  $shopname=$row['shopname'];
  $shoptype=$row['shoptype'];
  $fname=$row['fname'];
  $shopkeeperid=$row['userid'];
  $shopprofile=$row['profile'];
  $cstype=explode(",", $stype);
  $cshoptype=explode(",", $shoptype);
  $result=array_intersect($cstype,$cshoptype);
  //print_r($result);
  if ($uid==$shopkeeperid||$sellerid==$shopkeeperid||count($result)==0) 
  {
   continue;
  }
  /*$countcheck=0;
  foreach ($cshoptype as $value) 
  {
    if (in_array($value, $cstype)) 
    {
      $countcheck=$countcheck+1;
    }
  }
  if ($countcheck==0) 
  {
    echo "hj";
    continue;
  }*/
 ?>
 <tr class='w3-border-bottom'>
  <?php
  $similaraddcheck="select * from shopaddshortcut where shopkeeperid='$shopkeeperid' and userid='$uid'";
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
  <input type='text' value='$shopname' name='shopname'>
  <input type='text' value='$shoptype' name='shoptype'>
  <input type='text' value='$fname' name='fname'>
  <input type='text' value='$shopkeeperid' name='shopkeeperid'>
  <input type='text' value='$shopprofile' name='shopkeeperprofile'>";
  echo "<td>$shopname<br>$fname<br><button type='submit' value='go' class='w3-button w3-card-1 w3-round w3-padding-small w3-blue' name='shopitemsdisplay' >GO</button><button type='submit'  class='w3-button w3-round w3-margin-left w3-light-grey  w3-padding-small' name='addshortcut'>$variable</button></td>";
  echo "<td><img src='sellerprofiles/$shopprofile' class=' w3-round-xxlarge sideshopimage' width='60' height='60'></td></form>";
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
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
</div>
</div>
<script type="text/javascript">
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
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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
/*var listuploaderror="<?php echo $_GET['profileerror']?>";
alert(listuploaderror);*/
</script>
<script type="text/javascript">
var dissatisfied=parseInt('<?php echo $dissatisfied; ?>');
var satisfied=parseInt('<?php echo $satisfied; ?>');
var good=parseInt('<?php echo $good; ?>');
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Type', 'Percentages'],
  ['Good',good],
  ['Dissatisfied',dissatisfied],
  ['Satisfied', satisfied]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Ratings', 'width':300, 'height':250,'is3D':'true'};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  chart.draw(data, options);
}
</script>

</body>
</html>
<!--
<input type='text' value='$shopname' name='shopname'><input type='text' value='$shoptype' name='shoptype'><input type='text' value='$fname' name='fname'><input type='text' value='$shopkeeperid' name='shopkeeperid'><input type='text' value='$shopprofile' name='shopkeeperprofile'>