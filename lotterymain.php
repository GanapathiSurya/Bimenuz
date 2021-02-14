<!DOCTYPE html>
<html>

<?php
require 'connection.php';
?>
<head>
	<title>Lottery Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  .im
  {
  	width:150px;
  	height:150px;
  	border:2px solid rgb(0,204,255);
  	transition:transform 2s;
  }
  .im:hover
  {
  	transform: rotateZ(20deg);
  }
  .number
  {
  	background-color:rgb(77,166,255);
  }
  button
  {
  	background-color:white;
  	width:60px;
  }
  button:hover
  {
  	background-color: #f2f2f2;
  }
  #resultproduct
  {
  	border:4px dashed green;
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
require 'titlebar.php';
?>
<?php
if (!empty($_SESSION)) 
{
$lotterycheckstart="select * from lotterytimings";
$lotterycheckstartresult=mysqli_query($con,$lotterycheckstart);
if (!$lotterycheckstartresult) 
{
echo mysqli_error($con)."error";
}
if (mysqli_num_rows($lotterycheckstartresult)>0) 
{
  //echo "rows are there";
 while ($row=mysqli_fetch_assoc($lotterycheckstartresult)) 
 {
  $startingdate=$row['startdate'];
  $endingdate=$row['enddate'];
  $startingtime=$row['starttime'];
  $endingtime=$row['endtime'];
  }
 date_default_timezone_set("Asia/kolkata");
$present=date("Y-m-d H:i:s");
//echo $present;
$start=$startingdate." ".$startingtime;
$end=$endingdate." ".$endingtime;
//echo "<br>HI".$end."<br>".$present;


if (($present>=$start)) 
{
	//echo "167.jjf";
	$getresponse="select gift from lotteryresult where userid='$uid'";
	$getresponseres=mysqli_query($con,$getresponse);
	if(mysqli_num_rows($getresponseres)>0)
	{
	    echo "<span class='w3-text-green w3-medium'>Your response has been recorded.</span><br>";
	}
	if (($present<=$end)) 
	{
		//echo "hellodd76";
$folder_path = "lotteryproducts"; 
$files = glob($folder_path.'/*'); 
?>
<div style="overflow-x:auto;">
<table cellspacing='20'><tr>
<?php
foreach ($files as $value) 
{
  echo "<td><img src='$value' class='w3-small  im w3-margin w3-round-large w3-card'></td>";
}
?>
</tr></table>
</div>
<div class="w3-margin  w3-medium">
	<b>Entry fee-₹1</b>
</div>
<p id="demo" class="w3-margin-left w3-large"></p>
<div class="w3-margin  w3-medium">
	<b>
	<?php
	$lotterycheck="select * from lotterytimings";
	$lotterycheckresult=mysqli_query($con,$lotterycheck);
	if (mysqli_num_rows($lotterycheckresult)>0) 
	{
		while ($row=mysqli_fetch_assoc($lotterycheckresult)) 
		{
			$deaddate=$row['enddate'];
			$deadtime=$row['endtime'];
		}
		?>
		
     <center><br><span class='w3-medium'><b>&#128197;</b></span><?php echo $deaddate;?><br><b>&#128337;</b><?php echo $deadtime;?></span></center>
		<?php
	}
	?>	
	</b>
</div>
<form action="lotteryprocess.php" method="post" style="text-align:justify;">
<?php
for($i=0;$i<200;$i++)
{
	if ($i==4) 
	{
		$num=$i+1;
	echo "<button type='submit' value='0' class='w3-padding w3-border' name='chance'>$num</button>";
	continue;
	}
	if ($i==14) 
	{
		$num=$i+1;
	echo "<button type='submit' value='1' class='w3-padding w3-border' name='chance'>$num</button>";
	continue;
	}
	if ($i==24) 
	{
		$num=$i+1;
	echo "<button type='submit' value='2' class='w3-padding w3-border' name='chance'>$num</button>";
	continue;
	}
	if ($i==34) 
	{
		$num=$i+1;
	echo "<button type='submit' value='3' class='w3-padding w3-border' name='chance'>$num</button>";
	continue;
	}
	if ($i==44) 
	{
		$num=$i+1;
	echo "<button type='submit' value='4' class='w3-padding w3-border' name='chance'>$num</button>";
	continue;
	}
	$num=$i+1;
	echo "<button type='submit' value='nogift' class='w3-padding w3-border' name='chance'>$num</button>";
}
?>
</form>
<?php
	}
	else
	{
		echo "<b>".$endingdate.$endingtime."</b><br>";
   echo "<b>Time UP!</b>";
   $resultcheck="select * from lotteryresult where userid='$uid'";
   $resultcheckresult=mysqli_query($con,$resultcheck);
   if (mysqli_num_rows($resultcheckresult)==0) 
   {
   	
   		echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>You are not participated.</div>";
   }
   else 
   {
   	$getresult="select gift from lotteryresult where userid='$uid'";
   	$getresultnow=mysqli_query($con,$getresult);
   	while ($row=mysqli_fetch_assoc($getresultnow)) 
   	{
   		$finalresult=$row['gift'];
   	}
   	if ($finalresult=='nogift') 
   	{
   		echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>You lost.</div>";
   	}
   	else
   	{
   		$lastresult="select gift from lotteryresult where userid='$uid'";
   	    $lastresultnow=mysqli_query($con,$lastresult);
   		while ($row=mysqli_fetch_assoc($lastresultnow)) 
   		{
   			//echo "hj";
   		  $gift=$row['gift'];
   		  $giftcheck="select userid from lotteryresult where gift='$gift' LIMIT 1";
   		  $giftcheckres=mysqli_query($con,$giftcheck);
   		  if (!$giftcheckres) 
   		  {
   		  	echo mysqli_error($con);
   		  }
   		  while ($row=mysqli_fetch_assoc($giftcheckres)) 
   		  {
   		  	$giftid=$row['userid'];
   		  }
   		}
   		if ($giftid!=$uid) 
   		{
   			echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>You lost.</div>";
   		}
   		else
   		{
   		    //echo $finalresult;
   			echo "<div class='w3-pale-green w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-green'>Congratulations!..You won lottery</div>";
   			echo "<img src='lotteryproducts/$finalresult' class=' w3-margin' width='170' height='170' id='resultproduct'>";
   		?>
   		<center><form action="lotteryprocess.php" method="post">
   		   Delivery Location<br><textarea rows="5" cols="20" name="place">jj</textarea><br>
   		   <input type="submit" class="w3-green w3-button w3-round w3-margin w3-large" name="lotteryaddress" value="submit">
   		</form></center>
   		<?php
   		}
   	}
   }
	}
   }
   else
   {
     ?>
     <center><br><span class='w3-medium'><b>&#128197;</b></span><?php echo $startingdate;?><br><b>   &#128337;</b><?php echo $startingtime;?></span></center>
     <?php
   	echo "";
   	echo "<div class='w3-pale-green w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-green'>Lottery will be coming soon.</div>";
   }
  }
else
{
	echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>Lottery not available now.</div>";
}	
}//empty ses
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>

<script type="text/javascript">
// Set the date we're counting down to
var countDownDate = new Date("July 16,2020 18:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "Time Up!..";
    location.reload();
  }
}, 1000);

</script>
<pre>
    
    
    
    
    
    
    
    
    
    
</pre>
</body>
</html>
