<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>Shopin page</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="topnavbar.css">
<script type="text/javascript" src="topnavbar.js"></script>
<style type="text/css">
table,td
{
	border-collapse: collapse;
}
img
{
	border:2px solid rgb(77,166,255);
}
input[type=text]
{
	display: none;
}

</style>
</head>
<body>
<?php
require 'titlebar.php';
require 'topnavbar.html';
?>
<div class="row">
  <div class="col-lg-4 col-sm-12 w3-border-right">
<?php
if (!empty($_SESSION)) 
{
$uid=$_SESSION['userid'];
 $locateget="select * from registration where userid='$uid'";
   $locategetres=mysqli_query($con,$locateget);
   while ($row=mysqli_fetch_assoc($locategetres)) 
   {
     $mycity=$row['city'];
   } 
//echo "<a href='head.php' class='w3-button w3-small w3-light-grey w3-padding w3-round' style='text-decoration:none;'>Go to Home</a><br><br>";
if($mycity!="")
{
$sellsql="select * from seller where userid!='$uid' order by (city='$mycity')";
}
else
 {
     $sellsql="select * from seller where userid!='$uid' ";
 }
$sellresult=mysqli_query($con,$sellsql); 
if (!$sellresult) 
{
  echo mysqli_error($con);
}
if (mysqli_num_rows($sellresult)>0) 
{
  ?>
  <div class="w3-padding " style="position:sticky;top:0px;background-color:rgb(77,166,255);">
  <center>
<input type="search" class='w3-border-0' id="search" onkeyup="myFunction()" placeholder="Search Shops">
</center></div><br>
<table id="myTable" class="w3-table w3-small  w3-border-0">
<?php
 while ($row=mysqli_fetch_assoc($sellresult)) 
 {
  $shopname=$row['shopname'];
  $shoptype=$row['shoptype'];
  $fname=$row['fname'];
  $shopkeeperid=$row['userid'];
  $shopprofile=$row['profile'];
/*  if ($uid==$shopkeeperid) 
  {
    continue;
  }*/
 ?>
 <tr class='w3-border-bottom'>
  <?php
  $addcheck="select * from shopaddshortcut where shopkeeperid='$shopkeeperid' and shopname='$shopname' and shoptype='$shoptype' and userid='$uid'";
  $addcheckresult=mysqli_query($con,$addcheck);
  if (mysqli_num_rows($addcheckresult)>0) 
  {
    $variable="Added";
  }
  else
  {
    $variable="Add Shortcut";
  }
  echo "<form action='shopprocess.php' method='post'><input type='text' value='$shopname' name='shopname'><input type='text' value='$shoptype' name='shoptype'><input type='text' value='$fname' name='fname'><input type='text' value='$shopkeeperid' name='shopkeeperid'><input type='text' value='$shopprofile' name='shopkeeperprofile'>";
  echo "<td>$shopname<br>$fname<br><button type='submit' value='go' class='w3-button w3-card-1 w3-round w3-padding-small w3-blue w3-text-white' name='shopitemsdisplay' >GO</button><button type='submit'  class='w3-button w3-round w3-margin-left w3-text-black w3-light-grey w3-padding-small' name='addshortcut'>$variable</button></td>";
  echo "<td><img src='sellerprofiles/$shopprofile' class=' w3-round-xxlarge' width='60' height='60'></td></form>";
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

echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>No shops Yet.</div>";
}
}//empty
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
</div>
<div class="col-lg-8 col-sm-12">
    
</div>
</div>
<script>
	function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
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