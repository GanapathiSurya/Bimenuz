<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>Delivery</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $("#details").click(function(){
    $("#detailsdiv").toggle();
  });
});
</script>
</head>
<body ng-app="">
<?php
require 'titlebar.php';
if (!empty($_SESSION)) 
{
?>
<div class="row">
<div class="col-xl-4 w3-border-right col-lg-12 col-sm-12">
<table class="table w3-border-0 w3-small">
<tr>
<td><button onclick="document.getElementById('createdelivery').style.display='block'" class="w3-button w3-margin-right w3-round-medium w3-light-grey" title="New Delivery"><b>+</b></button><br>New Delivery</td>
<td><a href="givedeliveryhistory.php">
<button onclick="" class="w3-button w3-margin-right w3-round-medium w3-amber" title="Your Fests"><b>H</b></button></a><br>History</td>
</tr>
</table>
<?php
$getmydeliveries="select * from bimenuzdeliveries where userid='$uid'";
$getmydeliveriesres=mysqli_query($con,$getmydeliveries);
if (mysqli_num_rows($getmydeliveriesres)>0) 
{
	echo "<center><h3>You Started..</h3></center>";
	while ($row=mysqli_fetch_assoc($getmydeliveriesres)) 
	{
	 $title=$row['title'];
     $deliveryid=$row['deliveryid'];
		$from=$row['fromlocation'];
		$to=$row['tolocation'];
	    $price=$row['price'];
	    //$per=$row['per'];
	  ?>

<div class="w3-border w3-margin ">
<table>
<tr>
<td class="w3-padding">
<i class="fas fa-map-marker w3-text-green w3-small"></i>
<br><?php echo $from;?>
</td>
<td class="w3-padding">
<span class="w3-text-brown w3-xxlarge">&#8674;</span>
</td>
<td class="w3-padding">
<i class="fas fa-map-marker-alt w3-text-red  w3-small"></i>
<br><?php echo $to;?>
</td>
</tr>
<tr>
<td colspan="3" class="w3-padding">
<b>Charges:</b><?php echo $price." Rs for each.";?>
</td>
</tr>	
</table>
<center>
<div class="w3-bar">
<div class="w3-bar-item">
<a href="mydeliveries.php"><button class="w3-blue  w3-round w3-button w3-padding-small">GO</button></a>	
</div>	
<div class="w3-bar-item">
<form action="bimenuzdeliverysprocess.php" method="post">
	<input type="text" name="deliveryid" value="<?php echo $deliveryid;?>" style="display: none;">
<button class="w3-red  w3-round w3-button w3-padding-small" type="submit" name="enddelivery">End</button>
</form>
</div>	
</div>
</center>
</div>
	  <?php
	}
?>
<?php
}
?>
</div>
<div class="col-lg-8">
<?php
$select="select * from bimenuzdeliveries where userid!='$uid'";
$selectres=mysqli_query($con,$select);
if (mysqli_num_rows($selectres)>0) 
{
?>
<div class="w3-padding " id="addsearch" style="position:sticky;top:5px;">
<center>
<input type="search" class='w3-border-0' id="searchdeliveries" onkeyup="searchdeliveries()" placeholder="Search here">
</center></div>
<?php
}
require 'bimenuzdeliveries.php';
?>
</div>
</div>

<div id="createdelivery" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('createdelivery').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
 <?php
if (mysqli_num_rows($getmydeliveriesres)==0) 
{
?>
<form action="bimenuzdeliverysprocess.php" enctype="multipart/form-data" method="post" class="w3-container w3-white">
        <legend>Delivery Boy</legend>
<b>Title</b><input type="text" name="title" placeholder="Title" class="w3-input" required><br>
<b>From</b><input type="text" name="start" placeholder="From" class="w3-input" required><br>
<b>To</b><input type="text" name="end" placeholder="To" class="w3-input" required><br>
<b>Charges for each item(Rs)</b><input type="number" name="price" placeholder="Price" class="w3-input" required><br>
<!--<b>Which items you want to deliver?</b>
<input name="per" class="w3-input" placeholder="Which items" required>-->
       <input type="submit" class="w3-input w3-text-white w3-round w3-blue"  name="deliverownsubmit"> 
</form>
<?php
}
else
{
	echo "Sorry you already iniated one delivery.Can't create more than one..";
}
 ?>
        
    </div>
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

function searchdeliveries() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('searchdeliveries');
  filter = input.value.toUpperCase();
  ul = document.getElementById("deliverieslist");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("span")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>
</body>
</html>