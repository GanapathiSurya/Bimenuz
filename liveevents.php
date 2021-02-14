<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>Live Events</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
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
 /* #addsearch
  {
    background-color: rgb(77,166,255);
  }*/
}
#topprofile
{
	border:2px solid rgb(77,166,255);
}
.festprofile
{
	border:2px solid rgb(77,166,255);
	width:70px;
	height:70px;
	border-radius:50%;
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
if(!empty($_SESSION))
{
?>
<div class="row">
<div class="col-lg-3">
<table class="table w3-border-0 w3-small">
<tr>
<td><button onclick="document.getElementById('createfest').style.display='block'" class="w3-button w3-margin-right w3-round-medium w3-blue" title="New Fest"><b>+</b></button><br>New Fest</td>
<!--
<td><a href="">
<button onclick="" class="w3-button w3-margin-right w3-round-medium w3-green" title="Your Fests"><i class="fa fa-user-plus"></i></button></a><br>Invitee</td>-->
<td><a href="myfests.php">
<button onclick="" class="w3-button w3-margin-right w3-round-medium w3-light-grey" title="Your Fests"><b>H</b></button></a><br>MyFests</td>
</tr>
</table>
<button onclick="showinvitations('notify')" class="w3-button w3-small w3-block w3-light-grey w3-hover-light-grey" style="outline: none;"> Invitations<i class="fas fa-caret-down"></i></button>
<div id="notify" class="w3-hide">
  <?php

$invitee="select * from festshoppers where festshopperid='$uid'";
$inviteeresult=mysqli_query($con,$invitee);
if (mysqli_num_rows($inviteeresult)>0) 
 {
 ?>
 <table class="table w3-border-0 w3-small">
 <?php
  while ($row=mysqli_fetch_assoc($inviteeresult)) 
  {
 ?>
 <tr>
 <?php
    $festerid=$row['festerid'];
    //echo $festerid;
    $getfestdetails="select * from fests where userid='$festerid'";
    $getfestdetailsres=mysqli_query($con,$getfestdetails);
    while($row=mysqli_fetch_assoc($getfestdetailsres))
    {
    $festname=$row['festname'];
    $festdate=$row['festdate'];
    $festtime=$row['festtime'];
    $festprofile=$row['festprofile'];
    $festvenue=$row['festvenue'];
    }
    ?>
  <form action="eventprocess.php" method="post"><input type="text" name="festname" value="<?php echo $festname;?>" style="display: none;"><input type="text" name="festdate" value="<?php echo $festdate;?>" style="display: none;"><input type="text" name="festtime" value="<?php echo $festtime;?>" style="display: none;"><input type="text" name="festprofile" value="<?php echo $festprofile;?>" style="display: none;"><input type="text" name="festerid" value="<?php echo $festerid;?>" style="display: none;"><input type="text" name="festvenue" value="<?php echo $festvenue;?>" style="display: none;"><td><b><?php echo $festname;?></b><br>&#8702;<?php echo $festdate." ".$festtime;?></td><td><button class='w3-button w3-padding-small w3-text-white w3-round w3-margin' style="background-color: rgb(77,166,255);" type="submit" name="fest_add_shop">Join</button></td></form>
    <?php
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
  echo "<br><span class='w3-large w3-leftbar w3-pale-red w3-border-red w3-padding'>No Invitations Yet.</span>";
 }
  ?>
</div>
</div>
<div class="col-lg-9">
<?php
$eventscheck="select * from fests";
$eventscheckresult=mysqli_query($con,$eventscheck);
if (!$eventscheckresult) 
{
	echo "136".mysqli_error($con);
}
if (mysqli_num_rows($eventscheckresult)>0) 
{
?>
<div class="w3-padding " id='searchdiv'>
  <center>
<input type="search" class='w3-border-0' id="search" onkeyup="myFunction()" placeholder="Search Fests..">
</center></div>
<table id="myTable" class="w3-table w3-border-0 w3-small">
<?php
	while ($row=mysqli_fetch_assoc($eventscheckresult)) 
	{
		$festerid=$row['userid'];
		$festname=$row['festname'];
		$festdate=$row['festdate'];
		$festtime=$row['festtime'];
		$festcity=$row['festcity'];
		$feststate=$row['feststate'];
    $festprofile=$row['festprofile'];
		$festpincode=$row['festpincode'];
		$festvenue=$row['festvenue'];
		$festcountry=$row['festcountry'];
		$festprofile=$row['festprofile'];
		//echo "ll.".$festprofile;
		//$getfester="select * from registration where userid='$uid'";
		//$getfesterresult=mysqli_query($con,$getfester);
		//while ($row=mysqli_fetch_assoc($getfesterresult)) 
		//{
		 //$festername=$row['firstname'];
		 //$festerphone=$row['phone'];
		 //$festerprofile=$row['profile'];
		//}
?>
<!--<td><img src='festprofiles/$festprofile' class='w3-round festprofile'><br><button class='w3-btn w3-padding-small w3-amber w3-round w3-margin'>Go</button></td>-->
<tr class="w3-border">
<?php
echo "<form action='eventprocess.php' method='post' enctype='multipart/form-data'>
<input type='text' name='festerid' value='$festerid' style='display:none;'>
<input type='text' name='festprofile' value='$festprofile' style='display:none;'>
<td><b>$festname</b><br>&#8702;$festdate $festtime<br><i class='fa fa-map-marker w3-text-red'></i>$festvenue<br><button class='w3-button w3-block w3-padding-small w3-round w3-margin-top w3-text-white' type='submit' style='background-color:rgb(77,166,255)' name='gotofest'>Visit</button></td><td></td>
</form>";
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
  echo "<br><div class='w3-large w3-leftbar w3-panel w3-pale-red w3-border-red w3-padding'>No Live Events Yet.</div>";
 }
?>
</div>
</div>
<div id="createfest" class="w3-modal">
    <div class="w3-modal-content">
      <span onclick="document.getElementById('createfest').style.display='none'" class="w3-button w3-display-topright">&times;</span>
    <form action="eventprocess.php" class="w3-padding" method="post" enctype="multipart/form-data"> 
      <?php
        if (@$_GET['error']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium w3-text-grey ">
        *<?php echo $_GET['error'];?>
        </div><br> 
        <?php
        }
        ?>  
    <h3>FEST DETAILS</h3><hr>      	
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><b>Fest Name</b></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="festname" type="text" placeholder="Fest Name">
    </div>
</div>
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><b>Fest Date</b></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="festdate" type="date" placeholder="Fest Date">
    </div>
</div>
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><b>Fest Time</b></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="festtime" type="time" placeholder="Fest Time">
    </div>
</div>
        <b>City</b><br>
        <input type="text" name="festcity" class="w3-input w3-border" >
        <b>Pincode</b><br>
        <input type="number" name="festpincode" class="w3-input w3-border" >
        <b>State</b><br>
        <input type="text" name="feststate" class="w3-input w3-border" >
        <b>Country</b><br>
        <input type="text" name="festcountry" class="w3-input w3-border">
        <b>Venue</b><br>
        <textarea name="festvenue" cols="30" rows="5">
        </textarea>
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px;"><font class="w3-text-black"><b>Fest Profile</b></font></div><br>
  <div class="w3-rest">
  <input class="w3-input w3-border-0" type="file"  name="festprofile"  placeholder="Choose profile">
  </div>
</div>
<input type="submit" value="Submit" class="w3-button w3-round-xxlarge w3-block w3-hover-blue w3-section  w3-ripple w3-padding" style="background-color: rgb(77,166,255);color:black" name="fest_create_submit">

       </form>
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
function showinvitations(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
</body>
</htm>