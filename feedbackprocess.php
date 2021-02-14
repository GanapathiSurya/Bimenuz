<!DOCTYPE html>
<html>
<head>
	<?php
	require 'connection.php';
if(!empty($_SESSION))
{
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
}
?>
	<title>feedback Completed</title>
<meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="w3.css">
</head>
<body>
<?php
if (isset($_POST['feedback'])) 
{
	$feedback=$_POST['feedback'];
	$sellerid=$_POST['sellerid'];
	$sno=$_POST['sno'];
	$shopcheck="select * from ratings where sellerid='$sellerid'";
	$shopcheckres=mysqli_query($con,$shopcheck);
	if (mysqli_num_rows($shopcheckres)==0) 
	{
		echo "empty";
	 $firstinsert="insert into ratings values('$sellerid','0','0','0')";
	 $firstinsertres=mysqli_query($con,$firstinsert);
	}
	if ($feedback=='dissatisfied') 
	{
		$updatefeed="update ratings set dissatisfied=dissatisfied+1 where sellerid='$sellerid' ";
		$updatefeedres=mysqli_query($con,$updatefeed);
		$updaterate="update buystatus set dissatisfied=dissatisfied+1 where sno='$sno' ";
		$updaterateres=mysqli_query($con,$updaterate);
	}

	if ($feedback=='satisfied') 
	{
		$updatefeed="update ratings set satisfied=satisfied+1 where sellerid='$sellerid'";
		$updatefeedres=mysqli_query($con,$updatefeed);
		$updaterate="update buystatus set satisfied=satisfied+1 where sno='$sno' ";
		$updaterateres=mysqli_query($con,$updaterate);
	}
	if ($feedback=='good') 
	{
		$updatefeed="update ratings set good=good+1 where sellerid='$sellerid'";
		$updatefeedres=mysqli_query($con,$updatefeed);
		$updaterate="update buystatus set good=good+1 where sno='$sno' ";
		$updaterateres=mysqli_query($con,$updaterate);
	}
	if (!$updatefeedres) 
	{
		echo "updated";
	}
	$URL="head.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

	//echo "<h1>Thanks for your feedback..</h1>";
	//echo "<button class='w3-green w3-padding w3-button'>Home</button>";
}
?>
</body>
</html>