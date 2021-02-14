<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
  <title>Orders to seller</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
</style>
</head>
<body>
<?php
require 'titlebar.php';
if(!empty($_SESSION))
{
?>

<table class="w3-table">
<tr>
<td><button class="w3-round w3-button w3-light-grey" onclick="openCity('no')">Not delivered</button></td>
<td><button class="w3-round w3-button w3-light-grey" onclick="openCity('yes')">Delivered</button></td>
</tr>
</table>
<div id="no" class="status">
<?php
$uid=$_SESSION['userid'];
$sql="select * from buystatus where sellerid='$uid' and statusbuy='notdelivered' order by sno desc";
$result=mysqli_query($con,$sql);
if(!$result)
{
  echo "Error".mysqli_error($con);
}
if (mysqli_num_rows($result)>0) 
{
  ?>
<div class="w3-padding w3-large " style="background-color:rgb(77,166,255);">
<center>
<input type="search" class="w3-border-bottom w3-border-0" id="searchname" onkeyup="myFunctioname()" placeholder="Search names">
<input type="search" class="w3-border-bottom w3-border-0" id="search" onkeyup="myFunction()" placeholder="Search items">
</center></div><br>
<table id="myTable" class="w3-table w3-small w3-striped w3-border-0">
  <?php
 while ($row=mysqli_fetch_assoc($result)) 
 {
  $itemimage=$row['itemimage'];
  $itemname=$row['itemname'];
  $itemprice=$row['itemprice'];
  $currency=$row['currency'];
  $itemper=$row['itemper'];
  $itemsper=$row['itemsper'];
  $noofitems=$row['noofitems'];
  $cost=$row['cost'];
  $dateoforder=$row['datetimebuy'];
  $statusbuy=$row['statusbuy'];
  $userid=$row['userid'];
  $sqls="select * from registration where userid='$userid'";
  $results=mysqli_query($con,$sqls);
  while($row=mysqli_fetch_assoc($results))
  {
    $firstname=$row['firstname'];
    $userprofile=$row['profile'];
    $phone=$row['phone'];
    $city=$row['city'];
    $state=$row['state'];
    $country=$row['country'];
    $address=$row['address'];
    $pincode=$row['pincode'];
  }
 ?>
 <tr>
  <?php
  if($statusbuy=='notdelivered')
  {
    $buy='<b class="w3-text-red">not delivered.</b>';
    //$buy='';
  }
  else
  {
    $buy='<b class="w3-text-green">delivered.</b>';
  }
  echo "<form action='' method='post'>";
  echo "<td><b>&#128197;$dateoforder</b><br>$firstname<br><b>Purchase:</b>$noofitems $itemsper   <b>Total cost:</b>$cost$currency<br><select><option selected>Details</option><option><span class='w3-text-green'>&#128222;</span>$phone</option><option>$city</option><option>$pincode</option></select></td><td><img src='fruits/$itemimage' class=' w3-round-xxlarge' width='60' height='60'><br>$itemname<br>$itemprice$currency/$itemper</td>
  <td><span class='w3-text-red'>&#9873;</span>$address<br>$buy</td>";
  echo "</form>";
  ?>
<!--  <img src='userprofiles/$userprofile' class=' w3-round-xxlarge' width='60' height='60'><i class='fa fa-map-marker w3-text-red'></i>-->
 </tr>
 <?php
 }
 ?>
 </table>
 <?php
}
?>

</div>
<div id="yes" class="status" style="display:none">
<?php
$uid=$_SESSION['userid'];
$sql="select * from buystatus where sellerid='$uid' and statusbuy='delivered' order by sno desc";
$result=mysqli_query($con,$sql);
if(!$result)
{
  echo "Error".mysqli_error($con);
}
if (mysqli_num_rows($result)>0) 
{
  ?>
<div class="w3-padding " style="background-color:rgb(77,166,255);">
<center>
<input type="search" class="w3-border-bottom w3-border-0" id="searchname" onkeyup="myFunctioname()" placeholder="Search names">
<input type="search" class="w3-border-bottom w3-border-0" id="search" onkeyup="myFunction()" placeholder="Search items">
</center></div><br>
<table id="myTable" class="w3-table w3-small w3-striped w3-border-0">
  <?php
 while ($row=mysqli_fetch_assoc($result)) 
 {
  $itemimage=$row['itemimage'];
  $itemname=$row['itemname'];
  $itemprice=$row['itemprice'];
  $currency=$row['currency'];
  $itemper=$row['itemper'];
  $itemsper=$row['itemsper'];
  $noofitems=$row['noofitems'];
  $cost=$row['cost'];
  $dateoforder=$row['datetimebuy'];
  $statusbuy=$row['statusbuy'];
  $userid=$row['userid'];
  $sqls="select * from registration where userid='$userid'";
  $results=mysqli_query($con,$sqls);
  while($row=mysqli_fetch_assoc($results))
  {
    $firstname=$row['firstname'];
    $userprofile=$row['profile'];
    $phone=$row['phone'];
    $city=$row['city'];
    $state=$row['state'];
    $country=$row['country'];
    $address=$row['address'];
    $pincode=$row['pincode'];
  }
 ?>
 <tr>
  <?php
  if($statusbuy=='notdelivered')
  {
    $buy='<b class="w3-text-red">not delivered.</b>';
  }
  else
  {
    $buy='<b class="w3-text-green">delivered.</b>';
  }
  echo "<form action='' method='post'>";
  echo "<td><b>&#128197;$dateoforder</b><br>$firstname<br><b>Purchase:</b>$noofitems $itemsper   <b>Total cost:</b>$cost$currency<br><select><option selected>Details</option><option><i class='fas fa-phone w3-text-green'></i>$phone,</option></select></td><td><img src='fruits/$itemimage' class=' w3-round-xxlarge' width='60' height='60'><br>$itemname<br>$itemprice$currency/$itemper</td>
  <td><span class='w3-text-red'>&#9873;</span>$address<br>$pincode<br>Delivered?<br>$buy</td>";
  echo "</form>";
  ?>
<!--  <img src='userprofiles/$userprofile' class=' w3-round-xxlarge' width='60' height='60'><i class='fa fa-map-marker w3-text-green'></i>-->
 </tr>
 <?php
 }
 ?>
 </table>
 <?php
}
?>
</div>
<?php
}
else
{
echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
<script>
function openCity(status) {
  var i;
  var x = document.getElementsByClassName("status");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(status).style.display = "block";  
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
function myFunctioname() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchname");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
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
</script>

</body>
</html>
