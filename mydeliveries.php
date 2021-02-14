<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>My Deliveries</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="topnavbar.css">
<script type="text/javascript" src="topnavbar.js"></script>
</head>
<body>
<?php
require 'titlebar.php';
require  'topnavbar.html';
if (!empty($_SESSION)) 
{

$getall="select * from deliveryreg where ownerid='$uid' order by sno DESC";
$getallres=mysqli_query($con,$getall);
if (mysqli_num_rows($getallres)>0) 
{
?>
<div class="w3-padding" style="position:sticky;top:5px;background-color:rgb(77,166,255);">
<center>
<input type="search" class='w3-border-0' id="searchdeliverycustomer" onkeyup="searchdeliverycustomer()" placeholder="Search here">
</center></div>
<table class='w3-table' id="deliverycustomerstable">
<?php
while ($row=mysqli_fetch_assoc($getallres)) 
{
$number=$row['number'];
$deliveryid=$row['deliveryid'];
$price=$row['price'];
$cost=$row['cost'];
$status=$row['status'];
$datetime=$row['datetime'];
$picked=$row['picked'];
$userid=$row['userid'];
$name=$row['name'];
$phone=$row['phone'];
?>
<tr class="w3-border-bottom">
<form action='bimenuzdeliverysprocess.php' method='post'>
<input type="text" name="deliveryid" value="<?php echo $deliveryid;?>" style="display:none;">
<input type="text" name="userid" value="<?php echo $userid;?>" style="display:none;">	
<input type="text" name="datetime" value="<?php echo $datetime;?>" style="display:none;">
<?php
if ($picked=="no") 
{
$var2="Picked?<button class='w3-pale-green w3-button w3-tiny w3-padding-small'  name='pick' >yes</button>";
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
$var1="Delivered?<button class='w3-pale-green w3-padding-small w3-button w3-tiny ' name='deliver'>yes</button>";
}
}
echo "<td>$name<br>$phone<br>$number Items<br><b>Cost</b>:$cost Rs</td><td>$datetime<br>$var2<br>$var1<br></td>
";
?>
</form>
</tr>
<?php
}
echo "</table>";
}
else
{
echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>No Orders Yet.</div>";
}	
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
<script type="text/javascript">

function searchdeliverycustomer() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchdeliverycustomer");
  filter = input.value.toUpperCase();
  table = document.getElementById("deliverycustomerstable");
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