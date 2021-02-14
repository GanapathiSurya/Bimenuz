<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>History</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require 'titlebar.php';
if(!empty($_SESSION))
{
$gethistory="select * from deliveryreg where userid='$uid' order by sno DESC";
$gethistoryres=mysqli_query($con,$gethistory);
if (mysqli_num_rows($gethistoryres)>0) 
{
?>
<!--<input class="w3-input w3-border-2" placeholder="Search here..." oninput="searchhistory()" id="searchhistory" style="position:sticky;top:0px;">-->
<?php
while ($row=mysqli_fetch_assoc($gethistoryres)) 
{
$title=$row['title'];
$number=$row['number'];
$deliveryid=$row['deliveryid'];
$price=$row['price'];
$cost=$row['cost'];
$status=$row['status'];
$datetime=$row['datetime'];
$picked=$row['picked'];
$getdeliveydetails="select name,phone,fromlocation,tolocation from bimenuzdeliveries where deliveryid='$deliveryid'";
$getdeliveydetailsres=mysqli_query($con,$getdeliveydetails);
if (mysqli_num_rows($getdeliveydetailsres)>0) 
{
?>
<table class='w3-table w3-border-bottom' id="historytable">
<?php
while ($row=mysqli_fetch_assoc($getdeliveydetailsres)) 
{
?>
<tr>
<?php
$name=$row['name'];
$phone=$row['phone'];
//$per=$row['per'];
$from=$row['fromlocation'];
$to=$row['tolocation'];
if ($picked=="no") 
{
$var2="<span class='w3-text-red'>Not picked</span>";
$var1="";
}
else 
{
$var2="<span class='w3-text-green'>Picked</span>";
if ($status=='yes') 
{
$var1="<span class='w3-text-green'>Delivered</span>";
}
else
{
$var1="<span class='w3-text-red'>Not delivered</span>";
}
}
echo "<td><b>$title</b><select class='w3-border w3-white'><option>Details</option><option>$name</option><option>$phone</option></select><br><b>$from</b> &#8674; <b>$to</b><br>Price:$price Rs<br>$number Items ,Cost:$cost Rs<br>$var2 $var1</td><td>$datetime</td>";
?>
</tr>
<?php
}
echo "</table>";
}
}
}
else
{
  echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>No History</div>";
}   
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
</center>
<script type="text/javascript">

function searchhistory() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchhistory");
  filter = input.value.toUpperCase();
  table = document.getElementById("historytable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
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