<!DOCTYPE html>
<html>	
<?php
session_start();
$con=mysqli_connect("localhost","root","","bimenuz");
if (!$con) 
{
    die("Connection failed".mysqli_error());
}
?>
<head>
	<title>Invitees</title>
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
</head>
<body>
<?php
if (!empty($_SESSION)) 
{
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
$invitee="select * from festshoppers where festshopperid='$uid'";
$inviteeresult=mysqli_query($con,$invitee);
if (mysqli_num_rows($inviteeresult)>0) 
 {
 ?>
 <table class="table w3-border-0">
 <?php
 	while ($row=mysqli_fetch_assoc($inviteeresult)) 
 	{
 ?>
 <tr>
 <?php
 		$festerid=$row['festerid'];
 		$getfestdetails="select * from fests where userid='$festerid'";
 		$getfestdetailsres=mysqli_query($con,$getfestdetails);
 		while($row=mysqli_fetch_assoc($getfestdetailsres))
 		{
		$festname=$row['festname'];
		$festdate=$row['festdate'];
		$festtime=$row['festtime'];
 		}
    ?>
    <form><td><b><?php echo $festname;?></b><br>&#8702;<?php echo $festdate." ".$festtime;?></td><td><button class='w3-button w3-padding-small w3-amber w3-round w3-margin'>Go</button></td></tr>
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
 	echo "No Invitations Yet.";
 }
 ?>
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
</body>
</html>