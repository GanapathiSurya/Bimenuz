<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>My Fests</title>
	 <link rel="stylesheet" type="text/css" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://macdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://www.w3schools.com/lib/w3.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style type="text/css">

.festprofile
{
	border:2px solid rgb(77,166,255);
	width:70px;
	height:70px;
	border-radius:50%;
}
@media screen and (max-width:800px)
{
  #name
  {
    display: none;
  }
}
@media screen and (max-width:240px)
{
  #logosss
  {
    width:30px;
    height:30px;
    margin: 0px;
  }
  #brandsss
  {
    width:80px;
    height:35px;
    margin: 0px;
  }
}
@media screen and (max-width:240px)
{
#logosss
{
  width:40px;
  height:40px;
}
#brandsss
{
  width:110px;
  height:40px;
}
}
button.sl
{
  width:30px;
  height:30px;
}

@media screen and (max-width:320px)
{
  #brandsss
{
  width:100px;
  height:40px;
}
#logosss
{
  width:40px;
  height:40px;
}
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
 $uid=$_SESSION['userid'];
 $myname=$_SESSION['firstname'];
 $myfestscheck="select * from fests where userid='$uid'";
 $myfestscheckresult=mysqli_query($con,$myfestscheck);
 if (!$myfestscheckresult) 
 {
 	echo mysqli_error($con);
 }
 if (mysqli_num_rows($myfestscheckresult)>0) 
 {
 ?>
 <table class="table w3-border-0">
 <?php
 	while ($row=mysqli_fetch_assoc($myfestscheckresult)) 
 	{
     	$festname=$row['festname'];
     	$festdate=$row['festdate'];
     	$festtime=$row['festtime'];
     	$festvenue=$row['festvenue'];
     	$festprofile=$row['festprofile'];	
     	$festerid=$row['userid'];
    ?>
    <tr><form action="eventprocess.php" method="post">
    <input type="text" name="festerid" style="display:none;" value="<?php echo $festerid;?>">
    <input type="text" name="festprofile" style="display:none;" value="<?php echo $festprofile;?>"><td><b><?php echo $festname;?></b><br>&#8702;<?php echo $festdate." ".$festtime;?><br><i class='fa fa-map-marker w3-text-red'></i><?php echo $festvenue;?></td><td><img src='festprofiles/<?php echo $festprofile;?>' class='w3-round festprofile'></td></tr>
    <tr><td><button class='w3-button w3-padding-small w3-blue w3-round w3-margin' type="submit" name="myfestgo">Go</button></td></form><td><button class='w3-button w3-padding-small w3-light-grey w3-round ' onclick='document.getElementById("addfestshops").style.display="block"'>Add shops</button></td></tr>
    <?php
 	}
 	?>
 </table>
<button onclick="sentids('sentones')" class="w3-button w3-block w3-light-grey" style="outline: none;">Sent <i class="fas fa-caret-down"></i></button>
 <div id="sentones" class="w3-hide">
  <?php

$sentee="select distinct festshopperid from festshoppers where festerid='$uid'";
$senteeresult=mysqli_query($con,$sentee);
if (mysqli_num_rows($senteeresult)>0) 
 {
 ?>
 <table class="table w3-border-0">
 <?php
  while ($row=mysqli_fetch_assoc($senteeresult)) 
  {
  	$sentid=$row['festshopperid'];
 ?>
 <tr>
   <form><td><?php echo $sentid;?></td></tr>
</tr>
  <?php
  }
  ?>
 </table>
  <?php
 }
 else
 {
  echo "No Sent Information.";
 }
  ?>
</div>
<form action="eventprocess.php" method="post">
  <button type="submit" class="w3-button w3-padding w3-red w3-block" name="end_fest">End Fest</button>
</form>
<br>
<p class="w3-margin"><b>NOTE:</b>Be careful if you press the 'end fest' button ,the entire fest will no more be on online.</p>
 	<?php
 }
 else
 {

  echo "<br><div class='w3-large w3-leftbar w3-panel w3-pale-red w3-border-red w3-padding'>No Fest Events Yet.</div>";
 }
 ?>
 <div id="addfestshops" class="w3-modal">
    <div class="w3-modal-content w3-padding">
      <span onclick="document.getElementById('addfestshops').style.display='none'" class="w3-button w3-display-topright">&times;</span>
      <form action="eventprocess.php" method="post" enctype="multipart/form-data">

 	Your Id:<input type="text" name="festerid" class='w3-input' value="<?php echo $festerid;?>" readonly><br>

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
 	<span class="w3-padding w3-margin w3-red">Instructions</span><br><br>
 	<b>Add shops of sellers here by providing their userid's here with comma separated text carefully...</b><br>
 	<b>NOTE:</b><br>
 	1.For adding of multiple shops->>Enter like <span style="text-decoration:underline;font-weight:bolder;">userid1,userid2,userid3,userid4,userid5</span><br>
 	2.For adding of single shop at a time->>Enter normally like <span style="text-decoration: underline;font-weight: bolder;">userid</span>
 	<input type="text" name="festshopowners" class="w3-input w3-border">
 	<button type="submit" class="w3-button w3-padding w3-blue w3-round w3-margin" name="add_fest_shops_submit" >Add</button>
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

function sentids(id) {
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