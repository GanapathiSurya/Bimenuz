<!DOCTYPE html>
<html>
<?php
 require 'connection.php';
?>
<head>
<title>Fest Account</title>

<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  td
  {
  	border:none;
  }
  a
  {
  	color: black;
  	text-decoration:underline;
  }

@media screen and (max-width:1000px)
{
   #festprofile
  {
    height:280px;
  }
}
@media screen and (max-width:600px)
{
  #festprofile
  {
    height:200px;
  }
}
@media screen and (min-width:1000px)
{
   #festprofile
  {
    height:280px;
  }
}
@media screen and (max-width:1000px)
{
  #searchdiv
  {

    background-color:rgb(77,166,255);
  }
}

@media screen and (min-width:990px)
{
  #searchdiv
  {

    background-color:#f2f2f2;
  }
}
#searchdiv
{
    top:0px;
    position:sticky;
}
</style>
</head>
<body>
<?php
require 'titlebar.php';
?>
<?php
if (empty($_SESSION)) 
{
echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
elseif (!empty($_SESSION)) 
{
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
$festerid=$_GET['festerid'];
?>
<div class="row">
<div class="col-lg-4 w3-border-right">
<?php
$getfestdetails="select * from festshopperdetails where festerid='$festerid' and festshopperid='$uid'";
$getfestdetailsresult=mysqli_query($con,$getfestdetails);
if(mysqli_num_rows($getfestdetailsresult)>0)
{
  while($row=mysqli_fetch_assoc($getfestdetailsresult))
  {
    $festname=$row['festname'];
    $festdate=$row['festdate'];
    $festtime=$row['festtime'];
    $festprofile=$row['festprofile'];
    $festvenue=$row['festvenue'];
    if($row['festshopname']!='NULL')
    {
      $festshopname=$row['festshopname'];
    }
  }
?>
<img src="festprofiles\<?php echo $festprofile;?>" class='w3-border-bottom' width='100%' id='festprofile'>
<button onclick="showname('shopname')" class="w3-button w3-block w3-light-grey w3-left-align w3-hover-light-grey" style="outline:none;">Name your shop here<i class="fa fa-caret-down"></i></button>
<div id="shopname" class="w3-container w3-hide">
  *Mandatory for your shop appearance..
  <form action="eventprocess.php" method='post' class="w3-margin">
    <input type="text" name="festerid" value="<?php echo $festerid;?>" style="display:none;">
    <input type="text" class='w3-input w3-margin w3-border' name="festshopname"><br>
    <button class="w3-button w3-blue w3-round w3-padding" type="submit" name="fest_shop_name_submit">Confirm</button>
  </form>
</div>
<button class='w3-padding-small w3-light-grey w3-border-0 w3-round-large w3-hover-gray w3-hover-text-white w3-margin' style="" onclick="document.getElementById('product').style.display='block'"><font size='4'>&#10010;New product</font></button>
<form action="eventprocess.php" method="post">
<input type="text" name="festerid" style="display: none;" value="<?php echo $festerid;?>">
<button class='w3-padding-small w3-light-grey w3-border-0 w3-round-large w3-hover-gray w3-hover-text-white w3-margin' type="submit" name="orders_submit"><font size='4'>Orders</font></button>
</form>
<div id="product" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container w3-padding">
      <span onclick="document.getElementById('product').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <form action="eventprocess.php" method="post" enctype="multipart/form-data">
        <b>OrganizerId</b>
        <input type="text" name="productfesterid" value="<?php echo $festerid;?>" readonly>
        <?php
        if (@$_GET['itemexist']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['itemexist'];?></div>  
        <?php
        }
        ?>
        <?php
        if (@$_GET['error']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['error'];?></div>  
        <?php
        }
        ?>
        <div class="w3-row w3-section">
            Item name<input class="w3-input w3-border " name="itemname" type="text" required>
         </div>
         <div class="w3-bar">
          <div class="w3-bar-item">Price<input class="w3-border" name="itemprice" type="number" placeholder="price" required oninput='this.value = Math.abs(this.value)'>
          </div>
            <div class="w3-bar-item">
            <select name="itemcurrency" required>
            <option value="Rs" selected>Rupee</option>
            </select>
            </div>           
            <div class="w3-bar-item">per/
            <select name="itemper" required>
            <option value="item" selected>item</option>
            <option value="kg">kg</option>
            <option value="dozen">dozen</option>  
            </select>
            </div>           
         </div>
         
         <input type="file" name="itemimage">
         <br><br>
        <button type="submit" name="fest_product_upload" class="w3-input w3-button w3-light-grey">Confirm</button>
      </form>
    </div>
  </div>
</div>
<?php
}
?>
</div>
<div class="col-lg-8">
<?php
$festproducts="select * from festproducts where festerid='$festerid' and festshopperid='$uid'";
$festproductsresult=mysqli_query($con,$festproducts);
if(!$festproductsresult)
{
  echo mysqli_error($con)."222";
}
if(mysqli_num_rows($festproductsresult)>0)
{
if(isset($festshopname))
{
  echo "<b><span style='font-family:cursive;' class='w3-xxlarge w3-center'>".$festshopname."</span></b>";
}
?> 
<div class="w3-padding " id="searchdiv">
<center>
<input type="search" id="itemsearch" onkeyup="myfestshopitems()" placeholder="Search items" class="w3-border-0">
</center></div><br>
  <table id="itemtable" class="w3-table w3-striped w3-border-0">
  <?php
 while ($row=mysqli_fetch_assoc($festproductsresult)) 
 {
    $itemname=$row['itemname'];
    $itemprice=$row['itemprice'];
    $itemper=$row['itemper'];
    $itemimage=$row['itemimage'];
    $currency=$row['itemcurrency'];
 ?>
 <tr>
  <?php
  echo "<form action='' method='post'>";
  echo "<td class='w3-border-0'><img src='festproducts/$itemimage' class=' w3-round-xxlarge' width='60' height='60'></td><td class='w3-border-0'>$itemname<br>$itemprice$currency/$itemper</td><td class='w3-border-0'></td>";
  echo "</form>";
  ?>
 </tr>
 <?php
 }
 ?>
 </table>
</div>
</div>
<?php
}
}
?> 
<script type="text/javascript">

  function myfestshopitems() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("itemsearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("itemtable");
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

function showname(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
</body>
</html>