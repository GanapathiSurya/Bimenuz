<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
<title>FestShopitemsdisplay</title>

<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<div class="col-lg-6  col-sm-12 w3-border-right">
<div class="w3-bar w3-border-bottom">
<?php
$festerid=$_GET['festerid'];
$festshopperid=$_GET['festshopperid'];
$festshoppername=$_GET['festshoppername'];
$festshopperphone=$_GET['festshopperphone'];
$festshopname=$_GET['festshopname'];
?>
<div class="w3-bar-item">
<?php
echo "<h3><span style='font-family:pristina;' class='w3-xxlarge'>$festshopname</span></h3>";
echo $festshoppername."<br>";
echo "<i class='fa fa-phone w3-text-green'></i>$festshopperphone";
}
?>
<!--<a href="accountsettings.php">
<div class="w3-padding" style="background-color:rgb(77,166,255);width:50px;height:48px;color:white;border-radius:50%"><i class="fa fa-pencil" aria-hidden="true" style="font-size:20px;"></i>
</div>
</a>--> 
</div>
</div>
<?php
if(!empty($_SESSION))
{
 ?>
 
<?php
$stock = "SELECT * FROM festproducts where festerid='$festerid' and festshopperid='$festshopperid'";
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
  $itemname=$row['itemname'];
    $itemprice=$row['itemprice'];
    $itemper=$row['itemper'];
    $itemimage=$row['itemimage'];
    $currency=$row['itemcurrency'];
 ?>
 <tr>
  <?php
  echo "<form action='productdetailsprocess.php' method='post'><input type='text' name='itemname' value='$itemname'><input type='text' name='itemprice' value='$itemprice'><input type='text' name='itemper' value='$itemper'><input type='text' name='itemimage' value='$itemimage'><input type='text' name='currency' value='$currency'><input type='text' name='festerid' value='$festerid'><input type='text' name='festshopperid' value='$festshopperid'>";
  echo "<td class='w3-border-0'><img src='festproducts/$itemimage' class=' w3-round-xxlarge' width='60' height='60'></td><td class='w3-border-0'>$itemname<br>$itemprice$currency/$itemper</td><td class='w3-border-0'><button type='submit' value='go' class='w3-button w3-blue w3-text-white w3-card-1 w3-round w3-padding-small' name='fest_product_detail_submit'>GO</button></a></td>";
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
<div class="col-lg-6 col-sm-12 w3-border-left">
<?php
if (empty($_SESSION)) 
{
echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>"; 
}
else
{
$festerid=$_GET['festerid'];
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
      $festerphone=$row['festshopperphone'];
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
</body>
</html>
<!--
<input type='text' value='$shopname' name='shopname'><input type='text' value='$shoptype' name='shoptype'><input type='text' value='$fname' name='fname'><input type='text' value='$shopkeeperid' name='shopkeeperid'><input type='text' value='$shopprofile' name='shopkeeperprofile'>