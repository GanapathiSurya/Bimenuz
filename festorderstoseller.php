<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
  <title>Fest Orders to seller</title>
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
?>
<div>
<?php
if(!empty($_SESSION))
{
?>

<?php
$uid=$_SESSION['userid'];
$festerid=$_GET['festerid'];
$sql="select * from festbuystatus where festerid='$festerid' and festshopperid='$uid' and status='notdelivered' order by sno desc";
$result=mysqli_query($con,$sql);
if(!$result)
{
  echo "Error".mysqli_error($con);
}
if (mysqli_num_rows($result)>0) 
{
echo "<a href='head.php' class='w3-button w3-small w3-light-grey w3-padding w3-round' style='text-decoration:none;'>Go to Home</a><br><br>";
  ?>
<div class="w3-padding w3-large" style="background-color:rgb(77,166,255);">
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
  $status=$row['status'];
  $userid=$row['userid'];
  $festerid=$row['festerid'];
  $sno=$row['sno'];
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
  /*if($status=='notdelivered')
  {
    $buy='<b class="w3-text-red">not delivered.</b>';
  }*/
  echo "<td><b>&#128197;$dateoforder</b><br>$firstname<br><b>Purchase:</b>$noofitems $itemsper   <b>Total cost:</b>$cost$currency<br><select><option selected>Details</option><option><span class='w3-text-green'>&#128222;</span>$phone</option><option>$city</option><option>$pincode</option></select></td><td><img src='festproducts/$itemimage' class=' w3-round-xxlarge' width='60' height='60'><br>$itemname<br>$itemprice$currency/$itemper</td>
  <td><form action='festdeliveryprocess.php' method='post'><input type='text' name='festerid' value='$festerid' style='display:none;'><input type='text' value='$sno' name='sno' style='display:none;'><button type='submit' class='w3-button w3-right' name='delete_fest_order'>&#10005;</button></form><br><span class='w3-text-red'>&#9873;</span>$address<br>$state</td>";
  ?>
  <!--<br>Delivered?<br>$buy-->
<!--  <img src='userprofiles/$userprofile' class=' w3-round-xxlarge' width='60' height='60'><i class='fa fa-map-marker w3-text-red'></i>-->
 </tr>
 <?php
 }
 ?>
 </table>
 <?php
}
else
{
  echo "<div class='w3-panel w3-pale-red w3-border-red w3-leftbar w3-padding'>No Orders for you yet.</div>";
}
?>
<?php
}
else
{
    echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>

</div>
<script>

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
