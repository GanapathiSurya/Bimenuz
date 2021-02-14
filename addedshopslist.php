<!DOCTYPE html>
<html>
<head>
  <title>Added shops</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--<link rel="stylesheet" href="https://macdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://www.w3schools.com/lib/w3.js" type="text/javascript"></script>-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<!--<script src='https://kit.fontawesome.com/a076d05399.js'></script>-->
<!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
<style type="text/css">
td
{
  width:500px;
}
input[type=text]
{
  display: none;
}
img
{
  border:2px solid rgb(77,166,255);
}

table {
  width: 100%;
  table-layout: fixed;
}
td
{
  width:200px;
}
</style>
</head>
<body>

<?php
if (!empty($_SESSION)) 
{
require 'connection.php';
$uid=$_SESSION['userid'];
?>
<!--<div class="w3-padding" id="addsearch">
<center>
<input type="search" id="search" onkeyup="myFunction()" placeholder="Search Shops" style="border:none;">
</center>
</div>-->
<?php
$shoplist="select * from shopaddshortcut where userid='$uid' order by shopname ASC";
$result=mysqli_query($con,$shoplist);
if (mysqli_num_rows($result)>0) 
{
?>
<div style="overflow-x:auto;">
<table class="w3-table w3-margin-top w3-border-0">
  <tr>
<?php
  while ($row=mysqli_fetch_assoc($result)) 
  {
    $shopname=$row['shopname'];
  $shopkeepername=$row['shopkeepername'];
  $shopkeeperid=$row['shopkeeperid'];
  $shoptype=$row['shoptype'];
  $shopprofile=$row['shopprofile'];
    if ($uid==$shopkeeperid) 
  {
   continue;
  }
  echo "<form action='shopprocess.php' method='post'><input type='text' value='$shopname' name='shopname'><input type='text' value='$shopkeepername' name='shopkeepername'><input type='text' value='$shopkeeperid' name='shopkeeperid'><input type='text' value='$shoptype' name='shoptype'>";
    echo "<td class=' w3-border w3-border-bottom-0 w3-display-container '><button type='submit' class='w3-button w3-light-grey w3-padding-small w3-display-topright' name='remove'>&#215;</button><img src='sellerprofiles/$shopprofile' class='w3-round-xxlarge' width='60' height='60'><br>$shopname<br>$shopkeepername<br><br><br><br><button type='submit' value='go' class='w3-button w3-margin-top  w3-text-white  w3-round w3-padding-small w3-medium w3-margin w3-display-bottommiddle ' style='background-color:rgb(77,166,255);' name='shopitemsdisplay'>GO</button></td></form>";
  ?>
<?php
}
?>
<!--<button type='submit' class='w3-button w3-light-grey w3-padding-small' name='remove'>&#213;</button>-->
</tr>
</table>
</div>
<?php
}
else
{
echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>No shops were added.</div>";
}
}
?>

<script>
  /*function myFunction() 
  {
    alert("jj");
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementsByClassName("addshoptable")[0];
  tr=table.getElementsByTagName("tr");
  td=tr[0].getElementsByTagName("td");
  for (i = 0; i < td.length; i++) 
  {
    alert("hello");
      txtValue = td[i].textContent || td[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) 
      {
        td[i].style.display = "";
      } 
      else {
        td[i].style.display = "none";
      }
  }
}*/
</script>
</body>
</html>